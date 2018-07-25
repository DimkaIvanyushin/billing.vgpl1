<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimetableController extends Controller
{
    public function home()
    {

        header ( "Content-type: application/vnd.ms-excel" );
        header ( "Content-Disposition: attachment; filename=foo_bar.xls" );
        echo "<table style=\"width:100%\"><tr><th>Firstname</th><th>Lastname</th><th>Age</th></tr><tr><td>Jill</td><td>Smith</td> <td>50</td></tr><tr><td>Eve</td><td>Jackson</td> <td>94</td></tr></table>";

//        return view('timetable.home', [
//
//        ]);
    }
}
