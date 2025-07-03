<?php

namespace App\Http\Controllers;

use App\Helpers\TextHelper;
use App\Models\Answer;
use App\Models\Question;
use App\Models\QuestionSet;
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
        // dd($mockTest);
        return view('mock-test.index', compact('mockTest'));
    }

    // public function start(Request $request, $slug)
    // {
    //     $testType = Topic::where('slug', $slug)->firstOrFail();


    //     if (!$request->session()->has('mock_test_attempt_id')) {
    //         $attemptId = (string) Str::uuid();
    //         $request->session()->put('mock_test_attempt_id', $attemptId);
    //     } else {
    //         $attemptId = $request->session()->get('mock_test_attempt_id');
    //     }

    //     //  Đếm số câu đúng
    //     if ($slug === 'civics') {
    //         $correctAnswersCount = UserAnswerQuestion::where('attempt_id', $attemptId)
    //             ->where('is_correct', true)
    //             ->whereHas('question.topic', function ($q) use ($slug) {
    //                 $q->where('slug', $slug);
    //             })
    //             ->count();

    //         if ($correctAnswersCount >= 6) {
    //             return redirect()->route('mock-test.prepare', 'reading');
    //         }
    //     }

    //     $page = (int) $request->query('page', 1);
    //     $question = $testType->questions()->with('answers')->skip($page - 1)->take(1)->first();
    //     if ($question) {
    //         $question->setRelation('answers', $question->answers->shuffle());
    //     }

    //     $total = match ($slug) {
    //         'civics' => 10,
    //         'reading', 'writing' => 1,
    //         'n400' => 5,
    //         default => $testType->questions()->count(),
    //     };

    //     // Kiểm tra nếu đã trả lời đủ số câu thì chuyển sang phần tiếp theo
    //     $answeredCount = UserAnswerQuestion::where('attempt_id', $attemptId)
    //         ->whereHas('question.topic', function ($q) use ($slug) {
    //             $q->where('slug', $slug);
    //         })
    //         ->count();


    //     if ($slug === 'civics' && $answeredCount >= 10) {
    //         return redirect()->route('mock-test.prepare', 'reading');
    //     }

    //     // TODO: Fix => chỉ giả lập 5 lần, nhớ fix
    //     if ($slug === 'n400' && $answeredCount >= 5) {
    //         return redirect()->route('mock-test.result');
    //     }

    //     $view = match ($slug) {
    //         'civics' => 'mock-test.start-civic',
    //         'reading' => 'mock-test.start-reading',
    //         'writing' => 'mock-test.start-writing',
    //         'n400' => 'mock-test.start-n400',
    //     };

    //     return view($view, compact('testType', 'question', 'page', 'total', 'attemptId'));
    // }

    public function start(Request $request, $slug)
    {
        $testType = Topic::where('slug', $slug)->firstOrFail();

        if (!$request->session()->has('mock_test_attempt_id')) {
            $attemptId = (string) Str::uuid();
            $request->session()->put('mock_test_attempt_id', $attemptId);
        } else {
            $attemptId = $request->session()->get('mock_test_attempt_id');
        }

        $page = (int) $request->query('page', 1);
        if ($page < 1) $page = 1;

        $setNumber = (int) $request->query('set_number', 1); // Default đề số 1 nếu không truyền

        if ($slug === 'n400') {
            $questionIds = QuestionSet::where('set_number', $setNumber)->pluck('question_id');

            $question = Question::with('answers')
                ->whereIn('id', $questionIds)
                ->orderBy('id')
                ->skip($page - 1)
                ->take(1)
                ->first();

            if ($question) {
                // $question->setRelation('answers', $question->answers->shuffle());
            }

            $total = count($questionIds);

            $answeredCount = UserAnswerQuestion::where('attempt_id', $attemptId)
                ->whereIn('question_id', $questionIds)
                ->count();

            if ($answeredCount >= $total) {
                return redirect()->route('mock-test.result');
            }
        } else {
            $question = $testType->questions()->with('answers')->skip($page - 1)->take(1)->first();


            if ($question) {
                $question->setRelation('answers', $question->answers->shuffle());
            }

            $total = match ($slug) {
                'civics' => 10,
                'reading', 'writing' => 1,
                default => $testType->questions()->count(),
            };

            $answeredCount = UserAnswerQuestion::where('attempt_id', $attemptId)
                ->whereHas('question.topic', function ($q) use ($slug) {
                    $q->where('slug', $slug);
                })
                ->count();

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

                if ($answeredCount >= 10) {
                    return redirect()->route('mock-test.prepare', 'reading');
                }
            }
        }

        $view = match ($slug) {
            'civics' => 'mock-test.start-civic',
            'reading' => 'mock-test.start-reading',
            'writing' => 'mock-test.start-writing',
            'n400' => 'mock-test.start-n400',
        };

        return view($view, compact('testType', 'question', 'page', 'total', 'attemptId'));
    }


    // public function submitAnswer(Request $request, $slug)
    // {
    //     $request->validate([
    //         'question_id' => 'required|exists:questions,id',
    //         'answer_id' => 'nullable|exists:answers,id',
    //         'answer_text' => 'nullable|string',
    //     ]);

    //     $questionId = $request->question_id;
    //     $answerId = $request->answer_id;
    //     $answerText = $request->answer_text;
    //     $questionContent = $request->question_content;

    //     $additionalField = $request->additional_field;
    //     $attemptId = session()->get('mock_test_attempt_id');

    //     if (!$attemptId) {
    //         return redirect()->route('start.mock-test', $slug)->with('error', 'Bài thi chưa được khởi tạo.');
    //     }

    //     $question = Question::with('answers')->findOrFail($questionId);
    //     $isCorrect = false;

    //     if ($answerText) {
    //         // $isCorrect = strtolower(trim($questionContent)) === strtolower(trim($answerText));
    //         $isCorrect = TextHelper::normalizeText($questionContent) === TextHelper::normalizeText($answerText);
    //     }

    //     if ($question->type === 'multiple_choice' && $answerId) {
    //         $isCorrect = Answer::where('id', $answerId)->where('is_correct', true)->exists();
    //     }

    //     $testType = Topic::where('slug', $slug)->firstOrFail();
    //     $currentPage = (int) $request->query('page', 1);
    //     $total = $testType->questions()->count();
    //     $maxAttempts = $testType->max_attempts ?? 1;


    //     // Check nếu đã có câu trả lời trước đó thì update
    //     $userAnswer = UserAnswerQuestion::where('attempt_id', $attemptId)
    //         ->where('question_id', $questionId)
    //         ->first();

    //     if ($userAnswer) {
    //         $userAnswer->update([
    //             'answer_id' => $answerId,
    //             'answer_text' => $answerText,
    //             'additional_answer' => empty($additionalField) ? null : $additionalField,
    //             'is_correct' => $isCorrect,
    //             'answered_at' => now(),
    //         ]);
    //     } else {
    //         UserAnswerQuestion::create([
    //             'attempt_id' => $attemptId,
    //             'user_id' => Auth::user()->id,
    //             'question_id' => $questionId,
    //             'answer_id' => $answerId,
    //             'answer_text' => $answerText,
    //             'additional_answer' => empty($additionalField) ? null : $additionalField,
    //             'is_correct' => $isCorrect,
    //             'answered_at' => now(),
    //         ]);
    //     }

    //     // Nếu là reading và sai thì xử lý retry
    //     if ($slug === 'reading') {
    //         if ($redirect = $this->handleRetry('reading', $questionId, $currentPage, $maxAttempts, $isCorrect, 'writing')) {
    //             return $redirect;
    //         }
    //     }

    //     // Nếu là writing và sai thì xử lý retry
    //     if ($slug === 'writing') {
    //         if ($redirect = $this->handleRetry('writing', $questionId, $currentPage, $maxAttempts, $isCorrect, 'n400')) {
    //             return $redirect;
    //         }
    //     }


    //     // Chuyển trang tiếp theo nếu không phải writing hoặc đúng
    //     if ($currentPage >= $total) {
    //         $top4Topics = Topic::orderBy('id')->limit(4)->get();

    //         $nextTest = $top4Topics->first(function ($topic) use ($testType) {
    //             return $topic->id > $testType->id;
    //         });

    //         return $nextTest
    //             ? redirect()->route('mock-test.prepare', $nextTest->slug)
    //             : redirect()->route('mock-test.result');
    //     }

    //     return redirect()->route('start.mock-test', [$slug, 'page' => $currentPage + 1]);
    // }

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
        $currentPage = (int) $request->query('page', 1);
        $setNumber = (int) $request->query('set_number', 1);

        if (!$attemptId) {
            return redirect()->route('start.mock-test', $slug)->with('error', 'Bài thi chưa được khởi tạo.');
        }

        $question = Question::with('answers')->findOrFail($questionId);
        $isCorrect = false;

        if ($answerText) {
            $isCorrect = TextHelper::normalizeText($questionContent) === TextHelper::normalizeText($answerText);
        }

        if ($question->type === 'multiple_choice' && $answerId) {
            $isCorrect = Answer::where('id', $answerId)->where('is_correct', true)->exists();
        }

        $testType = Topic::where('slug', $slug)->firstOrFail();
        $maxAttempts = $testType->max_attempts ?? 1;

        // Lưu lại câu trả lời
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

        // Retry cho reading
        if ($slug === 'reading') {
            if ($redirect = $this->handleRetry('reading', $questionId, $currentPage, $maxAttempts, $isCorrect, 'writing')) {
                return $redirect;
            }
        }

        // Retry cho writing
        if ($slug === 'writing') {
            if ($redirect = $this->handleRetry('writing', $questionId, $currentPage, $maxAttempts, $isCorrect, 'n400')) {
                return $redirect;
            }
        }

        // Logic skip cho n400
        if ($slug === 'n400') {
            // Nếu có skip logic từ đáp án
            if ($answerId) {
                $answer = Answer::find($answerId);
                if ($answer && ($answer->skip_to_question || $answer->skip_to_category || $answer->enabled_category)) {
                    return $this->handleSkip($slug, $answer, $setNumber);
                }
            }

            // Nếu là câu text có skip_to_question
            if ($question->type === 'text' && $answerText && is_numeric($answerText)) {
                if ((int) $answerText === 0 && ($question->skip_to_question || $question->skip_to_category)) {
                    return $this->handleSkip($slug, $question, $setNumber);
                }
            }

            // Mặc định: sang câu tiếp theo
            $questionIds = QuestionSet::where('set_number', $setNumber)->pluck('question_id');
            $total = $questionIds->count();

            // Kiểm tra nếu đã trả lời câu cuối cùng
            $lastQuestionId = $questionIds->last();
            $lastAnswered = UserAnswerQuestion::where('attempt_id', $attemptId)
                ->where('question_id', $lastQuestionId)
                ->exists();

            if ($lastAnswered) {
                return redirect()->route('mock-test.result');
            }

            return redirect()->route('start.mock-test', [
                'slug' => $slug,
                'page' => $currentPage + 1,
                'set_number' => $setNumber
            ]);
        }

        // Các bài thi còn lại
        $total = $testType->questions()->count();

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

    protected function handleSkip(string $slug, $object, int $setNumber)
    {
        // Skip logic chỉ dùng cho n400
        if ($slug !== 'n400') {
            return null;
        }

        // Gán enabled_category nếu có
        if (isset($object->enabled_category)) {
            if ($object->enabled_category == -1) {
                session()->forget('enabled_category');
            } elseif ($object->enabled_category > 0) {
                session()->put('enabled_category', $object->enabled_category);
            }
        }

        // Nếu skip_to_category thì chuyển đề
        if (isset($object->skip_to_category) && $object->skip_to_category > 0) {
            $questionIds = QuestionSet::where('set_number', $setNumber)
                ->orderBy('id')
                ->pluck('question_id')
                ->toArray();

            // Lấy danh sách các câu hỏi ứng với category cần skip đến
            $targetQuestionId = Question::whereIn('id', $questionIds)
                ->where('category_id', $object->skip_to_category)
                ->orderBy('id')
                ->value('id'); // Lấy câu hỏi đầu tiên thuộc category đó

            if ($targetQuestionId) {
                $targetIndex = array_search($targetQuestionId, $questionIds);

                if ($targetIndex !== false) {
                    return redirect()->route('start.mock-test', [
                        'slug' => $slug,
                        'page' => $targetIndex + 1,
                        'set_number' => $setNumber
                    ]);
                }
            }
        }


        // Nếu chỉ skip trong set hiện tại
        if (isset($object->skip_to_question) && $object->skip_to_question > 0) {
            $questionIds = QuestionSet::where('set_number', $setNumber)
                ->orderBy('id')
                ->pluck('question_id')
                ->toArray();

            // Tìm index của current_question_id trong mảng
            $currentIndex = array_search($object->question_id, $questionIds);

            if ($currentIndex !== false) {
                // Tính index cần tới
                $targetIndex = $currentIndex + ($object->skip_to_question - 1);

                // Kiểm tra index tồn tại
                if (isset($questionIds[$targetIndex])) {
                    return redirect()->route('start.mock-test', [
                        'slug' => $slug,
                        'page' => $targetIndex + 1,
                        'set_number' => $setNumber
                    ]);
                }
            }
        }


        // Nếu không có skip rõ ràng thì sang câu tiếp theo
        return redirect()->route('start.mock-test', [
            'slug' => $slug,
            'page' => request()->query('page', 1) + 1,
            'set_number' => $setNumber
        ]);
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
        $attemptId = $request->session()->get("mock_test_attempt_id");

        if (!$attemptId) {
            return redirect()->route('mock-test.list');
        }

        foreach ($testTypes as $testType) {
            $slug = $testType->slug;
            $setNumber = $request->query('set_number', 1);

            if ($slug === 'n400') {
                $questionIds = QuestionSet::where('set_number', $setNumber)
                    ->orderBy('id')
                    ->pluck('question_id');

                $questions = Question::whereIn('id', $questionIds)
                    ->with('answers')
                    ->get();
            } else {
                $questions = $testType->questions()->with('answers')->get();
                $questionIds = $questions->pluck('id');
            }

            $userAnswers = UserAnswerQuestion::where('attempt_id', $attemptId)
                ->whereIn('question_id', $questionIds)
                ->with('answer')
                ->get()
                ->keyBy('question_id');

            $correctAnswers = $userAnswers->where('is_correct', true)->count();

            $isPassed = match ($slug) {
                'civics' => $correctAnswers >= 6,
                'reading', 'writing' => $correctAnswers >= 1,
                default => null,
            };

            $details = [];

            foreach ($questions as $question) {
                $userAnswer = $userAnswers->get($question->id);
                if (!$userAnswer) continue;

                $correctAnswer = $question->answers->firstWhere('is_correct', true);

                $details[] = [
                    'question' => $question->content,
                    'vietnamese_question' => $question->translation,
                    'type' => $question->type,
                    'user_answer' => $userAnswer->content ?? $userAnswer->answer?->content ?? $userAnswer->answer_text ?? $userAnswer->answer?->answer_text,
                    'correct_answer' => $correctAnswer?->content,
                    'vietnamese_correct_answer' => $correctAnswer?->explanation,
                    'pronunciation_suggest_answer' => $correctAnswer?->pronunciation,
                    'is_correct' => $userAnswer->is_correct,
                ];

                if (in_array($slug, ['reading', 'writing'])) {
                    break;
                }
            }

            // Tính totalQuestions
            if ($slug === 'n400') {
                $answeredIds = $userAnswers->keys();
                $lastAnsweredId = $answeredIds->max();
                $orderedQuestionIds = $questionIds->values()->toArray();
                $lastIndex = array_search($lastAnsweredId, $orderedQuestionIds);
                $totalQuestions = $lastIndex !== false ? $lastIndex + 1 : $userAnswers->count();
            } elseif ($slug === 'civics') {
                $totalQuestions = $userAnswers->filter(function ($ua) {
                    return !empty($ua->answer_text) || !empty($ua->answer_id);
                })->count();
            } elseif (in_array($slug, ['reading', 'writing'])) {
                $totalQuestions = 3;
                foreach ($questions as $question) {
                    $userAnswer = $userAnswers->get($question->id);
                    if ($userAnswer && $userAnswer->is_correct) {
                        $resultKey = "{$slug}_retry_result_{$question->id}";
                        $totalQuestions = session()->get($resultKey, 1);
                        break;
                    }
                }
            } else {
                $totalQuestions = $questions->count();
            }

            $results[] = [
                'title' => $testType->name,
                'vietnamese_title' => $testType->vietnamese_name,
                'slug' => $slug,
                'icon' => "icon/mockTests/{$slug}.svg",
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
