@extends('layouts.base-test')

@section('title', 'N-400')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/n400.css') }}">
@endpush

@section('content')
    <div class="header-inner">
        <div class="header">
            <a href="{{ route('home') }}"><img src="{{ asset('icon/mockTests/home.svg') }}" alt="Home" /></a>
            <h1 class="header-title">
                N-400 & NÓI<br>
                <span class="header-subtitle">{{ $category->title_en }}</span>

            </h1>
        </div>
    </div>


    <main class="main-content">
        @if ($question && $question->type == 'text')
            <form method="GET" action="{{ route('n400.category.show', ['id' => $category->id, 'page' => $page + 1]) }}"
                id="questionForm">
                <div class="quiz-container">
                    <div class="audio">
                        <img src="{{ asset('icon/mockTests/audio.svg') }}" style="width: 40px;" alt="Play audio" />
                        <input class="questionText hidden" type="hidden" value="{{ $question->content }}"></input>
                    </div>
                    <span class="font-sm text-center">{!! $question->content !!}</span>

                    <textarea type="text" name="answer_text" class="instruction-text form-control mt-4"
                        placeholder=" {{ isset($question->answer_note) ? e($question->answer_note) : 'Nhập ở đây' }} ">{{ e($question->default_answers) }}</textarea>
                </div>
            </form>
        @endif

        @if ($question && ($question->type === null || $question->type === 'multiple_choice'))
            <form method="GET" action="{{ route('n400.category.show', ['id' => $category->id, 'page' => $page + 1]) }}"
                id="questionForm">
                <div class="quiz-container">
                    <div class="audio">
                        <img src="{{ asset('icon/mockTests/audio.svg') }}" style="width: 40px;" alt="Play audio" />
                        <input class="questionText hidden" type="hidden" value="{{ $question->question_text }}"></input>
                    </div>

                    <span class="font-sm text-center">{!! $question->content !!}</span>

                    <div class="radio-options bg-light p-4 rounded text-start mt-4">
                        @foreach ($question->answers as $answer)
                            <div class="form-check mb-2 d-flex justify-content-center gap-2 align-items-start">
                                <div class="d-flex flex-column" style="width: 100%;">
                                    <div class="d-flex gap-2 justify-content-start align-items-center">
                                        <input class="form-check-input toggle-additional" type="radio" name="answer_id"
                                            id="answer{{ $answer->id }}" value="{{ $answer->id }}"
                                            data-has-additional="{{ $answer->additional_answer_placeholder ? 'true' : 'false' }}"
                                            @if (trim($answer->content) === trim($question->default_answers)) checked @endif>

                                        <label class="form-check-label radio-label font-sm"
                                            for="answer{{ $answer->id }}">
                                            {{ $answer->content }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            {{-- Field bổ sung --}}
                            <textarea type="text" name="additional_field_{{ $answer->id }}"
                                class="form-control mt-2 additional-field questionText" placeholder="{{ $answer->additional_answer_placeholder }}"
                                style="display: none;"></textarea>

                            {{-- Box cảnh báo --}}
                            @if ($answer->warning)
                                <div class="warning-container mb-2 d-none" data-answer-id="{{ $answer->id }}">
                                    <div class="mt-3 font-sm text-muted p-3 rounded shadow-sm"
                                        style="background: #f9f9fc; border-left: 4px solid #FF3363;">
                                        <p class="d-flex align-center gap-2 mb-2 font-sm" style="color: #FF3363;">
                                            <img src="{{ asset('icon/n400/warning.svg') }}" alt="Warning">
                                            <strong>Cảnh báo:</strong>
                                        </p>
                                        <ul class="m-0 p-0" style="list-style: none;">
                                            <li>{{ $answer->warning }}</li>
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </form>
        @endif

        @php
            $tips = json_decode($question->tips, true);
        @endphp

        @if (isset($question->tips) && !isset($tips['another_answer_way']))
            <div class="container-tips">
                <div class="tips-box">
                    <strong>
                        <p class="d-block font-sm font-bold">Mẹo ghi nhớ:</p>
                    </strong>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($tips as $label => $value)
                            <div class="answer-tips">

                                <span class="tag">
                                    <span class="tag-key">{{ $label . ':' }} </span> <span class="tag-value">
                                        {{ $value }} </span>
                                </span>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        @endif


        <div class="hint-container">
            <div class="toggle-container">
                <label class="switch">
                    <input type="checkbox" id="hintToggle">
                    <span class="slider"></span>
                </label>
                <span>Hiện gợi ý</span>
            </div>
            <div class="line mt-3"></div>

            <div id="hintText" style="display: none;">
                <div class="translate-box mt-3 text-center">
                    <p class="font-very-sm-italic">Dịch: {{ $question->translation }}</p>
                </div>
                @if (isset($question->tips) && isset($tips['another_answer_way']))
                    <div class="mt-3 font-sm text-muted p-3 rounded shadow-sm"
                        style="background: #f9f9fc; border-left: 4px solid #27ae60;">
                        <p class="ml-2 mb-2 font-sm"><strong>Cách trả lời khác:</strong></p>
                        <ul class="p-0 mb-0" style="list-style: none;">
                            @foreach ($tips['another_answer_way'] as $tip)
                                <li class="mb-1">
                                    <span class="d-block">
                                        - <span
                                            class="font-sm {{ isset($tip['is_best_answer']) && $tip['is_best_answer'] == true ? 'font-bold' : '' }}">{{ $tip['en'] }}</span>
                                        <em class="font-sm-italic">({{ $tip['vi'] }})</em>
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>


        </div>


    </main>

    <div class="test-footer">
        {{-- <button class="btn btn-round" id="prevBtn">
                    <img src="{{ asset('icon/mockTests/arrow-left.svg') }}" alt="Prev" />
                </button> --}}
        <button class="btn btn-round" id="nextBtn">
            <img src="{{ asset('icon/mockTests/arrow-right.svg') }}" alt="Next" />
        </button>

    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            // Audio click (text-to-speech)
            $('.audio').on('click', function() {
                const text = $('.questionText').val();
                console.log('speak', text);
                speakText(text);
            });

            // Toggle hiện/ẩn gợi ý
            $('#hintToggle').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#hintText').slideDown();
                } else {
                    $('#hintText').slideUp();
                }
            })


            const isTextType = $('textarea[name="answer_text"]').length > 0;

            // Trường hợp dạng TEXT
            if (isTextType) {
                const $textInput = $('textarea[name="answer_text"]');
                // $textInput.val('');/

                $textInput.on('input', function() {
                    $('#nextBtn').toggleClass('active', $(this).val().trim().length > 0);
                });

                $('#nextBtn').on('click', function(e) {
                    const isTextType = $('textarea[name="answer_text"]').length > 0;

                    if (isTextType) {
                        const $textInput = $('textarea[name="answer_text"]');
                        const text = $textInput.val().trim();

                        if (!text) {
                            alert('Vui lòng nhập câu trả lời!');
                            return;
                        }

                        // Chuyển sang page kế tiếp
                        const nextUrl =
                            `{{ route('n400.category.show', ['id' => $category->id]) }}?page={{ $page + 1 }}`;
                        window.location.href = nextUrl;
                    }
                });


                return;
            }

            // Trường hợp dạng MULTIPLE CHOICE
            const radioInputs = $('input[name="answer_id"]');

            radioInputs.on('change', function() {
                const selected = $(this);
                const hasAdditional = selected.data('has-additional');
                const answerId = selected.val();


                // Highlight label được chọn
                $('.radio-label').removeClass('active');
                $(`label[for="${selected.attr('id')}"]`).addClass('active');

                // Ẩn toàn bộ cảnh báo
                $('.warning-container').addClass('d-none');

                // Hiện cảnh báo nếu có
                $(`.warning-container[data-answer-id="${answerId}"]`).removeClass('d-none');

                // Cho phép bấm nút tiếp
                $('#nextBtn').addClass('active');

                // Ẩn toàn bộ các field bổ sung
                $('.additional-field').hide();

                // Hiện field bổ sung nếu đáp án cần
                if (hasAdditional) {
                    const inputName = `additional_field_${selected.val()}`;
                    $(`textarea[name="${inputName}"]`).show();
                }
            });

            $('#nextBtn').on('click', function(e) {
                const selected = $('input[name="answer_id"]:checked').val();

                if (!selected) {
                    alert('Vui lòng chọn một đáp án!');
                    return;
                }

                const selectedAnswer = $('input[name="answer_id"]:checked').val();
                const nextUrl =
                    `{{ route('n400.category.show', ['id' => $category->id]) }}?page={{ $page }}&answer_id=${selectedAnswer}`;
                window.location.href = nextUrl;
            });

        });
    </script>
@endpush
