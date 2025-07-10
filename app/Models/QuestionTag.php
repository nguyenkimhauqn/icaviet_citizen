<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionTag extends Model
{
    use HasFactory;
    public function questions()
    {
        return $this->belongsToMany(UserQuestion::class, 'question_tag_map');
    }
}
