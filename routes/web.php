<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\StudentExamController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;

// Default route for the home page
Route::view('/', 'welcome')->name('welcome');

// Redirect users to different pages based on their role after login
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    if (auth()->user()->role == 'admin') {
        return redirect()->route('exams.index');
    }

    // if (auth()->user()->role == 'teacher') {
    //     return redirect()->route('teacher.dashboard');
    // }

    // return redirect()->route('student.dashboard');
    // For now, redirect Teacher and Student to the welcome screen
    $role = auth()->user()->role;
    $message = match ($role) {
        'teacher' => 'Welcome to the system, dear teacher.',
        'student' => 'Welcome to the system, dear student.',
        default => 'Welcome to the system!'
    };

    return redirect()->route('welcome')->with('message', $message);
})->name('dashboard');

// Route for profile, accessible by all authenticated users
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Admin routes: These routes are only accessible to admins
Route::middleware(['auth', 'admin'])->group(function () {
    // Routes for exam management, result viewing, subject management, etc.
    Route::resource('exams', ExamController::class);
    // Route for creating subjects
    Route::post('/subjects', [SubjectController::class, 'store'])->name('subjects.store');

});

// Teacher routes: These routes are only accessible to teachers
Route::middleware(['auth', 'teacher'])->group(function () {
    // Routes for teachers (checking student exams, viewing results, etc.)
    Route::get('check-student-exams', [ExamController::class, 'checkStudentExams']);

    // Add more routes for teacher functionality as needed
});

// Student routes: These routes are only accessible to students
Route::middleware(['auth', 'student'])->group(function () {
    // Routes for students to take exams
    Route::get('start-exam/{exam}', [StudentExamController::class, 'start']);

    // Add more routes for student functionality as needed
});

// Routes for viewing exam results (only accessible to Admin, Teacher, and Student)
Route::middleware(['auth'])->group(function () {
    Route::get('results/{examResult}', [ResultController::class, 'show'])->name('results.show');
});

// Admin routes for managing teachers
Route::middleware(['auth', 'admin'])->group(function () {
    // Show all teachers
    Route::get('/admin/teachers', [TeacherController::class, 'index'])->name('admin.teachers.index');

    // Show form to create a new teacher
    Route::get('/admin/teachers/create', [TeacherController::class, 'create'])->name('admin.teachers.create');

    // Store a new teacher
    Route::post('/admin/teachers', [TeacherController::class, 'store'])->name('admin.teachers.store');

    // Show form to edit a teacher
    Route::get('/admin/teachers/{teacher}/edit', [TeacherController::class, 'edit'])->name('admin.teachers.edit');

    // Update teacher details
    Route::put('/admin/teachers/{teacher}', [TeacherController::class, 'update'])->name('admin.teachers.update');

    // Delete teacher
    Route::delete('/admin/teachers/{teacher}', [TeacherController::class, 'destroy'])->name('admin.teachers.destroy');
});

// Make sure to include authentication routes at the bottom
require __DIR__ . '/auth.php';
