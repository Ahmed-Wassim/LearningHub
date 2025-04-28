<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});



require __DIR__ . '/auth.php';

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return view('dashboard.layouts.app');
    })->name('admin.dashboard');
});

Route::view('/login', 'auth.login')->name('login.index')->middleware('guest');

Route::view('/register', 'auth.register')->name('register.index');

Route::view('/home', 'home')->name('home');
