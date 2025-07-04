<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['title_en', 'title_vn'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
