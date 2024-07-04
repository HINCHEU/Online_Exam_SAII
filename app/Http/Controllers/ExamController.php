<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Quize;
use Illuminate\Support\Facades\Auth;
use App\Models\QuizeAnswer;
use App\Models\Group;
use App\Models\AssignExam;

class ExamController extends Controller
{
    //

    public function  index()
    {
        $exam = Exam::where('created_by', Auth::user()->id)->get();
        $group = Group::where('created_by', Auth::user()->id)->get();
        $assignedGroups = AssignExam::where('is_assigned', true)
            ->get()
            ->groupBy('exam_id')
            ->map(function ($group) {
                return $group->unique('group_id');
            });

        return view('teacher.exam.CreateExam')
            ->with('exams', $exam)
            ->with('groups', $group)
            ->with('assignedGroups', $assignedGroups);
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
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'total_mark' => 'required',
            'total_mark' => 'required|integer|min:1',
        ], [
            'date.after_or_equal' => 'Date must be today or later.',
            'end_time.after' => 'End time must be after start time.',
        ]);

        // Ensure start time is not in the past
        $startTime = $request->input('date') . ' ' . $request->input('start_time');
        if (strtotime($startTime) < strtotime(now())) {
            return redirect()->back()->withInput()->with('error', 'Start time cannot be in the past.');
        }

        // Create a new exam instance and fill it with the validated data
        $exam = new Exam();
        $exam->courseName = $validatedData['course_name'];
        $exam->description = $validatedData['description'];
        $exam->instruction = $validatedData['instruction'];
        $exam->topic = $validatedData['topic'];
        $exam->date = $validatedData['date'];
        $exam->startDate = $validatedData['start_time'];
        $exam->endDate = $validatedData['end_time'];
        $exam->created_by = $user_id;
        $exam->type = 'qcm';

        // Try to save the exam to the database
        try {
            $exam->save();

            // Retrieve the ID of the newly created exam
            $exam_id = $exam->id;

            // Create a new Quize instance and associate it with the exam
            $quize = new Quize();
            $quize->exam_id = $exam_id;
            $quize->total_mark = $validatedData['total_mark'];
            $quize->save();
        } catch (\Exception $e) {
            // Log the exception for debugging if needed
            // logger()->error('Failed to save exam: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->withInput()->with('error', 'Failed to save exam. Please try again.');
        }

        // If saving succeeds, redirect to the "question.add" route
        return redirect()->route('question.add', ['quize_id' => $quize->id])->with('success', 'Exam saved successfully.');
    }

    public function update(Request $request, $exam_id)
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
            'total_mark' => 'required'
        ]);
        // Retrieve the exam instance from the database
        $exam = Exam::find($exam_id);
        // Update the exam properties
        $exam->courseName = $request->input('course_name');
        $exam->description = $request->input('description');
        $exam->instruction = $request->input('instruction');
        $exam->topic = $request->input('topic');
        $exam->date = $request->input('date');
        $exam->startDate = $request->input('start_time');
        $exam->endDate = $request->input('end_time');
        //dd($exam);
        // Try to save the exam to the database
        try {
            $exam->save();
            // Retrieve the ID of the newly created exam
            $quize = Quize::where('exam_id', $exam_id)->first();
            $quize->total_mark = $request->input('total_mark');
            //dd($quize);
            $quize->save();
        } catch (\Exception $e) {
            // Log the exception for debugging if needed
            // logger()->error('Failed to update exam: ' . $e->getMessage());
            // Redirect back with an error message
            return redirect()->back()->withInput()->with('error', 'Failed to update exam. Please');
        }
        // If saving succeeds, redirect to the "question.add" route
        // dd($exam_id);
        $quizeAnswers = QuizeAnswer::where('quize_id', $exam_id)->get();

        $exam = Exam::where('id', $exam_id)->first();
        //find quize
        $quize = Quize::where('id', $exam_id)->first();
        return view('teacher.exam.UpdateQuestion')
            ->with('exam_id', $exam_id)
            ->with('questions', $quizeAnswers)
            ->with('exam', $exam)
            ->with('quize', $quize)
            ->with('success', "Update exam successfully");
    }
}
