<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Teacher::create([
            'name' => 'John Doe',
            'expertise' => 'Web Development'
        ]);

        \App\Models\Teacher::create([
            'name' => 'Sarah Watson',
            'expertise' => 'Data Analysis'
        ]);
    }
}
