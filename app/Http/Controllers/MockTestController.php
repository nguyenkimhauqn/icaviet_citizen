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

    public function start(Request $request, $slug)
    {
        $page = (int) $request->query('page', 1);
        if ($page == 1) {
            $request->session()->forget("shown_questions_{$slug}");
        }

        $testType = Topic::where('slug', $slug)->firstOrFail();

        if (!$request->session()->has('mock_test_attempt_id')) {
            $attemptId = (string) Str::uuid();
            $request->session()->put('mock_test_attempt_id', $attemptId);
        } else {
            $attemptId = $request->session()->get('mock_test_attempt_id');
        }

        $totalSets = QuestionSet::distinct('set_number')->count(); // Tổng số bộ đề
        $shownSetKey = "mock_test_round_$slug";
        $currentRound = session()->get($shownSetKey, 0);

        // Nếu người dùng truyền `set_number` từ query, dùng cái đó (ưu tiên hơn), ngược lại dùng round robin
        $setNumber = (int) $request->query('set_number', 0);
        $representativeData = null;

        if ($page < 1) $page = 1;
        if ($slug === 'n400') {
            if ($setNumber < 1) {
                // Tính toán theo round robin
                $setNumber = ($currentRound % 2) + 1;
                // Cập nhật round cho lần sau
                session()->put($shownSetKey, $currentRound + 1);

                // Ghi nhớ set_number vào session để sau dùng khi show kết quả
                $request->session()->put("mock_test_set_number_{$slug}", $setNumber);

                // Redirect để đính `set_number` vào URL
                return redirect()->route('start.mock-test', [
                    'slug' => $slug,
                    'page' => $page,
                    'set_number' => $setNumber,
                ]);
            }


            $questionIds = QuestionSet::where('set_number', $setNumber)->pluck('question_id');

            $question = Question::with('answers')
                ->whereIn('id', $questionIds)
                ->orderBy('id')
                ->skip($page - 1)
                ->take(1)
                ->first();

            // Kiểm tra nếu category_id = 7 mà chưa được enabled thì skip qua câu tiếp theo
            if ($question && $question->category_id == 7 && !session()->has('enabled_category')) {
                // Lấy toàn bộ danh sách câu hỏi trong bộ đề này
                $questions = Question::whereIn('id', $questionIds)
                    ->orderBy('id')
                    ->get()
                    ->values(); // Đảm bảo index từ 0

                // Xác định index hiện tại
                $currentIndex = $questions->search(fn($q) => $q->id === $question->id);

                $totalCategory7 = $questions->where('category_id', 7)->count();
                // Tìm index kế tiếp có category_id khác 7
                $nextIndex = $questions->slice($currentIndex + 1)->search(fn($q) => $q->category_id != 7);

                $debugQ = $questions->where('category_id', 7);

                // Nếu tìm thấy, redirect đến page tương ứng
                if ($nextIndex !== false) {
                    return redirect()->route('start.mock-test', [
                        'slug' => $slug,
                        'page' => $nextIndex + $totalCategory7, // cộng vì slice bỏ qua phần đầu
                        'set_number' => $setNumber,
                    ]);
                }

                // Nếu không có câu nào khác category_id != 7 -> chuyển sang kết quả
                return redirect()->route('mock-test.result');
            }


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
            //$question = $testType->questions()->with('answers')->skip($page - 1)->take(1)->first();

            // if (in_array($slug, ['reading', 'writing'])) {
            //     $question = $testType->questions()->inRandomOrder()->with('answers')->first();
            // } else {
            //     $question = $testType->questions()->with('answers')->skip($page - 1)->take(1)->first();
            // }


            // if ($question) {
            //     $question->setRelation('answers', $question->answers->shuffle());
            // }

            // $total = match ($slug) {
            //     'civics' => 10,
            //     'reading', 'writing' => 1,
            //     default => $testType->questions()->count(),
            // };

            // $answeredCount = UserAnswerQuestion::where('attempt_id', $attemptId)
            //     ->whereHas('question.topic', function ($q) use ($slug) {
            //         $q->where('slug', $slug);
            //     })
            //     ->count();

            // if ($slug === 'civics') {
            //     $correctAnswersCount = UserAnswerQuestion::where('attempt_id', $attemptId)
            //         ->where('is_correct', true)
            //         ->whereHas('question.topic', function ($q) use ($slug) {
            //             $q->where('slug', $slug);
            //         })
            //         ->count();

            //     if ($correctAnswersCount >= 6) {
            //         return redirect()->route('mock-test.prepare', 'reading');
            //     }

            //     if ($answeredCount >= 10) {
            //         return redirect()->route('mock-test.prepare', 'reading');
            //     }
            // }

            $shownSessionKey = "shown_questions_$slug";
            $shownIds = session()->get($shownSessionKey, []);

            $questionBuilder = $testType->questions()
                ->whereNotIn('id', $shownIds)
                ->inRandomOrder()
                ->with('answers');

            $question = $questionBuilder->first();

            if (!$question) {
                return redirect()->route('mock-test.result');
            }

            $shownIds[] = $question->id;
            session()->put($shownSessionKey, $shownIds);

            $question->setRelation('answers', $question->answers->shuffle());

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
                $user = Auth::user()->load('representative');
                $representativeData = $user->representative;

                $correctAnswersCount = UserAnswerQuestion::where('attempt_id', $attemptId)
                    ->where('is_correct', true)
                    ->whereHas('question.topic', function ($q) use ($slug) {
                        $q->where('slug', $slug);
                    })
                    ->count();

                if ($correctAnswersCount >= 6 || $answeredCount >= 10) {
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


        return view($view, compact('testType', 'question', 'page', 'total', 'attemptId', 'setNumber', 'representativeData'));
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
        $currentPage = (int) $request->query('page', 1);
        // $setNumber = (int) $request->query('set_number', 1);
        $setNumber = (int) $request->set_number;
        $request->session()->put("mock_test_set_number_{$slug}", $setNumber);

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

        // dd($setNumber);
        if ($userAnswer) {
            $userAnswer->update([
                'answer_id' => $answerId,
                'answer_text' => $answerText,
                'additional_answer' => empty($additionalField) ? null : $additionalField,
                'is_correct' => $isCorrect,
                'answered_at' => now(),
                'set_number' => $setNumber,
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
                'set_number' => $setNumber,
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

            // Nếu người dùng trả lời "I am currently employed" -> thì tiếp tục câu tiếp theo -> nhưng bỏ qua câu tiếp theo nữa
            // Ví dụ ?page=23 => tiếp tục ?page=24 => ?page=26 (bỏ qua 25)
            if ($currentPage === 24 && $answerId) {
                $answer = Answer::find($answerId);
                $answerText = trim(strtolower($answer->content ?? ''));

                if ($answerText === 'i am currently employed') {
                    // Đánh dấu để skip page 25 khi hoàn tất page 24\
                    session(['skip_page_25' => true]);
                } else {
                    // Nếu trả lời khác, xóa session skip nếu có
                    session()->forget('skip_page_25');
                }
            }


            // Nếu có skip logic từ đáp án
            if ($answerId) {
                $answer = Answer::find($answerId);
                if ($answer && ($answer->skip_to_question || $answer->skip_to_category || $answer->enabled_category)) {
                    return $this->handleSkip($slug, $answer, $setNumber);
                }
            }

            // Nếu là câu text có skip_to_question
            if ($question->type === 'text' && $answerText == "0" && is_numeric($answerText)) {
                if ((int) $answerText === 0 && ($question->skip_to_question || $question->skip_to_category)) {
                    return $this->handleSkip($slug, $question, $setNumber);
                }
            }

            // Mặc định chuyển sang câu tiếp theo (có kiểm tra cờ skip page 25)
            $nextPage = $currentPage + 1;
            if ($nextPage === 26 && session('skip_page_25')) {
                $nextPage = 27;
                session()->forget('skip_page_25');
            }

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
                'page' => $nextPage,
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

        return redirect()->route('start.mock-test', [
            'slug' => $slug,
            'page' => $currentPage + 1,
            'set_number' => $setNumber
        ]);
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

        // dd($object->skip_to_question_mockTest);

        if (isset($object->skip_to_question_mockTest)) {
            return redirect()->route('start.mock-test', [
                'slug' => $slug,
                'page' => $object->skip_to_question_mockTest,
                'set_number' => $setNumber
            ]);
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


    // private function handleRetry($slug, $questionId, $currentPage, $maxAttempts, $isCorrect, $nextSlug)
    // {
    //     $retryKey = "{$slug}_retry_{$questionId}";
    //     $resultKey = "{$slug}_retry_result_{$questionId}";


    //     if ($isCorrect) {
    //         $attemptCount = session()->get($retryKey, 1);

    //         // Ghi lại kết quả retry để showResult dùng
    //         session()->put($resultKey, $attemptCount);

    //         // Xóa retry để không ảnh hưởng đến logic chuyển tiếp
    //         session()->forget($retryKey);
    //         return redirect()->route('mock-test.prepare', [$nextSlug]);
    //     }

    //     $attemptCount = session()->get($retryKey, 1);

    //     if ($attemptCount >= $maxAttempts) {
    //         // Ghi lại kết quả là maxAttempts vì đã sai hết
    //         session()->put($resultKey, $maxAttempts);

    //         // Clear retry chính
    //         session()->forget($retryKey);
    //         return redirect()->route('mock-test.prepare', [$nextSlug]);
    //     }

    //     session()->put($retryKey, $attemptCount + 1);
    //     $remaining = $maxAttempts - $attemptCount;

    //     return redirect()
    //         ->route('start.mock-test', [$slug, 'page' => $currentPage])
    //         ->with('error', "Câu trả lời chưa đúng. Bạn còn {$remaining} lượt thử lại.");
    // }

    private function handleRetry($slug, $questionId, $currentPage, $maxAttempts, $isCorrect, $nextSlug)
    {
        $retryKey = "{$slug}_retry";
        $resultKey = "{$slug}_retry_result";


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

    // public function showResult(Request $request)
    // {
    //     $testTypes = Topic::take(4)->orderBy('num_order')->get();
    //     $results = [];
    //     $attemptId = $request->session()->get("mock_test_attempt_id");

    //     if (!$attemptId) {
    //         return redirect()->route('mock-test.list');
    //     }

    //     foreach ($testTypes as $testType) {
    //         $slug = $testType->slug;
    //         $setNumber = $request->query('set_number', 1);

    //         if ($slug === 'n400') {
    //             $questionIds = QuestionSet::where('set_number', $setNumber)
    //                 ->orderBy('id')
    //                 ->pluck('question_id');

    //             $questions = Question::whereIn('id', $questionIds)
    //                 ->with('answers')
    //                 ->get();
    //         } else {
    //             $questions = $testType->questions()->with('answers')->get();
    //             $questionIds = $questions->pluck('id');
    //         }

    //         $userAnswers = UserAnswerQuestion::where('attempt_id', $attemptId)
    //             ->whereIn('question_id', $questionIds)
    //             ->with('answer')
    //             ->get()
    //             ->keyBy('question_id');

    //         $correctAnswers = $userAnswers->where('is_correct', true)->count();

    //         $isPassed = match ($slug) {
    //             'civics' => $correctAnswers >= 6,
    //             'reading', 'writing' => $correctAnswers >= 1,
    //             default => null,
    //         };

    //         $details = [];

    //         foreach ($questions as $question) {
    //             $userAnswer = $userAnswers->get($question->id);
    //             if (!$userAnswer) continue;

    //             $correctAnswer = $question->answers->firstWhere('is_correct', true);

    //             $details[] = [
    //                 'question' => $question->content,
    //                 'vietnamese_question' => $question->translation,
    //                 'type' => $question->type,
    //                 'user_answer' => $userAnswer->content ?? $userAnswer->answer?->content ?? $userAnswer->answer_text ?? $userAnswer->answer?->answer_text,
    //                 'correct_answer' => $correctAnswer?->content,
    //                 'vietnamese_correct_answer' => $correctAnswer?->explanation,
    //                 'pronunciation_suggest_answer' => $correctAnswer?->pronunciation,
    //                 'is_correct' => $userAnswer->is_correct,
    //             ];

    //             if (in_array($slug, ['reading', 'writing'])) {
    //                 break;
    //             }
    //         }

    //         // Tính totalQuestions
    //         if ($slug === 'n400') {
    //             $answeredIds = $userAnswers->keys();
    //             $lastAnsweredId = $answeredIds->max();
    //             $orderedQuestionIds = $questionIds->values()->toArray();
    //             $lastIndex = array_search($lastAnsweredId, $orderedQuestionIds);
    //             $totalQuestions = $lastIndex !== false ? $lastIndex + 1 : $userAnswers->count();
    //         } elseif ($slug === 'civics') {
    //             $totalQuestions = $userAnswers->filter(function ($ua) {
    //                 return !empty($ua->answer_text) || !empty($ua->answer_id);
    //             })->count();
    //         } elseif (in_array($slug, ['reading', 'writing'])) {
    //             $totalQuestions = 3;
    //             foreach ($questions as $question) {
    //                 $userAnswer = $userAnswers->get($question->id);
    //                 if ($userAnswer && $userAnswer->is_correct) {
    //                     $resultKey = "{$slug}_retry_result";
    //                     $totalQuestions = session()->get($resultKey, 1);
    //                     break;
    //                 }
    //             }
    //         } else {
    //             $totalQuestions = $questions->count();
    //         }

    //         $results[] = [
    //             'title' => $testType->name,
    //             'vietnamese_title' => $testType->vietnamese_name,
    //             'slug' => $slug,
    //             'icon' => "icon/mockTests/{$slug}.svg",
    //             'correct' => $correctAnswers,
    //             'total' => $totalQuestions,
    //             'is_passed' => $isPassed,
    //             'is_complete' => $totalQuestions > 0,
    //             'details' => $details,
    //         ];
    //     }

    //     // $request->session()->forget('mock_test_attempt_id');

    //     return view('mock-test.result', compact('results'));
    // }

    public function showResult(Request $request)
    {
        $testTypes = Topic::take(4)->orderBy('num_order')->get();
        $results = [];
        $attemptId = $request->session()->get("mock_test_attempt_id");
        $user = Auth::user()->load('representative');
        $representativeData = $user->representative;

        if (!$attemptId) {
            return redirect()->route('mock-test.list');
        }

        foreach ($testTypes as $testType) {
            $slug = $testType->slug;
            $setNumber = $request->query('set_number') ?? session("mock_test_set_number_{$slug}", 1);


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

            // Đặc biệt xử lý riêng cho reading & writing
            if (in_array($slug, ['reading', 'writing'])) {
                $userAnswers = UserAnswerQuestion::where('attempt_id', $attemptId)
                    ->whereIn('question_id', $questionIds)
                    ->with(['question.answers'])
                    ->orderBy('answered_at') // Có thể đổi sang DESC nếu muốn mới nhất trước
                    ->get();

                $correctAnswers = 0;
                $details = [];

                foreach ($userAnswers as $userAnswer) {
                    $question = $userAnswer->question;
                    if (!$question) continue;

                    $correctAnswer = $question->answers->firstWhere('is_correct', true);

                    $details[] = [
                        'question' => $question->content,
                        'vietnamese_question' => $question->translation,
                        'type' => $question->type,
                        'user_answer' => $userAnswer->content
                            ?? $userAnswer->answer?->content
                            ?? $userAnswer->answer_text
                            ?? $userAnswer->answer?->answer_text
                            ?? 'Không có câu trả lời',
                        'correct_answer' => $correctAnswer?->content ?? 'Chưa xác định',
                        'vietnamese_correct_answer' => $correctAnswer?->explanation ?? '',
                        'pronunciation_suggest_answer' => $correctAnswer?->pronunciation ?? '',
                        'is_correct' => $userAnswer->is_correct,
                    ];

                    if ($userAnswer->is_correct) {
                        $correctAnswers++;
                    }
                }

                $totalQuestions = (int) session()->get("{$slug}_retry_result", $userAnswers->count());
            } else {
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
                }

                // Tổng câu hỏi theo loại
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
                } else {
                    $totalQuestions = $questions->count();
                }
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

            // Reset Random
            $request->session()->forget("shown_questions_{$slug}");
        }

        session()->forget([
            'skip_page_25',
        ]);
        $request->session()->forget('mock_test_attempt_id');

        return view('mock-test.result', compact('results', 'representativeData'));
    }
}
