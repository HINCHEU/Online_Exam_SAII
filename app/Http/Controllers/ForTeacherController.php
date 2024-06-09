<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\User;
use App\Models\student;
use LDAP\Result;

class ForTeacherController extends Controller
{
    //
    public function index()
    {
        $students = Student::where('status', 1)->get();

        return view('teacher.student')->with('students', $students);
    }
    public function show()
    {
        return view('teacher.AddStudent');
    }
    public function create(Request $request)
    {
        $request->validate([
            'stname' => 'required|max:32',
            'email' => 'required|unique:App\Models\User,email',
            'gender' => 'required',
            'DateOfBirth' => 'required|date',
            'password' => 'required',
        ]);


        $users = new user();
        $users->name = $request->input('stname');
        $users->email = $request->input('email');
        $users->password = bcrypt($request->input('password')); //
        $users->role_id =  2; // Student role id is 2
        $users->status = 1; //1 ==active
        $users->created_by = auth()->user()->id; //Assing Created by to the one who created this account
        //dd($users);

        // dd($students);
        $latest_user = User::latest()->first();

        $students = new Student();
        $students->stname = $request->input('stname');
        $students->gender = $request->input('gender'); // Fix gender assignment
        $DOB = date_create($request->input('DateOfBirth'));
        $format = "Y-m-d";
        $DOB = date_format($DOB, $format);
        $students->DateOfBirth = $DOB;
        $students->status = 1;
        $students->user_id =  $latest_user->id + 1; // Assign User Id with lastest User ID
        // dd($students);
        if ($users->save() and $students->save()) {
            return redirect()->route("view.student")->withSuccess('Great! You have successfully added a student');
        } else {
            return redirect()->back()->withErrors('Failed to add student'); // Use withErrors to display error messages
        }
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


        //dd($student);
        return view('teacher.EditStudent')->with('student', $student);
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
        
        // Save the changes
        $EditStudent->save();

        // Redirect back or wherever you want
        return redirect()->route('view.student');
    }
}
