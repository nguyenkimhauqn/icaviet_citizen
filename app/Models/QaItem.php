<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QaItem extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'question', 'answer'];

    public function category()
    {
        return $this->belongsTo(QaCategory::class, 'category_id');
    }
}
