<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\GradeController;
use App\Http\Controllers\Dashboard\LevelController;
use App\Http\Controllers\Dashboard\SubjectController;
use App\Http\Controllers\Dashboard\TeacherController;
use App\Http\Controllers\Site\GradeController as SiteGradeController;
use App\Http\Controllers\Site\LevelController as SiteLevelController;
use App\Http\Controllers\Site\SubjectController as SiteSubjectController;
use App\Http\Controllers\Site\TeacherController as SiteTeacherController;
;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
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

Route::get('/become-teacher', [SiteTeacherController::class, 'show'])->name('teacher.show');
Route::post('/become-teacher', [SiteTeacherController::class, 'store'])->name('teacher.store');
