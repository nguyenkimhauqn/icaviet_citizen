<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WritingTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Xoá toàn bộ câu hỏi writing cũ (topic_id = 2)
        // DB::table('questions')->where('topic_id', 2)->delete();

        // 2. Cập nhật topic writing test

        // 3. Danh sách câu hỏi với dịch và tips
        $questions = require database_path('data/writing.php');

        // 4. Xử lý từng câu hỏi
        foreach ($questions as $index => $q) {
            $content = $this->highlightTips($q['content'], $q['tips']);

            DB::table('questions')->insert([
                'content' => $content,
                'translation' => $q['translation'],
                'tips' => json_encode($q['tips'], JSON_UNESCAPED_UNICODE),
                'audio_path' => 'writing-' . str_pad($index + 1, 2, '0', STR_PAD_LEFT) . '.mp3',
                'topic_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }

    /**
     * Highlight các từ vựng bằng <strong> mà không lồng thẻ.
     */
    private function highlightTips($content, $tips)
    {
        $positions = [];

        // Ưu tiên từ dài hơn trước
        uksort($tips, function ($a, $b) {
            return strlen($b) - strlen($a);
        });

        $lowerContent = strtolower($content);

        foreach ($tips as $term => $definition) {
            $lowerTerm = strtolower($term);
            $offset = 0;

            while (($pos = strpos($lowerContent, $lowerTerm, $offset)) !== false) {
                $end = $pos + strlen($term);

                // Kiểm tra overlap
                $overlap = false;
                foreach ($positions as [$s, $e]) {
                    if (!($end <= $s || $pos >= $e)) {
                        $overlap = true;
                        break;
                    }
                }

                if (!$overlap) {
                    $positions[] = [$pos, $end, substr($content, $pos, $end - $pos)];
                }

                $offset = $end;
            }
        }

        // Sắp theo vị trí ngược để thay thế không làm lệch vị trí còn lại
        usort($positions, function ($a, $b) {
            return $b[0] - $a[0];
        });

        foreach ($positions as [$start, $end, $text]) {
            $content = substr_replace($content, "<strong>{$text}</strong>", $start, strlen($text));
        }

        return $content;
    }
}
