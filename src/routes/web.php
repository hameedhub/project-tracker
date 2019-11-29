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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/facilitator/dashboard/{id}', 'Facilitator\DashboardController@index');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
Route::get('/profile', 'DashboardController@profile');
Route::resource('admin/grades', 'Admin\GradesController');
Route::resource('admin/courses', 'Admin\CoursesController');
Route::resource('admin/users', 'Admin\UsersController');
Route::resource('facilitator/evaluation', 'Facilitator\AssessmentsController');
Route::resource('facilitator/submitted', 'Facilitator\ReportsController');
Route::resource('facilitator/course', 'Facilitator\CourseController');
Route::resource('student/registration', 'Student\RegCourseController');
Route::resource('student/submission', 'Student\SubmissionController');
Route::resource('student/assessment', 'Student\AssessmentController');