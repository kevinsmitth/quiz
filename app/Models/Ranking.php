<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    use HasFactory;

    protected $table = 'rankings';

    protected $fillable = [
        'user_id',
        'question_id',
        'answer_correctly'
    ];

    protected $casts = [
        'answered_correctly' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function question()
    {
        return $this->hasOne(Question::class, 'question_id', 'id');
    }
}
