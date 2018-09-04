<?php

namespace App\Http\Controllers;

use App\Course;
use App\Discipline;
use App\TableHoure;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Group;
use App\Teacher;
use App\CategoryHours;


class GroupController extends Controller
{
    public function home()
    {
        $groups = Group::get();

        // групируем по курсам
        $course_group = $groups->groupBy('course_id');

        $data = [];

        if (count($course_group) > 0) {
            foreach ($course_group as $i => $item) {
                $data[$i]['course_name'] = Course::find($i)->name;
                $data[$i]['groups'] = $item->toArray();
            }
        }

        return view('group.home', [
            'data' => $data
        ]);
    }

    public function create()
    {
        $teachers = Teacher::get();
        $courses = Course::get();

        return view('group.create', [
            'courses' => $courses,
            'teachers' => $teachers
        ]);
    }

    public function add(StoreRequest $request)
    {
        $data = explode(",", $request->name);
        $course_id = $request->course_id;

        if ($data) {
            foreach ($data as $value) {
                $group = new Group();
                $group->name = $value;
                $group->course_id = $course_id;
                $group->save();
            }

            return redirect()->route('group.home');
        }

        return redirect()->route('group.home');
    }

    public function edit($id)
    {
        $group = Group::find($id);
        $courses = Course::get();

        return view('layouts.edit', [
            'courses' => $courses,
            'group' => $group
        ]);
    }

    public function delete($id)
    {
        $group = Group::find($id);
        // Каскадное удаление всех часов данной группы
        $group->hours()->delete();
        // Удаление самой группы
        $group->delete();

        return redirect()->route('group.home');
    }

    public function put(Request $request)
    {
        $group = Group::find($request->id);
        $group->name = $request->name;
        $group->save();
        return redirect()->route('group.home');
    }

    public function show($id)
    {
        $data = [];
        $category_hours = CategoryHours::get();
        $group = Group::find($id);
        $teachers = TableHoure::get()->where('group_id', $group->id)->groupBy('teacher_id');

        foreach ($teachers as $teacher_id => $teacher) {
            $teacher_name = Teacher::find($teacher_id)->name;
            $disciplines = $teacher->groupBy('discipline_id');

            foreach ($disciplines as $discipline_id => $discipline) {
                $discipline_name = Discipline::find($discipline_id)->name;
                foreach ($discipline as $disc) {
                    $data[$teacher_name]['disciplines'][$discipline_name][$disc->category->name] = $disc['hour'];
                }
                $data[$teacher_name]['sum'] = 
                
                $data[$teacher_name]['disciplines'][$discipline_name]['1 полугодие'] +
                $data[$teacher_name]['disciplines'][$discipline_name]['2 полугодие'];
            }
        }

        return view('group.show', [
            'group'=> $group,
            'data' => $data,
            'category_hours' => $category_hours
        ]);
    }
}
