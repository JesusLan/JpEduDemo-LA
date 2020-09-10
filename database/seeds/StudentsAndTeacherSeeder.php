<?php

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class StudentsAndTeacherSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Student::query()->truncate();
        Student::create([
            "name" => "student1",
            "email" => "student1@gmail.com",
            'password' => bcrypt('student1'),
        ]);
        Student::create([
            "name" => "student2",
            "email" => "student2@gmail.com",
            'password' => bcrypt('student2'),
        ]);
        Student::create([
            "name" => "student3",
            "email" => "student3@gmail.com",
            'password' => bcrypt('student3'),
        ]);
        Student::create([
            "name" => "student4",
            "email" => "student4@gmail.com",
            'password' => bcrypt('student4'),
        ]);
        Student::create([
            "name" => "student5",
            "email" => "student5@gmail.com",
            'password' => bcrypt('student5'),
        ]);

        Teacher::query()->truncate();
        Teacher::create([
            "name" => "teacher1",
            "email" => "teacher1@gmail.com",
            'password' => bcrypt('teacher1'),
        ]);
        Teacher::create([
            "name" => "teacher2",
            "email" => "teacher2@gmail.com",
            'password' => bcrypt('teacher2'),
        ]);
        Teacher::create([
            "name" => "teacher3",
            "email" => "teacher3@gmail.com",
            'password' => bcrypt('teacher3'),
        ]);
        Teacher::create([
            "name" => "teacher4",
            "email" => "teacher4@gmail.com",
            'password' => bcrypt('teacher4'),
        ]);
        Teacher::create([
            "name" => "teacher5",
            "email" => "teacher5@gmail.com",
            'password' => bcrypt('teacher5'),
        ]);
    }
}
