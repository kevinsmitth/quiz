<?php

namespace Database\Seeders;

use App\Models\UserLevel;
use Illuminate\Database\Seeder;

class UserLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserLevel::create([
            'user_id' => 1,
            'actual_level' => 1,
            'actual_step' => 1
        ]);
    }
}
