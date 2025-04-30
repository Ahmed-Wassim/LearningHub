<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\LevelController;
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
});

Route::view('/login', 'auth.login')->name('login.index')->middleware('guest');

Route::view('/register', 'auth.register')->name('register.index');

Route::get('/levels', [SiteLevelController::class, 'index'])->name('levels.index');
