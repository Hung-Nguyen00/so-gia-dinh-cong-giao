<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Carbon\Carbon;
use DB;

class StudentController extends Controller
{
    // view list all students
    public function list()
    {
        return view('student.student_all');
    }

    //
    public function aboutStudent()
    {
        return view('student.student_about');
    }
    // student add 
    public function formAdd()
    {
        return view('student.student_add');
    }
    // student save
    public function formSave(Request $request)
    {
        return redirect()->back();
    }
    // student update to db
    public function studentUpdate( Request $request)
    {
        Toastr::success('Data updated successfully :)','Success');
        return redirect()->route('all/student/list');
    }
}
