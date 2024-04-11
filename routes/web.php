<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('tasks', 'tasks')
    ->middleware(['auth'])
    ->name('tasks');

Route::view('projects', 'projects')
    ->middleware(['auth'])
    ->name('projects');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
