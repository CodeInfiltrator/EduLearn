<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Category::create([
            'name' => 'Web Development',
            'description' => 'Materi tentang membuat website'
        ]);

        \App\Models\Category::create([
            'name' => 'Data Science',
            'description' => 'Pembelajaran data dan machine learning'
        ]);
    }
}
