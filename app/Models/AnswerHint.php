<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerHint extends Model
{
    use HasFactory;

    protected $fillable = ['answer_id', 'content'];

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
    
}
