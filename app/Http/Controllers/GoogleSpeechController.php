<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Cloud\Speech\V1\SpeechClient;
use Google\Cloud\Speech\V1\RecognitionConfig;
use Google\Cloud\Speech\V1\RecognitionAudio;
use Illuminate\Support\Facades\Storage;

class GoogleSpeechController extends Controller
{
    public function transcribe(Request $request)
    {   
        $request->validate([
            'audio' => 'required|mimes:wav|max:10240', // max 10MB
        ]);

        // Lưu file
        $path = $request->file('audio')->store('google_temp');
        $audioContent = Storage::get($path);

        // Tạo SpeechClient
        $speech = new SpeechClient([
            'credentials' => storage_path('app/google/speech-key.json'),
        ]);

        // Cấu hình
        $config = new RecognitionConfig([
            'encoding' => RecognitionConfig\AudioEncoding::LINEAR16,
            'sample_rate_hertz' => 44100,
            'language_code' => 'en-US', // hoặc 'vi-VN' nếu là tiếng Việt
        ]);

        // Audio
        $audio = new RecognitionAudio([
            'content' => $audioContent,
        ]);

        // Gửi request
        try {
            $response = $speech->recognize($config, $audio);
            $speech->close();

            $transcript = '';
            foreach ($response->getResults() as $result) {
                $alternatives = $result->getAlternatives();
                if (isset($alternatives[0])) {
                    $transcript .= $alternatives[0]->getTranscript() . ' ';
                }
            }

            if (trim($transcript) === '') {
                return response()->json([
                    'error' => 'Không thể nhận dạng rõ ràng giọng nói. Vui lòng thu âm lại.',
                    'transcript_guess' => null
                ]);
            }

            return response()->json([
                'transcript' => trim($transcript)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Đã xảy ra lỗi khi xử lý giọng nói: ' . $e->getMessage(),
                'transcript_guess' => null
            ]);
        }
    }
}
