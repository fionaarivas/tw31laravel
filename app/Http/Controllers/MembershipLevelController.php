<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MembershipLevel;
use Illuminate\Http\Request;

class MembershipLevelController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = MembershipLevel::query();

        if ($search) {
            $term = "%{$search}%";

            $query->where(function ($query) use ($term) {
                $query->where('name', 'like', $term)
                    ->orWhere('benefits', 'like', $term);
            });
        }

        $levels = $query
            ->orderBy('fee')
            ->get();

        return view(
            'membership_levels.index',
            compact('levels', 'search')
        );
    }

    public function create()
    {
        $existingLevels = MembershipLevel::orderBy('fee')
            ->get();

        return view(
            'membership_levels.create',
            compact('existingLevels')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    'unique:membership_levels,name',
                ],
                'fee' => [
                    'required',
                    'numeric',
                    'min:0',
                ],
                'validity_period_months' => [
                    'required',
                    'integer',
                    'min:1',
                ],
                'benefits' => 'nullable|string',
            ],
            [
                'name.unique' =>
                    'This membership level already exists. Please choose a different name.',
            ]
        );

        $validated['is_active'] = true;

        MembershipLevel::create($validated);

        return redirect()
            ->route('membership-levels.index')
            ->with(
                'success',
                'Membership level added successfully.'
            );
    }

    public function show(MembershipLevel $membershipLevel)
    {
        return view(
            'membership_levels.show',
            compact('membershipLevel')
        );
    }

    public function edit(MembershipLevel $membershipLevel)
    {
        return view(
            'membership_levels.edit',
            compact('membershipLevel')
        );
    }

    public function update(
        Request $request,
        MembershipLevel $membershipLevel
    ) {
        $validated = $request->validate(
            [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    'unique:membership_levels,name,' .
                        $membershipLevel->id,
                ],
                'fee' => [
                    'required',
                    'numeric',
                    'min:0',
                ],
                'validity_period_months' => [
                    'required',
                    'integer',
                    'min:1',
                ],
                'benefits' => 'nullable|string',
                'is_active' => 'required|boolean',
            ],
            [
                'name.unique' =>
                    'This membership level already exists. Please choose a different name.',
            ]
        );

        $membershipLevel->update($validated);

        return redirect()
            ->route('membership-levels.index')
            ->with(
                'success',
                'Membership level updated successfully.'
            );
    }

    public function deactivate(MembershipLevel $membershipLevel)
    {
        $membershipLevel->update([
            'is_active' => false,
        ]);

        return redirect()
            ->route('membership-levels.index')
            ->with(
                'success',
                'Membership level deactivated successfully.'
            );
    }

    public function activate(MembershipLevel $membershipLevel)
    {
        $membershipLevel->update([
            'is_active' => true,
        ]);

        return redirect()
            ->route('membership-levels.index')
            ->with(
                'success',
                'Membership level activated successfully.'
            );
    }

    public function destroy(MembershipLevel $membershipLevel)
    {
        $isUsedByMembers = Member::where(
            'membership_level_id',
            $membershipLevel->id
        )->exists();

        if ($isUsedByMembers) {
            return redirect()
                ->route('membership-levels.index')
                ->with(
                    'error',
                    'This level cannot be deleted because it is assigned to existing members. Deactivate it instead.'
                );
        }

        $membershipLevel->delete();

        return redirect()
            ->route('membership-levels.index')
            ->with(
                'success',
                'Membership level deleted successfully.'
            );
    }
}