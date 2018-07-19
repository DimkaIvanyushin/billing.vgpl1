<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Group;
use App\Teacher;

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

        if ($data)
        {
            foreach ($data as $value)
            {
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
}
