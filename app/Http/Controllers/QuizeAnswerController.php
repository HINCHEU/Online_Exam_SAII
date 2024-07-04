<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Quize;
use Illuminate\Http\Request;
use App\Models\QuizeAnswer;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Facades\Validator;


class QuizeAnswerController extends Controller
{
    public function index(Request $request, $quize_id)
    {
        // Fetch all QuizeAnswer records where quize_id matches $quize_id
        $quize_answers = QuizeAnswer::where('quize_id', $quize_id)->get();
        $quize = Quize::where('id', $quize_id)->first();
        // dd($quize);
        // Count the number of fetched records
        $count = $quize_answers->count();

        //debugg
        //dd($count);
        //dd($quize_id);

        return view('teacher.exam.AddQuestion')
            ->with('quize_id', $quize_id)
            ->with('count', $count)
            ->with('quize', $quize);
    }
    //
    public function create(Request $request, $quize_id)
    {
        // Find the quiz by ID
        $quize = Quize::find($quize_id);
        $totalMark = $quize->total_mark;

        // Get the questions from the request
        $questions = $request->input('questions');
        // Calculate the total marks for the questions
        $totalQuestionMark = array_sum(array_column($questions, 'mark'));

        // Define validation rules
        $validator = Validator::make($request->all(), [
            'questions.*.question' => 'required|string',
            'questions.*.answer_a' => 'required|string',
            'questions.*.answer_b' => 'required|string',
            'questions.*.answer_c' => 'required|string',
            'questions.*.correct_answer' => 'required|string',
            'questions.*.mark' => 'required|numeric|min:0',
        ]);

        // Check if the total marks of the questions exceed the total mark of the quiz
        if ($totalQuestionMark > $totalMark) {
            return back()->withErrors(['The total marks for all questions should not exceed the total mark of the quiz.'])->withInput();
        }

        // Check if validation fails
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Save the questions
        foreach ($questions as $questionData) {
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

        // Redirect to a route after saving
        return redirect()->route('exam.show')->with('success', 'Questions added successfully');
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
