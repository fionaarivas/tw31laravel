<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MembershipCategory;
use App\Models\MembershipLevel;
use Illuminate\Http\Request;

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
            'email' => 'required|email|unique:members,email',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string',
            'membership_category_id' => 'required|exists:membership_categories,id',
            'membership_level_id' => 'required|exists:membership_levels,id',
        ]);

        $nextNumber = (Member::max('id') ?? 0) + 1;

        $validated['membership_number'] =
            'MEM-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $validated['status'] = 'active';

        Member::create($validated);

        return redirect()
            ->route('members.index')
            ->with('success', 'Member added successfully.');
    }

    public function show(Member $member)
    {
        $member->load([
            'membershipCategory',
            'membershipLevel',
        ]);

        return view('members.show', compact('member'));
    }

    public function edit(Member $member)
    {
        $categories = MembershipCategory::where('is_active', true)->get();
        $levels = MembershipLevel::where('is_active', true)->get();

        return view('members.edit', compact(
            'member',
            'categories',
            'levels'
        ));
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
            'membership_category_id' => 'required|exists:membership_categories,id',
            'membership_level_id' => 'required|exists:membership_levels,id',
            'status' => 'required|in:active,inactive',
        ]);

        $member->update($validated);

        return redirect()
            ->route('members.index')
            ->with('success', 'Member updated successfully.');
    }

    public function destroy(Member $member)
    {
        // Deactivate instead of permanently deleting the record.
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
}