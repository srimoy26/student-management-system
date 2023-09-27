<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;

class AddStudent extends Command
{
    protected $signature = 'student:add {first_name} {last_name} {email} {phone}';
    protected $description = 'Add a new student to the student table';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $firstName = $this->argument('first_name');
        $lastName = $this->argument('last_name');
        $email = $this->argument('email');
        $phone = $this->argument('phone');

        if (Student::where('email', $email)->exists()) {
            $this->error('Student with this email already exists.');
            return;
        }

        $student = new Student([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'phone' => $phone,
        ]);

        $student->save();

        $this->info('Student added successfully.');
    }
}
