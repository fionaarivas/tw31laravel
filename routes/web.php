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
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', [PageController::class, 'about']);

Route::get('/task/{id}', [PageController::class, 'task']);

Route::get('/tasks', [TaskController::class, 'index'])
    ->name('tasks.index');

Route::post('/tasks', [TaskController::class, 'store'])
    ->name('tasks.store');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

  

    Route::resource('members', MemberController::class);

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



    Route::middleware('admin')->group(function () {



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
    });



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




    Route::resource(
        'payments',
        PaymentController::class
    );
});

require __DIR__ . '/auth.php';


Route::get(
    '/member/dashboard',
    [TaskController::class, 'memberDashboard']
)
    ->middleware('auth')
    ->name('member.dashboard');

    Route::get(
    '/task-dashboard',
    [TaskController::class, 'dashboard']
)
    ->middleware('auth')
    ->name('task.dashboard');

    Route::delete(
    '/tasks/{task}',
    [TaskController::class, 'destroy']
)->name('tasks.destroy');

Route::patch(
    '/member/tasks/{task}/complete',
    [TaskController::class, 'complete']
)->name('member.tasks.complete');


Route::get('/weather', [
    WeatherController::class,
    'show',
])->name('weather.show');