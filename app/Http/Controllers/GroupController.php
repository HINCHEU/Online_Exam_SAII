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
        $groups = Group::where('created_by', Auth::user()->id)
            ->where('status', 1)
            ->withCount(['students' => function ($query) {
                $query->where('status', 1); // Only count active students
            }])
            ->get();

        return view('teacher.exam.group.group', compact('groups'));
    }

    public function show()
    {
        return view('teacher.exam.group.AddGroup');
    }
    public function create(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'max:32',
                function ($attribute, $value, $fail) {
                    $userId = Auth::id();
                    if (Group::where('name', $value)->where('created_by', $userId)->exists()) {
                        $fail('ក្រុម ' . $attribute . ' ត្រូវបានប្រើប្រាស់ដោយអ្នកម្ដងរួចមកហើយ');
                    }
                },
            ],
            'desc' => 'required|max:200',
        ]);

        $group = new Group();
        $group->name = $request->input('name');
        $group->desc = $request->input('desc');
        $group->status = 1; // Assuming default status
        $group->created_by = Auth::user()->id;

        if ($group->save()) {
            // Redirect with success message and newly created group ID
            return redirect()->route('group.show')
                ->with('success', 'បង្កើតក្រុមដោយជោគជ័យ!')
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
                ->with('success', 'កែសម្រួលក្រុមបានជោកជ័យ!');
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
            return redirect()->route('group.show')->with('error', 'មិនអាចរកក្រុមឃើញ');
        }

        // Update the status to 0 instead of deleting
        $group->status = 0;
        $group->save();
        return redirect()->route('group.show')->with('successfull', 'លុបក្រុមបានជោគជ័យ!');
    }
}
