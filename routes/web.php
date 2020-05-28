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

Route::get('/', function () {
    return view('welcome');
});


// For staff login
Route::post('/auth', 'authController@authenticate');

Route::get('/staff_main_page', function () {
    return view('staff_main_page');
});



// For student_management page
Route::get('/student_management', 'StudentController@index');

Route::post('/add_student', 'StudentController@store');

Route::put('/update_student', 'StudentController@update');

Route::delete('delete_student/{id}','StudentController@destroy');



// For subject_management page
Route::get('/subject_management', 'SubjectController@index');

Route::post('/add_subject', 'SubjectController@store');

Route::put('/update_subject', 'SubjectController@update');

Route::delete('delete_subject','SubjectController@destroy');



// For enrollment page
Route::get('/enrollment', 'EnrollmentController@index');

Route::post('/enroll', 'EnrollmentController@store');

Route::delete('delete_enrollee/{id}','EnrollmentController@destroy');

Route::delete('clear_enrollees','EnrollmentController@clear');