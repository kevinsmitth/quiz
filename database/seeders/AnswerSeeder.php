<?php

namespace Database\Seeders;

use App\Models\Answer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 80; $i++) {

            Answer::create([
                'answer' => Str::random(10),
                'author_id' => 1,
                'status' => random_int(0, 1)
            ]);
        }
    }
}
