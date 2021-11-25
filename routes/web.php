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

Route::get('/', [App\Http\Controllers\QuestionController::class, 'index'])->name('question');

Route::group(['excluded_middleware' => ['csrf']], function () {
    Route::post('/store/answer', 'App\Http\Controllers\SubmissionController@store');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/store', [App\Http\Controllers\HomeController::class, 'store'])->name('store');
Route::get('/edit/question/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('edit');
Route::delete('/question/delete/{id}', [App\Http\Controllers\HomeController::class, 'delete'])->name('delete');
Route::post('/update/question/{id}', 'App\Http\Controllers\HomeController@update');
