<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssignExam;
use App\Models\Group;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;

class AssignExamController extends Controller
{
    public function assignGroup(Request $request, $examId)
    {
        $request->validate([
            'group_id' => 'required|exists:group,id',
        ]);

        $assignExam = new AssignExam();
        $assignExam->exam_id = $examId;
        $assignExam->group_id = $request->group_id;
        $assignExam->is_assigned = true;
        $assignExam->user_id = Auth::id();
        $assignExam->save();

        return redirect()->route('exam.show')->with('success', 'Group assigned successfully.');
    }
    public function unassignGroup($examId, $groupId)
    {
        AssignExam::where('exam_id', $examId)
            ->where('group_id', $groupId)
            ->where('is_assigned', true)
            ->delete();

        return redirect()->back()->with('success', 'Group unassigned successfully.');
    }
}
