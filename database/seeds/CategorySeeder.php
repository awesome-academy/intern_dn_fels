<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Animals',
            ],
            [
                'name' => 'Plants',
            ],
            [
                'name' => 'Jobs',
            ],
            [
                'name' => 'Transportation',
            ],
            [
                'name' => 'Country',
            ]
        ]);
    }
}
