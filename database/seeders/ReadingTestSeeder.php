<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ReadingTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Xóa toàn bộ câu hỏi reading (topic_id = 3)
        DB::table('questions')->where('topic_id', 3)->delete();

        // 2. Tạo topic Reading test (id = 3)
        DB::table('topics')->updateOrInsert(
            ['id' => 3],
            [
                'name' => 'Reading Test',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // 3. Danh sách câu hỏi với dịch và tips

        $questions = require database_path('data/reading.php');

        // 4. Xử lý từng câu hỏi
        foreach ($questions as $index => $q) {
            $content = $this->highlightTips($q['content'], $q['tips']);

            DB::table('questions')->insert([
                'content' => $content,
                'translation' => $q['translation'],
                'pronunciation' => $q['pronunciation'],
                'tips' => json_encode($q['tips'], JSON_UNESCAPED_UNICODE),
                'audio_path' => 'reading-' . str_pad($index + 1, 2, '0', STR_PAD_LEFT) . '.mp3',
                'topic_id' => 3,
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
