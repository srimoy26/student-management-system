<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;
use App\Models\Course;

class EnrollStudentInCourse extends Command
{
    protected $signature = 'enroll:student {student_id : The ID of the student} {course_id : The ID of the course}';
    protected $description = 'Enroll a student in a course';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $studentId = $this->argument('student_id');
        $courseId = $this->argument('course_id');

        $student = Student::find($studentId);
        $course = Course::find($courseId);

        if (!$student || !$course) {
            $this->error('Student or course not found.');
            return;
        }

        if ($student->courses->contains($courseId)) {
            $this->info('Student is already enrolled in the course.');
            return;
        }

       
        $student->courses()->attach($courseId);

        $this->info('Student enrolled in the course successfully.');
    }
}
