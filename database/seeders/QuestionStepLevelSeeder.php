<?php

namespace Database\Seeders;

use App\Models\QuestionStepLevel;
use Illuminate\Database\Seeder;

class QuestionStepLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuestionStepLevel::create([
            'level' => 1,
            'step' => 1,
            'question_id' => 1
        ]);
        QuestionStepLevel::create([
            'level' => 1,
            'step' => 2,
            'question_id' => 2
        ]);
        QuestionStepLevel::create([
            'level' => 1,
            'step' => 3,
            'question_id' => 3
        ]);
        QuestionStepLevel::create([
            'level' => 1,
            'step' => 4,
            'question_id' => 4
        ]);
        QuestionStepLevel::create([
            'level' => 1,
            'step' => 5,
            'question_id' => 5
        ]);
    }
}
