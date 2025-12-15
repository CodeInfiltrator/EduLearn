<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['name', 'expertise'];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}

