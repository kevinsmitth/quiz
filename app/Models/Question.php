<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $fillable = [
        'question',
        'author_id'
    ];

    public function level()
    {
        return $this->hasOne(QuestionStepLevel::class, 'question_id', 'id');
    }

    public function answers()
    {
        return $this->belongsToMany(Answer::class, 'question_answers');
    }
}
