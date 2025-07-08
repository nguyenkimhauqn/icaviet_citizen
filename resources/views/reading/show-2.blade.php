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
                    alt="icon_starred"> </span>
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

                    <div id="alert-content"></div>

                    {{-- Kết quả thu âm --}}
                    {{-- doing  --}}
                    <div id="box-speech-result" class="bg-light box-speech-result d-flex justify-content-between p-3">
                        <span id="speech-result" class="px-3 py-2 d-inline-block">
                            Nhấn vào micro và đọc câu
                        </span>
                        <img id="icon-correct" class="d-none" src="{{ url('public/icon/icon-correct.svg') }}"
                            alt="icon-correct">
                        {{-- <i id="icon-close" class="bi bi-x-lg px-3 py-2 d-none"></i> --}}
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
            {{-- <div class="wp-action d-flex">
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
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // ====== [01] Phát audio khi bấm loa ======
            $('.play-audio-btn').on('click', function() {
                let audioSrc = $(this).data('audio');
                let audio = new Audio(audioSrc);
                audio.play();
            });

            const correctAudio = new Audio('{{ asset('public/audio/civics/correct-answer.mp3') }}');
            const wrongAudio = new Audio('{{ asset('public/audio/civics/Wrong-answer.mp3') }}');

            document.addEventListener('click', function() {
                correctAudio.load();
                wrongAudio.load();
            });

            function normalize(text) {
                return text.toLowerCase().replace(/[^\w\s]|_/g, "").replace(/\s+/g, " ").trim();
            }

            function isSafari() {
                return /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
            }

            const $startBtn = $('#start-recording');
            const $resultBox = $('#box-speech-result');
            const $resultContent = $('#speech-result');
            const $answerText = $('#writing-answer').text();
            const iconStop = document.getElementById('icon-stop');
            const iconMic = document.getElementById('icon-mic');
            const iconWave = document.getElementById('box-img-loading');
            const iconCorrect = document.getElementById('icon-correct');

            let recognition = null;
            let isRecognizing = false;
            let isReadyToStart = true;
            let stoppedManually = false;
            let resultReturned = false;
            let stopTimeout = null;

            $startBtn.on('click', function() {
                if (!isReadyToStart || isRecognizing) {
                    $resultContent.text("⏳ Đang xử lý hoặc đang ghi âm...");
                    return;
                }

                $startBtn.prop('disabled', true);

                const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
                if (!SpeechRecognition) {
                    alert("Trình duyệt không hỗ trợ ghi âm.");
                    return;
                }

                // ⚠️ TẠO MỚI mỗi lần bấm
                recognition = new SpeechRecognition();

                // Gán lại các handler mỗi lần
                recognition.onresult = function(event) {

                    resultReturned = true;
                    isRecognizing = false;
                    isReadyToStart = true;
                    clearTimeout(stopTimeout);

                    const rawTranscript = event.results[0][0].transcript;
                    const transcript = normalize(rawTranscript);
                    const answerNormalized = normalize($answerText);

                    $resultBox.removeClass('isActive');
                    iconStop.classList.add('d-none');
                    iconWave.classList.add('d-none');
                    iconMic.classList.remove('d-none');

                    if (transcript === answerNormalized) {
                        $resultContent.text(transcript);
                        $resultBox.removeClass('bg-light answer-wrong').addClass('answer-correct');
                        iconCorrect.classList.remove('d-none');
                        correctAudio.play();
                    } else {
                        $resultContent.text(transcript);
                        $resultBox.removeClass('bg-light answer-correct').addClass('answer-wrong');
                        wrongAudio.play();
                    }

                    // $startBtn.prop('disabled', false);
                };

                recognition.onerror = function(event) {

                    console.warn("Recognition error:", event.error);
                    $resultContent.text("❌ Lỗi: " + event.error);
                    isRecognizing = false;
                    isReadyToStart = true;

                    iconStop.classList.add('d-none');
                    iconWave.classList.add('d-none');
                    iconMic.classList.remove('d-none');

                    // $startBtn.prop('disabled', false);
                };

                recognition.onend = function() {

                    isRecognizing = false;
                    isReadyToStart = true;
                    clearTimeout(stopTimeout);

                    if ($resultBox.hasClass('isActive')) {
                        $resultBox.removeClass('isActive');
                        if (!resultReturned) {
                            $resultContent.text('❌ Không nhận được kết quả, vui lòng thử lại');
                            $resultBox.removeClass('answer-correct answer-wrong').addClass('bg-light');
                        }
                    }

                    iconStop.classList.add('d-none');
                    iconMic.classList.remove('d-none');
                    iconWave.classList.add('d-none');

                    // $startBtn.prop('disabled', false);

                };

                // Các biến điều khiển
                stoppedManually = false;
                resultReturned = false;
                isRecognizing = true;
                isReadyToStart = false;

                // Giao diện
                $resultBox.removeClass('answer-correct answer-wrong isActive');
                $resultBox.addClass('isActive');
                $resultContent.text('⏳ Đang nghe...');
                iconStop.classList.remove('d-none');
                iconMic.classList.add('d-none');
                iconWave.classList.remove('d-none');
                iconCorrect.classList.add('d-none');

                try {
                    recognition.start();
                } catch (err) {
                    console.warn("Recognition start error:", err);
                    $resultContent.text('⚠️ Không thể bắt đầu ghi âm.');
                    isRecognizing = false;
                    isReadyToStart = true;
                }
            });

            iconStop.addEventListener('click', function() {
                if (!recognition || !isRecognizing) return;

                stoppedManually = true;
                resultReturned = false;
                isRecognizing = false;

                $resultContent.text('🛑 Đang xử lý...');
                iconStop.classList.remove('d-none');
                iconWave.classList.remove('d-none');
                iconMic.classList.add('d-none');

                const stopDelay = isSafari() ? 4000 : 0;
                setTimeout(() => {
                    try {
                        recognition.stop();
                        $startBtn.prop('disabled', false);
                    } catch (e) {
                        console.warn('Recognition stop error:', e);
                    }
                }, stopDelay);

                stopTimeout = setTimeout(function() {
                    if (!resultReturned) {
                        $resultContent.text('❌ Không nhận được kết quả, vui lòng thử lại');
                        $resultBox.removeClass('answer-correct answer-wrong').addClass('bg-light');
                    }
                    iconStop.classList.add('d-none');
                    iconWave.classList.add('d-none');
                    iconMic.classList.remove('d-none');
                }, isSafari() ? 5000 : 0);
            });

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

            // ====== [05] Đánh dấu sao ======
            $('.toggle-star-btn').each(function() {
                updateStarIcon($(this));
            });

            $('.toggle-star-btn').on('click', function() {
                let btn = $(this);
                let questionId = btn.data('question-id');
                $.post("{{ url('civics/star') }}/" + questionId, {
                    _token: '{{ csrf_token() }}'
                }, function(res) {
                    btn.toggleClass('stared', res.status === 'added');
                    updateStarIcon(btn);
                });
            });
        });
    </script>
@endsection
