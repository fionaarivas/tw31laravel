<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use App\Models\MembershipCategory;
use App\Models\MembershipLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Member::with([
            'membershipCategory',
            'membershipLevel',
        ]);

        if ($search) {
            $query->where(function ($query) use ($search) {
                $term = "%{$search}%";

                $query->where('name', 'like', $term)
                    ->orWhere('membership_number', 'like', $term)
                    ->orWhere('email', 'like', $term)
                    ->orWhereHas('membershipCategory', function ($category) use ($term) {
                        $category->where('name', 'like', $term);
                    })
                    ->orWhereHas('membershipLevel', function ($level) use ($term) {
                        $level->where('name', 'like', $term);
                    });
            });
        }

        $members = $query->latest()->get();

        return view('members', compact('members', 'search'));
    }

    public function create()
    {
        $categories = MembershipCategory::where('is_active', true)->get();
        $levels = MembershipLevel::where('is_active', true)->get();

        return view('members.create', compact('categories', 'levels'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email|unique:users,email',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'membership_category_id' => 'required|exists:membership_categories,id',
            'membership_level_id' => 'required|exists:membership_levels,id',
        ]);

        $nextNumber = (Member::max('id') ?? 0) + 1;

        $membershipNumber =
            'MEM-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make('member12345'),
            'role' => 'member',
        ]);

        Member::create([
            'user_id' => $user->id,
            'membership_number' => $membershipNumber,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'address' => $validated['address'],
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'membership_category_id' => $validated['membership_category_id'],
            'membership_level_id' => $validated['membership_level_id'],
            'status' => 'active',
        ]);

        return redirect()
            ->route('members.index')
            ->with('success', 'Member added successfully.');
    }

    public function show(Member $member)
    {
        $member->load([
            'membershipCategory',
            'membershipLevel',
            'membershipTransactions.membershipLevel',
            'membershipTransactions.payments',
            'tasks',
        ]);

        return view('members.show', compact('member'));
    }

    public function edit(Member $member)
    {
        $categories = MembershipCategory::where('is_active', true)->get();
        $levels = MembershipLevel::where('is_active', true)->get();

        return view(
            'members.edit',
            compact('member', 'categories', 'levels')
        );
    }

    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'membership_number' => [
                'required',
                'string',
                'max:255',
                'unique:members,membership_number,' . $member->id,
            ],
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'unique:members,email,' . $member->id,
            ],
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'membership_category_id' => 'required|exists:membership_categories,id',
            'membership_level_id' => 'required|exists:membership_levels,id',
            'status' => 'required|in:active,inactive',
        ]);

        $member->update($validated);

        if ($member->user) {
            $member->user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);
        }

        return redirect()
            ->route('members.index')
            ->with('success', 'Member updated successfully.');
    }

   public function destroy(Member $member)
{
    DB::transaction(function () use ($member) {
        
        $member->tasks()->delete();

        
        $member->membershipTransactions()
            ->with('payments')
            ->get()
            ->each(function ($transaction) {
                $transaction->payments()->delete();
                $transaction->delete();
            });

        
        if ($member->user) {
            $member->user->delete();
        }

       
        $member->delete();
    });

    return redirect()
        ->route('members.index')
        ->with('success', 'Member deleted successfully.');
}

    public function deactivate(Member $member)
    {
        $member->update([
            'status' => 'inactive',
        ]);

        return redirect()
            ->route('members.index')
            ->with('success', 'Member deactivated successfully.');
    }

    public function activate(Member $member)
    {
        $member->update([
            'status' => 'active',
        ]);

        return redirect()
            ->route('members.index')
            ->with('success', 'Member activated successfully.');
    }

    public function transactionHistory(Member $member)
    {
        $member->load([
            'membershipCategory',
            'membershipLevel',
            'membershipTransactions.membershipLevel',
            'membershipTransactions.payments',
        ]);

        return view(
            'members.transactions',
            compact('member')
        );
    }
}