<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Inertia('Questions/Index', [
        'questions' => [
            ['id' => 1, 'title' => 'Question 1'],
            ['id' => 2, 'title' => 'Question 2'],
        ]
    ]);
})->name('questions.index');

Route::get('/question/{id}', function ($id) {
    return Inertia('Questions/Show', [
        'question' => [
            'id' => $id,
            'title' => 'Question ' . $id
        ]
    ]);
})->name('questions.show');
