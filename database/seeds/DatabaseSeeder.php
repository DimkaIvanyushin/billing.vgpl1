<?php

use Illuminate\Database\Seeder;
use App\Course;
use App\Group;
use App\Discipline;
use App\DisciplineType;
use App\CategoryHours;

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

        Group::create(['name' => '80', 'course_id' => 1]);
        Group::create(['name' => '81', 'course_id' => 1]);
        Group::create(['name' => '82', 'course_id' => 1]);
        Group::create(['name' => '83', 'course_id' => 1]);
        Group::create(['name' => '84', 'course_id' => 1]);

        Group::create(['name' => '75', 'course_id' => 2]);
        Group::create(['name' => '76', 'course_id' => 2]);
        Group::create(['name' => '77', 'course_id' => 2]);
        Group::create(['name' => '78', 'course_id' => 2]);
        Group::create(['name' => '79', 'course_id' => 2]);

        Group::create(['name' => '70', 'course_id' => 3]);
        Group::create(['name' => '71', 'course_id' => 3]);
        Group::create(['name' => '72', 'course_id' => 3]);
        Group::create(['name' => '73', 'course_id' => 3]);
        Group::create(['name' => '74', 'course_id' => 3]);

        Group::create(['name' => 'ТЭ-3', 'course_id' => 4]);
        Group::create(['name' => 'ТЭ-4', 'course_id' => 4]);

        Group::create(['name' => '388', 'course_id' => 5]);
        Group::create(['name' => '389', 'course_id' => 5]);
        Group::create(['name' => '389', 'course_id' => 5]);

        DisciplineType::create(['name' => 'Общеобразовательные ']);
        DisciplineType::create(['name' => 'Профильные ']);
        DisciplineType::create(['name' => 'Прочее ']);

        CategoryHours::create(['name' => 'Теория', 'position' => 1]);
        CategoryHours::create(['name' => 'ЛПЗ', 'position' => 2]);
        CategoryHours::create(['name' => 'Курсовое проектирование', 'position' => 3]);
        CategoryHours::create(['name' => '1 полугодие', 'position' => 4]);
        CategoryHours::create(['name' => '2 полугодие', 'position' => 5]);
        CategoryHours::create(['name' => 'Консультаии', 'position' => 6]);
        CategoryHours::create(['name' => 'Допконтроль', 'position' => 7]);
        CategoryHours::create(['name' => 'Экзамен', 'position' => 8]);
        CategoryHours::create(['name' => 'ОВР (кабинет)', 'position' => 9]);
        CategoryHours::create(['name' => 'ОВР (восп.раб.)', 'position' => 10]);
        CategoryHours::create(['name' => 'Факультатив', 'position' => 11]);
    }
}
