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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');

// Route::get('/home', 'Homecontroller@index');
Route::get('/show', 'AdminController@show')->name('admin.show');
Route::get('/subjects', 'SubjectController@index')->name('admin.subject');
Route::get('/view-subject/{id}', 'SubjectController@show')->name('admin.view-subject');
Route::post('/subject/store', 'SubjectController@store')->name('subject.store');
Route::post('/subject/update/{id}', 'SubjectController@update')->name('subject.update');
Route::post('/subject/delete/{id}', 'SubjectController@destroy')->name('subject.delete');

Route::resource('employees', 'EmployeeController');
Route::get('employee/previous-record', 'EmployeeController@previous_record')->name('employees.previous-record');
Route::get('employee/previous-exam-record/{exam_id}', 'EmployeeController@previous_exam_result')->name('employees.previous-exam-record');

// Route::get('employee/exam/{id}', 'EmployeeController@view')->name('employees.exam.view')->middleware('role:employee');

Route::get('employee/{id}', 'EmployeeController@exam')->name('employees.exam')->middleware('role:employee');
Route::get('employee/check/{exam_id}/{question_id}', 'EmployeeController@check')->name('employees.check')->middleware('role:employee');
Route::post('questions/update_time/{exam_id}/{question_id}', 'QuestionController@update_time')->name('question.update_time');

Route::resource('exams', 'ExamController');
Route::get('exam/subjective', 'ExamController@subjective')->name('exams.subjective');
Route::get('exam/result/{user_id}/{exam_id}', 'ExamController@result_view')->name('result.view');
Route::get('exam/question/{id}', 'ExamController@delete_question');
Route::get('/invite/{id}', 'ExamController@invite')->name('exams.invite');

// Route::resource('employees', 'EmployeeController');
Route::resource('questions', 'QuestionController');
Route::post('questions/{id}', 'QuestionController@save')->name('question.save');

