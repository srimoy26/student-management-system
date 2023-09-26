<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required',
            'courses' => 'required|array',
        ]);

        $student = new Student([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'courses' => json_encode($validatedData['courses']),
        ]);

        $student->save();

        return response()->json([
            'code' => 200,
            'data' => [
                'id' => $student->id,
                'name' => $student->first_name . ' ' . $student->last_name,
            ],
            'message' => 'Student created successfully'
        ]);
    }

    public function index()
    {
        $students = Student::all();
        return response()->json([
            'code' => 200,
            'data' => $students,
            'message' => 'Students retrieved successfully'
        ]);
    }

    public function paginateIndex()
    {
        $students = Student::paginate(10); 
        return response()->json([
            'code' => 200,
            'data' => $students,
            'message' => 'Students retrieved successfully'
        ]);
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return response()->json([
            'code' => 200,
            'data' => $student,
            'message' => 'Student retrieved successfully'
        ]);
    }

    public function update(Request $request, $id)
{
    try {
        $student = Student::findOrFail($id);

        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'required',
            'courses' => 'required|array',
        ]);

        $student->update([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'courses' => json_encode($validatedData['courses']),
        ]);

        return response()->json(['message' => 'Student updated successfully']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'An error occurred during the update.'], 500);
    }
}


    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return response()->json([
            'code' => 200,
            'data' => [],
            'message' => 'Student deleted successfully'
        ]);
    }
}
