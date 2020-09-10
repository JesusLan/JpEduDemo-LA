<?php

use Illuminate\Http\Request;

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

Route::namespace('Home')->group(function () {
    Route::get("student", "StudentController@index");
    Route::get("teacher", "TeacherController@index");
    Route::post("student-register", "StudentController@register");
    Route::post("teacher-register", "TeacherController@register");

    //学生路由
    Route::middleware("multiauth:student")->group(function () {
        Route::post("teacher-subscribe/{teacherId}", "TeacherSubscribeController@subscribe");
        Route::delete("teacher-unsubscribe/{teacherId}", "TeacherSubscribeController@unsubscribe");
        Route::get("subscribe-teachers", "TeacherSubscribeController@teachers");
        Route::get("student-me", "StudentController@me");
        Route::patch("student-bind-email", "StudentController@bindEmail");
        Route::patch("student-bind-line", "StudentController@bindLine");
    });

    //教师路由
    Route::middleware("multiauth:teacher")->group(function () {
        Route::get("teacher-subscribe-students", "TeacherSubscribeController@students");
        Route::get("teacher-me", "TeacherController@me");
        Route::patch("teacher-bind-email", "TeacherController@bindEmail");
        Route::patch("teacher-bind-line", "TeacherController@bindLine");
    });
});
