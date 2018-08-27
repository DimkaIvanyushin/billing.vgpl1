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

        Group::create(['name' => '60', 'course_id' => 1]);
        Group::create(['name' => '61', 'course_id' => 1]);
        Group::create(['name' => '62', 'course_id' => 1]);
        Group::create(['name' => '63', 'course_id' => 1]);

        Group::create(['name' => '70', 'course_id' => 2]);
        Group::create(['name' => '71', 'course_id' => 2]);
        Group::create(['name' => '72', 'course_id' => 2]);
        Group::create(['name' => '73', 'course_id' => 2]);

        Group::create(['name' => '80', 'course_id' => 3]);
        Group::create(['name' => '81', 'course_id' => 3]);
        Group::create(['name' => '82', 'course_id' => 3]);
        Group::create(['name' => '83', 'course_id' => 3]);

        DisciplineType::create(['name' => 'Общеобразовательные ']);
        DisciplineType::create(['name' => 'Профильные ']);
        DisciplineType::create(['name' => 'Прочее ']);

        Discipline::create(['name' => 'Математика', 'disciplinetype_id' => 1, 'count_hour' => 60]);
        Discipline::create(['name' => 'Русский', 'disciplinetype_id' => 1, 'count_hour' => 60]);
        Discipline::create(['name' => 'История', 'disciplinetype_id' => 1, 'count_hour' => 60]);

        Discipline::create(['name' => 'Основы идеологии белорусского государства', 'disciplinetype_id' => 1, 'count_hour' => 60]);
        Discipline::create(['name' => 'Всемирная истоиря', 'disciplinetype_id' => 1, 'count_hour' => 60]);
        Discipline::create(['name' => 'Историй Беларуси', 'disciplinetype_id' => 1, 'count_hour' => 60]);
        Discipline::create(['name' => 'Обществоведение', 'disciplinetype_id' => 1, 'count_hour' => 60]);

        Discipline::create(['name' => 'Информатика', 'disciplinetype_id' => 2, 'count_hour' => 60]);
        Discipline::create(['name' => 'ПО', 'disciplinetype_id' => 2, 'count_hour' => 60]);

        CategoryHours::create(['name' => 'Теория', 'position' => 1]);
        CategoryHours::create(['name' => 'ЛПЗ', 'position' => 2]);
        CategoryHours::create(['name' => '1 полугодие', 'position' => 3]);
        CategoryHours::create(['name' => '2 полугодие', 'position' => 4]);
        CategoryHours::create(['name' => 'Консультаии', 'position' => 5]);
        CategoryHours::create(['name' => 'Допконтроль', 'position' => 6]);
        CategoryHours::create(['name' => 'Экзамен', 'position' => 7]);
        CategoryHours::create(['name' => 'Учебная практика', 'position' => 8]);
        CategoryHours::create(['name' => 'Технологическая практика', 'position' => 9]);
        CategoryHours::create(['name' => 'ОВР (кабинет)', 'position' => 10]);
        CategoryHours::create(['name' => 'ОВР (восп.раб.)', 'position' => 11]);
        CategoryHours::create(['name' => 'ОВР (мк)', 'position' => 12]);
        CategoryHours::create(['name' => 'Факультатив', 'position' => 13]);
    }
}
