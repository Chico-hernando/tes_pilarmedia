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

Route::get('searchToken','Api\User\UserController@getToken');
Route::post('login','Api\User\UserController@login');
Route::get('users','Api\User\UserController@getUser');
Route::post('users','Api\User\UserController@createUser');
Route::put('users/{id}','Api\User\UserController@updateUser');
Route::delete('users/{id}','Api\User\UserController@deleteUser');

Route::get('users/{id}/attendance','Api\Attendance\AttendanceController@getAttendanceById');
Route::post('users/{id}/attendance/in','Api\Attendance\AttendanceController@createAttendance');
Route::post('users/{id}/attendance/out','Api\Attendance\AttendanceController@outAttendance');
Route::post('users/{id}/attendance/permission','Api\Attendance\AttendanceController@createPermission');
Route::get('attendance','Api\Attendance\AttendanceController@getAttendanceAll');
Route::put('attendance','Api\Attendance\AttendanceController@updateAttendance');
