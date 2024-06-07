<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExamController extends Controller
{
    //
    public function  index()
    {
        return view('teacher.exam.CreateExam');
    }
    public function create()
    {

        return view('teacher.exam.AddCreate');
    }
}
