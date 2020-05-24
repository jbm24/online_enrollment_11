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

Route::post('/auth', 'authController@authenticate');



Route::get('/student_management', 'StudentController@index');

Route::get('/edit/{id}', 'StudentController@edit');

Route::post('/add_student', 'StudentController@store');

Route::put('/update_student/{id}', 'StudentController@update');

Route::delete('delete/{id}','StudentController@destroy');



Route::get('/staff_main_page', function () {
    return view('staff_main_page');
});



Route::get('/subject_management', 'SubjectController@index');