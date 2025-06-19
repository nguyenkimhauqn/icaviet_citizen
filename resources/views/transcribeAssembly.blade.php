@extends('layouts.app')

@section('content')
    <h2>🎙 Ghi âm giọng nói (Hỗ trợ Safari)</h2>

    <button id="start">▶️ Ghi âm</button>
    <button id="stop" disabled>⏹️ Dừng</button>
    <audio id="audioPlayer" controls></audio>

    <p><strong>Kết quả chuyển giọng nói:</strong></p>
    <textarea id="transcript" rows="5" cols="60" readonly></textarea>

    <!-- Load Recorder.js -->
    <script src="{{ url('public/js/recorder.js') }}"></script>

    <script>
        let recorder, audioContext;

        document.getElementById('start').onclick = async () => {
            const stream = await navigator.mediaDevices.getUserMedia({ audio: true });

            audioContext = new (window.AudioContext || window.webkitAudioContext)();
            const input = audioContext.createMediaStreamSource(stream);

            recorder = new Recorder(input, { numChannels: 1 });
            recorder.record();

            document.getElementById('start').disabled = true;
            document.getElementById('stop').disabled = false;
        };

        document.getElementById('stop').onclick = () => {
            recorder.stop();
            recorder.exportWAV(sendWavToLaravel);

            document.getElementById('start').disabled = false;
            document.getElementById('stop').disabled = true;
        };

        function sendWavToLaravel(blob) {
            const audioURL = URL.createObjectURL(blob);
            document.getElementById('audioPlayer').src = audioURL;

            const formData = new FormData();
            formData.append('audio', blob, 'record.wav');

            fetch("{{ route('whisper.transcribeAssembly') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('transcript').value = data.text || '(Không có kết quả)';
                } else {
                    document.getElementById('transcript').value = data.message || 'Lỗi xử lý.';
                }
            })
            .catch(err => {
                alert("Lỗi khi gửi file: " + err.message);
            });
        }
    </script>
@endsection
