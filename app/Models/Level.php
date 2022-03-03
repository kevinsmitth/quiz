<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'level'
    ];

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_levels');
    }
}
