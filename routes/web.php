<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeacherController;
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

Route::get('/', [SampleController::class, 'home']);

Route::get('/about/{name}/{email}', [SampleController::class, 'about']);

Route::get('/service', [SampleController::class, 'service']);

Route::get('/create-employee', [EmployeeController::class, 'create']);
Route::post('/store-employee', [EmployeeController::class, 'store']);
Route::get('/employees', [EmployeeController::class, 'all']);
Route::get('/edit-employee/{id}', [EmployeeController::class, 'edit']);
Route::post('update-employee/{id}', [EmployeeController::class, 'update']);
Route::get('/delete-employee/{id}', [EmployeeController::class, 'delete']);

Route::get('admin/dashboard', [LayoutController::class, 'dashboard']);

Route::get('admin/form-elements', [LayoutController::class, 'formElements']);


Route::get('home', [LayoutController::class, 'home']);

Route::get('about-us', [LayoutController::class, 'about']);

Route::get('admin/login', [AuthController::class, 'login']);
Route::post('admin/login-user',[AuthController::class, 'loginUser']);
Route::get('admin/register', [AuthController::class, 'register']);
Route::post('admin/store-user',[AuthController::class, 'storeUser']);


Route::middleware(['checkLogin'])->group(function () {
    Route::get('admin/users',[UserController::class, 'allUsers']);
    Route::get('admin/approve/{userId}', [UserController::class, 'approve']);
    
    Route::middleware(['IsTeacher'])->group(function(){
        Route::get('admin/give-marks', function(){
            return 'Input marks as teacher';
        });
    });

    Route::middleware(['IsStudent'])->group(function(){
        Route::get('admin/my-marks', function(){
            return 'Viewing marks as student';
        });
    });

    Route::get('logout', [AuthController::class, 'logout']);
    
});

Route::get('create-teacher', [TeacherController::class, 'createTeacher']);
Route::get('/', [EmployeeController::class, 'showEmployees']);

Route::get('/employee/pdf', [EmployeeController::class, 'createPDF']);