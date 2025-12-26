<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\StudentExamController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::view('/', 'welcome');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Redirect users to different pages based on their role after login
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    // Check the user's role and redirect accordingly
    if (Auth::user()->role == 'admin') {
        return redirect()->route('exams.index');  // Redirect admin to the exam management page
    }

    // If the user is a student, redirect to their exam start page
    return redirect()->route('student_exam.start', 1);  // Redirect student to start the exam
})->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware('auth')->group(function () {
    // Routes for exam management (Admin)
    Route::resource('exams', ExamController::class);
    // Routes for student to take exams
    Route::prefix('exam/{exam}')->group(function () {
        Route::get('start', [StudentExamController::class, 'start'])->name('student_exam.start');
        Route::post('save-answer', [StudentExamController::class, 'saveAnswer'])->name('student_exam.save_answer');
        Route::post('submit', [StudentExamController::class, 'submit'])->name('student_exam.submit');
    });
    // Route for viewing results
    Route::get('results/{examResult}', [ResultController::class, 'show'])->name('results.show');
});
require __DIR__ . '/auth.php';
