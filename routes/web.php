<?php

use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


// Route::get('/home', 'Homecontroller@index');
Route::get('/show', 'AdminController@show')->name('admin.show');
Route::get('/subject', 'SubjectController@index')->name('admin.subject');
Route::post('/subject/store', 'SubjectController@store')->name('subject.store');
Route::post('/subject/update/{id}', 'SubjectController@update')->name('subject.update');
Route::post('/subject/delete/{id}', 'SubjectController@destroy')->name('subject.delete');


Route::resource('employees', 'EmployeeController');

// Route::get('employee/exam/{id}', 'EmployeeController@view')->name('employees.exam.view')->middleware('role:employee');

Route::get('employee/{id}', 'EmployeeController@exam')->name('employees.exam')->middleware('role:employee');
Route::get('employee/check/{exam_id}/{question_id}', 'EmployeeController@check')->name('employees.check')->middleware('role:employee');

Route::resource('exams', 'ExamController');
Route::get('/invite/{id}', 'ExamController@invite')->name('exams.invite');

// Route::resource('employees', 'EmployeeController');

