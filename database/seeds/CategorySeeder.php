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
                'name' => 'Nature',
                'image' => '/storage/category/nature.jpg',
            ],
            [
                'name' => 'Office',
                'image' => '/storage/category/office.jpg',
            ],
            [
                'name' => 'Number',
                'image' => '/storage/category/number.jpg',
            ],
            [
                'name' => 'Traffic',
                'image' => '/storage/category/traffic.jpg',
            ],
            [
                'name' => 'Food',
                'image' => '/storage/category/food.jpg',
            ]
        ]);
    }
}
