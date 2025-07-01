@extends('layouts.base-test')

@section('title', 'N-400')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/n400.css') }}">
@endpush

@section('content')

    <!-- Modal -->
    <div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            {{-- <div class="form-container bg-white text-center">
                <h5 class="mb-4 add-question-title">Thêm câu hỏi mới</h5>

                <form>
                    <input type="text" class="form-control mb-3" placeholder="Nhập câu hỏi">
                    <input type="text" class="form-control mb-4" placeholder="Nhập câu trả lời">
                    <button type="submit" class="btn btn-primary w-100 py-2">Lưu</button>
                </form>
            </div> --}}


            <form id="modalQuestionForm" method="POST" action="{{ route('n400.store') }}">
                @csrf
                <input type="hidden" name="category_id" id="modal_category_id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title add-question-title" id="addQuestionModalLabel">Thêm
                            câu hỏi mới</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control mb-3" name="content" placeholder="Nhập câu hỏi" required>
                        <input type="text" class="form-control mb-3" name="default_answers"
                            placeholder="Nhập câu trả lời" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary w-100 py-2">Lưu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



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
        <div class="add-question-container mt-4">
            <img src="{{ asset('icon/n400/menu.svg') }}" alt="Menu">
            <div class="d-flex">
                <div class="add-btn" data-bs-toggle="modal" data-bs-target="#addQuestionModal"
                    data-category-id="{{ $category->id }}">
                    <span>Thêm câu hỏi</span>
                    <img src="{{ asset('icon/n400/plus.svg') }}" alt="Thêm câu hỏi">
                </div>
                <img src="{{ asset('icon/n400/star.svg') }}" alt="Thêm câu hỏi">
            </div>
        </div>

        @if ($question && $question->type == 'text')
            <form method="GET" action="{{ route('n400.category.show', ['id' => $category->id, 'page' => $page + 1]) }}"
                id="questionForm">
                <div class="quiz-container" style="margin-top: 20px;">
                    <div class="audio">
                        <img src="{{ asset('icon/mockTests/audio.svg') }}" style="width: 70px;" alt="Play audio" />
                        <input class="questionText hidden" type="hidden" value="{{ $question->content }}"></input>
                    </div>
                    <span class="font-sm text-center">{!! $question->content !!}</span>

                    <div class="position-relative">
                        <img class="icon-textarea" src="{{ asset('icon/n400/sound.svg') }}" alt="Audio">
                        <textarea name="answer_text" class="instruction-text form-control mt-4 ps-5"
                            placeholder="{{ isset($question->answer_note) ? e($question->answer_note) : 'Nhập ở đây' }}">{{ e($question->default_answers) }}</textarea>
                    </div>

                    @if (isset($question->default_answers_pronunciation))
                        <div class="">
                            <p class="font-bold-italic text-start mt-2">Phát âm dễ nhớ:</p>
                            <textarea name="answer_text" class="instruction-text form-control mt-1">{{ e($question->default_answers_pronunciation) }}</textarea>
                        </div>
                    @endif

                </div>
            </form>
        @endif

        @if ($question && ($question->type === null || $question->type === 'multiple_choice'))
            <form method="GET" action="{{ route('n400.category.show', ['id' => $category->id, 'page' => $page + 1]) }}"
                id="questionForm">
                <div class="quiz-container" style="margin-top: 20px;">
                    <div class="audio">
                        <img src="{{ asset('icon/mockTests/audio.svg') }}" style="width: 70px;" alt="Play audio" />
                        <input class="questionText hidden" type="hidden" value="{{ $question->content }}"></input>
                    </div>

                    <span class="font-sm text-center">{!! $question->content !!}</span>

                    <div class="radio-options bg-light p-4 rounded text-start mt-4">
                        @foreach ($question->answers as $answer)
                            <div class="form-check mb-2 d-flex justify-content-center gap-2 align-items-start">
                                <div class="d-flex flex-column" style="width: 100%;">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex gap-2 justify-content-start align-items-center">
                                            <input class="form-check-input toggle-additional" type="radio"
                                                name="answer_id" id="answer{{ $answer->id }}"
                                                value="{{ $answer->id }}" data-answer="{{ $answer->content }}"
                                                data-has-audio="{{ $answer->has_audio ? 'true' : 'false' }}"
                                                data-has-additional="{{ $answer->additional_answer_placeholder ? 'true' : 'false' }}"
                                                @if (trim($answer->content) === trim($question->default_answers)) checked @endif>

                                            <label class="form-check-label radio-label font-sm"
                                                for="answer{{ $answer->id }}">
                                                {{ $answer->content }}
                                            </label>
                                        </div>

                                        {{-- @if ($answer->has_audio)
                                            <div class="audio-answer" data-answer="{{ $answer->content }}">
                                                <img src="{{ asset('icon/mockTests/audio.svg') }}" style="width: 10px;"
                                                    alt="Play audio" />
                                            </div>
                                        @endif --}}

                                        <div class="audio-answer d-none" id="audio-icon-{{ $answer->id }}"
                                            data-answer="{{ $answer->content }}">
                                            <img src="{{ asset('icon/mockTests/audio.svg') }}" style="width: 25px;"
                                                alt="Play audio" />
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- Field bổ sung --}}
                            {{-- <textarea type="text" name="additional_field_{{ $answer->id }}"
                                class="form-control mt-2 additional-field questionText" placeholder="{{ $answer->additional_answer_placeholder }}"
                                style="display: none;"></textarea> --}}

                            <div class="position-relative additional-field-container" style="display: none;">
                                <img class="icon-textarea-additional" data-answer-id="{{ $answer->id }}"
                                    src="{{ asset('icon/n400/sound.svg') }}" alt="Audio"
                                    style="position: absolute; top: 12px; left: 10px; width: 20px; cursor: pointer;">

                                <textarea type="text" name="additional_field_{{ $answer->id }}"
                                    class="form-control mt-2 ps-5 additional-field questionText"
                                    placeholder="{{ $answer->additional_answer_placeholder }}" rows="3"></textarea>
                            </div>

                            {{-- Box cảnh báo --}}
                            @if ($answer->warning)
                                <div class="warning-container mb-2 d-none" data-answer-id="{{ $answer->id }}">
                                    <div class="mt-3 font-sm text-muted p-3 rounded shadow-sm"
                                        style="background: #f9f9fc; border-left: 4px solid #FF3363;">
                                        <p class="d-flex align-center gap-2 mb-2 text-dark font-sm"
                                            style="color: #FF3363;">
                                            <img src="{{ asset('icon/n400/warning.svg') }}" alt="Warning">
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

        @php
            $tips = json_decode($question->tips, true);

            $filteredTips = collect($tips ?? [])->filter(function ($value, $key) {
                return $key !== 'another_answer_way' && $key !== 'suggestion';
            });
        @endphp

        <div class="hint-container">
            <div class="toggle-container">
                <label class="switch">
                    <input type="checkbox" id="hintToggle">
                    <span class="slider"></span>
                </label>
                <span>Hiện gợi ý</span>
            </div>
            <div class="line mt-3"></div>

            <div id="hintText" style="display: none; width: 100%;">
                <div class="translate-box mt-3 text-start">
                    <p class="font-very-sm-italic">Dịch: {{ $question->translation }}</p>
                    @if ($question->default_answers_translation)
                        - <span class="font-very-sm-italic">{{ $question->default_answers_translation }}</span>
                    @endif

                    @foreach ($question->answers as $answer)
                        @if ($answer->explanation)
                            <div>
                                - <span class="font-bold">{{ $answer->content }}:</span>
                                <span class="font-very-sm-italic">{{ $answer->explanation }}</span>
                            </div>
                        @endif
                    @endforeach
                </div>

                @if ($filteredTips->isNotEmpty())
                    <div class="container-tips mb-2">
                        <div class="tips-box">
                            <strong>
                                <p class="d-block font-sm font-bold">Mẹo ghi nhớ:</p>
                            </strong>
                            <div class="d-flex flex-wrap gap-2 mt-2">
                                @foreach ($tips as $label => $value)
                                    @if ($label !== 'another_answer_way' && $label !== 'suggestion')
                                        {{-- Bỏ qua entry đặc biệt --}}
                                        <div class="answer-tips">
                                            <span class="tag">
                                                <span class="tag-key">{{ $label . ':' }} </span>
                                                <span class="tag-value">{{ $value }}</span>
                                            </span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif


                @if (isset($question->tips) && isset($tips['another_answer_way']))
                    <div class="another-section">
                        <div class="mt-3 font-sm text-muted p-3 rounded shadow-sm another-way"
                            style="background: #f9f9fc; border-left: 4px solid #27ae60; width: 100%;">
                            <p class="ml-2 mb-2 text-dark font-sm"><strong>Cách trả lời khác:</strong></p>
                            <ul class="p-0 mb-0 text-dark font-sm" style="list-style: none;">
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
                    </div>
                @endif

                @if (isset($question->tips) && isset($tips['suggestion']))
                    <div class="another-section">
                        <div class="mt-3 font-sm text-muted p-3 rounded shadow-sm another-way"
                            style="background: #f9f9fc; border-left: 4px solid #27ae60; max-width: 500px;">
                            <p class="ml-2 mb-2 text-dark font-sm"><strong>Gợi ý:</strong></p>
                            <p class="text-dark font-sm">
                                {{ $tips['suggestion'] }}
                            </p>
                        </div>
                    </div>
                @endif
            </div>


        </div>


    </main>

    <div class="test-footer">
        <button class="btn btn-round" id="prevBtn">
            <img src="{{ asset('icon/mockTests/arrow-left.svg') }}" alt="Prev" />
        </button>
        <button class="btn btn-round" id="nextBtn">
            <img src="{{ asset('icon/mockTests/arrow-right.svg') }}" alt="Next" />
        </button>

    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            // Binding category_id vào hidden input khi mở modal
            $('#addQuestionModal').on('show.bs.modal', function(event) {
                const button = $(event.relatedTarget); // Button triggering modal
                const categoryId = button.data('category-id'); // Lấy category id

                $(this).find('#modal_category_id').val(categoryId); // Gán vào hidden input
            });


            function showDefaultAdditionalField() {
                const defaultChecked = $('input[name="answer_id"]:checked');
                if (defaultChecked.length) {
                    const answerId = defaultChecked.val();

                    // Highlight label
                    $(`label[for="answer${answerId}"]`).addClass('active');

                    // Hiện field bổ sung nếu có
                    if (defaultChecked.data('has-additional') === true || defaultChecked.data('has-additional') ===
                        'true') {
                        $(`textarea[name="additional_field_${answerId}"]`).closest('.additional-field-container')
                            .show();
                    }

                    // Hiện audio nếu có
                    if (defaultChecked.data('has-audio') === true || defaultChecked.data('has-audio') === 'true') {
                        $(`#audio-icon-${answerId}`).removeClass('d-none');
                    }

                    // Hiện cảnh báo nếu có
                    $(`.warning-container[data-answer-id="${answerId}"]`).removeClass('d-none');

                    // Bật nút Next
                    $('#nextBtn').addClass('active');
                }
            }

            showDefaultAdditionalField();

            $('#prevBtn').on('click', function(e) {
                e.preventDefault(); // Ngăn hành vi mặc định (nếu có)
                window.history.back(); // Quay lại trang trước
            });

            // Audio click (text-to-speech)
            // $('.audio').on('click', function() {
            //     const text = $('.questionText').val();
            //     console.log('speak', text);
            //     speakText(text);
            // });

            // Phát âm nội dung field bổ sung
            $(document).on('click', '.icon-textarea-additional', function() {
                const answerId = $(this).data('answer-id');
                const text = $(`textarea[name="additional_field_${answerId}"]`).val();

                console.log('🔊 speak additional:', text);
                speakText(text);
            });


            // Audio câu hỏi
            $('.audio').on('click', function() {
                let rawHtml = $(this).find('.questionText').val();

                // Tạo một thẻ ảo để loại bỏ các thẻ HTML
                let tempDiv = document.createElement("div");
                tempDiv.innerHTML = rawHtml;
                let plainText = tempDiv.textContent || tempDiv.innerText || "";

                console.log('speak', plainText); // Output: How long have you been in the United States?
                speakText(plainText);
            });

            // Audio trả lời (trắc nghiệm)
            $('.audio-answer').on('click', function() {
                const text = $(this).data('answer');
                console.log('speak', text);
                speakText(text);
            });


            // Audio trả lời (tự luận)
            $('.icon-textarea').on('click', function() {
                const text = $('textarea[name="answer_text"]').val();
                console.log('✅ speak:', text);
                speakText(text)
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

                // $('#nextBtn').on('click', function(e) {
                //     const $textInput = $('textarea[name="answer_text"]');
                //     const rawValue = $textInput.val().trim();

                //     // Nếu không nhập gì thì đi tiếp trong category hiện tại
                //     if (!rawValue) {
                //         const nextUrl = `{{ route('n400.category.show', ['id' => $category->id]) }}`;
                //         const nextPage = {{ $page + 1 }};
                //         const params = new URLSearchParams();
                //         params.set('page', nextPage);
                //         params.set('answer_text', rawValue);
                //         window.location.href = nextUrl + '?' + params.toString();
                //         return;
                //     }

                //     const numericValue = Number(rawValue);
                //     const isNumber = !isNaN(numericValue);

                //     const skipToCategory = {{ $question->skip_to_category ?? 'null' }};
                //     const skipToQuestion = {{ $question->skip_to_question ?? 'null' }};

                //     let nextUrl = `{{ route('n400.category.show', ['id' => $category->id]) }}`;
                //     let nextPage = {{ $page + 1 }};
                //     let currentPage = {{ $page }};

                //     // Chỉ skip nếu nhập đúng là số 0
                //     if (isNumber && numericValue === 0) {
                //         if (skipToCategory && skipToCategory !== 0) {
                //             nextUrl = `{{ route('n400.category.show', ['id' => '__ID__']) }}`.replace(
                //                 '__ID__', skipToCategory);
                //             nextPage = 1;
                //         }

                //         if (skipToQuestion && skipToQuestion !== 0) {
                //             nextPage = skipToQuestion;
                //         }
                //     }

                //     if (skipToCategory && skipToCategory !== 0) {
                //         nextUrl = `{{ route('n400.category.show', ['id' => '__ID__']) }}`.replace(
                //             '__ID__', skipToCategory);
                //         nextPage = 1;
                //     }

                //     const params = new URLSearchParams();
                //     params.set('page', nextPage);
                //     params.set('answer_text', rawValue);
                //     window.location.href = nextUrl + '?' + params.toString();
                // });

                $('#nextBtn').on('click', function(e) {
                    const $textInput = $('textarea[name="answer_text"]');
                    const rawValue = $textInput.val().trim();

                    const currentPage = {{ $page }};
                    const nextUrl = `{{ route('n400.category.show', ['id' => $category->id]) }}`;
                    const params = new URLSearchParams();

                    params.set('page', currentPage); // Gửi về đúng page hiện tại
                    params.set('answer_text', rawValue); // Gửi raw input để controller xử lý skip

                    window.location.href = nextUrl + '?' + params.toString();
                });

                return;
            }



            // Trường hợp dạng MULTIPLE CHOICE
            const radioInputs = $('input[name="answer_id"]');

            radioInputs.on('change', function() {
                const selected = $(this); // ✅ Khai báo đúng

                const hasAdditional = selected.data('has-additional');
                console.log('hasAdditional', hasAdditional)
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
                $('.additional-field-container').hide();

                // Hiện field bổ sung nếu đáp án cần
                if (hasAdditional) {
                    $(`textarea[name="additional_field_${selected.val()}"]`)
                        .closest('.additional-field-container')
                        .show();
                }

                // THÊM đoạn xử lý has_audio:
                $('.audio-answer').addClass('d-none');

                if (selected.data('has-audio') === true || selected.data('has-audio') === 'true') {
                    const answerText = selected.data('answer');
                    const answerId = selected.val();

                    $(`#audio-icon-${answerId}`).removeClass('d-none');
                }
            });


            $('#nextBtn').on('click', function(e) {
                const selected = $('input[name="answer_id"]:checked').val();

                // if (!selected) {
                //     alert('Vui lòng chọn một đáp án!');
                //     return;
                // }

                const selectedAnswer = $('input[name="answer_id"]:checked').val();
                const nextUrl =
                    `{{ route('n400.category.show', ['id' => $category->id]) }}?page={{ $page }}&answer_id=${selectedAnswer}`;
                window.location.href = nextUrl;
            });

        });
    </script>
@endpush
