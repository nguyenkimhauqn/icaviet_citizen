<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\StarredQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\MockObject\ReturnValueNotConfiguredException;

class ReadingController extends Controller
{
    public function show($index = 0)
    {
        $routeName = 'reading.show';

        $user = Auth::user();
        $questions = Question::where('topic_id', 3)->orderBy('id')->get();
        $total = $questions->count();
        $index = max(0, min($index, $total - 1));
        $question = $questions[$index];

        // KIỂM TRA CÂU HỎI SAO:
        $isStarred = StarredQuestion::where('user_id', $user->id)
            ->where('question_id', $question->id)
            ->exists();
        session(['reading_answer' => $question->content]);
        return view('reading.show', compact('question', 'index', 'total', 'isStarred', 'routeName'));
    }

    public function showStarred($index = 0)
    {
        $routeName = 'reading.starred';
        $mode = 'showStarred';
        $user = Auth::user();
        // Edit query by star
        $starredIds = StarredQuestion::where('user_id', $user->id)->pluck('question_id');
        $questions = Question::where('topic_id', 3)
            ->whereIn('id', $starredIds)
            ->orderBy('id')
            ->get();
        $total = $questions->count();
        // $index = max(0, min($index, $total - 1));
        // dump($total, $index);
        // dd("test");
        if ($total == $index  ) {
            return view('star.result');
        }
        $question = $questions[$index];
        // KIỂM TRA CÂU HỎI SAO:
        $isStarred = StarredQuestion::where('user_id', $user->id)
            ->where('question_id', $question->id)
            ->exists();
        return view('reading.show', compact('question', 'index', 'total', 'isStarred', 'routeName','mode'));
    }

    public function index()
    {
        return view('reading.assemblyai');
    }

    public function upload(Request $request)
    {
        if (!$request->hasFile('audio_data')) {
            return response()->json(['success' => false, 'message' => 'Không có file']);
        }

        $file = $request->file('audio_data');
        $ext = strtolower($file->getClientOriginalExtension());
        $allowed = ['webm', 'mp3', 'wav', 'm4a'];

        if (!in_array($ext, $allowed)) {
            return response()->json(['success' => false, 'message' => "❌ Định dạng không hỗ trợ: .$ext"]);
        }

        $filename = 'rec_' . uniqid() . '.' . $ext;
        $path = $file->storeAs('public/audios', $filename);
        $fullPath = storage_path('app/' . $path);

        // Nếu là webm thì convert sang wav
        if ($ext === 'webm') {
            $convertedPath = str_replace('.webm', '.wav', $fullPath);
            exec("ffmpeg -i {$fullPath} -ar 16000 -ac 1 -c:a pcm_s16le {$convertedPath}");

            if (!file_exists($convertedPath)) {
                return response()->json(['success' => false, 'message' => '❌ FFmpeg không convert được file .wav']);
            }

            $fullPath = $convertedPath;
        }

        // Gửi lên AssemblyAI
        $apiKey = env('ASSEMBLYAI_API_KEY');
        $upload = Http::withHeaders(['authorization' => $apiKey])
            ->attach('file', file_get_contents($fullPath), basename($fullPath))
            ->post('https://api.assemblyai.com/v2/upload');

        if (!$upload->ok()) return response()->json(['success' => false, 'message' => '❌ Upload thất bại']);

        $uploadUrl = $upload['upload_url'];
        $transcribe = Http::withHeaders(['authorization' => $apiKey])
            ->post('https://api.assemblyai.com/v2/transcript', [
                'audio_url' => $uploadUrl,
                'language_code' => 'en',
                'auto_punctuation' => true
            ]);

        if (!$transcribe->ok()) return response()->json(['success' => false, 'message' => '❌ Không tạo được phiên transcribe']);

        $id = $transcribe['id'];

        // Chờ kết quả
        for ($i = 0; $i < 10; $i++) {
            sleep(3);
            $poll = Http::withHeaders(['authorization' => $apiKey])
                ->get("https://api.assemblyai.com/v2/transcript/{$id}");

            if ($poll['status'] === 'completed') {
                return response()->json(['success' => true, 'text' => $poll['text']]);
            }
            if ($poll['status'] === 'error') {
                return response()->json(['success' => false, 'message' => '❌ ' . $poll['error']]);
            }
        }

        return response()->json(['success' => false, 'message' => '❌ Quá thời gian chờ kết quả']);
    }

    public function testStaticFile()
    {
        $filename = 'audi_test_api_2.mp3';
        $localPath = storage_path("app/public/audios/{$filename}");

        $mime = mime_content_type($localPath);
        $size = filesize($localPath);
        if ($size < 5000 || strpos($mime, 'audio') !== 0) {
            return response()->json([
                'success' => false,
                'message' => "❌ File tĩnh không hợp lệ: MIME = $mime | Size = $size bytes"
            ]);
        }

        $text = $this->transcribeWithAssemblyAI($localPath, $filename);

        return response()->json([
            'success' => true,
            'file' => $filename,
            'text' => $text,
        ]);
    }

    private function transcribeWithAssemblyAI($localPath, $filename)
    {
        // $apiKey = env('ASSEMBLYAI_API_KEY');
        $apiKey = config('services.assemblyai.key');

        $uploadRes = Http::withHeaders([
            'authorization' => $apiKey
        ])->attach(
            'file',
            file_get_contents($localPath),
            $filename
        )->post('https://api.assemblyai.com/v2/upload');

        if (!$uploadRes->ok()) return '❌ Upload static file thất bại.';

        $uploadUrl = $uploadRes->json('upload_url');

        $transRes = Http::withHeaders([
            'authorization' => $apiKey
        ])->post('https://api.assemblyai.com/v2/transcript', [
            'audio_url' => $uploadUrl,
            'language_code' => 'en',
            'auto_punctuation' => true
        ]);

        if (!$transRes->ok()) return '❌ Không thể gửi yêu cầu transcript.';

        $id = $transRes->json('id');

        for ($i = 0; $i < 10; $i++) {
            sleep(3);
            $res = Http::withHeaders(['authorization' => $apiKey])
                ->get("https://api.assemblyai.com/v2/transcript/{$id}");

            if ($res->json('status') === 'completed') {
                return $res->json('text');
            }

            if ($res->json('status') === 'error') {
                return '❌ Lỗi transcript: ' . $res->json('error');
            }
        }

        return '❌ Không nhận được kết quả sau 30 giây.';
    }
}
