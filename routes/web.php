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
    return view('application.home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
Route::get('/profile/{id?}', 'ProfileController@show')->name('profile.show');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::post('/follow', 'ProfileController@follow')->name('profile.follow');

Route::prefix('wordlist')->group(function () {
    Route::get('/', 'WordListController@index')->name('wordlist.index');
});

Route::post('courses/{course}/enroll', 'CourseController@enroll')->name('courses.enroll');
Route::post('courses/{course}/leave', 'CourseController@leave')->name('courses.leave');
Route::resource('courses', 'CourseController')->only([
    'index',
    'show',
]);

Route::get('/lessons/{lesson}/test', 'LessonController@test')->name('lessons.test');
Route::post('/lessons/{lesson}/test', 'LessonController@handleTest')->name('lessons.submit');
Route::get('/lessons/{lesson}/result', 'LessonController@result')->name('lessons.result');
Route::resource('lessons', 'LessonController')->only([
    'show',
]);
