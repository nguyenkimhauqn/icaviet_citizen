@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('/css/reading.css') }}">
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
                        data-audio="{{ asset('/audio/reading/' . $question->audio_path) }}" alt="icon_loudspeaker">

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
            <div class="wp-action d-flex">
                {{-- Previous --}}
                <a href="{{ route('reading.show', ['index' => ($index - 1 + $total) % $total]) }}"
                    class="btn action-btn btn-previous">
                    <i class="bi bi-chevron-left"></i>
                </a>

                {{-- Submit (Kiểm tra) --}}
                <button id="start-recording" class="btn-start action-btn btn-submit">
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
            // if (!sessionStorage.getItem('playedAudio')) {
            //     const autoPlayBtn = $('.play-audio-btn').first();
            //     if (autoPlayBtn.length) {
            //         const audioSrc = autoPlayBtn.data('audio');
            //         const autoAudio = new Audio(audioSrc);
            //         autoAudio.play().then(() => {
            //             sessionStorage.setItem('playedAudio', 'true');
            //         }).catch(function(e) {
            //             console.warn('Autoplay bị chặn bởi trình duyệt:', e);
            //         });
            //     }
            // }

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
            // Xử lý âm thanh
            const correctAudio = new Audio('{{ asset('/public/audio/civics/correct-answer.mp3') }}');
            const wrongAudio = new Audio('{{ asset('/public/audio/civics/Wrong-answer.mp3') }}');
            // Gán sẵn để iOS ghi nhận hành vi người dùng
            document.addEventListener('click', function() {
                correctAudio.load(); // pre-load
                wrongAudio.load();
            });

            // #3.1 Hàm chuẩn hóa văn bản
            function normalize(text) {
                return text
                    .toLowerCase()
                    .replace(/[^\w\s]|_/g, "") // bỏ dấu câu
                    .replace(/\s+/g, " ") // chuẩn hóa khoảng trắng
                    .trim();
            }
            // #3.2. Kha báo biến DOM và SpeechRecognition
            const $startBtn = $('#start-recording');
            const $resultBox = $('#box-speech-result');
            const $resultContent = $('#speech-result')
            const $answerText = $('#writing-answer').text();

            // Thêm phần tử liên quan đến hiển thị trong lúc ghi âm
            const iconStop = document.getElementById('icon-stop'); // icon stop
            const iconMic = document.getElementById('icon-mic'); // icon micro
            const iconWave = document.getElementById('box-img-loading'); // icon sóng
            // const alertContent = document.getElementById('alert-content'); // Alert Content
            const iconCorrect = document.getElementById('icon-correct'); // icon correct
            // #3.3 Kiểm tra hỗ trợ API
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

            if (!SpeechRecognition) {
                alert("Trình duyệt không hỗ trợ chức năng ghi âm.");
                $startBtn.prop('disabled', true);
                return;
            }
            // #3.4. Khởi tạo và cấu hình recognition
            const recognition = new SpeechRecognition();
            recognition.lang = 'en-US'; // Ngôn ngữ tiếng anh
            recognition.interimResults = false; // Chỉ nhận kết quả cuối (không realtime preview)
            recognition.maxAlternatives = 1; // Chỉ lấy 1 kết quả tốt nhất

            // #3.5. Xử lý CLICK ghi âm
            $startBtn.on('click', function() {
                $resultBox.removeClass('answer-correct answer-wrong'); // Xóa trạng thái đúng/ sai
                $resultBox.addClass('isActive'); // Gắn trạng thái đang nghe
                $resultContent.text('⏳ Đang nghe...');

                recognition.start(); // Bắt đầu thu âm

                // Hiển thị icon stop và sóng âm khi bắt đầu ghi
                iconStop.classList.remove('d-none'); // Hiện icon stop (hình vuông)
                iconMic.classList.add('d-none'); // Ẩn icon mic
                iconWave.classList.remove('d-none'); // Hiện sóng âm
                iconCorrect.classList.add('d-none'); // icon đúng
            });

            // #3.6. Khi có kết quả trả về (onresult)
            recognition.onresult = function(event) {
                const rawTranscript = event.results[0][0].transcript;
                const transcript = normalize(rawTranscript);
                const answerNormalized = normalize($answerText);
                $resultBox.removeClass('isActive'); // Gỡ trạng thái đang nghe

                // Ẩn tất cả icon liên quan đến ghi âm
                iconStop.classList.add('d-none');
                iconWave.classList.add('d-none');
                iconMic.classList.remove('d-none');
                // 3.7. So sánh kết quả và hiển thị đúng/sai
                if (transcript === answerNormalized) {
                    // ĐÚNG
                    $resultContent.text(transcript);
                    $resultBox.removeClass('bg-light answer-wrong').addClass('answer-correct');
                    iconCorrect.classList.remove('d-none');
                    new Audio('{{ asset('/public/audio/civics/correct-answer.mp3') }}')
                        .play();

                } else {
                    // SAI
                    $resultContent.text(transcript);
                    $resultBox.removeClass('bg-light answer-correct').addClass('answer-wrong');
                    // alertContent.textContent('Chưa đúng, hãy thử lại');
                    new Audio('{{ asset('/public/audio/civics/Wrong-answer.mp3') }}')
                        .play();
                }
            };

            // #3.7. Lỗi trong quá trình ghi âm
            recognition.onerror = function(event) {
                $resultContent.text("❌ Lỗi: " + event.error);

                // Ẩn icon stop & sóng âm nếu xảy ra lỗi
                iconStop.classList.add('d-none');
                iconWave.classList.add('d-none');
            };

            // #3.8. Khi ghi âm kết thúc (tự động hoặc stop)
            recognition.onend = function() {
                if ($resultBox.hasClass('isActive')) {
                    $resultBox.removeClass('isActive');
                    $resultContent.text('❌ Không nghe rõ âm thanh, vui lòng thử lại');
                }

                // Ẩn icon stop & sóng âm nếu chưa có kết quả
                iconStop.classList.add('d-none');
                iconMic.classList.remove('d-none');
                iconWave.classList.add('d-none');
            };
            // [END] 03. - Speech to Text

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
