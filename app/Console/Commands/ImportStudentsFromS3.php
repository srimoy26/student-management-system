<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Student;

class ImportStudentsFromS3 extends Command
{
    protected $signature = 'import:students-from-s3';
    protected $description = 'Import student data from S3 bucket';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $s3Bucket = 'studentdata-benesse';
        $s3Path = 's3://studentdata-benesse/generated.json';


        $studentData = Storage::disk('s3')->get($s3Path);
       
        if (empty($studentData)) {
            $this->error('Error: Student data is empty.');
            return Command::FAILURE;
        }

        $students = json_decode($studentData, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error('Error: Invalid JSON data format.');
            $this->error(json_last_error_msg());
            return Command::FAILURE;
        }

        
        foreach ($students as $student) {
            $newStudent = new Student();
            
            $newStudent->first_name = $student['first_name'];
            $newStudent->last_name = $student['last_name'];
            $newStudent->email = $student['email'];
            $newStudent->phone = $student['phone'];

            $newStudent->save();
        }

        $this->info('Student data imported successfully!');
        return Command::SUCCESS;
    }
}
