<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(1)->create();

        $levels = [Question::LOW, Question::MEDIUM, Question::HARD, Question::VERY_HARD];
        for ($i = 1; $i <= 10; $i++) {
            $questionId = DB::table('questions')->insertGetId(
                ['title' => 'Question '.$i, 'level' => $levels[rand(0,3)]]
            );
            for ($j = 1; $j <= rand(2,4); $j++) {
                DB::table('answers')->insert(
                    [
                        'question_id' => $questionId,
                        'title' => 'Answer '.$j,
                        'correct' => rand(0,1)
                    ]
                );
            }
        }
    }
}
