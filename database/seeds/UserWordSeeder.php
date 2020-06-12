<?php

use App\Models\User;
use App\Models\Word;
use Illuminate\Database\Seeder;

class UserWordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            'unlearned',
            'learned',
            'shortlisted',
        ];

        for ($i = 0; $i < 1000; $i++) {
            try {
                DB::table('user_word')->insert([
                    'user_id' => User::select('id')->orderByRaw("RAND()")->first()->id,
                    'word_id' => Word::select('id')->orderByRaw("RAND()")->first()->id,
                    'status' => $status[array_rand($status)],
                ]);
            } catch (Exception $e) {
                continue;
            }
        }
    }
}
