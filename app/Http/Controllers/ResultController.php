<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;
use App\Models\Answer;
use App\Models\student;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    //
    public function index()
    {
        $exam = Exam::where('created_by', Auth::id())->get();
        //id teacher

        return view('teacher.exam.Result')
            ->with('exam', $exam);
    }
    public function showStudentScores()
    {
        $user_id = Auth::user()->id;

        $students = DB::table('students')
            ->join('users', 'students.user_id', '=', 'users.id')
            ->join('answers1', 'students.user_id', '=', 'answers1.user_id')
            ->join('quize_answers', 'answers1.question_id', '=', 'quize_answers.id')
            ->join('exams', 'answers1.exam_id', '=', 'exams.id')
            ->select('students.id as student_id', 'students.stname', 'users.email', 'students.gender', 'students.DateOfBirth', 'exams.topic', 'exams.courseName', DB::raw('SUM(quize_answers.mark) as total_marks'))
            ->where('exams.created_by', '=', $user_id)
            ->groupBy('students.id', 'students.stname', 'users.email', 'students.gender', 'students.DateOfBirth', 'exams.topic', 'exams.courseName')
            ->get();

        return view('scores', ['students' => $students]);
    }
}
