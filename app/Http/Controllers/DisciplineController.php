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

    public function delete($id)
    {
        $discipline = Discipline::find($id);
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
