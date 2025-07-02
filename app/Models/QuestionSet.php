<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionSet extends Model
{
    use HasFactory;

    protected $table = 'question_sets';

    protected $fillable = [
        'topic_id',
        'question_id',
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
