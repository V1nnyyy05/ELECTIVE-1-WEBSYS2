<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //

    public function create(){
        return view('student');
    }

    public function store(Request $request){
        $validated = $request -> validate([
            'name' => 'required|min:3|max:30',
            'age' => 'required|min:1|max:3',
            'email' => 'required|email',
            'password' => 'required|min:3|confirmed',
        ],[
            'name.required' => 'Need mong maglagay ng Name Boy!!',
            'name.max' => 'Over naman sa dami ang name na yan!!',
            'name.min' => 'Teh ilagay mo naman lahat ng name mo!!',
            'age.required' => 'Need mong ilagay ang Age mo, ano yan wala kang edad??!!',
            'age.max' => 'Over sa age teh, Sobrang tanda mo naman!!',
            'email.required' => 'Need your Email please input',
            'password.required' => 'Please input valid Password',
            'password.confirmation' => 'Teh hindi sila Same Password, Ulitin mo!!',
        ]
        );
        return back()->with('success', 'Registration is Succesful, Congrats!!');
    }
}


