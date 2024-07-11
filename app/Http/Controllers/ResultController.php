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
            ->join('group', 'students.group_id', '=', 'group.id') // Join with the group table
            ->select(
                'students.id as student_id',
                'students.stname',
                'users.email',
                'students.gender',
                'students.DateOfBirth',
                'exams.topic',
                'exams.courseName',
                'group.name as group_name', // Select the group name
                DB::raw('SUM(CASE WHEN quize_answers.correct_answer = answers1.answer THEN quize_answers.mark ELSE 0 END) as correct_score'),
                DB::raw('SUM(quize_answers.mark) as total_possible_score')
            )
            ->where('exams.created_by', '=', $user_id)
            ->groupBy(
                'students.id',
                'students.stname',
                'users.email',
                'students.gender',
                'students.DateOfBirth',
                'exams.topic',
                'exams.courseName',
                'group.name' // Add group name to the group by clause
            )
            ->get();


        return view('scores', ['students' => $students]);
    }
}
