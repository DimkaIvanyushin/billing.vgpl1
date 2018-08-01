<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Discipline;
use App\Course;
use App\OtherHoure;
use App\TableHoure;
use App\Teacher;

class EntryController extends Controller
{
    public function home()
    {
        $data = [];

        // получаем все групы
        $groups = Group::get();

        // групируем по курсам
        $course_group = $groups->groupBy('course_id');

        // список курсов и их групп
        $group_list = [];

        if (count($course_group) > 0) {
            foreach ($course_group as $i => $item) {
                $group_list[$i]['course_name'] = Course::find($i)->name;
                $group = $item->toArray();
                $group_list[$i]['groups'] = $group;
                $group_list[$i]['count_grups'] = count($group);
            }
        }

        // получаем преподавателей
        $teachers = Teacher::get();

        foreach ($teachers as $i => $teacher) {
            // получаем все часы преподавателя
            $teacher_hour = Teacher::find($teacher->id)->hours()->get();

            // групируем по предметам
            $collection_items = $teacher_hour->groupBy('discipline_id');

            $sum_hour_group = 0;

            if (count($collection_items) > 0) {
                foreach ($collection_items as $i => $item) {
                    $discipline_name = Discipline::find($collection_items[$i][0]['discipline_id'])->name;
                    foreach ($item as $j => $node) {
                        $data[$teacher->name]['discipline'][$discipline_name]['hours'][Group::find($item[$j]['group_id'])->name] = $item[$j]['hour'];
                    }

                    $sum_hour_group += $data[$teacher->name]['discipline'][$discipline_name]['sum'] = $collection_items[$i]->sum('hour');
                }

                // получаем тарификацию преподавателя
                $tarification = $data[$teacher->name]['other_hour'] = Teacher::find($teacher->id)->other_hour()->first()->toArray();
                $data[$teacher->name]['total'] = $sum_hour_group + array_sum($tarification);
                $data[$teacher->name]['id'] = $teacher->id;
                $data[$teacher->name]['count_discipline'] = count( $data[$teacher->name]['discipline']);
            }
        }


        return view('entry.home', [
            'group_list' => $group_list,
            'teachers' => $data
        ]);
    }

}
