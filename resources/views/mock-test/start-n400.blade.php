@extends('layouts.base-test')

@push('styles')
    <link rel="stylesheet" href="{{ asset('public/css/n400.css') }}">
@endpush

@section('title', $testType->title)

@section('content')
    <div class="header-inner">
        <div class="header">
            <a href="{{ route('home') }}"><img src="{{ asset('public/icon/mockTests/home.svg') }}" alt="Home" /></a>
            <h1 class="header-title">
                THI THỬ<br>
                <span class="header-subtitle">{{ $testType->name }}</span>

                @if ($testType->vietnamese_name)
                    <span class="header-subtitle-2">({{ $testType->vietnamese_name }})</span>
                @endif
            </h1>
        </div>
    </div>


    <main class="main-content">
        @if ($question && $question->type == 'text')
            <form method="POST" action="{{ route('submit.answer', [$testType->slug, 'page' => $page]) }}"
                id="questionForm">
                @csrf
                {{-- <input type="hidden" name="question_id" value="{{ $question->id }}">

                <div class="quiz-container">
                    <div class="audio">
                        <img src="{{ asset('public/icon/mockTests/audio.svg') }}" style="width: 40px;" alt="Play audio" />
                        <input class="questionText hidden" type="hidden" value="{{ $question->content }}"></input>
                    </div>

                    <textarea type="text" name="answer_text" class="instruction-text form-control mt-3" placeholder="Nhập ở đây">
                        </textarea>
                </div> --}}

                <input type="hidden" name="question_id" value="{{ $question->id }}">

                <div class="quiz-container" style="margin-top: 20px;">
                    <div class="audio">
                        <img src="{{ asset('public/icon/mockTests/audio.svg') }}" style="width: 70px;" alt="Play audio" />
                        <input class="questionText hidden" type="hidden" value="{{ $question->content }}"></input>
                    </div>
                    {{-- <span class="font-sm text-center">{!! $question->content !!}</span> --}}
                    <span class="font-sm">
                        Show cho chị dễ debug:
                        <strong>{{ strip_tags($question->content) }}</strong>
                    </span>

                    <textarea name="answer_text" class="instruction-text form-control mt-4 ps-5" placeholder="'Nhập ở đây"></textarea>
                </div>

            </form>
        @endif

        {{-- TODO: Fix --}}
        @if ($question && ($question->type === null || $question->type === 'multiple_choice'))
            <form method="POST" action="{{ route('submit.answer', [$testType->slug, 'page' => $page]) }}"
                id="questionForm">
                @csrf
                <input type="hidden" name="question_id" value="{{ $question->id }}">
                <input type="hidden" name="answer_id" id="answer_id">
                <input type="hidden" name="additional_field" id="additional_field" value="">

                <div class="quiz-container" style="margin-top: 20px;">
                    <div class="audio">
                        <img src="{{ asset('public/icon/mockTests/audio.svg') }}" style="width: 70px;" alt="Play audio" />
                        <input class="questionText hidden" type="hidden" value="{{ $question->content }}"></input>
                    </div>

                    <span class="font-sm text-center hidden">{!! $question->content !!}</span>

                    <span class="font-sm">
                        Show cho chị dễ debug:
                        <strong>{{ strip_tags($question->content) }}</strong>
                    </span>

                    <div class="radio-options bg-light p-4 rounded text-start mt-4">
                        @foreach ($question->answers as $answer)
                            <div class="mb-2">
                                <div class="d-flex flex-column" style="width: 100%;">
                                    <div class="d-flex">
                                        <div class="d-flex gap-2 justify-content-center align-items-center">
                                            <input class="form-check-input toggle-additional" type="radio"
                                                name="answer_id" id="answer{{ $answer->id }}"
                                                value="{{ $answer->id }}" data-answer="{{ $answer->content }}"
                                                data-has-audio="{{ $answer->has_audio ? 'true' : 'false' }}"
                                                data-has-additional="{{ $answer->additional_answer_placeholder ? 'true' : 'false' }}">

                                            <label class="form-check-label radio-label font-sm"
                                                for="answer{{ $answer->id }}">
                                                {{ $answer->content }}
                                            </label>
                                        </div>

                                        {{-- @if ($answer->has_audio)
                                            <div class="audio-answer" data-answer="{{ $answer->content }}">
                                                <img src="{{ asset('public/icon/mockTests/audio.svg') }}" style="width: 10px;"
                                                    alt="Play audio" />
                                            </div>
                                        @endif --}}

                                        <div class="audio-answer d-none" id="audio-icon-{{ $answer->id }}"
                                            data-answer="{{ $answer->content }}">
                                            <img src="{{ asset('public/icon/mockTests/audio.svg') }}" style="width: 25px;"
                                                alt="Play audio" />
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- Field bổ sung --}}
                            <textarea type="text" name="additional_field_{{ $answer->id }}"
                                class="form-control mt-2 additional-field questionText" placeholder="{{ $answer->additional_answer_placeholder }}"
                                style="display: none;" rows="3"></textarea>

                            {{-- <div class="additional-field-container" style="display: none;">
                                @php
                                    $length = strlen($answer->additional_answer_placeholder ?? '');
                                    if ($length > 160) {
                                        $rows = 4;
                                    } elseif ($length > 80) {
                                        $rows = 3;
                                    } else {
                                        $rows = 2;
                                    }
                                @endphp
                                <textarea type="text" name="additional_field_{{ $answer->id }}"
                                    class="form-control mt-2 ps-5 additional-field questionText"
                                    placeholder="{{ $answer->additional_answer_placeholder }}" rows="{{ $rows }}"></textarea>
                            </div> --}}

                            {{-- Box cảnh báo --}}
                            @if ($answer->warning)
                                <div class="warning-container mb-2 d-none" data-answer-id="{{ $answer->id }}">
                                    <div class="mt-3 font-sm text-muted p-3 rounded shadow-sm"
                                        style="background: #f9f9fc; border-left: 4px solid #FF3363;">
                                        <p class="d-flex align-center gap-2 mb-2 text-dark font-sm" style="color: #FF3363;">
                                            <img src="{{ asset('public/icon/n400/warning.svg') }}" alt="Warning">
                                            <strong>Cảnh báo:</strong>
                                        </p>
                                        <ul class="m-0 p-0 text-dark font-sm" style="list-style: none;">
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
    </main>

    <div class="test-footer">
        {{-- <button class="btn btn-round" id="prevBtn">
                    <img src="{{ asset('public/icon/mockTests/arrow-left.svg') }}" alt="Prev" />
                </button> --}}
        <button class="btn btn-round" id="nextBtn">
            <img src="{{ asset('public/icon/mockTests/arrow-right.svg') }}" alt="Next" />
        </button>

    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            // Audio click (text-to-speech)
            $('.audio').on('click', function() {
                let rawHtml = $(this).find('.questionText').val();

                // Tạo một thẻ ảo để loại bỏ các thẻ HTML
                let tempDiv = document.createElement("div");
                tempDiv.innerHTML = rawHtml;
                let plainText = tempDiv.textContent || tempDiv.innerText || "";

                console.log('speak', plainText); // Output: How long have you been in the United States?
                speakText(plainText);;
            });


            const isTextType = $('textarea[name="answer_text"]').length > 0;

            // Trường hợp dạng TEXT
            if (isTextType) {
                const $textInput = $('textarea[name="answer_text"]');
                $textInput.val('');

                $textInput.on('input', function() {
                    $('#nextBtn').toggleClass('active', $(this).val().trim().length > 0);
                });

                $('#nextBtn').on('click', function(e) {
                    if (!$textInput.val().trim()) {
                        e.preventDefault();
                        alert('Vui lòng nhập câu trả lời!');
                        return;
                    }
                    $('#questionForm').submit();
                });

                return;
            }

            // Trường hợp dạng MULTIPLE CHOICE
            const radioInputs = $('input[name="answer_id"]');

            radioInputs.on('change', function() {
                const selected = $(this);
                const hasAdditional = selected.data('has-additional');

                // Highlight label được chọn
                $('.radio-label').removeClass('active');
                $(`label[for="${selected.attr('id')}"]`).addClass('active');

                // Cho phép bấm nút tiếp
                $('#nextBtn').addClass('active');

                // Ẩn toàn bộ các field bổ sung
                $('.additional-field').hide();

                // Hiện field bổ sung nếu đáp án cần
                if (hasAdditional) {
                    $(`textarea[name="additional_field_${selected.val()}"]`)
                        .show();
                }
            });

            $('#nextBtn').on('click', function(e) {
                const selected = $('input[name="answer_id"]:checked').val();


                if (!selected) {
                    e.preventDefault();
                    alert('Vui lòng chọn một đáp án!');
                    return;
                }

                // Xử lý lấy giá trị của field bổ sung nếu có
                const $additionalInput = $(`textarea[name="additional_field_${selected}"]`);
                const $hiddenField = $('#additional_field');

                if ($additionalInput.length > 0 && $additionalInput.is(':visible')) {
                    $hiddenField.val($additionalInput.val());
                } else {
                    $hiddenField.val('');
                }

                console.log('$hiddenField.val', $hiddenField.val())

                $('#questionForm').submit();
            });


        });
    </script>
@endpush
