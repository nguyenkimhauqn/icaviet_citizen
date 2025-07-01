@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('public/css/reading.css') }}">
    <div class="container max-w-2xl mx-auto px-4 py-6">
        {{-- Header --}}
        <div class="wp-header d-flex align-items-center mb-4">
            <div class="btn-home mr-2">
                <a href="{{ route('home') }}" class="" title="Quay về trang chủ" style="width: 42px; height: 42px;">
                    <img style="width: 50px; height: 50px;" src="{{ url('public/icon/Icon-back-home.svg') }}" alt="">
                </a>
            </div>
            <div class="flex justify-between items-center header-civics">
                <h3 class="heading-module text-2xl font-bold text-gray-800"> KIỂM TRA ĐỌC </h3>
            </div>
        </div>

        {{-- Tiến độ --}}
        <div class="process sp-bt d-flex justify-content-start">
            <div class="mb-2 text-base">
                <span class="">Câu hỏi </span> <span class="fw-bold"> {{ $index + 1 }} /
                    {{ $total }} </span>
            </div>
        </div>

        {{-- Câu hỏi chính (Audio + Câu hỏi) --}}
        <div id="reading-form">
            <div class="question-block">
                <div class="wp-question fl-item flex justify-center items-center my-6">
                    {{-- Icon Loa --}}
                    <img class="img-fluid img-loudspeaker play-audio-btn" src="{{ url('public/icon/loudspeaker.png') }}"
                        data-audio="{{ asset('public/audio/reading/' . $question->audio_path) }}" alt="icon_loudspeaker">

                    {{-- Nội dung câu hỏi --}}
                    <p id="writing-answer" class=" italic text-center mt-2">
                        {!! $question->content ?? '' !!}
                    </p>

                    <div id="box-img-loading" class="d-none">
                        <img src="{{ url('public/audio/reading/loading.gif') }}" alt="loading" class="img-fluid w-20">
                    </div>
                    {{-- Dịch câu hỏi và mẹo ghi nhớ --}}
                    @if ($question->pronunciation)
                        <p id="pronunciation" class="mt-2 d-none">
                            <strong>Phát âm dễ nhớ:</strong> {{ $question->pronunciation }}
                        </p>
                    @endif

                    {{-- Kết quả thu âm --}}
                    {{-- doing  --}}
                    <div id="box-speech-result" class="bg-light box-speech-result d-flex justify-content-between p-3">
                        <span id="speech-result" class="px-3 py-2 d-inline-block">
                            Nhấn vào micro và đọc câu
                        </span>
                        <img id="icon-correct" class="d-none" src="{{ url('public/icon/icon-correct.svg') }}"
                            alt="icon-correct">
                        <i id="icon-close" class="bi bi-x-lg px-3 py-2 d-none"></i>
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
                    <p class="mt-2 translation">
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

            {{-- Các nút hành động --}}
            <div class="wp-action d-flex">
                {{-- Previous --}}
                <a href="{{ route('reading.show', ['index' => ($index - 1 + $total) % $total]) }}"
                    class="btn action-btn btn-previous">
                    <i class="bi bi-chevron-left"></i>
                </a>

                {{-- Submit (Kiểm tra) --}}
                <button id="start-recording" class="btn action-btn btn-submit">
                    <i id="icon-mic" class="bi bi-mic"></i>
                    <i id="icon-stop" class="bi bi-square d-none"></i>
                </button>

                {{-- Next --}}
                <a href="{{ route('reading.show', ['index' => ($index + 1) % $total]) }}" class="btn action-btn btn-next">
                    <i class="bi bi-chevron-right"></i>
                </a>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // ====== [01] Auto play audio once ======
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
            $('.wp-action a').on('click', function() {
                sessionStorage.removeItem('playedAudio');
            });

            // ====== [02] Phát audio khi bấm loa ======
            $('.play-audio-btn').on('click', function() {
                let audioSrc = $(this).data('audio');
                let audio = new Audio(audioSrc);
                if (audio.paused) {
                    audio.play();
                }
            });

            // ====== [03] Speech To Text ======
            function normalize(text) {
                return text.toLowerCase()
                    .replace(/[^\w\s]|_/g, "")
                    .replace(/\s+/g, " ")
                    .trim();
            }

            const $startBtn = $('#start-recording');
            const $resultBox = $('#box-speech-result');
            const $speechResult = $('#speech-result');
            const $iconCorrect = $('#icon-correct');
            const $iconClose = $('#icon-close');
            const $btnNext = $('.action-btn.btn-next');
            const $answerText = $('#writing-answer').text();

            const micIcon = document.getElementById('icon-mic');
            const stopIcon = document.getElementById('icon-stop');
            const imgLoading = document.getElementById('box-img-loading');

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

            // ==== START RECORD ====
            let isRecording = false;

            function startRecording() {
                if (isRecording) return;
                isRecording = true

                // UI update
                $resultBox.removeClass('correct-answer wrong-answer isActive');
                $speechResult.text('');
                $iconCorrect.addClass('d-none');
                $iconClose.addClass('d-none');
                $resultBox.addClass('isActive');

                micIcon.classList.add('d-none');
                stopIcon.classList.remove('d-none');
                imgLoading.classList.remove('d-none');

                if (navigator.vibrate) navigator.vibrate(100); // UX rung nhẹ

                recognition.start();
            }

            // ==== STOP RECORD ====
            function stopRecording() {
                if (!isRecording) return;
                isRecording = false;

                setTimeout(() => {
                    recognition.stop();
                }, 300); // bạn có thể thử 200ms đến 500ms để xem tối ưu nhất
            }

            // ==== GHI ÂM GIỮ-ĐỂ-NÓI ====
            $startBtn.on('mousedown touchstart', function(e) {
                e.preventDefault();
                startRecording();
            });

            $startBtn.on('mouseup touchend', function(e) {
                e.preventDefault();
                stopRecording();
            });

            // ==== KẾT QUẢ ====
            recognition.onresult = function(event) {
                const rawTranscript = event.results[0][0].transcript;
                const transcript = normalize(rawTranscript);
                const answerNormalized = normalize($answerText);

                $resultBox.removeClass('isActive');
                stopIcon.classList.add('d-none');
                micIcon.classList.remove('d-none');
                imgLoading.classList.add('d-none');

                $speechResult.text(transcript);

                if (transcript === answerNormalized) {
                    $resultBox.removeClass('bg-light wrong-answer').addClass('correct-answer');
                    $iconCorrect.removeClass('d-none').addClass('d-block');
                    $iconClose.addClass('d-none');
                    $btnNext.addClass('btn-next-correct');
                    $btnNext.find('i').css('color', 'white');
                    const correctSound = new Audio('{{ asset('/public/audio/civics/correct-answer.mp3') }}');
                    correctSound.play();
                } else {
                    $resultBox.removeClass('bg-light correct-answer').addClass('wrong-answer');
                    $iconCorrect.removeClass('d-block').addClass('d-none');
                    $iconClose.removeClass('d-none');
                    const wrongAudio = new Audio('{{ asset('public/audio/civics/Wrong-answer.mp3') }}');
                    wrongAudio.play();
                }
            };

            recognition.onerror = function(event) {
                $speechResult.text("❌ Lỗi: " + event.error);
            };

            recognition.onend = function() {
                isRecording = false;

                if ($resultBox.hasClass('isActive')) {
                    $resultBox.removeClass('isActive');
                    $speechResult.text('Nhấn vào micro và đọc câu!');
                    stopIcon.classList.add('d-none');
                    micIcon.classList.remove('d-none');
                    imgLoading.classList.add('d-none');
                }
            };

            // ====== [04] Toggle dịch + mẹo ghi nhớ ======
            $('#icon-show').on('click', function(e) {
                e.preventDefault();
                const boxTranslateTip = $('#boxTranslateTip');
                const pronunciation = $('#pronunciation');
                boxTranslateTip.toggleClass('d-none d-block');
                pronunciation.toggleClass('d-none d-block');

                const img = $('#icon-show img');
                const currentSrc = img.attr('src');
                const switchOff = "{{ url('public/icon/writing/Switch.png') }}";
                const switchOn = "{{ url('public/icon/writing/Switch_on.png') }}";

                img.attr('src', currentSrc === switchOff ? switchOn : switchOff);
            });
        });
    </script>
@endsection
