<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

class StudentController extends Controller
{
    // view list all students
    public function list()
    {
        return view('student.student_all');
    }
    // student add 
    public function formAdd()
    {
        return view('student.student_add');
    }
    // student save
    public function formSave(Request $request)
    {
        $request->validate([
            'firstName'          => 'required|string|max:255',
            'lastName'            => 'required|string|max:255',
            'email'               => 'required|string|email',
            'registrationDate'    => 'required|date',
            'rollNo'              => 'required|string|max:255',
            'class'               => 'required|string|max:255',
            'gender'              => 'required|string|max:255',
            'mobileNumber'        => 'required|min:11|numeric',
            'parentsName'         => 'required|string|max:255',
            'parentsMobileNumber' => 'required|min:11|numeric',
            'dateOfBirth'         => 'required|date',
            'bloodGroup'          => 'required|string|max:255',
            'address'             => 'required|string|max:255',
            'upload'              => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb
        ]);
        
        $image = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images'), $image);

        $user = new Student;
        $user->name         = $request->name;
        $user->avatar       = $image;
        $user->email        = $request->email;
        $user->phone_number = $request->phone;
        $user->role_name    = $request->role_name;
      
        $user->save();
       
        Toastr::success('Insert data has been successfully :)','Success');
        return redirect()->back();
    }
}
