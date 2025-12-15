<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Course::create([
            'title' => 'Belajar HTML',
            'description' => 'Kursus dasar HTML',
            'category_id' => 1,
            'teacher_id' => 1,
        ]);

        \App\Models\Course::create([
            'title' => 'Intro to Machine Learning',
            'description' => 'Pembelajaran dasar ML',
            'category_id' => 2,
            'teacher_id' => 2,
        ]);
    }
}
