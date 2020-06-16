<?php

use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 2000; $i++) {
            $id = DB::table('questions')->insertGetId([
                'value' => $faker->sentence(20),
                'lesson_id' => $faker->randomElement(\App\Models\Lesson::pluck('id')->toArray()),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $correct = rand(0, 3);
            for ($j = 0; $j < 4; $j++) {
                DB::table('answers')->insert([
                    'question_id' => $id,
                    'word_id' => $faker->randomElement(\App\Models\Word::pluck('id')->toArray()),
                    'is_correct' => ($correct == $j),
                ]);
            }
        }
    }
}
