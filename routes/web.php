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

    Route::resource('/students', 'App\Http\Controllers\StudentController');
    Route::resource('/lecturers', 'App\Http\Controllers\LecturerController');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/store', [App\Http\Controllers\HomeController::class, 'store'])->name('store');
    Route::get('/edit/question/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('edit');
    Route::delete('/question/delete/{id}', [App\Http\Controllers\HomeController::class, 'delete'])->name('delete');
    Route::post('/update/question/{id}', 'App\Http\Controllers\HomeController@update');

   
    Route::post('/students/{id}/exam', [App\Http\Controllers\QuestionController::class, 'questions'])->name('questions');
    Route::get('/courses', [App\Http\Controllers\QuestionController::class, 'course'])->name('course');
    Route::get('/students/{id}/result', [App\Http\Controllers\ResultController::class, 'studentResult'])->name('result');
    Route::get('/test-timeout', [App\Http\Controllers\TestController::class, 'timeOut'])->name('timeout');
    Route::resource('/results', App\Http\Controllers\ResultController::class);
    Route::post('/results/search', [App\Http\Controllers\ResultController::class, 'resultSearch'])->name('result');
    Route::get('/test-submitted', [App\Http\Controllers\TestController::class, 'submitTest'])->name('submitTest');
});
