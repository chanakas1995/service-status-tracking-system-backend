<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeSubjectController;
use App\Http\Controllers\EmployeeTypeController;
use App\Http\Controllers\GsOfficeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\ServiceTypeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return response()->json(["message" => "Welcome to BSE Education Management System API"], 200);
});

Route::post('auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('auth/user', [AuthController::class, 'getUser']);
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class)->only('index');
    Route::resource('employee-types', EmployeeTypeController::class)->only('index');
    Route::resource('employees', EmployeeController::class);
    Route::resource('branches', BranchController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('gs-offices', GsOfficeController::class);
    Route::resource('service-types', ServiceTypeController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('employees.employee-subjects', EmployeeSubjectController::class);
    Route::resource('service-requests', ServiceRequestController::class);
});
