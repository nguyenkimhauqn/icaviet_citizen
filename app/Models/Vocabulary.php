<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vocabulary extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'word',
        'meaning',
        'hint',
        'synonymous',
        'example',
        'audio',
        'user_id'
    ];

    public function category()
    {
        return $this->belongsTo(VocabularyCategory::class, 'category_id');
    }
}
