<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use App\Discipline;
use App\Group;
use App\TableHoure;

class TimetableController extends Controller
{
    public function home()
    {
        $db_json = file_get_contents("bd.json");
        $entryes = json_decode($db_json, true);

        foreach ($entryes as $entry) {
            $teacher = Teacher::get()->where('name', $entry['Name'])->first();

            if ($teacher != NULL) {
                $discipline = Discipline::get()->where('name', $entry['discipline'])->first();
               
                if($discipline != NULL) {   
                    $group = Group::get()->where('name', $entry['group'])->first();

                    if($group != NULL) {
                        
                        // TableHoure::create(['discipline_id' => $discipline->id, 'group_id' => $group->id,'teacher_id' => $teacher->id, 'otherhour_id' => 1, 'hour' => $entry['Теория'] ]);
                        // TableHoure::create(['discipline_id' => $discipline->id, 'group_id' => $group->id,'teacher_id' => $teacher->id, 'otherhour_id' => 2, 'hour' => $entry['ЛПЗ'] ]);
                        // TableHoure::create(['discipline_id' => $discipline->id, 'group_id' => $group->id,'teacher_id' => $teacher->id, 'otherhour_id' => 3, 'hour' => $entry['Курсовое проектирование'] ]);
                        // TableHoure::create(['discipline_id' => $discipline->id, 'group_id' => $group->id,'teacher_id' => $teacher->id, 'otherhour_id' => 4, 'hour' => $entry['1 полугодие'] ]);
                        // TableHoure::create(['discipline_id' => $discipline->id, 'group_id' => $group->id,'teacher_id' => $teacher->id, 'otherhour_id' => 5, 'hour' => $entry['2 полугодие'] ]);
                        // TableHoure::create(['discipline_id' => $discipline->id, 'group_id' => $group->id,'teacher_id' => $teacher->id, 'otherhour_id' => 6, 'hour' => $entry['Консультаии'] ]);
                        // TableHoure::create(['discipline_id' => $discipline->id, 'group_id' => $group->id,'teacher_id' => $teacher->id, 'otherhour_id' => 7, 'hour' => $entry['Допконтроль'] ]);
                        // TableHoure::create(['discipline_id' => $discipline->id, 'group_id' => $group->id,'teacher_id' => $teacher->id, 'otherhour_id' => 8, 'hour' => $entry['Экзамен'] ]);
                        // TableHoure::create(['discipline_id' => $discipline->id, 'group_id' => $group->id,'teacher_id' => $teacher->id, 'otherhour_id' => 9, 'hour' => $entry['ОВР (кабинет)'] ]);
                        // TableHoure::create(['discipline_id' => $discipline->id, 'group_id' => $group->id,'teacher_id' => $teacher->id, 'otherhour_id' => 10, 'hour' => $entry['ОВР (восп.раб.)'] ]);
                        // TableHoure::create(['discipline_id' => $discipline->id, 'group_id' => $group->id,'teacher_id' => $teacher->id, 'otherhour_id' => 11, 'hour' => $entry['Факультатив'] ]);
                    }
                }
            }
        }
        echo "Ура!";
        // header ( "Content-type: application/vnd.ms-excel" );
        // header ( "Content-Disposition: attachment; filename=foo_bar.xls" );
        // echo "<table style=\"width:100%\"><tr><th>Firstname</th><th>Lastname</th><th>Age</th></tr><tr><td>Jill</td><td>Smith</td> <td>50</td></tr><tr><td>Eve</td><td>Jackson</td> <td>94</td></tr></table>";

//        return view('timetable.home', [
//
//        ]);
    }
}
