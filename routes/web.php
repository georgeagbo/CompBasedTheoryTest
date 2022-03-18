<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;

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

Route::group(['excluded_middleware' => ['csrf']], function () {
    Route::post('/store/answer', 'App\Http\Controllers\SubmissionController@store');
});



Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/store', [App\Http\Controllers\HomeController::class, 'store'])->name('store');
    Route::get('/edit/question/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('edit');
    Route::delete('/question/delete/{id}', [App\Http\Controllers\HomeController::class, 'delete'])->name('delete');
    Route::post('/update/question/{id}', 'App\Http\Controllers\HomeController@update');
    Route::get('/lecturers', [App\Http\Controllers\HomeController::class, 'createLecturerForm'])->name('createLecturerForm');
    Route::post('/lecturers', [App\Http\Controllers\HomeController::class, 'createLecturer'])->name('createLecturer');
    Route::get('/students', [App\Http\Controllers\HomeController::class, 'createStudentForm'])->name('createStudentForm');
    Route::post('/students', [App\Http\Controllers\HomeController::class, 'createStudent'])->name('createStudent');
    Route::get('/students/{id}/test', [App\Http\Controllers\QuestionController::class, 'index'])->name('index');
    Route::get('/students/{id}/result', [App\Http\Controllers\ResultController::class, 'studentResult'])->name('result');
    Route::get('/test-timeout', [App\Http\Controllers\TestController::class, 'timeOut'])->name('timeout');
    Route::resource('/results', App\Http\Controllers\ResultController::class);
    Route::post('/results/search', [App\Http\Controllers\ResultController::class, 'resultSearch'])->name('result');
    Route::get('/test-submitted', [App\Http\Controllers\TestController::class, 'submitTest'])->name('submitTest');

});
