<?php

namespace Database\Seeders;

use App\Models\QuestionAnswer;
use Illuminate\Database\Seeder;

class QuestionAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 20; $i++) {
            $question_answer = new QuestionAnswer();
            $question_answer->question_id = random_int(1, 10);
            $question_answer->answer_id = random_int(1, 80);
            $question_answer->save();
        }
    }
}
