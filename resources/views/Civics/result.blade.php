@extends('layouts.app')

@section('content')
    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('/public/css/result.css') }}">

    <div class="container py-5">
        <div class="test-result-container">
            <!-- Tiêu đề -->
            <h5 class="result-title text-center">KIỂM TRA CÔNG DÂN</h5>

            <!-- Hình vỗ tay -->
            <div class="result-icon text-center">
                <img src="{{ url('public/icon/Clap.gif') }}" alt="Kết quả icon" />
            </div>

            <!-- Số câu đúng -->
            <p class="correct-answers text-center">
                <span class="correct-count"> {{ $quiz->correct_answers ?? '' }}/{{ $quiz->total_questions ?? '' }} </span>
                câu đúng
            </p>

            <!-- Lời động viên -->
            <h3 class="encouragement-en text-center">Practice makes perfect!</h3>
            <p class="encouragement-vi text-center">Luyện tập nhiều sẽ giỏi!</p>

            <!-- Box dropdown -->
            <div class="review-dropdown">
                <img src="{{ url('public/icon/Icon_civics_results.svg') }}" alt="icon" class="icon-inline" />
                <div class="text-review-dropdown">
                    Xem lại câu sai
                </div>
                <img src="{{ url('public/icon/chevron-right.svg') }}" alt="icon" class="icon-inline" />
            </div>

            <!-- Hiển thị câu hỏi và đáp án (data cứng) -->
            <div class="mt-4 list-question-answers d-none">
                @foreach ($quizQuestions as $item)
                    @php
                        $question = $item->question;
                        $answerCorrect = $item->question->answers->where('is_correct', 1)->first();
                    @endphp
                    <div class="question-card text-start mb-4 p-3 rounded ">
                        <div class="question-text mb-1">
                            {{-- 15. Who is in charge of the <strong>Executive Branch</strong>? --}}
                            {!! $question->content ?? '' !!}
                        </div>
                        <div class="question-translation fst-italic  mb-2">
                            Dịch: {{ $question->translation ?? '' }}
                            {{-- Dịch: Ai phụ trách nhánh Hành pháp? --}}
                        </div>
                        <div class="wp-correct-answer">
                            <div class="correct-answer-box d-flex align-items-start gap-2">
                                <img src="{{ url('public/icon/icon-correct.svg') }}"
                                    style="width:18px; height:18px; margin-top:2px">
                                {{-- <span class="text-success fw-semibold"> Terrorists attacked the United States </span> --}}
                                <span class="text-success fw-semibold"> {{ $answerCorrect->content ?? '' }} </span>
                            </div>

                            <div class="answer-translation  mt-2">
                                {{-- Dịch: Tổng thống --}}
                                {{ $answerCorrect->explanation ?? '' }}
                            </div>

                            <div class="answer-hint  mt-1">
                                <strong>Phát âm dễ nhớ:</strong> {{ $answerCorrect->pronunciation ?? '' }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Nút CTA -->
            <div class="action-buttons text-center">
                @php
                    $retryRoute = $mode === 'show' ? route('civics.form') : route('civics.starred');
                @endphp
                <a href="{{ $retryRoute }}" class="btn btn-primary mb-2 d-inline-block">
                    Tiếp tục luyện tập
                </a>

                <a class="back-home mt-4 d-inline-block" href="{{ url('/') }}"
                    class="text-primary text-center d-block">Về trang
                    chủ</a>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // alert(1);
            $('.review-dropdown').on('click', function() {
                $('.list-question-answers').toggleClass('d-none d-block');
            });
        });
    </script>
@endsection
