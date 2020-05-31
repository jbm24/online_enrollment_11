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

Route::get('/fetch_student_table', 'StudentController@fetch');

Route::post('/add_student', 'StudentController@store');

Route::put('/update_student', 'StudentController@update');

Route::delete('/delete_student','StudentController@destroy');



// For subject_management page
Route::get('/subject_management', 'SubjectController@index');

Route::get('/fetch_subject_table', 'SubjectController@fetch');

Route::post('/add_subject', 'SubjectController@store');

Route::put('/update_subject', 'SubjectController@update');

Route::delete('/delete_subject','SubjectController@destroy');

Route::delete('delete_enrollee/{studId}/{subId}','EnrollmentController@destroy');

Route::delete('clear_enrollees','EnrollmentController@clear');



// For enrollment page
Route::get('/enrollment', 'EnrollmentController@index');

Route::get('/search', 'EnrollmentController@search');

Route::post('/enroll', 'EnrollmentController@store');