<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MembershipCategory;
use Illuminate\Http\Request;

class MembershipCategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = MembershipCategory::query();

        if ($search) {
            $term = "%{$search}%";

            $query->where(function ($query) use ($term) {
                $query->where('name', 'like', $term)
                    ->orWhere('description', 'like', $term);
            });
        }

        $categories = $query
            ->orderBy('name')
            ->get();

        return view(
            'membership_categories.index',
            compact('categories', 'search')
        );
    }

    public function create()
    {
        $existingCategories = MembershipCategory::orderBy('name')
            ->get();

        return view(
            'membership_categories.create',
            compact('existingCategories')
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
                    'unique:membership_categories,name',
                ],
                'description' => 'nullable|string',
            ],
            [
                'name.unique' =>
                    'This membership category already exists. Please choose a different name.',
            ]
        );

        $validated['is_active'] = true;

        MembershipCategory::create($validated);

        return redirect()
            ->route('membership-categories.index')
            ->with(
                'success',
                'Membership category added successfully.'
            );
    }

    public function show(MembershipCategory $membershipCategory)
    {
        return view(
            'membership_categories.show',
            compact('membershipCategory')
        );
    }

    public function edit(MembershipCategory $membershipCategory)
    {
        return view(
            'membership_categories.edit',
            compact('membershipCategory')
        );
    }

    public function update(
        Request $request,
        MembershipCategory $membershipCategory
    ) {
        $validated = $request->validate(
            [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    'unique:membership_categories,name,' .
                        $membershipCategory->id,
                ],
                'description' => 'nullable|string',
                'is_active' => 'required|boolean',
            ],
            [
                'name.unique' =>
                    'This membership category already exists. Please choose a different name.',
            ]
        );

        $membershipCategory->update($validated);

        return redirect()
            ->route('membership-categories.index')
            ->with(
                'success',
                'Membership category updated successfully.'
            );
    }

    public function deactivate(
        MembershipCategory $membershipCategory
    ) {
        $membershipCategory->update([
            'is_active' => false,
        ]);

        return redirect()
            ->route('membership-categories.index')
            ->with(
                'success',
                'Membership category deactivated successfully.'
            );
    }

    public function activate(
        MembershipCategory $membershipCategory
    ) {
        $membershipCategory->update([
            'is_active' => true,
        ]);

        return redirect()
            ->route('membership-categories.index')
            ->with(
                'success',
                'Membership category activated successfully.'
            );
    }

    public function destroy(
        MembershipCategory $membershipCategory
    ) {
        $isUsedByMembers = Member::where(
            'membership_category_id',
            $membershipCategory->id
        )->exists();

        if ($isUsedByMembers) {
            return redirect()
                ->route('membership-categories.index')
                ->with(
                    'error',
                    'This category cannot be deleted because it is assigned to existing members. Deactivate it instead.'
                );
        }

        $membershipCategory->delete();

        return redirect()
            ->route('membership-categories.index')
            ->with(
                'success',
                'Membership category deleted successfully.'
            );
    }
}