<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    // view list all students
    public function list()
    {
        return view('student.student_all');
    }
}
