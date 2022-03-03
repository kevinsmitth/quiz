<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionStepLevel extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'level',
        'step',
        'question_id',
    ];
}
