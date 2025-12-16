<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class MentorController extends Controller
{
    public function index()
    {
        $mentors = Teacher::all();

        return response()->json([
            'message' => 'Successfully retrieved mentors data',
            'data' => $mentors,
        ]);
    }

    public function assignStudent(Request $request, $id)
    {
        $request->validate(['student_uuid' => 'required|exists:students,uuid']);
        $student = Student::findOrFail($request->student_uuid);
        // pastikan $id adalah teacher id
        $teacher = Teacher::findOrFail($id);
        $student->mentor_id = $teacher->id;
        $student->save();

        Activity::create([
            'date' => now(),
            'activity' => 'Student assigned to mentor',
            'student_uuid' => $student->id,
            'mentor_id' => $teacher->id,
        ]);

        return response()->json(['message' => 'Student assigned successfully']);
    }
}
