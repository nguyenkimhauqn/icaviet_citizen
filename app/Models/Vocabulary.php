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
        'example',
        'audio'
    ];

    public function category()
    {
        return $this->belongsTo(VocabularyCategory::class, 'category_id');
    }
}
