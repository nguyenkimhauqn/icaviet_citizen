<?php

namespace App\Helpers;

class TextHelper
{
    public static function normalizeText($text)
    {
        $text = preg_replace('/[[:punct:]]+/u', '', $text);
        $text = preg_replace('/\s+/', ' ', $text);
        return strtolower(trim($text));
    }
}
