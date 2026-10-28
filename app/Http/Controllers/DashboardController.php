<?php

namespace App\Http\Controllers;

use App\Models\Member;

class DashboardController extends Controller
{
    public function index()
{
    $totalMembers = Member::count();

    $activeMembers = Member::where('status', 'active')->count();

    $pendingTransactions = 0;
    $collectedPayments = 0;

    $recentMembers = Member::with([
        'membershipCategory',
        'membershipLevel',
    ])->latest()->take(5)->get();

    return view('dashboard', compact(
        'totalMembers',
        'activeMembers',
        'pendingTransactions',
        'collectedPayments',
        'recentMembers'
    ));
}
}
