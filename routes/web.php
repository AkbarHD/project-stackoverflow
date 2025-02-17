<?php

use App\Http\Controllers\QuestionController;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Support\Facades\Route;


Route::get('/', [QuestionController::class, 'index'])->name('questions.index');

Route::get('/questions/{question:slug}', [QuestionController::class, 'show'])->name('questions.show');
Route::resource('/questions', QuestionController::class)->except('show', 'index')->middleware('auth');
