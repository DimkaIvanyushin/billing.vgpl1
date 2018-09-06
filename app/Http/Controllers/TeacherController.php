<?php

namespace App\Http\Controllers;

use App\Discipline;
use App\Group;
use App\TableHoure;
use App\Teacher;
use App\Course;
use App\CategoryHours;
use App\DisciplineType;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    private $max_hour;
    private $min_hour;

    function __construct()
    {
        $this->max_hour = 1400;
        $this->min_hour = 800;
    }

    public function create()
    {
        return view('teacher.create');
    }

    public function home()
    {
        $start = microtime(true);

        $data = $this->get_teacher_hours();

        $time = microtime(true) - $start;
        echo "Время выполнения функции ".$time."<br>";

        return view('teacher.home', [
            'teachers' => $data
        ]);
    }

    private function get_teacher_hours()
    {
        $result = [];

        $all_discipline = Discipline::get();
        $all_teacher = Teacher::get();
        $all_group = Group::get();

        $data = TableHoure::get()->groupBy('teacher_id');
        foreach ($data as $key => $value) {

            $teacher = $all_teacher->find($key);

            $disciplines = $value->groupBy('discipline_id');

            $result[$teacher->name]['total'] = 0;
            $result[$teacher->name]['id'] =  $teacher->id;

            foreach ($disciplines as $key => $value) {
                $discipline_name =  $all_discipline->find($key)->name;
                $group = $value->groupBy('group_id');

                foreach ($group as $key => $value) {
                    $group_name = $all_group->find($key)->name;
                    $result[$teacher->name]['discipline'][$discipline_name]['group'][$group_name] = $value;
                    $result[$teacher->name]['total'] += $value->where('otherhour_id', '>', 2)->sum('hour');
                }
            }
        }
        
        return $result;
    }

    public function entryes()
    {
        $teachers = Teacher::get()->sortBy('name');
        $category_hours = CategoryHours::get();
        $discipline = Discipline::get();
        $groups = Group::get();

        $data = [];

        // TODO говно КОД
        $i = 0;
        $j = 0;
        foreach ($teachers as $teacher) {
            if ($i >= 3) {
                $i = 0;
                $j++;
            }
            $data[$j][$teacher->name] = $this->get_hour_teacher($teacher);
            $data[$j][$teacher->name]['id'] = $teacher->id;
            $i++;
        }

        return view('entry.home', [
            'category_hours' => $category_hours,
            'discipline' => $discipline,
            'groups' => $groups,
            'data' => $data
        ]);
    }

    public function find(Request $request)
    {

        return view('entry.home', [

        ]);
    }

    private function get_hour_teacher($teacher)
    {
        $data = [];
        $total['sum'] = 0;
        $total['total'] = 0;

        $teacher_discipline = TableHoure::get()->where('teacher_id', $teacher['id'])->groupBy('discipline_id');

        if (count($teacher_discipline) > 0) {
            foreach ($teacher_discipline as $key => $item) {
                $discipline_teacher = Discipline::find($key);
                $groups_discipline = $item->groupBy('group_id');

                // в зависимости от предмета, находим процентную ставку
                if ($discipline_teacher->discipline_type->id == 1) {
                    $percent = 5;
                } else {
                    $percent = 10;
                }
                
                $data[$discipline_teacher->name]['percent'] =  $percent;
                $data[$discipline_teacher->name]['url'] = '/discipline/show/'.$discipline_teacher->id;

                foreach ($groups_discipline as $key => $group_disciplines) {
                    $group_teacher = Group::find($key);

                    foreach ($group_disciplines as $group_discipline) {
                        $category_hour = CategoryHours::find($group_discipline['otherhour_id']);

                        $data[$discipline_teacher->name]['groups'][$group_teacher->name]['hours'][$category_hour->name]['hour'] = $group_discipline['hour'];
                        $data[$discipline_teacher->name]['groups'][$group_teacher->name]['hours'][$category_hour->name]['id'] = $group_discipline['id'];
                        if (!isset($total['hours'][$category_hour->name])) {
                            $total['hours'][$category_hour->name] = 0;
                        }
                        $total['hours'][$category_hour->name] += $group_discipline['hour'];
                    }

                    //TODO переделать по позициям а не обращаться через имя
                    $data[$discipline_teacher->name]['groups'][$group_teacher->name]['sum'] = 
                    $data[$discipline_teacher->name]['groups'][$group_teacher->name]['hours']['1 полугодие']['hour'] + 
                    $data[$discipline_teacher->name]['groups'][$group_teacher->name]['hours']['2 полугодие']['hour'];
                    $total['sum'] += $data[$discipline_teacher->name]['groups'][$group_teacher->name]['sum'];
                }
            }

            $total['total'] = array_sum($total['hours']) - $total['hours']['Теория'] - $total['hours']['ЛПЗ'];
        }

        return ['data' => $data, 'total' => $total];
    }

    public function show($id)
    {
        $teacher = Teacher::find($id);
        $category_hours = CategoryHours::get();
        $discipline = Discipline::get();
        $groups = Group::get();

        $teacher_hour = $this->get_hour_teacher($teacher);

        return view('teacher.show', [
            'teacher' => $teacher,
            'category_hours' => $category_hours,
            'discipline' => $discipline,
            'groups' => $groups,
            'data' => $teacher_hour['data'],
            'total' => $teacher_hour['total']
        ]);
    }

    // TODO Доделать вывод в EXCEL
    // Генерация EXEL данных
    private function generate_exel_table($data)
    {

    }

    // вывод в excel файл
    public function print_excel($id)
    {
        $data = $this->generate_date_show($id);
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=foo_bar.xls");
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

        // удаляем все часы преподавателя
        $teacher_hours = TableHoure::where('teacher_id', $teacher->id)->delete();

        // удаляем преподавателя
        $teacher->delete();
        return redirect()->route('teacher.home');
    }

    //TODO Добавить проверки на удаление

    public function delete_active(Request $request)
    {
        foreach ($request->teacher_id as $teacher) {
            $this->delete($teacher);
        }

        return response('Ok!', 200);
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

    // TODO добавить проверки!!!
    public function add_hour(Request $request)
    {
        foreach ($request->hour as $key => $hour) {
            $table_hour = new TableHoure();
            $table_hour->teacher_id = $request->teacher_id;
            $table_hour->discipline_id = $request->discipline_id;
            $table_hour->group_id = $request->group_id;
            $table_hour->otherhour_id = $key;
            $table_hour->hour = $hour;
            $table_hour->save();
        }
        return redirect('teacher/show/' . $request->teacher_id);
    }

    public function edit_hour(Request $request)
    {
        $entry = TableHoure::find($request->entry_id);
        $entry->hour = $request->value;
        $entry->save();
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

        return redirect()->route('teacher.home');
    }

    public function discipline_delete(Request $request)
    {
        $discipline = Discipline::get()->where('name', $request->discipline_name)->first();
        $group = Group::get()->where('name', $request->group_name)->first();

        $discipline_id = $discipline->id;
        $teacher_id = $request->teacher_id;
        $group_id = $group->id;

        TableHoure::where('teacher_id', $teacher_id)
            ->where('discipline_id', $discipline_id)
            ->where('group_id', $group_id)
            ->delete();

        return redirect()->route('teacher.show', ['id' => $teacher_id]);

    }

}
