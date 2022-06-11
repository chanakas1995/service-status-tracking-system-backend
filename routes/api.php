<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeTypeController;
use App\Http\Controllers\RoleController;
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
});
