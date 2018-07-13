<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Group;
use App\Teacher;

class GroupController extends Controller
{
    public function home()
    {
        $groups = Group::get();
        return view('layouts.home', [
            'lists' => $groups
        ]);
    }

    public function create()
    {
        $teachers = Teacher::get();
        return view('group.create', [
            'teachers' => $teachers
        ]);
    }

    public function add(StoreRequest $request)
    {
        $data = explode(",", $request->name);
        
        if ($data)
        {
            foreach ($data as $value)
            {
                $group = new Group();
                $group->name = $value;
                $group->save();
            }

            return redirect()->route('group.home');
        }

        return redirect()->route('group.home');
    }

    public function edit($id)
    {
        $group = Group::find($id);
        return view('layouts.edit', [
            'group' => $group
        ]);
    }

    public function delete($id)
    {
        $group = Group::find($id);
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
