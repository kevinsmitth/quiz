<?php

use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/me', [UserController::class, 'me'])->name('me');
    Route::get('/quiz', [QuizController::class, 'index'])->name('quiz');
    Route::post('/check-answer', [QuizController::class, 'check_answer'])->name('check.answer');
    Route::get('/next-question', [QuizController::class, 'next_question'])->name('next.question');
});
