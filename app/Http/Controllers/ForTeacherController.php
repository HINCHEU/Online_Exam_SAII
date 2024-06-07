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
        $students =  student::all();
        // $email = $students->User->id;
        // dd($email);

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
        $users->role_id =  2; // Student role id is 4
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
        $students->user_id =  $latest_user->id + 1; // Assign User Id with lastest User ID
        // dd($students);
        if ($users->save() and $students->save()) {
            return redirect()->route("view.student")->withSuccess('Great! You have successfully added a student');
        } else {
            return redirect()->back()->withErrors('Failed to add student'); // Use withErrors to display error messages
        }
    }
}
