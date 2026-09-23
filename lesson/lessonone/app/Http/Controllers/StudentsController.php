<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function index(){
        return view('students/index');
    }

    public function show(){
        return view('students/show');
    }

    public function edit(){
        return view('students/edit');
    }
}
