<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $table = 'answers';

    protected $fillable = [
        'answer',
        'author_id',
        'status'
    ];

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_answers');
    }
}
