<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

require __DIR__ . '/auth.php';

Route::view('/login', 'auth.login')->name('login.index');

Route::view('/register', 'auth.register')->name('register.index');

Route::view('/home', 'home')->name('home');

