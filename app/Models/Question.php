<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'audio_path', 'topic_id', 'category_id', 'user_id', 'translation','pronunciation','tips', 'has_guideline'];

    protected $casts = [
        'has_guideline' => 'boolean',
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function starredByUsers()
    {
        return $this->belongsToMany(User::class, 'starred_questions');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
