<?php

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;

class CourseEnrollmentController extends Controller
{
    public function enrollStudent(Request $request, $studentId, $courseId)
    {
        $student = Student::findOrFail($studentId);
        $course = Course::findOrFail($courseId);

       
        $student->courses()->attach($course);

        return response()->json(['message' => 'Student enrolled in the course']);
    }

    public function unenrollStudent(Request $request, $studentId, $courseId)
    {
        $student = Student::findOrFail($studentId);
        $course = Course::findOrFail($courseId);

        
        $student->courses()->detach($course);

        return response()->json(['message' => 'Student unenrolled from the course']);
    }
}

