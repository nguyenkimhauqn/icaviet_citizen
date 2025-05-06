<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['quiz_id', 'question_id', 'user_answer_id', 'is_correct', 'question_order'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function userAnswer()
    {
        return $this->belongsTo(Answer::class, 'user_answer_id');
    }
    
}
