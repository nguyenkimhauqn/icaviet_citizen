
// Text to speech by Hau Nguyen 

function speakText(text) {
    const speak = () => {
        const utterance = new SpeechSynthesisUtterance(text);
        utterance.lang = 'en-US';
        utterance.rate = 0.7;

        // Gán giọng đọc ưu tiên
        const voices = speechSynthesis.getVoices();
        const preferred = ['Google US English', 'Samantha', 'Zira', 'Karen'];
        const matched = voices.find(v => preferred.includes(v.name));
        const fallback = voices.find(v => v.lang.startsWith('en')) || voices[0];
        utterance.voice = matched || fallback || null;

        speechSynthesis.speak(utterance);
    };

    if (speechSynthesis.getVoices().length === 0) {
        speechSynthesis.onvoiceschanged = () => {
            speak();
            speechSynthesis.onvoiceschanged = null;
        };
    } else {
        speak();
    }
}

// Tốt trên Iphone
// function speakText(text) {
//     let hasSpoken = false;

//     const speak = (text) => {
//         if (hasSpoken) return;
//         hasSpoken = true;

//         const utterance = new SpeechSynthesisUtterance(text);
//         utterance.lang = 'en-US';
//         utterance.rate = 0.7;

//         const voices = speechSynthesis.getVoices();
//         const preferredVoices = ['Google US English', 'Samantha', 'Microsoft Zira', 'Karen'];
//         const matched = voices.find(v => preferredVoices.includes(v.name));
//         const fallback = voices.find(v => v.lang === 'en-US' && v.name.toLowerCase().includes('female'));
//         const anyUS = voices.find(v => v.lang === 'en-US');

//         utterance.voice = matched || fallback || anyUS || null;
//         speechSynthesis.speak(utterance);
//     };

//     const voices = speechSynthesis.getVoices();
//     if (voices.length === 0) {
//         speechSynthesis.onvoiceschanged = () => {
//             speak(text);
//             speechSynthesis.onvoiceschanged = null;
//         };
//     } else {
//         speak(text);
//     }
// }
// [END] - Tex to speech