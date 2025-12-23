<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['title', 'description', 'category_id', 'teacher_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function students()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
        return $this->belongsToMany(User::class, 'enrollments')
                ->withTimestamps();
    }
    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('order');
    }
}

