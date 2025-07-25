<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuestionComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_question_id',
        'user_id',
        'content',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(UserQuestion::class, 'user_question_id');
    }
}
