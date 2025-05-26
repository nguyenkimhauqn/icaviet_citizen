@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('/public/css/writing.css') }}">

    <div class="container max-w-2xl mx-auto px-4 py-6">
        {{-- Header --}}
        <div class="wp-header d-flex align-items-end mb-4">
            <div class="btn-home mr-2">
                <a href="{{ route('home') }}"
                    class="btn btn-outline-dark rounded-circle d-flex align-items-center justify-content-center"
                    title="Quay về trang chủ" style="width: 48px; height: 48px;">
                    <i class="bi bi-arrow-left-circle-fill fs-3"></i>
                </a>
            </div>
            <div class="flex justify-between items-center header-civics">
                <h3 class="text-2xl font-bold text-gray-800"> KIỂM TRA VIẾT </h3>
            </div>
        </div>

        {{-- Tiến độ --}}
        <div class="sp-bt">
            <div class="mb-2 text-base">
                <span class="highlight-text"> Câu hỏi {{ $index + 1 }} </span> / <span class="highlight-text">
                    {{ $total }} </span>
            </div>
        </div>

        {{-- Câu hỏi chính (Audio + Viết lại) --}}
        <form action=" {{ route('writing.check') }} " method="POST">
            @csrf
            <div class="question-block">
                <div class="wp-question fl-item flex justify-center items-center my-6">
                    {{-- Icon Loa --}}
                    <img class="img-fluid img-loudspeaker play-audio-btn" src="{{ url('public/icon/loudspeaker.png') }}"
                        data-audio="{{ asset('public/audio/writing/' . $question->audio_path) }}" alt="icon_loudspeaker">
                    {{-- Audio element ẩn --}}
                    <audio id="audio-player" src="{{ asset('public/audio/writing/' . $question->audio_path) }}"></audio>
                    {{-- Nút hiện/ẩn đáp án --}}
                    <h5 id="icon-show">
                        <i class="bi bi-toggle-off toggle-icon"></i>
                    </h5>
                    {{-- Nội dung câu hỏi - ẩn mặc định --}}
                    <p id="writing-answer" class="d-none hidden italic text-center mt-2">{{ $question->content }}</p>
                    {{-- Thông báo đúng/sai (placeholder) --}}
                    @if (session('result') !== null)
                        <div class="text-center mt-4 font-semibold">
                            @if (empty(session('input_answer')))
                                <div class="alert alert-warning d-inline-block" role="alert">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                    Nhập đáp án của bạn
                                </div>
                            @elseif (session('result'))
                                <div class="alert alert-success d-inline-block" role="alert">
                                    <i class="bi bi-check-circle-fill me-2"></i>
                                    Chính xác!
                                </div>
                            @else
                                <div class="alert alert-danger d-inline-block" role="alert">
                                    <i class="bi bi-x-circle-fill me-2"></i>
                                    Sai rồi!
                                </div>
                            @endif
                        </div>
                    @endif
                    {{-- Input người dùng --}}
                    <div class="mt-2 flex fl-item">
                        <input type="hidden" name="index" value="{{ $index }}">
                        <textarea name="user_answer"
                            class="input-writing form-control text-lg px-4 border rounded textarea-writing text-lg px-4 py-2 border rounded"
                            rows="1" placeholder="Viết câu trả lời của bạn..."> {{ old('user_answer', session('input_answer')) }} </textarea>
                    </div>
                    {{-- Các nút hành động --}}
                    <div class="wp-action justify-between items-center mt-4">
                        {{-- Previous --}}
                        <a href="{{ route('writing.show', ['index' => ($index - 1 + $total) % $total]) }}"
                            class="btn btn-primary">
                            ← Trước
                        </a>
                        {{-- Submit (Kiểm tra) --}}
                        <button type="submit" class="btn btn-secondary btn-submit">
                            ✓ Kiểm tra
                        </button>

                        <a href="{{ route('writing.show', ['index' => ($index + 1) % $total]) }}" class="btn btn-primary">
                            Tiếp →
                        </a>
                    </div>
                </div>
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
                answer.toggleClass('d-none d-block');
                $('#icon-show i').toggleClass('bi-toggle-off bi-toggle-on');
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
        });
    </script>
@endsection
