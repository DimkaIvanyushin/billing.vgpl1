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



        return view('entry.home', [

        ]);
    }

}
