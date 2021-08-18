<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GiaoPhanController;
use App\Http\Controllers\GiaoHatController;
use App\Http\Controllers\GiaoXuController;
use App\Http\Controllers\GiaoHoController;
use App\Http\Controllers\GiaoTinhController;
use App\Http\Controllers\TenThanhController;
use App\Http\Controllers\ChucVuController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware'=>'auth'],function()
{
    Route::get('home',function()
    {
        return view('home');
    });
    Route::get('home',function()
    {
        return view('home');
    });
});

Auth::routes();
// ----------------------------- main dashboard ------------------------------//
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// import and export excel
Route::post('file-import', [GiaoPhanController::class, 'fileImport'])->name('GP-file-import');
Route::get('file-export', [GiaoPhanController::class, 'fileExport'])->name('GP-file-export');

Route::resources([
    'giao-tinh' => GiaoTinhController::class,
    'giao-phan' => GiaoPhanController::class,
    'giao-hat' => GiaoHatController::class,
    'giao-xu' => GiaoXuController::class,
    'giao-ho' => GiaoHoController::class,
    'ten-thanh' => TenThanhController::class,
    'chuc-vu' => ChucVuController::class
]);





// ----------------------------- dashboard all ------------------------------//
Route::get('student_dashboard', [App\Http\Controllers\Dashboard\MainDashboardController::class, 'student'])->name('student_dashboard');
Route::get('teacher_dashboard', [App\Http\Controllers\Dashboard\MainDashboardController::class, 'teacher'])->name('teacher_dashboard');
Route::get('parent_dashboard', [App\Http\Controllers\Dashboard\MainDashboardController::class, 'parent'])->name('parent_dashboard');


// -----------------------------login----------------------------------------//
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'authenticate']);
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// ----------------------------- lock screen --------------------------------//
Route::get('lock_screen', [App\Http\Controllers\LockScreen::class, 'lockScreen'])->middleware('auth')->name('lock_screen');
Route::post('unlock', [App\Http\Controllers\LockScreen::class, 'unlock'])->name('unlock');

// ------------------------------ register ---------------------------------//
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'storeUser'])->name('register');

// ----------------------------- forget password ----------------------------//
Route::get('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'getEmail'])->name('forget-password');
Route::post('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'postEmail'])->name('forget-password');

// ----------------------------- reset password -----------------------------//
Route::get('reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'getPassword']);
Route::post('reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'updatePassword']);

// ----------------------------- user profile ------------------------------//
Route::get('profile_user', [App\Http\Controllers\UserManagementController::class, 'profile'])->name('profile_user');
Route::post('profile_user/store', [App\Http\Controllers\UserManagementController::class, 'profileStore'])->name('profile_user/store');

Route::get('activity/log', [App\Http\Controllers\UserManagementController::class, 'activityLog'])->middleware('auth')->name('activity/log');
Route::get('activity/login/logout', [App\Http\Controllers\UserManagementController::class, 'activityLogInLogOut'])->middleware('auth')->name('activity/login/logout');

// ----------------------------- form change password ------------------------------//
Route::get('change/password', [App\Http\Controllers\UserManagementController::class, 'changePasswordView'])->middleware('auth')->name('change/password');
Route::post('change/password/db', [App\Http\Controllers\UserManagementController::class, 'changePasswordDB'])->name('change/password/db');

// ----------------------------- student ------------------------------//
Route::get('all/student/list',[App\Http\Controllers\StudentController::class,'list'])->name('all/student/list');
Route::get('add/student/new',[App\Http\Controllers\StudentController::class,'formAdd'])->name('add/student/new');
Route::post('add/student/save',[App\Http\Controllers\StudentController::class,'formSave'])->name('add/student/save');
Route::get('student/about',[App\Http\Controllers\StudentController::class,'aboutStudent'])->name('student/about');
Route::get('student/edit/{id}',[App\Http\Controllers\StudentController::class,'studentEdit'])->name('student/edit');
Route::post('student/update',[App\Http\Controllers\StudentController::class,'studentUpdate'])->name('student/update');


