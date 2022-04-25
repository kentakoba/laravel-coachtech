<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();


// Route::get('/register', [App\Http\Controllers\AuthController::class, 'getRegister'])->name('');

// Route::get('/', [App\Http\Controllers\HomeController::class, 'getIndex'])->name('');

// Route::get('/home', [App\Http\Controllers\AttendanceController::class, 'getIndex'])->name('');
Route::get('/', [App\Http\Controllers\AttendanceController::class, 'getIndex'])->name('');
Route::get('/attendance/start', [App\Http\Controllers\AttendanceController::class, 'startAttendance'])->name('attendancestart');
Route::get('/attendance/end', [App\Http\Controllers\AttendanceController::class, 'endAttendance'])->name('attendanceend');
Route::get('/break/end', [App\Http\Controllers\RestController::class, 'endRest'])->name('endrest');
Route::get('/break/start', [App\Http\Controllers\RestController::class, 'startRest'])->name('startrest');


Route::get('/attendance/a', [App\Http\Controllers\AttendanceController::class, 'getAttendance'])->name('getattendance');

Route::post('/attendance/a', [App\Http\Controllers\AttendanceController::class, 'changeDate'])->name('changedate');
