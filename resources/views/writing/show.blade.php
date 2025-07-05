@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('public/css/writing.css') }}">

    <div class="container mt-4">
        {{-- Header --}}
        <div class="wp-header d-flex align-items-center mb-4">
            <div class="btn-home mr-2">
                <a href="{{ route('home') }}" class="" title="Quay về trang chủ" style="width: 42px; height: 42px;">
                    <img style="width: 50px; height: 50px;" src="{{ url('public/icon/Icon-back-home.svg') }}" alt="">
                </a>
            </div>
            <div class="flex justify-between items-center header-civics">
                <h3 class="heading-module text-2xl font-bold text-gray-800"> KIỂM TRA VIẾT </h3>
            </div>
        </div>

        {{-- Tiến độ --}}
        <div class="process sp-bt d-flex">
            {{-- nav menu gắn sao --}}
            @if (!empty($mode) && $mode === 'showStarred')
                <div class="mb-2 text-base">
                    <a href="{{ route('star.category') }}">
                        <img src="{{ url('public/icon/star/icon-menu-star.png') }}" alt="icon-menu">
                    </a>
                </div>
            @endif

            <div class="mb-2 text-base">
                <span class="">Câu hỏi </span> <span class="fw-bold"> {{ $index + 1 }} /
                    {{ $total }} </span>
            </div>

            <span class="d-block toggle-star-btn {{ $isStarred ? 'stared' : '' }} " data-question-id={{ $question->id }}
                data-active={{ $isStarred ? '1' : '0' }}> <img src="{{ url('public/icon/Icon _Starred.svg') }}"
                    alt="icon_starred">
            </span>
        </div>

        {{-- Câu hỏi chính (Audio + Viết lại) --}}
        <form id="writing-form">
            @csrf
            <div class="question-block">
                <div class="wp-question fl-item flex justify-center items-center my-6">
                    {{-- Icon Loa --}}
                    <img class="img-fluid img-loudspeaker play-audio-btn" src="{{ url('public/icon/loudspeaker.png') }}"
                        data-audio="{{ asset('public/audio/writing/' . $question->audio_path) }}" alt="icon_loudspeaker">
                    {{-- Audio element ẩn --}}
                    <audio id="audio-player" src="{{ asset('public/audio/writing/' . $question->audio_path) }}"></audio>

                    {{-- Nội dung câu hỏi - ẩn mặc định --}}
                    <p id="writing-answer" class="d-none hidden italic text-center mt-2">{!! $question->content !!}</p>
                    {{-- Thông báo đúng/sai (placeholder) --}}
                    @if (session('result') !== null)
                        <div class="text-center mt-4 font-semibold">
                            @if (empty(session('input_answer')))
                                <div class="alert alert-warning d-inline-block" role="alert">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                    Nhập đáp án của bạn
                                </div>
                            @elseif (!session('result'))
                                <div class="alert alert-danger d-inline-block" role="alert">
                                    <i class="bi bi-x-circle-fill me-2"></i>
                                    Chưa chính xác, hãy thử lại!
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- Input người dùng --}}
                    <div class="textarea-wrapper w-100 d-flex justify-content-center">
                        <input type="hidden" name="index" value="{{ $index }}">
                        <textarea name="user_answer" class="input-writing form-control text-lg px-4 py-2 border rounded textarea-writing"
                            rows="3" placeholder="Nhập ở đây">{{ old('user_answer', session('input_answer')) }}</textarea>

                        {{-- Nút xóa (ẩn mặc định) --}}
                        <button type="button" id="clear-answer-btn">
                            &times;
                        </button>
                    </div>

                </div>
            </div>

            {{-- Nút hiện/ẩn đáp án --}}
            <div class="box-icon-show d-flex justify-content-center align-items-center">
                <div id="icon-show">
                    <img src="{{ url('public/icon/writing/Switch.png') }}" alt="icon_show" class="img-fluid">
                    <span class="text-hint"> Hiện gợi ý </span>
                </div>
            </div>

            <div id="boxTranslateTip" class="box-translate-tip d-none">
                {{-- Dịch câu hỏi và mẹo ghi nhớ --}}
                @if ($question->translation)
                    <p class="mt-2">
                        <strong>Dịch:</strong> {{ $question->translation }}
                    </p>
                @endif
                <div class="container-tips">
                    @if ($question->tips)
                        <div class="tips-box">
                            <strong>
                                <p class="d-block"> Từ vựng: </p>
                            </strong>
                            @foreach (json_decode($question->tips, true) as $label => $value)
                                <div class="answer-tips">
                                    <span class="tag">
                                        <span class="tag-key">{{ $label . ':' }} </span> <span class="tag-value">
                                            {{ $value }} </span>
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            {{-- <div class="wp-action d-flex">
                <a href="{{ route($routeName, ['index' => ($index - 1 + $total) % $total]) }}"
                    class="btn action-btn btn-previous">
                    <i class="bi bi-chevron-left"></i>
                </a>

                <button type="submit" class="btn action-btn btn-submit">
                    <i class="bi bi-check-lg"></i>
                </button>

                <a href="{{ route($routeName, ['index' => ($index + 1) % $total]) }}" class="btn action-btn btn-next">
                    <i class="bi bi-chevron-right"></i>
                </a>
            </div> --}}
            @if ($mode === 'showStarred')
                <div class="wp-action d-flex">
                    <a href="{{ route($routeName, ['index' => $index - 1]) }}" class="btn action-btn btn-previous">
                        <i class="bi bi-chevron-left"></i>
                    </a>

                    <button id="start-recording" class="btn-start action-btn btn-submit">
                        <i id="icon-mic" class="bi bi-mic"></i>
                        <i id="icon-stop" class="bi bi-square d-none"></i>
                    </button>

                    <a href="{{ route($routeName, ['index' => $index + 1]) }}" class="btn action-btn btn-next">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
            @else
                <div class="wp-action d-flex">
                    <a href="{{ route($routeName, ['index' => ($index - 1 + $total) % $total]) }}"
                        class="btn action-btn btn-previous">
                        <i class="bi bi-chevron-left"></i>
                    </a>

                    <button id="start-recording" class="btn-start action-btn btn-submit">
                        <i id="icon-mic" class="bi bi-mic"></i>
                        <i id="icon-stop" class="bi bi-square d-none"></i>
                    </button>

                    <a href="{{ route($routeName, ['index' => ($index + 1) % $total]) }}" class="btn action-btn btn-next">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
            @endif

        </form>

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // === * 01. Xử lý Toogle đáp án * ===
            $('#icon-show').on('click', function(e) {
                e.preventDefault();
                const answer = $('#writing-answer');
                const boxTranslateTip = $('#boxTranslateTip');
                answer.toggleClass('d-none d-block');
                boxTranslateTip.toggleClass('d-none d-block');
                // Xử lý đổi ảnh
                const img = $('#icon-show img');
                const currentSrc = img.attr('src');
                const switchOff = "{{ url('public/icon/writing/Switch.png') }}";
                const switchOn = "{{ url('public/icon/writing/Switch_on.png') }}";

                img.attr('src', currentSrc === switchOff ? switchOn : switchOff);

            });
            // === * [END] 01. Xử lý Toogle đáp án * ===

            // === * 02. Xử lý nút phát audio * ===
            // Phát tự động câu hỏi khi vào trang
            // Phát tự động audio CÂU HỎI nếu chưa từng phát
            if (!sessionStorage.getItem('playedAudio')) {
                const autoPlayBtn = $('.play-audio-btn').first();
                if (autoPlayBtn.length) {
                    const audioSrc = autoPlayBtn.data('audio');
                    const autoAudio = new Audio(audioSrc);
                    autoAudio.play().then(() => {
                        sessionStorage.setItem('playedAudio', 'true');
                    }).catch(function(e) {
                        console.warn('Autoplay bị chặn bởi trình duyệt:', e);
                    });
                }
            }
            // Khi bấm nút “Trước” hoặc “Tiếp”, reset lại trạng thái
            $('.wp-action a').on('click', function() {
                sessionStorage.removeItem('playedAudio');
            });

            // Phát âm câu hỏi
            $('.play-audio-btn').on('click', function() {
                let audioSrc = $(this).data('audio');
                let audio = new Audio(audioSrc);
                if (audio.paused) {
                    audio.play();
                }
            });
            // === * [END] - Xử lý nút phát audio * ===

            // Ajax check đáp án
            $('#writing-form').on('submit', function(e) {
                e.preventDefault();

                const index = $('input[name="index"]').val();
                const userAnswer = $('textarea[name="user_answer"]').val();

                $.ajax({
                    url: '{{ route('writing.check.ajax') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        index: index,
                        user_answer: userAnswer
                    },
                    success: function(response) {
                        const $textarea = $('textarea[name="user_answer"]');
                        const $btnNext = $('.action-btn.btn-next');

                        if (!userAnswer.trim()) {
                            // Không làm gì nếu chưa nhập gì
                            return;
                        }

                        if (response.result === true) {
                            $textarea.removeClass('wrong-answer').addClass('correct-answer');
                            $btnNext.addClass('btn-next-correct');
                            $btnNext.find('i').css('color', 'white');
                            new Audio(
                                    '{{ asset('public/audio/civics/correct-answer.mp3') }}'
                                )
                                .play();
                        } else {
                            $textarea.removeClass('correct-answer').addClass('wrong-answer');
                            $('#clear-answer-btn').show();
                            new Audio(
                                    '{{ asset('public/audio/civics/Wrong-answer.mp3') }}'
                                )
                                .play();

                            $('#clear-answer-btn').on('click', function() {
                                $textarea.val('').focus();
                                $textarea.removeClass('wrong-answer');
                                $(this).hide();
                            });
                        }
                    },
                    error: function(xhr) {
                        alert('Đã xảy ra lỗi kiểm tra.');
                    }
                });
            });
            // [END] - Ajax check đáp án

            // === * Lưu câu hỏi đánh dấu sao * ===

            //  --- Check isStarred ---
            $('.toggle-star-btn').each(function() {
                updateStarIcon($(this));
            });
            // --- [END] Check isStarred ---

            // --- Toggle + AJAX ---
            $('.toggle-star-btn').on('click', function() {
                let btn = $(this);
                let questionId = btn.data('question-id');
                // alert(1);
                $.post("{{ url('civics/star') }}/" + questionId, {
                    _token: '{{ csrf_token() }}'
                }, function(res) {
                    // Cập nhật trạng thái class
                    btn.toggleClass('stared', res.status === 'added');
                    // Gọi hàm update hình ảnh
                    updateStarIcon(btn);
                });
            });
            // ---  [END] - Toggle + AJAX ---

            // [END] == * Lưu câu hỏi đánh dấu sao * ===
        });
    </script>
@endsection
