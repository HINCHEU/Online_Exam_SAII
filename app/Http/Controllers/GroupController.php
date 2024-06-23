<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class GroupController extends Controller
{
    //
    public function index()
    {
        $group = Group::where('created_by', Auth::user()->id)->where('status', 1)->get();
        return view('teacher.exam.group.group')->with('groups', $group);
    }
    public function show()
    {
        return view('teacher.exam.group.AddGroup');
    }
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|max:32|unique:group,name',
            'desc' => 'required|max:200'
        ]);

        $group = new Group();
        $group->name = $request->input('name');
        $group->desc = $request->input('desc');
        $group->status = 1; // Assuming default status
        $group->created_by = Auth::user()->id;

        if ($group->save()) {
            // Redirect with success message and newly created group ID
            return redirect()->route('group.show')
                ->with('success', 'Group created successfully!')
                ->with('group', $group); // Pass the newly created group
        } else {
            return redirect()->route('group.add')
                ->withErrors($group->getErrors())
                ->withInput(); // This will flash old input to the form
        }
    }

    public function edit($id)
    {
        $group = Group::where('id', $id)->first();
        return view('teacher.exam.group.UpdateGroup')->with('group', $group);
    }
    public function update(Request $request, $group_id)
    {
        // Find the group to update
        $group = Group::findOrFail($group_id);

        // Validate the request input
        $request->validate([
            'name' => [
                'required',
                'max:32',
                Rule::unique('group', 'name')->ignore($group->id),
            ],
            'desc' => 'required|max:200',
        ]);

        // Update the group attributes
        $group->name = $request->input('name');
        $group->desc = $request->input('desc');

        // Save the changes and handle the response
        if ($group->save()) {
            return redirect()->route('group.show', ['group_id' => $group->id])
                ->with('success', 'Group updated successfully!');
        } else {
            return redirect()->route('group.edit', ['group_id' => $group->id])
                ->withErrors($group->getErrors())
                ->withInput(); // This will flash old input to the form
        }
    }


    public function delete($id)
    {
        $group = Group::findOrFail($id);

        if (!$group) {
            return redirect()->route('group.show')->with('error', 'group not found.');
        }

        // Update the status to 0 instead of deleting
        $group->status = 0;
        $group->save();
        return redirect()->route('group.show')->with('successfull', 'delete succesfully not found.');
    }
}
