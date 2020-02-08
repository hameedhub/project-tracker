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

Route::get('/foo', function () {
    Artisan::call('storage:link');
});

Route::get('/', function () {
    return redirect('/dashboard');
});

// Route::get('/facilitator/dashboard/{id}', 'Facilitator\DashboardController@index');

Auth::routes();
Route::get('/download/{file}', 'DownloadsController@download');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/dashboard', 'DashboardController@index');
Route::get('/profile', 'DashboardController@profile');
Route::match(['put', 'patch'], '/update/{id}', 'DashboardController@update');
Route::resource('admin/grades', 'Admin\GradesController');
Route::resource('admin/courses', 'Admin\CoursesController');
Route::resource('admin/users', 'Admin\UsersController');
Route::get('admin/users/{id}/{status}',[
    'as' => 'change', 'uses' =>  'Admin\UsersController@change']);
Route::resource('admin/set', 'Admin\SetController');
Route::resource('facilitator/evaluation', 'Facilitator\AssessmentsController');
Route::resource('facilitator/submitted', 'Facilitator\ReportsController');
Route::resource('facilitator/course', 'Facilitator\CourseController');
Route::resource('facilitator/material', 'Facilitator\MaterialController');
Route::resource('student/registration', 'Student\RegCourseController');
Route::resource('student/submission', 'Student\SubmissionController');
Route::resource('student/assessment', 'Student\AssessmentController');