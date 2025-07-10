<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function starredQuestions()
    {
        return $this->belongsToMany(Question::class, 'starred_questions', 'user_id', 'question_id');
    }

    public function representative()
    {
        return $this->belongsTo(Representative::class);
    }
    
    // Chia sẻ kinh nghiệm

    public function questions()
    {
        return $this->hasMany(UserQuestion::class);
    }

    public function questionComments()
    {
        return $this->hasMany(UserQuestionComment::class);
    }
}
