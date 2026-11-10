<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MembershipTransaction;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMembers = Member::count();

        $activeMembers = Member::where(
            'status',
            'active'
        )->count();

        $pendingTransactions = MembershipTransaction::where(
            'status',
            'pending'
        )->count();

        $collectedPayments = Payment::sum('amount');

        $recentMembers = Member::with([
            'membershipCategory',
            'membershipLevel',
        ])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalMembers',
            'activeMembers',
            'pendingTransactions',
            'collectedPayments',
            'recentMembers'
        ));
    }
}