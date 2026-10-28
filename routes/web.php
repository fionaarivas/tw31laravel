<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', [PageController::class, 'about']);

Route::get('/task/{id}', [PageController::class, 'task']);

Route::get('/tasks', [TaskController::class, 'index'])
->name('tasks.index');

Route::post('/tasks', [TaskController::class, 'store'])
->name('tasks.store');

Route::resource('members', MemberController::class);

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::patch('/members/{member}/deactivate', [MemberController::class, 'deactivate'])
    ->name('members.deactivate');

Route::patch('/members/{member}/activate', [MemberController::class, 'activate'])
    ->name('members.activate');