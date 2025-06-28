<?php

namespace App\Http\Controllers;

use App\Helpers\TextHelper;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Topic;
use App\Models\UserAnswerQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MockTestController extends Controller
{
    public function show()
    {
        $mockTest = Topic::orderBy('num_order', 'asc')->take(4)->get();
        return view('mock-test.index', compact('mockTest'));
    }

    public function start(Request $request, $slug)
    {
        $testType = Topic::where('slug', $slug)->firstOrFail();


        if (!$request->session()->has('mock_test_attempt_id')) {
            $attemptId = (string) Str::uuid();
            $request->session()->put('mock_test_attempt_id', $attemptId);
        } else {
            $attemptId = $request->session()->get('mock_test_attempt_id');
        }

        //  Đếm số câu đúng
        if ($slug === 'civics') {
            $correctAnswersCount = UserAnswerQuestion::where('attempt_id', $attemptId)
                ->where('is_correct', true)
                ->whereHas('question.topic', function ($q) use ($slug) {
                    $q->where('slug', $slug);
                })
                ->count();

            if ($correctAnswersCount >= 6) {
                return redirect()->route('mock-test.prepare', 'reading');
            }
        }

        $page = (int) $request->query('page', 1);
        $question = $testType->questions()->with('answers')->skip($page - 1)->take(1)->first();
        if ($question) {
            $question->setRelation('answers', $question->answers->shuffle());
        }

        $total = match ($slug) {
            'civics' => 10,
            'reading', 'writing' => 1,
            'n400' => 5,
            default => $testType->questions()->count(),
        };

        // Kiểm tra nếu đã trả lời đủ số câu thì chuyển sang phần tiếp theo
        $answeredCount = UserAnswerQuestion::where('attempt_id', $attemptId)
            ->whereHas('question.topic', function ($q) use ($slug) {
                $q->where('slug', $slug);
            })
            ->count();


        if ($slug === 'civics' && $answeredCount >= 10) {
            return redirect()->route('mock-test.prepare', 'reading');
        }

        // TODO: Fix => chỉ giả lập 5 lần, nhớ fix
        if ($slug === 'n400' && $answeredCount >= 5) {
            return redirect()->route('mock-test.result');
        }

        $view = match ($slug) {
            'civics' => 'mock-test.start-civic',
            'reading' => 'mock-test.start-reading',
            'writing' => 'mock-test.start-writing',
            'n400' => 'mock-test.start-n400',
        };

        return view($view, compact('testType', 'question', 'page', 'total', 'attemptId'));
    }

    public function submitAnswer(Request $request, $slug)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'answer_id' => 'nullable|exists:answers,id',
            'answer_text' => 'nullable|string',
        ]);

        $questionId = $request->question_id;
        $answerId = $request->answer_id;
        $answerText = $request->answer_text;
        $questionContent = $request->question_content;

        $additionalField = $request->additional_field;
        $attemptId = session()->get('mock_test_attempt_id');

        if (!$attemptId) {
            return redirect()->route('start.mock-test', $slug)->with('error', 'Bài thi chưa được khởi tạo.');
        }

        $question = Question::with('answers')->findOrFail($questionId);
        $isCorrect = false;

        if ($answerText) {
            // $isCorrect = strtolower(trim($questionContent)) === strtolower(trim($answerText));
            $isCorrect = TextHelper::normalizeText($questionContent) === TextHelper::normalizeText($answerText);
        }

        if ($question->type === 'multiple_choice' && $answerId) {
            $isCorrect = Answer::where('id', $answerId)->where('is_correct', true)->exists();
        }

        $testType = Topic::where('slug', $slug)->firstOrFail();
        $currentPage = (int) $request->query('page', 1);
        $total = $testType->questions()->count();
        $maxAttempts = $testType->max_attempts ?? 1;


        // Check nếu đã có câu trả lời trước đó thì update
        $userAnswer = UserAnswerQuestion::where('attempt_id', $attemptId)
            ->where('question_id', $questionId)
            ->first();

        if ($userAnswer) {
            $userAnswer->update([
                'answer_id' => $answerId,
                'answer_text' => $answerText,
                'additional_answer' => empty($additionalField) ? null : $additionalField,
                'is_correct' => $isCorrect,
                'answered_at' => now(),
            ]);
        } else {
            UserAnswerQuestion::create([
                'attempt_id' => $attemptId,
                'user_id' => Auth::user()->id,
                'question_id' => $questionId,
                'answer_id' => $answerId,
                'answer_text' => $answerText,
                'additional_answer' => empty($additionalField) ? null : $additionalField,
                'is_correct' => $isCorrect,
                'answered_at' => now(),
            ]);
        }

        // Nếu là reading và sai thì xử lý retry
        if ($slug === 'reading') {
            if ($redirect = $this->handleRetry('reading', $questionId, $currentPage, $maxAttempts, $isCorrect, 'writing')) {
                return $redirect;
            }
        }

        // Nếu là writing và sai thì xử lý retry
        if ($slug === 'writing') {
            if ($redirect = $this->handleRetry('writing', $questionId, $currentPage, $maxAttempts, $isCorrect, 'n400')) {
                return $redirect;
            }
        }


        // Chuyển trang tiếp theo nếu không phải writing hoặc đúng
        if ($currentPage >= $total) {
            $top4Topics = Topic::orderBy('id')->limit(4)->get();

            $nextTest = $top4Topics->first(function ($topic) use ($testType) {
                return $topic->id > $testType->id;
            });

            return $nextTest
                ? redirect()->route('mock-test.prepare', $nextTest->slug)
                : redirect()->route('mock-test.result');
        }

        return redirect()->route('start.mock-test', [$slug, 'page' => $currentPage + 1]);
    }

    private function handleRetry($slug, $questionId, $currentPage, $maxAttempts, $isCorrect, $nextSlug)
    {
        $retryKey = "{$slug}_retry_{$questionId}";
        $resultKey = "{$slug}_retry_result_{$questionId}";


        if ($isCorrect) {
            $attemptCount = session()->get($retryKey, 1);

            // Ghi lại kết quả retry để showResult dùng
            session()->put($resultKey, $attemptCount);

            // Xóa retry để không ảnh hưởng đến logic chuyển tiếp
            session()->forget($retryKey);
            return redirect()->route('mock-test.prepare', [$nextSlug]);
        }

        $attemptCount = session()->get($retryKey, 1);

        if ($attemptCount >= $maxAttempts) {
            // Ghi lại kết quả là maxAttempts vì đã sai hết
            session()->put($resultKey, $maxAttempts);

            // Clear retry chính
            session()->forget($retryKey);
            return redirect()->route('mock-test.prepare', [$nextSlug]);
        }

        session()->put($retryKey, $attemptCount + 1);
        $remaining = $maxAttempts - $attemptCount;

        return redirect()
            ->route('start.mock-test', [$slug, 'page' => $currentPage])
            ->with('error', "Câu trả lời chưa đúng. Bạn còn {$remaining} lượt thử lại.");
    }


    public function prepare($slug)
    {
        $currentTest = Topic::where('slug', $slug)->firstOrFail();

        $previousTest = Topic::where('num_order', '<', $currentTest->num_order)
            ->orderBy('num_order', 'desc')
            ->first();

        return view('mock-test.prepare', [
            'currentTest' => $currentTest,
            'previousTest' => $previousTest,
        ]);
    }

    public function showResult(Request $request)
    {
        $testTypes = Topic::take(4)->orderBy('num_order')->get();
        $results = [];

        foreach ($testTypes as $testType) {
            $questions = $testType->questions()->with('answers')->get();
            $questionIds = $questions->pluck('id');

            $attemptId = $request->session()->get("mock_test_attempt_id");

            if (!$attemptId) {
                // Nếu không có attempt, bỏ qua test này
                continue;
            }

            $userAnswers = UserAnswerQuestion::where('attempt_id', $attemptId)
                ->whereIn('question_id', $questionIds)
                ->with('answer') // để lấy dữ liệu answer_text nếu chọn lựa
                ->get()
                ->keyBy('question_id');

            $correctAnswers = $userAnswers->where('is_correct', true)->count();

            $isPassed = match ($testType->slug) {
                'civics' => $correctAnswers >= 6,
                'reading', 'writing' => $correctAnswers >= 1,
                default => null,
            };

            $details = [];

            foreach ($questions as $question) {
                $userAnswer = $userAnswers->get($question->id);

                // Bỏ qua nếu chưa có câu trả lời từ người dùng
                if (!$userAnswer) {
                    continue;
                }

                $correctAnswer = $question->answers->firstWhere('is_correct', true);

                $details[] = [
                    'question' => $question->content,
                    'vietnamese_question' => $question->translation,
                    'type' => $question->type,
                    'user_answer' => $userAnswer?->content ?? $userAnswer?->answer?->content ?? $userAnswer?->answer_text ?? $userAnswer?->answer?->answer_text,
                    'correct_answer' => $correctAnswer?->content,
                    'vietnamese_correct_answer' => $correctAnswer?->explanation,
                    'pronunciation_suggest_answer' => $correctAnswer?->pronunciation,
                    'is_correct' => $userAnswer?->is_correct,
                ];

                // Nếu chỉ muốn 1 câu cho reading/writing thì vẫn giữ lại break nếu cần
                if (in_array($testType->slug, ['reading', 'writing'])) {
                    break;
                }
            }


            if ($testType->slug === 'civics') {
                $totalQuestions = UserAnswerQuestion::where('attempt_id', $attemptId)
                    ->whereIn('question_id', $questionIds)
                    ->where(function ($query) {
                        $query->whereNotNull('answer_text')
                            ->orWhereNotNull('answer_id');
                    })
                    ->count();
            } elseif (in_array($testType->slug, ['reading', 'writing'])) {
                $totalQuestions = 3;

                foreach ($questions as $question) {
                    $userAnswer = $userAnswers->get($question->id);

                    if ($userAnswer && $userAnswer->is_correct) {
                        $resultKey = "{$testType->slug}_retry_result_{$question->id}";
                        $retryCount = session()->get($resultKey);

                        $totalQuestions = $retryCount ?? 1;
                        break;
                    }
                }
            } else {
                // $totalQuestions = $questions->count();
                $totalQuestions = 5;
            }

            $results[] = [
                'title' => $testType->name,
                'vietnamese_title' => $testType->vietnamese_name,
                'slug' => $testType->slug,
                'icon' => "icon/mockTests/{$testType->slug}.svg",
                'correct' => $correctAnswers,
                'total' => $totalQuestions,
                'is_passed' => $isPassed,
                'is_complete' => $totalQuestions > 0,
                'details' => $details,
            ];
        }


        $request->session()->forget('mock_test_attempt_id');

        return view('mock-test.result', compact('results'));
    }
}
