<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\LessonController;
use App\Http\Controllers\Site\PaymentController;
use App\Http\Controllers\Dashboard\GradeController;
use App\Http\Controllers\Dashboard\LevelController;
use App\Http\Controllers\Site\SubjectUserController;
use App\Http\Controllers\Dashboard\SubjectController;
use App\Http\Controllers\Dashboard\TeacherController;
use App\Http\Controllers\Site\SubjectTeacherController;
use App\Http\Controllers\Site\SubjectUserDetailController;
use App\Http\Controllers\Site\GradeController as SiteGradeController;
use App\Http\Controllers\Site\LevelController as SiteLevelController;
use App\Http\Controllers\Site\SubjectController as SiteSubjectController;
use App\Http\Controllers\Site\TeacherController as SiteTeacherController;
use App\Http\Controllers\Site\DashboardController as SiteDashboardController;
;

Route::get('/', function () {
    return redirect()->route('levels.index');
});



require __DIR__ . '/auth.php';

Route::middleware(['auth', 'admin'])->prefix('/admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::resource('levels', LevelController::class)->except('show');

    Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');
    Route::post('/grades', [GradeController::class, 'store'])->name('grades.store');
    Route::post('/grades/generate', [GradeController::class, 'generate'])->name('grades.generate');
    Route::put('/grades/{grade}', [GradeController::class, 'update'])->name('grades.update');
    Route::delete('/grades/{grade}', [GradeController::class, 'destroy'])->name('grades.destroy');

    Route::resource('/subjects', SubjectController::class)->except('show');

    Route::get('/teachers/pending', [TeacherController::class, 'pending'])->name('teachers.pending');
    Route::get('/teachers/approved', [TeacherController::class, 'index'])->name('teachers.approved');
    Route::post('teachers/approve/{id}', [TeacherController::class, 'approve'])->name('teachers.approve');
    Route::post('teachers/reject/{id}', [TeacherController::class, 'reject'])->name('teachers.reject');
});

Route::view('/login', 'auth.login')->name('login.index')->middleware('guest');

Route::view('/register', 'auth.register')->name('register.index');

Route::get('/levels', [SiteLevelController::class, 'index'])->name('levels.index');

Route::get('/levels/{level}', [SiteGradeController::class, 'index'])->name('levels.grades');

Route::get('/levels/{level}/grades/{grade}', [SiteSubjectController::class, 'index'])->name('levels.grades.subjects');
Route::get('/levels/{level}/grades/{grade}/subjects/{subject}', [SubjectTeacherController::class, 'index'])->name('levels.grades.subjects.teachers');
Route::get('/levels/{level}/grades/{grade}/subjects/{subject}/teacher/{id}', [SubjectUserController::class, 'index'])->name('levels.grades.subjects.teachers.detail');

Route::get('/become-teacher', [SiteTeacherController::class, 'show'])->name('teacher.show');
Route::post('/become-teacher', [SiteTeacherController::class, 'store'])->name('teacher.store');
Route::get('/teacher/dashboard', [SiteDashboardController::class, 'index'])->middleware('teacher')->name('teacher.dashboard');
Route::post('/lessons', [LessonController::class, 'store'])->middleware('teacher')->name('lessons.store');
Route::get('/manage-course/{id}', [SiteDashboardController::class, 'manageSubject'])->middleware('teacher')->name('manage-course');
Route::get('/resource/download', [LessonController::class, 'download'])->middleware('teacher')->name('download-resource');
Route::post('/manage-course/{id}/description', [SubjectUserDetailController::class, 'store'])->middleware('teacher')->name('course-description.store');


//payment process

// Display checkout page
Route::get('/checkout/{course}', [PaymentController::class, 'checkout'])
    ->name('payment.checkout');

// Process payment
Route::post('/payment/process', [PaymentController::class, 'processPayment'])
    ->name('payment.process');

// Payment callback
Route::get('/payment/callback', [PaymentController::class, 'callback'])
    ->name('payment.callback');

// Payment success page
Route::get('/payment/success/{enrollment_id}', [PaymentController::class, 'success'])
    ->name('payment.success');

// Payment failed page
Route::get('/payment/failed', [PaymentController::class, 'failed'])
    ->name('payment.failed');
