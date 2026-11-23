<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\MembershipCategory;
use App\Models\MembershipLevel;
use App\Models\MembershipTransaction;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        $categories = MembershipCategory::where(
            'is_active',
            true
        )
            ->orderBy('name')
            ->get();

        $levels = MembershipLevel::where(
            'is_active',
            true
        )
            ->orderBy('fee')
            ->get();

        return view(
            'auth.register',
            compact('categories', 'levels')
        );
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class,
            ],
            'phone_number' => [
                'required',
                'string',
                'max:20',
            ],
            'address' => [
                'required',
                'string',
                'max:500',
            ],
            'membership_category_id' => [
                'required',
                'exists:membership_categories,id',
            ],
            'membership_level_id' => [
                'required',
                'exists:membership_levels,id',
            ],
            'latitude' => [
                'nullable',
                'numeric',
                'between:-90,90',
            ],
            'longitude' => [
                'nullable',
                'numeric',
                'between:-180,180',
            ],
            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
            ],
        ]);

        $user = DB::transaction(function () use ($request): User {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'member',
            ]);

            $member = Member::create([
                'user_id' => $user->id,
                'membership_number' =>
                    $this->generateMembershipNumber(),
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'membership_category_id' =>
                    $request->membership_category_id,
                'membership_level_id' =>
                    $request->membership_level_id,
                'status' => 'pending',
            ]);

            $level = MembershipLevel::findOrFail(
                $request->membership_level_id
            );

            MembershipTransaction::create([
                'transaction_number' =>
                    $this->generateTransactionNumber(),
                'member_id' => $member->id,
                'membership_level_id' => $level->id,
                'transaction_type' => 'application',
                'amount' => $level->fee,
                'status' => 'pending',
                'transaction_date' => now()->toDateString(),
                'membership_start_date' => null,
                'membership_end_date' => null,
                'notes' =>
                    'Membership application submitted by the member.',
            ]);

            return $user;
        });

        event(new Registered($user));

        return redirect()
            ->route('login')
            ->with(
                'status',
                'Membership application submitted. Please wait for admin approval.'
            );
    }

    private function generateMembershipNumber(): string
    {
        do {
            $number = 'MEM-' . str_pad(
                (string) ((int) Member::max('id') + 1),
                4,
                '0',
                STR_PAD_LEFT
            );
        } while (
            Member::where(
                'membership_number',
                $number
            )->exists()
        );

        return $number;
    }

    private function generateTransactionNumber(): string
    {
        do {
            $number =
                'TRX-' .
                now()->format('Ymd') .
                '-' .
                strtoupper(Str::random(6));
        } while (
            MembershipTransaction::where(
                'transaction_number',
                $number
            )->exists()
        );

        return $number;
    }
}