<?php

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            try {
                $finishTime = rand(0, 1) == 0 ? date('Y-m-d H:i:s', mt_rand(time(), time() + 86400 * 30)) : null;
                DB::table('user_course')->insert([
                    'user_id' => User::select('id')->orderByRaw("RAND()")->first()->id,
                    'course_id' => Course::select('id')->orderByRaw("RAND()")->first()->id,
                    'finished_at' => $finishTime,
                ]);
            } catch (Exception $e) {
                continue;
            }
        }
    }
}
