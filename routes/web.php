<?php

use App\Http\Controllers\QuestionController;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Support\Facades\Route;


Route::get('/', [QuestionController::class, 'index'])->name('questions.index');

Route::get('/question/{question:slug}', [QuestionController::class, 'show'])->name('questions.show');
