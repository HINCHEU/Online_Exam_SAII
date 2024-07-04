<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    //
    public function index()
    {
        $exam = Exam::where('created_by', Auth::id())->get();
        return view('teacher.exam.Result')
            ->with('exam', $exam);
    }
}
