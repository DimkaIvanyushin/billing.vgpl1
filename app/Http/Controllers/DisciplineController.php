<?php

namespace App\Http\Controllers;

use App\Discipline;
use App\DisciplineType;
use App\TableHoure;
use App\Teacher;
use App\TD;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;

class DisciplineController extends Controller
{
    public function create()
    {
        $disciplines_type = DisciplineType::get();

        return view('discipline.create', [
            'disciplines_type' => $disciplines_type
        ]);
    }

    public function home()
    {
        $disciplines = Discipline::get()->groupBy('disciplinetype_id');

        return view('discipline.home', [
            'lists' => $disciplines
        ]);
    }

    // TODO Добавить проверки

    public function add(StoreRequest $request)
    {
        $data = explode(",", $request->name);
        $discipline_type = $request->discipline_type;
        $count_hour = $request->count_hour;

        if ($data) {
            foreach ($data as $value) {
                $discipline = new Discipline();
                $discipline->name = $value;
                $discipline->disciplinetype_id = $discipline_type;
                $discipline->count_hour = $count_hour;
                $discipline->save();
            }

            return redirect()->route('discipline.home');
        }

        return redirect()->route('discipline.home');
    }

    public function edit($id)
    {
        $discipline = Discipline::find($id);
        $disciplines_type = DisciplineType::get();

        return view('layouts.edit', [
            'discipline' => $discipline,
            'disciplines_type' => $disciplines_type
        ]);
    }

    public function show($id)
    {
        // Получаем дисциплинну
        $discipline = Discipline::find($id);
        // получаем все часы данной дисциплины
        // и группируем их
        $discipline_hours = $discipline->hours()->get()->groupBy('teacher_id');

        // Общие количество часов дисциплины
        $total_hour_discipline = 0;

        // преобразуем данные для отправкм
        $data = [];

        foreach ($discipline_hours as $key => $teacher) {
            $data[$key]['teacher_name'] = Teacher::find($key)->name;
            $total_hour_discipline += $data[$key]['teacher_count_hour'] = $teacher->sum('hour');
        }

        return view('discipline.show', [
            'discipline' => $discipline,
            'data' => $data,
            'total_hour_discipline' => $total_hour_discipline
        ]);
    }

    public function delete($id)
    {
        $discipline = Discipline::find($id);
        // Каскадное удаление всех часов данной дисциплины
        $discipline->hours()->delete();
        // Удаляем дисциплину
        $discipline->delete();

        return redirect()->route('discipline.home');
    }

    public function put(Request $request)
    {
        $discipline = Discipline::find($request->id);
        $discipline->name = $request->name;
        $discipline->disciplinetype_id = $request->discipline_type;
        $discipline->count_hour = $request->count_hour;

        $discipline->save();
        return redirect()->route('discipline.home');
    }
}
