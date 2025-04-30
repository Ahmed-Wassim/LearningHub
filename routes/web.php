<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\GradeController;
use App\Http\Controllers\Dashboard\LevelController;
use App\Http\Controllers\Site\GradeController as SiteGradeController;
use App\Http\Controllers\Site\LevelController as SiteLevelController;

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
});

Route::view('/login', 'auth.login')->name('login.index')->middleware('guest');

Route::view('/register', 'auth.register')->name('register.index');

Route::get('/levels', [SiteLevelController::class, 'index'])->name('levels.index');

Route::get('/levels/{level}', [SiteGradeController::class, 'index'])->name('levels.grades');
