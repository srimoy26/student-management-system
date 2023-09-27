<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Course;

class AddCourse extends Command
{
    protected $signature = 'course:add {name}';
    protected $description = 'Add a new course to the courses table';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->argument('name');

        $course = new Course([
            'name' => $name,
        ]);

        $course->save();

        $this->info('Course added successfully.');
    }
}
