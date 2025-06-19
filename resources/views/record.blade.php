@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">🎙 Ghi âm giọng nói (OPEN AI)</h2>

    <div class="mb-3">
        <button id="start" class="btn btn-primary me-2">
            ▶️ Bắt đầu ghi âm
        </button>
        <button id="stop" class="btn btn-danger" disabled>
            ⏹️ Dừng ghi âm
        </button>
    </div>

    <div class="mb-4">
        <audio id="audioPlayer" controls class="w-100"></audio>
    </div>

    <div class="mb-3">
        <label for="transcript" class="form-label fw-bold">📄 Kết quả chuyển giọng nói:</label>
        <textarea id="transcript" class="form-control" rows="5" readonly></textarea>
    </div>
</div>

<script src="{{ URL('public/js/recorder.js') }}"></script>
<script>
    let recorder, audioContext;

    document.getElementById('start').onclick = async () => {
        try {
            const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
            audioContext = new(window.AudioContext || window.webkitAudioContext)();
            const input = audioContext.createMediaStreamSource(stream);
            recorder = new Recorder(input, { numChannels: 1 });
            recorder.record();

            document.getElementById('start').disabled = true;
            document.getElementById('stop').disabled = false;
        } catch (err) {
            alert("Không thể truy cập micro: " + err.message);
        }
    };

    document.getElementById('stop').onclick = () => {
        recorder.stop();
        recorder.exportWAV(sendWavToLaravel);
        document.getElementById('start').disabled = false;
        document.getElementById('stop').disabled = true;
    };

    function sendWavToLaravel(blob) {
        const url = URL.createObjectURL(blob);
        document.getElementById('audioPlayer').src = url;

        const formData = new FormData();
        formData.append('audio', blob, 'record.wav');

        fetch("{{ route('whisper.transcribe') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.error) {
                document.getElementById('transcript').value = '[Lỗi] ' + data.error + (data.transcript_guess ? '\nĐoán: ' + data.transcript_guess : '');
            } else {
                document.getElementById('transcript').value = data.transcript || 'Không có kết quả.';
            }
        })
        .catch(err => {
            alert("Lỗi khi gửi file: " + err.message);
        });
    }
</script>
@endsection
