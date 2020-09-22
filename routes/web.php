<?php

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

Route::namespace('Home')->group(function () {
    Route::get("line-redirect-to-provider/{authProvider}", "LineController@redirectToProvider");
    Route::get("line-callback-students", "LineController@studentLoginCallback");
    Route::get("line-callback-teachers", "LineController@teacherLoginCallback");
    Route::get("line-callback-teacher-bind", "LineController@teacherBindCallback");
    Route::get("line-callback-student-bind", "LineController@studentBindCallback");
});
