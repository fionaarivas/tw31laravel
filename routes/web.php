<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MembershipCategoryController;
use App\Http\Controllers\MembershipLevelController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PaymentController;

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

Route::resource(
    'membership-categories',
    MembershipCategoryController::class
);

Route::patch(
    '/membership-categories/{membershipCategory}/deactivate',
    [
        MembershipCategoryController::class,
        'deactivate',
    ]
)->name('membership-categories.deactivate');

Route::patch(
    '/membership-categories/{membershipCategory}/activate',
    [
        MembershipCategoryController::class,
        'activate',
    ]
)->name('membership-categories.activate');

Route::resource(
    'membership-levels',
    MembershipLevelController::class
);

Route::patch(
    '/membership-levels/{membershipLevel}/deactivate',
    [
        MembershipLevelController::class,
        'deactivate',
    ]
)->name('membership-levels.deactivate');

Route::patch(
    '/membership-levels/{membershipLevel}/activate',
    [
        MembershipLevelController::class,
        'activate',
    ]
)->name('membership-levels.activate');

Route::resource(
    'transactions',
    TransactionController::class
);

Route::resource(
    'payments',
    PaymentController::class
);

Route::resource('transactions', TransactionController::class);

Route::patch(
    '/transactions/{transaction}/approve',
    [TransactionController::class, 'approve']
)->name('transactions.approve');

Route::get(
    '/members/{member}/transactions',
    [MemberController::class, 'transactionHistory']
)->name('members.transactions');