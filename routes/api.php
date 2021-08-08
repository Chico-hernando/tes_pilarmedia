<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users','User\UserController@getUser');
Route::post('users','User\UserController@createUser');
Route::put('users/{id}','User\UserController@updateUser');
Route::delete('users/{id}','User\UserController@deleteUser');

Route::get('users/{id}/attendance','Attendance\AttendanceController@getAttendanceById');
Route::post('users/{id}/attendance/in','Attendance\AttendanceController@createAttendance');
Route::post('users/{id}/attendance/out','Attendance\AttendanceController@outAttendance');
Route::post('users/{id}/attendance/permission','Attendance\AttendanceController@createPermission');
Route::get('attendance','Attendance\AttendanceController@getAttendanceAll');
Route::put('attendance','Attendance\AttendanceController@updateAttendance');
