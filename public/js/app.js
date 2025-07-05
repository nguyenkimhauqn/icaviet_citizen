
// updateStarIcon by HauNguyen
const baseUrl = window.Laravel.baseUrl;

function updateStarIcon($btn) {
    // alert(1);
    const $img = $btn.find('img');

    if ($btn.hasClass('stared')) {
        $img.attr('src', baseUrl + '/public/icon/icon_starred_active.svg');
    } else {
        $img.attr('src', baseUrl + '/public/icon/Icon _Starred.svg');
    }
}
// [END] - updateStarIcon by HauNguyen


// TEXT TO SPEECH by HauNguyen
function speakText(text) {
    const speak = () => {
        const utterance = new SpeechSynthesisUtterance(text);
        utterance.lang = "en-US";
        utterance.rate = 0.7;

        const voices = speechSynthesis.getVoices();
        const preferred = ["Google US English", "Samantha", "Zira", "Karen"];
        const matched = voices.find((v) => preferred.includes(v.name));
        utterance.voice = matched || null;

        speechSynthesis.speak(utterance);
    };

    // Nếu chưa có voice, đợi sự kiện onvoiceschanged rồi mới gọi speak
    if (speechSynthesis.getVoices().length === 0) {
        speechSynthesis.onvoiceschanged = () => {
            speak();
            speechSynthesis.onvoiceschanged = null; // gỡ bỏ sau khi gọi
        };
    } else {
        speak(); // Gọi luôn nếu đã có voice
    }
}
// [END] - TEXT TO SPEECH

