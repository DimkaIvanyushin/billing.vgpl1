<?php

namespace App\Http\Controllers;

use App\Discipline;
use App\Teacher;
use App\TD;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;

class DisciplineController extends Controller
{
    public function create()
    {
        return view('discipline.create');
    }

    public function home()
    {
        $disciplines = Discipline::get();
        return view('layouts.home', [
            'lists' => $disciplines
        ]);
    }

    public function add(StoreRequest $request)
    {
        $data = explode(",", $request->name);
        
        if ($data)
        {
            foreach ($data as $value)
            {
                $discipline = new Discipline();
                $discipline->name = $value;
                $discipline->save();
            }

            return redirect()->route('discipline.home');
        }

        return redirect()->route('discipline.home');
    }

    public function edit($id)
    {
        $discipline = Discipline::find($id);
        return view('layouts.edit', [
            'discipline' => $discipline
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

        foreach ($discipline_hours as $key => $teacher)
        {
            $data[$key]['teacher_name'] = Teacher::find($key)->name;
            $total_hour_discipline += $data[$key]['teacher_count_hour'] = $teacher->sum('hour');
        }

        return view('discipline.show', [
            'discipline' => $discipline,
            'data' => $data,
            'total_hour_discipline' =>  $total_hour_discipline
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
        $discipline->save();
        return redirect()->route('discipline.home');
    }
}
