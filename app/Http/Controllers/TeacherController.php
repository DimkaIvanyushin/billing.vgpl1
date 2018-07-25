<?php

namespace App\Http\Controllers;

use App\Discipline;
use App\Group;
use App\OtherHoure;
use App\TableHoure;
use App\Teacher;
use App\Course;
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

    /**
     * идентификатор преподаваетля
     * @param $id
     *
     *  Вернет предметы преподавателя и количество часов каждого предмета и общее
     * @return array
     */

    private function generate_date_show($id)
    {
        $teacher = [];

        // Проверяем наличие преподователя по ID
        if (Teacher::find($id) == null) {
            return null;
        }

        // получаем преподавателя
        $teacher['teacher_info'] = Teacher::find($id);

        // если не нашёл часов у преподавателя то NULL
        if (!Teacher::find($id)->hours()->exists()) {
            return null;
        }

        // получаем все часы преподавателя
        $teacher_hour = Teacher::find($id)->hours()->get();

        // групируем по предметам
        $collection_items = $teacher_hour->groupBy('discipline_id');

        // если не нашёл дополнительных часов у преподавателя то NULL
        if (!Teacher::find($id)->other_hour()->exists()) {
            return null;
        }

        // получаем тарификацию преподавателя
        $teacher['other_hour'] = Teacher::find($id)->other_hour()->first();

        // количество предметов
        $teacher['count_discipline'] = count($collection_items);

        // общие количество часов c группами
        $teacher['sum_hour_group'] = 0;

        if (count($collection_items) > 0) {
            foreach ($collection_items as $i => $item) {
                $teacher['discipline'][$i]['discipline'] = Discipline::find($collection_items[$i][0]['discipline_id'])->name;
                $teacher['discipline'][$i]['discipline_id'] = Discipline::find($collection_items[$i][0]['discipline_id'])->id;
                foreach ($item as $j => $node) {
                    $teacher['discipline'][$i]['time'][$j]['hour'] = $item[$j]['hour'];
                    $teacher['discipline'][$i]['time'][$j]['group'] = Group::find($item[$j]['group_id'])->name;
                    $teacher['discipline'][$i]['time'][$j]['id'] = $node->id;
                }
                $teacher['sum_hour_group'] += $teacher['discipline'][$i]['sum_hour'] = $collection_items[$i]->sum('hour');
            }
        }

        // получаем все часы
        $teacher['total_hour'] = $teacher['sum_hour_group'] + array_sum($teacher['other_hour']->toArray());

        return $teacher;
    }


    public function show($id)
    {
        // получаем преподавателя и его часы
        $teacher = $this->generate_date_show($id);

        if ($teacher == null) {
            return redirect()->route('entry.home')
                ->withErrors([
                    'error' => 'Преподаватель не найден'
                ]);
        }

        // получаем все групы
        $groups = Group::get();

        // получаем все дисциплины
        $disciplines = Discipline::get();

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

        return view('teacher.show', [
            'teacher' => $teacher['teacher_info'],
            'group_list' => $group_list,
            'disciplines' => $disciplines,
            'hour' => $teacher['discipline'],
            'other_hour' => $teacher['other_hour'],
            'sum_hour_group' => $teacher['sum_hour_group'],
            'count_discipline' => $teacher['count_discipline'],
            'total' => $teacher['total_hour']
        ]);
    }

    public function add_other_hour(Request $request)
    {
        $value = $request->value;
        $teacher_id = $request->teacher_id;

        if (empty($value)) {
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

    // Генерация EXEL данных
    private function generate_exel_table($data)
    {
        echo "<table class=\"table table-bordered bg-white table-striped\">";
        echo "<thead>";
        echo "<tr>";
        echo "<td rowspan=\"2\">Дисциплина</td>";

        echo "</tr>";
        echo "</table>";
    }

    // вывод в excel файл
    public function print_excel($id)
    {
        $data = $this->generate_date_show($id);
       
        header ( "Content-type: application/vnd.ms-excel" );
        header ( "Content-Disposition: attachment; filename=foo_bar.xls" );

        $this->generate_exel_table($data);
    }


    public function edit($id)
    {
        $teacher = Teacher::find($id);

        if ($teacher == null) {
            return redirect()->route('entry.home')
                ->withErrors([
                    'error' => 'Преподаватель не найден'
                ]);
        }

        return view('layouts.edit', [
            'teacher' => $teacher
        ]);
    }

    public function delete($id)
    {
        $teacher = Teacher::find($id);

        if ($teacher == null) {
            return redirect()->route('entry.home')
                ->withErrors([
                    'error' => 'Преподаватель не найден'
                ]);
        }

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

        if (empty($value)) {
            $value = 0;
        }

        $entry = TableHoure::find($entry_id);
        $entry->hour = $value;
        $entry->save();

        // пересчитываем сумму
        $teacher_id = $entry->teacher_id;
        $discipline_id = $entry->discipline_id;

        // количество часов по предмету
        $sum = TableHoure::where('teacher_id', $teacher_id)->where('discipline_id', $discipline_id)->sum('hour');

        // количество часов по предметам
        $sum_hour_group = TableHoure::where('teacher_id', $teacher_id)->sum('hour');

        // общие количество часов
        // получаем тарификацию преподавателя
        $tarificatin = Teacher::find($teacher_id)->other_hour()->first();
        $total = $sum_hour_group + array_sum($tarificatin->toArray());

        return response([
            'sum' => $sum,
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

    //
    //
    //Удаление предмета у преподавателя

    public function discipline_delete(Request $request)
    {
        $teacher_id = $request->teacher_id;
        $discipline_id = $request->discipline_id;

        $teacher = Teacher::find($teacher_id);
        $teacher->hours()->where('discipline_id', '=', $discipline_id)->delete();


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

}
