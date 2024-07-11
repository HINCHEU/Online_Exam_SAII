<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use  App\Models\User;
use App\Models\student;
use LDAP\Result;
use Illuminate\Support\Facades\Auth;

class ForTeacherController extends Controller
{


    // Assuming you're in a controller method
    public function index()
    {
        $authUserId = Auth::user()->id; // Get the ID of the currently authenticated user

        // Query to retrieve students with status = 1 and created by the authenticated user
        $students = Student::where('status', 1)
            ->whereHas('user', function ($query) use ($authUserId) {
                $query->where('created_by', $authUserId);
            })
            ->get();

        // Return or use $students as needed
        return view('teacher.student', compact('students'));
    }

    public function show()
    {
        $group = Group::where('created_by', Auth::user()->id)->get();
        //dd($group);
        return view('teacher.AddStudent')->with('groups', $group);
    }
    public function create(Request $request)
    {

        $request->validate([
            'stname' => 'required|max:32',
            'email' => 'required|unique:App\Models\User,email',
            'gender' => 'required',
            'DateOfBirth' => 'required|date',
            'password' => 'required',
            'group_id' => 'required', // Validate group_id
        ]);

        // Create a new user
        $user = new User();
        $user->name = $request->input('stname');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role_id = 2; // Assuming Student role id is 2
        $user->status = 1; // Active status
        $user->created_by = auth()->user()->id; // Set created_by to the current user

        if ($user->save()) {
            $user->sendEmailVerificationNotification();
            // Create a new student linked to the user
            $student = new Student();
            $student->stname = $request->input('stname');
            $student->gender = $request->input('gender');
            $student->DateOfBirth = $request->input('DateOfBirth');
            $student->status = 1; // Active status
            $student->user_id = $user->id; // Assign User Id of the newly created user
            $student->group_id = $request->input('group_id'); // Assign Group ID from form

            if ($student->save()) {
                return redirect()->route("view.student")->withSuccess('Great! You have successfully added a student');
            } else {
                return redirect()->route("view.student")->withErrors('Error! Unable to add student');
            }
        }

        return redirect()->back()->withErrors('Failed to add student');
    }

    public function delete(Request $request, $student_id)
    {
        $student = Student::find($student_id);

        if (!$student) {
            return redirect()->route('view.student')->with('error', 'Student not found.');
        }

        // Update the status to 0 instead of deleting
        $student->status = 0;
        $student->save();

        return redirect()->route('view.student')->with('success', 'Student status updated successfully.');
    }
    ///edit Student (view)
    function edit(Request $request, $student_id)
    {
        $student = Student::find($student_id);
        $group = Group::where('created_by', Auth::user()->id)->get();

        //dd($student);
        return view('teacher.EditStudent')
            ->with('student', $student)
            ->with('groups', $group);
    }
    // Update Student
    public function update(Request $request, $id)
    {
        $EditStudent = student::findOrFail($id);

        // Handle file upload if provided
        // if ($request->hasFile('file')) {
        //     // Process the file upload here
        //     $file = $request->file('file');
        //     // For example, you can store the file in a specific directory
        //     $filename = time() . '_' . $file->getClientOriginalName();
        //     $file->move(public_path('uploads'), $filename);
        //     // Update the teacher record with the new file path
        //     $EditTeacher->user_image = 'uploads/' . $filename;
        // }

        // Update other fields
        $EditStudent->stname = $request->name;
        $EditStudent->DateOfBirth = $request->DateOfBirth;
        $EditStudent->gender = $request->gender;
        $EditStudent->group_id = $request->group_id;

        // Save the changes
        $EditStudent->save();

        // Redirect back or wherever you want
        return redirect()->route('view.student')->with('success', 'update succesfully');
    }
}
