<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Models\Student;
use App\Models\AssignExam;
use App\Models\Quize;
use App\Models\QuizeAnswer;
use App\Models\Answer; // Assuming you have an Answer model to store the answers

class AttenceExamController extends Controller
{
    // public function index(Request $request)
    // {
    //     $user_id = Auth::user()->id;

    //     // Find the student's group_id
    //     $student = Student::where('user_id', $user_id)->first();

    //     if (!$student) {
    //         // Handle case when the student is not found
    //         return redirect()->back()->withErrors('Student not found.');
    //     }

    //     $group_id = $student->group_id;

    //     // Find exam_ids that are assigned with the group in the AssignExam table
    //     $exam_ids = AssignExam::where('group_id', $group_id)
    //         ->where('is_assigned', 1)
    //         ->pluck('exam_id');

    //     // Find the exams that are assigned to the group
    //     $exams = Exam::whereIn('id', $exam_ids)->get();

    //     return view('student.index')->with('exams', $exams);
    // }

    // app/Http/Controllers/AttenceExamController.php

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

        // Find exam_ids that are assigned with the group in the AssignExam table
        $exam_ids = AssignExam::where('group_id', $group_id)
            ->where('is_assigned', 1)
            ->pluck('exam_id');

        // Find the exams that are assigned to the group
        $exams = Exam::whereIn('id', $exam_ids)->get();

        // Fetch total scores for each exam from quizes_answers table
        foreach ($exams as $exam) {
            // Retrieve all quizzes for the exam
            $quizzes = Quize::where('exam_id', $exam->id)->get();

            // Initialize the total score and total mark
            $totalScore = 0;
            $totalMark = 0;

            if ($quizzes) {
                // Fetch all quiz answers for the exam and user
                $answers = Answer::where('exam_id', $exam->id)
                    ->where('user_id', $user_id)
                    ->get();

                // Sum the marks for all the user's answers and calculate the total possible marks
                foreach ($quizzes as $quiz) {
                    $totalMark += $quiz->total_mark;

                    foreach ($answers as $answer) {
                        $quizeAnswer = QuizeAnswer::where('id', $answer->question_id)
                            ->where('quize_id', $quiz->id)
                            ->first();

                        if ($quizeAnswer && $quizeAnswer->correct_answer == $answer->answer) {
                            $totalScore += $quizeAnswer->mark;
                        }
                    }
                }
            }

            // Assign the total score and total mark to the exam object
            $exam->score = $totalScore;
            $exam->full_mark = $totalMark;
        }

        // Return the view with exams and their respective scores
        return view('student.index')->with('exams', $exams);
    }





    public function show(Request $request, $exam_id)
    {
        $exam = Exam::where('id', $exam_id)->first();
        $quize = Quize::where('id', $exam_id)->first();
        $quizeAnswers = QuizeAnswer::where('quize_id', $exam_id)->get();

        return view('student.exam')
            ->with('exam', $exam)
            ->with('quize', $quize)
            ->with('questions', $quizeAnswers);
    }

    public function submit(Request $request)
    {
        // Validate the request data
        $request->validate([
            'exam_id' => 'required|integer|exists:exams,id',
            'answers' => 'required|array',
            'answers.*' => 'required|string'
        ]);

        $examId = $request->input('exam_id');
        $answers = $request->input('answers');

        // Loop through the answers and save them to the database
        foreach ($answers as $questionId => $answer) {
            Answer::create([
                'exam_id' => $examId,
                'question_id' => $questionId,
                'answer' => $answer,
                'user_id' => auth()->user()->id
            ]);
        }

        // Redirect back or to a results page with a success message
        return redirect()->route('student', ['exam' => $examId])
            ->with('success', 'Your answers have been submitted successfully!');
    }


    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function result($examId)
    // {
    //     // Fetch the results or display a confirmation message
    //     return view('exam.result', compact('examId'));
    // }

    public function result($examId)
    {
        // Example logic to fetch exam details or results
        // $user_id = Auth::id();
        // $exam_ids = Exam::where('created_by', $examId)->get('id');
        // $quize = Quize::where('exam_id', $exam_ids)->get();
        return redirect()->route('student');
    }




    // app/Http/Controllers/AttenceExamController.php
    public function calculateScore(Request $request)
    {
        $user_id = Auth::user()->id;
        $exam_id = $request->input('exam_id');

        // Fetch the student's answers
        $studentAnswers = Answer::where('user_id', $user_id)
            ->where('exam_id', $exam_id)
            ->get();

        // Assuming you have a way to get the correct answers
        $correctAnswers = QuizeAnswer::where('quize_id', $exam_id)->get();

        $score = 0;

        // Calculate the score
        foreach ($studentAnswers as $studentAnswer) {
            foreach ($correctAnswers as $correctAnswer) {
                if ($studentAnswer->question_id == $correctAnswer->question_id && $studentAnswer->answer == $correctAnswer->correct_answer) {
                    $score++;
                }
            }
        }

        return response()->json(['score' => $score]);
    }
}
