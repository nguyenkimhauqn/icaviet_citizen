<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/mock-test.css') }}">
    @stack('styles')
</head>

<body>
    {{-- Header --}}

    <div class="container">
        @yield('content')
    </div>

    <!-- jQuery + Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>
    <script>
        // Text to speech
        let isSpeaking = false;

        function speak(text) {
            if (!('speechSynthesis' in window)) {
                alert("Trình duyệt của bạn không hỗ trợ Text-to-Speech.");
                return;
            }

            const synth = window.speechSynthesis;

            // Nếu đang đọc thì bỏ qua
            if (isSpeaking || synth.speaking) {
                console.warn("Speech is already in progress...");
                return;
            }

            const utter = new SpeechSynthesisUtterance(text);
            utter.voice = synth.getVoices().find(voice => voice.lang === 'en-US');

            isSpeaking = true;

            // Khi đọc xong
            utter.onend = () => {
                isSpeaking = false;
                console.log("Speech finished.");
            };

            // Nếu có lỗi
            utter.onerror = () => {
                isSpeaking = false;
                console.error("Speech failed.");
            };

            synth.speak(utter);
        }

        // Speech to text
        let isListening = false;

        function listen(onResult = (text) => {}, onDone = () => {}, onError = () => {}) {
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            if (!SpeechRecognition) {
                alert("Trình duyệt của bạn không hỗ trợ Speech Recognition.");
                return;
            }

            if (isListening) {
                console.warn("Already listening...");
                return;
            }

            const recognition = new SpeechRecognition();
            recognition.lang = 'en-US';
            recognition.interimResults = false;
            recognition.maxAlternatives = 1;

            isListening = true;

            recognition.onstart = () => {
                console.log("Voice recognition started...");
            };

            recognition.onresult = (event) => {
                const transcript = event.results[0][0].transcript;
                onResult(transcript);
            };

            recognition.onerror = (event) => {
                console.error("Speech recognition error:", event.error);
                let message = "Đã xảy ra lỗi khi nhận giọng nói.";

                switch (event.error) {
                    case 'no-speech':
                        message = "Không phát hiện thấy giọng nói nào. Vui lòng thử lại.";
                        break;
                    case 'audio-capture':
                        message = "Không thể truy cập microphone. Vui lòng kiểm tra thiết bị.";
                        break;
                    case 'not-allowed':
                        message = "Bạn đã từ chối quyền truy cập microphone hoặc trình duyệt đã chặn.";
                        break;
                    case 'aborted':
                        message = "Ghi âm đã bị hủy.";
                        break;
                    case 'network':
                        message = "Lỗi kết nối mạng.";
                        break;
                    case 'service-not-allowed':
                        message = "Trình duyệt hoặc thiết bị không cho phép sử dụng microphone.";
                        break;
                    default:
                        message = "Lỗi không xác định: " + event.error;
                }

                alert(message);
                isListening = false;
                onError();
            };

            recognition.onend = () => {
                isListening = false;
                onDone();
                console.log("Voice recognition ended.");
            };

            recognition.start();
        }
    </script>

    @stack('scripts')
</body>

</html>
