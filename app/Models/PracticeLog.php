<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PracticeLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'started_at', 'finished_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
