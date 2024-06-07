<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    //'
    public function All_Teacher()
    {
        $Teachers = Teacher::where('role_id', '3')->get();
        $AllTeacher = count($Teachers);
        return view('Admin.index')->with('AllTeacher', $AllTeacher);
    }
    public function show()
    {
        $Teachers = Teacher::where('role_id', '3')->get();
        return view('Admin.Teacher')->with('Teachers', $Teachers);
    }
    public function Edit($id)
    {
        //dd($id);
        $EditTeacher =  Teacher::findOrFail($id);

        return view('Admin.editTeacher')->with('EditTeacher', $EditTeacher);
    }

    public function update(Request $request, $id)
    {
        $EditTeacher = Teacher::findOrFail($id);

        // Handle file upload if provided
        if ($request->hasFile('file')) {
            // Process the file upload here
            $file = $request->file('file');
            // For example, you can store the file in a specific directory
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            // Update the teacher record with the new file path
            $EditTeacher->user_image = 'uploads/' . $filename;
        }

        // Update other fields
        $EditTeacher->name = $request->name;
        $EditTeacher->status = $request->status;

        // Save the changes
        $EditTeacher->save();

        // Redirect back or wherever you want
        return redirect()->route('show');
    }
    public function destroy(Request $request, $teacher)
    {
        $id = $teacher;
        dd($id);
        $teacher = Teacher::find($id);
        $teacher->delete();
        return redirect()->route('show');
    }
}
