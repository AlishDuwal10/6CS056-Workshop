<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    // Fields allowed for mass assignment, e.g. Student::create($validated)
    protected $fillable = ['name', 'email', 'phone', 'address', 'date_of_birth'];
}