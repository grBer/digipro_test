<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

/* Route::get('/', function () {
    return view('form');
});
 */

Route::get('/', [FormController::class, 'showForm'])->name('form.show');
Route::post('/', [FormController::class, 'submitForm'])->name('form.submit');
Route::get('/questions', [FormController::class, 'showQuestions'])->name('questions.show');
Route::post('/questions/next', [FormController::class, 'nextQuestion'])->name('questions.next');