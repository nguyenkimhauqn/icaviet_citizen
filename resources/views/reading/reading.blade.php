<!DOCTYPE html>
<html>
<head>
    <title>Recorder.js Test</title>
</head>
<body>
    <h2>Ghi âm bằng Recorder.js</h2>
    <button id="startBtn">Bắt đầu ghi</button>
    <button id="stopBtn" disabled>Dừng</button>
    <audio id="player" controls></audio>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/recorderjs/0.1.0/recorder.min.js"></script>
    <script>
        let audioContext, recorder;

        document.getElementById('startBtn').onclick = async () => {
            const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
            audioContext = new AudioContext();
            const input = audioContext.createMediaStreamSource(stream);
            recorder = new Recorder(input, { numChannels: 1 });

            recorder.record();
            document.getElementById('startBtn').disabled = true;
            document.getElementById('stopBtn').disabled = false;
        };

        document.getElementById('stopBtn').onclick = () => {
            recorder.stop();
            recorder.exportWAV(blob => {
                const formData = new FormData();
                formData.append('audio_data', blob, 'recording.wav');

                fetch('{{ route('reading.upload') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('player').src = data.path;
                    }
                });
            });

            document.getElementById('startBtn').disabled = false;
            document.getElementById('stopBtn').disabled = true;
        };
    </script>
</body>
</html>
