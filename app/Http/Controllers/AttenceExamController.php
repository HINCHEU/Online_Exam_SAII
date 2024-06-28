<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Models\student;
use App\Models\AssignExam;
use App\Models\Quize;
use App\Models\QuizeAnswer;

class AttenceExamController extends Controller
{
    //
    public function index(Request $request)
    {
        $user_id = Auth::user()->id;

        // Find the student's group_id
        $student = Student::where('user_id', $user_id)->first();

        if (!$student) {
            // Handle case when the student is not found
            return redirect()->back()->withErrors('Student not found.');
        }

        $group_id = $student->group_id;
        //dd($group_id);
        // Find exam_ids that are assigned with the group in the AssignExam table
        $exam_ids = AssignExam::where('group_id', $group_id)
            ->where('is_assigned', 1)
            ->pluck('exam_id'); // Using pluck to get a plain array of exam_ids

        //dd($exam_ids);
        // Find the exams that are assigned to the group
        $exams = Exam::whereIn('id', $exam_ids)->get();
        //

        return view('student.index')->with('exams', $exams);
    }
    public function show(Request $request, $exam_id)
    {
        $exam = Exam::where('id', $exam_id)->first();
        //dd($exam);
        $quize = Quize::where('id', $exam_id)->first();
        //dd($quize);
        $quizeAnswers = QuizeAnswer::where('quize_id', $exam_id)->get();
        return view('student.exam')
            ->with('exam', $exam)
            ->with('quize', $quize)
            ->with('questions', $quizeAnswers);
    }
}
