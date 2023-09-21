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

        return response()->json(['message' => 'Student added successfully'], 201);
    }
}
