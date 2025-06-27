@extends('layouts.app1')

@section('title', $testType->title)

@section('content')
    <div class="header-inner">
        <div class="header">
            <a href="{{ route('home') }}"><img src="{{ asset('icon/mockTests/home.svg') }}" alt="Home" /></a>
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
            <form method="POST" action="{{ route('submit.answer', [$testType->slug, 'page' => $page]) }}" id="questionForm">
                @csrf
                <input type="hidden" name="question_id" value="{{ $question->id }}">

                <div class="quiz-container">
                    <div class="audio">
                        <img src="{{ asset('icon/mockTests/audio.svg') }}" style="width: 40px;" alt="Play audio" />
                        <input class="questionText hidden" type="hidden" value="{{ $question->content }}"></input>
                    </div>

                    <textarea type="text" name="answer_text" class="instruction-text form-control mt-3" placeholder="Nhập ở đây">
                        </textarea>
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


                <div class="quiz-container">
                    <div class="audio">
                        <img src="{{ asset('icon/mockTests/audio.svg') }}" style="width: 40px;" alt="Play audio" />
                        <input class="questionText hidden" type="hidden" value="{{ $question->question_text }}"></input>
                    </div>

                    <div class="radio-options bg-light p-4 rounded">
                        @foreach ($question->answers as $answer)
                            <div class="form-check mb-2 d-flex justify-content-center gap-2 align-items-start">
                                <div class="d-flex flex-column" style="width: 100%;">
                                    <div class="d-flex gap-2 justify-content-center align-items-center">
                                        <input class="form-check-input toggle-additional" type="radio" name="answer_id"
                                            id="answer{{ $answer->id }}" value="{{ $answer->id }}"
                                            data-has-additional="{{ $answer->has_additional_answer ? 'true' : 'false' }}">

                                        <label class="form-check-label radio-label font-sm"
                                            for="answer{{ $answer->id }}">
                                            {{ $answer->content }}
                                        </label>
                                    </div>

                                    {{-- Field bổ sung --}}
                                    <textarea type="text" name="additional_field_{{ $answer->id }}"
                                        class="form-control mt-2 additional-field questionText" placeholder="Nhập thông tin bổ sung..."
                                        style="display: none;"></textarea>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </form>
        @endif
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
                    const inputName = `additional_field_${selected.val()}`;
                    $(`textarea[name="${inputName}"]`).show();
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
