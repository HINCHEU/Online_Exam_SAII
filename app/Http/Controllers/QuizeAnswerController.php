<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Quize;
use Illuminate\Http\Request;
use App\Models\QuizeAnswer;
use PHPUnit\Framework\Constraint\Count;

class QuizeAnswerController extends Controller
{
    public function index(Request $request)
    {
        $quize_answers = QuizeAnswer::all();
        $count = count($quize_answers);
        //dd($count);
        return view('teacher.exam.AddQuestion', compact('quize_answers'));
    }
    //
    public function create(Request $request)
    {
        $quize = Quize::where('id', Exam::all());
        // dd($request);
        $data = $request->input('questions');
        foreach ($data as $questionData) {
            $question = new QuizeAnswer();
            $question->question_text = $questionData['question'];
            $question->answer_a = $questionData['answer_a'];
            $question->answer_b = $questionData['answer_b'];
            $question->answer_c = $questionData['answer_c'];
            $question->correct_answer = $questionData['correct_answer'];
            //$question->exam_id = ;

            $question->save();
        }
        return redirect()->route('exam.add');
    }
}
