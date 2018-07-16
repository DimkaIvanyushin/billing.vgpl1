<?php

namespace App\Http\Controllers;

use App\Discipline;
use App\Group;
use App\OtherHoure;
use App\TableHoure;
use App\Teacher;
use http\Env\Response;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function create()
    {
        return view('teacher.create');
    }

    public function home()
    {
        $teachers = Teacher::get();
        return view('layouts.home', [
            'lists' => $teachers
        ]);
    }

    public function show($id)
    {
        // получаем преподавателя
        $teacher = Teacher::find($id);

        // получаем все групы
        $groups = Group::get();

        // получаем все часы преподавателя
        $teacher_hour = Teacher::find($id)->hours()->get();

        // Получаем дисциплины
        $disciplines = Discipline::get();

        // групируем по предметам
        $collection_items = $teacher_hour->groupBy('discipline_id');

        // получаем тарификацию преподавателя
        $tarificatin = Teacher::find($id)->other_hour()->first();

        // часы за каждый предмет
        $hour = [];

        // количество предметов
        $count_discipline = count($collection_items);

        // общие количество часов c группами
        $sum_hour_group = 0;

        if (count($collection_items) > 0) {
            foreach ($collection_items as $i => $item) {
                $hour[$i]['discipline'] = Discipline::find($collection_items[$i][0]['discipline_id'])->name;
                $hour[$i]['discipline_id'] = Discipline::find($collection_items[$i][0]['discipline_id'])->id;
                foreach ($item as $j => $node) {
                    $hour[$i]['time'][$j]['hour'] = $item[$j]['hour'];
                    $hour[$i]['time'][$j]['group'] = Group::find($item[$j]['group_id'])->name;
                    $hour[$i]['time'][$j]['id'] = $node->id;
                }
                $sum_hour_group += $hour[$i]['sum_hour'] = $collection_items[$i]->sum('hour');
            }
        }

        // получаем все часы
        $total = $sum_hour_group + array_sum($tarificatin->toArray());

        return view('teacher.show', [
            'teacher' => $teacher,
            'groups' => $groups,
            'disciplines' => $disciplines,
            'hour' => $hour,
            'other_hour' => $tarificatin,
            'sum_hour_group' =>$sum_hour_group,
            'count_discipline' => $count_discipline,
            'total' => $total
        ]);
    }

    public function add_other_hour(Request $request)
    {
        $value = $request->value;
        $teacher_id = $request->teacher_id;

        if (empty($value))
        {
            $value = 0;
        }

        $teacher = OtherHoure::firstOrNew(['teacher_id' => $teacher_id]);

        $teacher[$request->name] = $value;
        $teacher->save();

        // количество часов по предметам
        $sum_hour_group = TableHoure::where('teacher_id', $teacher_id)->sum('hour');

        // общие количество часов
        // получаем тарификацию преподавателя
        $tarificatin = Teacher::find($teacher_id)->other_hour()->first();
        $total = $sum_hour_group + array_sum($tarificatin->toArray());

        return response([
            'sum_hour_group' => $sum_hour_group,
            'total' => $total
        ], 200);
    }

    public function edit($id)
    {
        $teacher = Teacher::find($id);
        return view('layouts.edit', [
            'teacher' => $teacher
        ]);
    }

    public function delete($id)
    {
        $teacher = Teacher::find($id);
        $teacher->delete();
        return redirect()->route('teacher.home');
    }

    public function create_hour($id)
    {
        $teacher = Teacher::find($id);
        $disciplines = Discipline::get();
        $groups = Group::get();
        return view('teacher.create_hour', [
            'disciplines' => $disciplines,
            'groups' => $groups,
            'teacher' => $teacher
        ]);
    }

    public function add_discipline(Request $request)
    {
        $teacher = $request->teacher;
        $discipline = $request->discipline;
        $group = Group::get();

        for ($i = 0; $i < count($group); $i++) {
            $table_hour = new TableHoure();
            $table_hour->teacher_id = $teacher;
            $table_hour->discipline_id = $discipline;
            $table_hour->group_id = $group[$i]->id;
            $table_hour->hour = 0;
            $table_hour->save();
        }

        return response($group, 200);
    }

    public function add_hour(Request $request)
    {
        $entry_id = $request->entry_id;
        $value = $request->value;

        if (empty($value))
        {
            $value = 0;
        }

        $entry = TableHoure::find($entry_id);
        $entry->hour = $value;
        $entry->save();

        // пересчитываем сумму
        $teacher_id = $entry->teacher_id;
        $discipline_id = $entry->discipline_id;

        // количество часов по предмету
        $sum = TableHoure::where('teacher_id', $teacher_id)->where('discipline_id',$discipline_id)->sum('hour');

        // количество часов по предметам
        $sum_hour_group = TableHoure::where('teacher_id', $teacher_id)->sum('hour');

        // общие количество часов
        // получаем тарификацию преподавателя
        $tarificatin = Teacher::find($teacher_id)->other_hour()->first();
        $total = $sum_hour_group + array_sum($tarificatin->toArray());

        return response([
            'sum'=> $sum,
            'sum_hour_group' => $sum_hour_group,
            'total' => $total
        ], 200);
    }

    public function put(Request $request)
    {
        $teacher = Teacher::find($request->id);
        $teacher->name = $request->name;
        $teacher->save();
        return redirect()->route('teacher.home');
    }

    public function add(Request $request)
    {
        $data = $request->only('name');

        $teacher = Teacher::create($data);
        OtherHoure::create(['teacher_id' => $teacher->id]);

        return redirect()->route('teacher.home');
    }

}
