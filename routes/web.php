<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MembershipCategoryController;
use App\Http\Controllers\MembershipLevelController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get(
    '/task/{id}',
    [PageController::class, 'task']
);

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Profile Routes
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');


    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */

    Route::middleware('admin')->group(function () {

        Route::get(
            '/dashboard',
            [DashboardController::class, 'index']
        )->name('dashboard');

        Route::resource(
            'members',
            MemberController::class
        );

        Route::patch(
            '/members/{member}/deactivate',
            [MemberController::class, 'deactivate']
        )->name('members.deactivate');

        Route::patch(
            '/members/{member}/activate',
            [MemberController::class, 'activate']
        )->name('members.activate');

        Route::get(
            '/members/{member}/transactions',
            [MemberController::class, 'transactionHistory']
        )->name('members.transactions');


        /*
        |--------------------------------------------------------------------------
        | Admin Task Routes
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/tasks',
            [TaskController::class, 'index']
        )->name('tasks.index');

        Route::post(
            '/tasks',
            [TaskController::class, 'store']
        )->name('tasks.store');

        Route::delete(
            '/tasks/{task}',
            [TaskController::class, 'destroy']
        )->name('tasks.destroy');

        Route::get(
            '/task-dashboard',
            [TaskController::class, 'dashboard']
        )->name('task.dashboard');


        /*
        |--------------------------------------------------------------------------
        | Membership Category Routes
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'membership-categories',
            MembershipCategoryController::class
        );

        Route::patch(
            '/membership-categories/{membershipCategory}/deactivate',
            [MembershipCategoryController::class, 'deactivate']
        )->name('membership-categories.deactivate');

        Route::patch(
            '/membership-categories/{membershipCategory}/activate',
            [MembershipCategoryController::class, 'activate']
        )->name('membership-categories.activate');


        /*
        |--------------------------------------------------------------------------
        | Membership Level Routes
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'membership-levels',
            MembershipLevelController::class
        );

        Route::patch(
            '/membership-levels/{membershipLevel}/deactivate',
            [MembershipLevelController::class, 'deactivate']
        )->name('membership-levels.deactivate');

        Route::patch(
            '/membership-levels/{membershipLevel}/activate',
            [MembershipLevelController::class, 'activate']
        )->name('membership-levels.activate');


        /*
        |--------------------------------------------------------------------------
        | Admin Transaction Routes
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'transactions',
            TransactionController::class
        );

        Route::patch(
            '/transactions/{transaction}/approve',
            [TransactionController::class, 'approve']
        )->name('transactions.approve');

        Route::get(
            '/transactions/{transaction}/receipt',
            [TransactionController::class, 'receipt']
        )->name('transactions.receipt');


        /*
        |--------------------------------------------------------------------------
        | Admin Payment Routes
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'payments',
            PaymentController::class
        );
    });


    /*
    |--------------------------------------------------------------------------
    | Verified Member Routes
    |--------------------------------------------------------------------------
    */

    Route::middleware('verified')->group(function () {

        Route::get(
            '/member/dashboard',
            [TaskController::class, 'memberDashboard']
        )->name('member.dashboard');

        Route::get(
            '/member/tasks',
            [TaskController::class, 'memberTasks']
        )->name('member.tasks.index');

        Route::get(
            '/member/transactions',
            [MemberController::class, 'memberTransactionHistory']
        )->name('member.transactions');

        Route::patch(
            '/member/tasks/{task}/start',
            [TaskController::class, 'start']
        )->name('member.tasks.start');

        Route::patch(
            '/member/tasks/{task}/complete',
            [TaskController::class, 'complete']
        )->name('member.tasks.complete');

        Route::get(
            '/weather',
            [WeatherController::class, 'show']
        )->name('weather.show');
    });
});

require __DIR__ . '/auth.php';