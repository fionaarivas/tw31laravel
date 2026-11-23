<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    public function __invoke(
        Request $request
    ): View|RedirectResponse {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            if ($user->role === 'admin') {
                return redirect()->route('dashboard');
            }

            return redirect()->route('member.dashboard');
        }

        return view('auth.verify-email');
    }
}