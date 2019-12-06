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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/facilitator/dashboard/{id}', 'Facilitator\DashboardController@index');

Auth::routes();
Route::get('/download/material/{file}', 'DownloadsController@material');
Route::get('/download/assessment/{file}', 'DownloadsController@assessment');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/dashboard', 'DashboardController@index');
Route::get('/profile', 'DashboardController@profile');
Route::match(['put', 'patch'], '/update/{id}', 'DashboardController@update');
Route::resource('admin/grades', 'Admin\GradesController')->middleware('admin');
Route::resource('admin/courses', 'Admin\CoursesController')->middleware('admin');
Route::resource('admin/users', 'Admin\UsersController')->middleware('admin');
Route::resource('admin/resource', 'Admin\MaterialController')->middleware('admin');
Route::get('admin/users/{id}/{status}',[
    'as' => 'change', 'uses' =>  'Admin\UsersController@change']);
Route::resource('admin/set', 'Admin\SetController')->middleware('admin');
Route::resource('facilitator/evaluation', 'Facilitator\AssessmentsController')->middleware('facilitator');
Route::resource('facilitator/submitted', 'Facilitator\ReportsController')->middleware('facilitator');
Route::resource('facilitator/course', 'Facilitator\CourseController')->middleware('facilitator');
Route::resource('facilitator/material', 'Facilitator\MaterialController')->middleware('facilitator');
Route::resource('student/registration', 'Student\RegCourseController')->middleware('student');
Route::resource('student/submission', 'Student\SubmissionController')->middleware('student');
Route::resource('student/assessment', 'Student\AssessmentController')->middleware('student');
Route::resource('student/materials', 'Student\MaterialController')->middleware('student');