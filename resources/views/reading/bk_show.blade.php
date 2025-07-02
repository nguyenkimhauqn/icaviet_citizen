@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('public/css/reading.css') }}">
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
                <h3 class="text-2xl font-bold text-gray-800"> KIỂM TRA ĐỌC </h3>
            </div>
        </div>

        {{-- Tiến độ --}}
        <div class="sp-bt">
            <div class="mb-2 text-base">
                <span class="highlight-text"> Câu hỏi {{ $index + 1 }} </span> / <span class="highlight-text">
                    {{ $total ?? '' }} </span>
            </div>
        </div>

        {{-- Câu hỏi chính (Audio + Câu hỏi) --}}
        <div class="question-block">
            <div class="wp-question fl-item flex justify-center items-center my-6">
                {{-- Icon Loa --}}
                <img class="img-fluid img-loudspeaker play-audio-btn" src="{{ url('public/icon/loudspeaker.png') }}"
                    data-audio="{{ asset('publicaudio/reading/' . $question->audio_path) }}" alt="icon_loudspeaker">

                {{-- Nội dung câu hỏi --}}
                <p id="writing-answer" class=" italic text-center mt-2">
                    {{ $question->content ?? '' }}
                </p>
                {{-- Kết quả thu âm --}}
                <div id="box-speech-result" class="bg-light box-speech-result text-center mt-1">
                    <span id="speech-result" class="px-3 py-2 d-inline-block">
                        Nhấn vào micro và đọc câu!
                    </span>
                </div>
                {{-- Các nút hành động --}}
                <div class="wp-action justify-between items-center mt-4">
                    <a href="{{ route('reading.show', ['index' => ($index - 1 + $total) % $total]) }}"
                        class="btn btn-primary">
                        ← Trước
                    </a>
                    <button id="start-recording" class="btn btn-secondary btn-submit d-focus">
                        🎤 Thu âm
                    </button>
                    <a href="{{ route('reading.show', ['index' => ($index + 1 + $total) % $total]) }}"
                        class="btn btn-primary">
                        Tiếp →
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            // === 01. Tự động phát audio 1 lần ===
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
            // Reset khi bấm nút chuyển câu
            $('.wp-action a').on('click', function() {
                sessionStorage.removeItem('playedAudio');
            });

            // === 02. Phát audio khi bấm loa ===
            $('.play-audio-btn').on('click', function() {
                let audioSrc = $(this).data('audio');
                let audio = new Audio(audioSrc);
                if (audio.paused) {
                    audio.play();
                }
            });

            // 03. Speech to Text
            function normalize(text) {
                return text
                    .toLowerCase()
                    .replace(/[^\w\s]|_/g, "") // bỏ dấu câu
                    .replace(/\s+/g, " ") // chuẩn hóa khoảng trắng
                    .trim();
            }

            const $startBtn = $('#start-recording');
            const $resultBox = $('#box-speech-result');
            const $answerText = $('#writing-answer').text();
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

            if (!SpeechRecognition) {
                alert("Trình duyệt không hỗ trợ chức năng ghi âm.");
                $startBtn.prop('disabled', true);
                return;
            }

            const recognition = new SpeechRecognition();
            recognition.lang = 'en-US';
            recognition.interimResults = false;
            recognition.maxAlternatives = 1;

            $startBtn.on('click', function() {
                $resultBox.removeClass('bg-success bg-danger');
                $resultBox.addClass('isActive');
                $resultBox.text('⏳ Đang nghe...');
                recognition.start();
            });

            recognition.onresult = function(event) {
                const rawTranscript = event.results[0][0].transcript;
                const transcript = normalize(rawTranscript);
                const answerNormalized = normalize($answerText);
                $resultBox.removeClass('isActive'); // reset trạng thái nghe

                // Kiểm tra với đáp án
                if (transcript === answerNormalized) {
                    $resultBox.text(transcript);
                    $resultBox.removeClass('bg-light bg-danger').addClass('bg-success');
                } else {
                    $resultBox.text(transcript);
                    $resultBox.removeClass('bg-light bg-success').addClass('bg-danger');
                }
            }

            recognition.onerror = function(event) {
                $resultBox.text("❌ Lỗi: " + event.error);
            };

            recognition.onend = function() {
                // Nếu vẫn còn text "Đang nghe..." thì reset lại
                if ($resultBox.hasClass('isActive')) {
                    $resultBox.removeClass('isActive');
                    $resultBox.text('Nhấn vào micro và đọc câu!');
                }
            };
            // [END] 03. - Speech to Text
        });
    </script>
@endsection
