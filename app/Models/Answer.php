<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    
    protected $fillable = ['question_id', 'content', 'is_correct', 'audio_path'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function hints()
    {
        return $this->hasMany(AnswerHint::class);
    }
}
