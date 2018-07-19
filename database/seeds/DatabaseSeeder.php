<?php

use Illuminate\Database\Seeder;
use App\Course;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::create(['name' => '1 курс']);
        Course::create(['name' => '2 курс']);
        Course::create(['name' => '3 курс']);
        Course::create(['name' => 'ТУ курс']);
        Course::create(['name' => 'ССО']);
    }
}
