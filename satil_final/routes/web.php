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

Auth::routes();




Route::get('admin/home','AdminController@index');

Route::get('admin/login','Admin\LoginController@showLoginForm')->name('admin.login');
Route::POST('admin/login','Admin\LoginController@login');
Route::post('admin-password/email','Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin-password/reset','Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin-password/reset','Admin\ResetPasswordController@reset')->name('admin.password.request');
Route::get('admin-password/reset/{token}','Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');


Route::get('test','TestController@homepage');

Route::group(array('prefix' =>'/admin'),function() {
    Route::group(['middleware' => ['auth:admin']], function () {

//Section Route
        Route::get('/section', 'SectionController@test');
        Route::post('/section/save','SectionController@saveData');
        Route::get('/section/edit/{id}','SectionController@Edit');
        Route::post('/section/update','SectionController@update');
        Route::post('/section/delete','SectionController@destroy');

        Route::get('/section/teacher','SectionController@teacher');
        Route::get('/section/student','SectionController@student');

        //section student
        Route::POST('/add/section/student','SectionController@addStudentOnSection');
        Route::get('/sectionStudent/edit/{id}','SectionController@EditStudentOnSection');
        Route::POST('/sectionStudent/update','SectionController@UpdateStudentOnSection');
        Route::get('/sectionStudent/delete/{id}','SectionController@deleteStudentOnSection');

        //section teacher
        Route::POST('add/sectionTeacher','SectionController@addTeacherOnSection');
        Route::get('/sectionTeacher/edit/{id}','SectionController@EditTeacherOnSection');
        Route::POST('/sectionTeacher/update','SectionController@UpdateTeacherOnSection');
        Route::get('/sectionTeacher/delete/{id}','SectionController@deleteTeacherOnSection');


        Route::POST('/section/sectionStudent/type','SectionController@student');

        //Subject Route
        Route::get('/subject','Admin\SubjectController@test');
        Route::get('/subjectEdit/{id}','Admin\SubjectController@edit');
        Route::get('/subjectDelete/{id}','Admin\SubjectController@delete');
        Route::post('/subject/save','Admin\SubjectController@saveData');
        Route::post('/subject/update','Admin\SubjectController@UpdateData');

    });
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/SubjectNameTeacher','HomeController@SubjectNameTeacher');
    Route::get('/SubjectNameStudent','HomeController@SubjectNameStudent');
    Route::POST('/teacher/takeAttendance/','HomeController@test');
    Route::get('/teacher/takeAttendance/','HomeController@getMethodOfTest');
    Route::POST('/takeAttendance/','HomeController@takeAttendance');
    Route::POST('/student/giveAttendance','HomeController@MatchToSectionAndSecret');
    Route::POST('/GiveAttendance','HomeController@StudentGiveAttendence');
});

Route::get('/datatesting','HomeController@datatesting');
