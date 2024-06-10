<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;

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
    public function save(Request $request, $user_id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'course_name' => 'required|string|max:255',
            'description' => 'required|string',
            'instruction' => 'required|string',
            'topic' => 'required|string|max:255',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        // Create a new exam instance and fill it with the validated data
        $exam = new Exam();
        $exam->courseName = $request->input('course_name');
        $exam->description = $request->input('description');
        $exam->instruction = $request->input('instruction');
        $exam->topic = $request->input('topic');
        $exam->date = $request->input('date');
        $exam->startDate = $request->input('start_time');
        $exam->endDate = $request->input('end_time');
        $exam->created_by = $user_id;
        $exam->type = 'qcm';

        // Try to save the exam to the database
        try {
            $exam->save();
        } catch (\Exception $e) {
            // Log the exception for debugging
            logger()->error('Failed to save exam: ' . $e->getMessage());

            dd($e);
            // Redirect back with an error message
            //return redirect()->back()->withInput()->with('error', 'Failed to save exam. Please try again.');
        }

        // If saving succeeds, redirect to the "Question.add" route
        return redirect()->route('question.add')->with('success', 'Exam saved successfully.');
    }
}
