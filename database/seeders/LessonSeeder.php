<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lesson;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run()
    {
        Lesson::create([
            'course_id' => 1,
            'title' => 'Introduction',
            'content' => 'Welcome to the course',
            'order' => 1
        ]);

        Lesson::create([
            'course_id' => 1,
            'title' => 'Next Step',
            'content' => 'Deep dive lesson',
            'order' => 2
        ]);
    }
}
