<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representative extends Model
{
    use HasFactory;
    protected $fillable = [
        'zip',
        'state',
        'capital',
        'representative',
        'senators',
        'governor',
    ];

    protected $casts = [
        'representative' => 'array',
        'senators' => 'array',
        'governor' => 'array',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
