<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            if ($user->role === 'admin') {
                return redirect()->route('dashboard');
            }

            return redirect()->route('member.dashboard');
        }

        $user->sendEmailVerificationNotification();

        return back()->with(
            'status',
            'verification-link-sent'
        );
    }
}