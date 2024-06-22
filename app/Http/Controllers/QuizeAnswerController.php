<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Quize;
use Illuminate\Http\Request;
use App\Models\QuizeAnswer;
use PHPUnit\Framework\Constraint\Count;

class QuizeAnswerController extends Controller
{
    public function index(Request $request, $quize_id)
    {
        // Fetch all QuizeAnswer records where quize_id matches $quize_id
        $quize_answers = QuizeAnswer::where('quize_id', $quize_id)->get();

        // Count the number of fetched records
        $count = $quize_answers->count();
        //debugg
        //dd($count);
        //dd($quize_id);

        return view('teacher.exam.AddQuestion')
            ->with('quize_id', $quize_id)
            ->with('count', $count);
    }
    //
    public function create(Request $request, $quize_id)
    {
        // $quize = Quize::where('id', Exam::all());
        // dd($request);
        $data = $request->input('questions');
        foreach ($data as $questionData) {
            $question = new QuizeAnswer();
            $question->question_text = $questionData['question'];
            $question->answer_a = $questionData['answer_a'];
            $question->answer_b = $questionData['answer_b'];
            $question->answer_c = $questionData['answer_c'];
            $question->correct_answer = $questionData['correct_answer'];
            $question->mark = $questionData['mark'];


            $question->quize_id = $quize_id;

            $question->save();
        }
        return redirect()->route('exam.show');
    }
    public function updateView(Request $request, $exam_id)
    {
        // dd($exam_id);
        $quizeAnswers = QuizeAnswer::where('quize_id', $exam_id)->get();
        //dd($quizeAnswers);
        $exam = Exam::where('id', $exam_id)->first();
        //find quize
        $quize = Quize::where('id', $exam_id)->first();

        //dd($quize);
        return view('teacher.exam.UpdateQuestion')
            ->with('exam_id', $exam_id)
            ->with('questions', $quizeAnswers)
            ->with('exam', $exam)
            ->with('quize', $quize);
    }
    public function update(Request $request, $exam_id)
    {
        $questionsData = $request->input('questions');

        foreach ($questionsData as $question_id => $questionData) {
            // Find the QuizeAnswer record by its ID
            $question = QuizeAnswer::findOrFail($question_id);

            // Update the question attributes
            $question->question_text = $questionData['question'];
            $question->answer_a = $questionData['answer_a'];
            $question->answer_b = $questionData['answer_b'];
            $question->answer_c = $questionData['answer_c'];
            $question->correct_answer = $questionData['correct_answer'];
            $question->mark = $questionData['mark'];

            // Save the updated question
            $question->save();
        }

        // dd($exam_id);
        $quizeAnswers = QuizeAnswer::where('quize_id', $exam_id)->get();

        $exam = Exam::where('id', $exam_id)->first();
        //find quize
        $quize = Quize::where('id', $exam_id)->first();
        return view('teacher.exam.UpdateQuestion')
            ->with('exam_id', $exam_id)
            ->with('questions', $quizeAnswers)
            ->with('exam', $exam)
            ->with('quize', $quize);
    }
}
