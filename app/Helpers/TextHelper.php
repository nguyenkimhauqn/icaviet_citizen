<?php

namespace App\Helpers;

class TextHelper
{
    public static function normalizeText($text)
    {
        // Xóa toàn bộ thẻ HTML
        $text = strip_tags($text);

        // Xóa dấu câu
        $text = preg_replace('/[[:punct:]]+/u', '', $text);

        // Chuẩn hóa khoảng trắng
        $text = preg_replace('/\s+/', ' ', $text);

        return strtolower(trim($text));
    }

    public static function removeStrongTags($text)
    {
        return str_replace(['<strong>', '</strong>'], '', $text);
    }
}
