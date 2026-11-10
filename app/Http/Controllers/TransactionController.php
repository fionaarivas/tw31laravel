<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MembershipLevel;
use App\Models\MembershipTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;


class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = MembershipTransaction::with([
            'member',
            'membershipLevel',
        ]);

        if ($search) {
            $term = "%{$search}%";

            $query->where(function ($query) use ($term) {
                $query->where(
                    'transaction_number',
                    'like',
                    $term
                )
                ->orWhere(
                    'transaction_type',
                    'like',
                    $term
                )
                ->orWhere(
                    'status',
                    'like',
                    $term
                )
                ->orWhereHas('member', function ($member) use ($term) {
                    $member->where('name', 'like', $term);
                });
            });
        }

        $transactions = $query
            ->latest()
            ->get();

        return view(
            'transactions.index',
            compact('transactions', 'search')
        );
    }

    public function create()
    {
        $members = Member::where('status', 'active')
            ->orderBy('name')
            ->get();

        $levels = MembershipLevel::where('is_active', true)
            ->orderBy('fee')
            ->get();

        return view(
            'transactions.create',
            compact('members', 'levels')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => [
                'required',
                'exists:members,id',
            ],
            'membership_level_id' => [
                'required',
                'exists:membership_levels,id',
            ],
            'transaction_type' => [
                'required',
                'in:application,renewal',
            ],
            'transaction_date' => [
                'required',
                'date',
            ],
            'notes' => [
                'nullable',
                'string',
            ],
        ]);

        $level = MembershipLevel::findOrFail(
            $validated['membership_level_id']
        );

        $transactionNumber = $this->generateTransactionNumber();

        MembershipTransaction::create([
            'transaction_number' => $transactionNumber,
            'member_id' => $validated['member_id'],
            'membership_level_id' => $validated['membership_level_id'],
            'transaction_type' => $validated['transaction_type'],
            'amount' => $level->fee,
            'status' => 'pending',
            'transaction_date' => $validated['transaction_date'],
            'membership_start_date' => null,
            'membership_end_date' => null,
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()
            ->route('transactions.index')
            ->with(
                'success',
                'Membership transaction created successfully.'
            );
    }

    public function show (MembershipTransaction $transaction) 
    {
        $transaction->load([
            'member',
            'membershipLevel',
            'payments',
        ]);

        return view(
            'transactions.show', compact('transaction'));
    }

    public function edit(
        MembershipTransaction $transaction
    ) {
        $members = Member::orderBy('name')
            ->get();

        $levels = MembershipLevel::orderBy('fee')
            ->get();

        return view(
            'transactions.edit',
            compact('transaction', 'members', 'levels')
        );
    }

    public function update(
        Request $request,
        MembershipTransaction $transaction
    ) {
        $validated = $request->validate([
            'member_id' => [
                'required',
                'exists:members,id',
            ],
            'membership_level_id' => [
                'required',
                'exists:membership_levels,id',
            ],
            'transaction_type' => [
                'required',
                'in:application,renewal',
            ],
            'status' => [
                'required',
                'in:pending,expired,cancelled',
            ],
            'transaction_date' => [
                'required',
                'date',
            ],
            'membership_start_date' => [
                'nullable',
                'date',
            ],
            'membership_end_date' => [
                'nullable',
                'date',
                'after_or_equal:membership_start_date',
            ],
            'notes' => [
                'nullable',
                'string',
            ],
        ]);

        $level = MembershipLevel::findOrFail(
            $validated['membership_level_id']
        );

        $validated['amount'] = $level->fee;

        $transaction->update($validated);

        return redirect()
            ->route('transactions.index')
            ->with(
                'success',
                'Membership transaction updated successfully.'
            );
    }

    public function destroy(
    MembershipTransaction $transaction
) {
    if ($transaction->payments()->exists()) {
        return redirect()
            ->back()
            ->with(
                'error',
                'This transaction cannot be deleted because it has a recorded payment.'
            );
    }

    $transaction->delete();

    return redirect()
        ->route('transactions.index')
        ->with(
            'success',
            'Membership transaction deleted successfully.'
        );
}

    private function generateTransactionNumber()
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

    public function approve(MembershipTransaction $transaction)
{
    if ($transaction->status !== 'paid') {
        return redirect()
            ->back()
            ->with(
                'error',
                'Only paid transactions can be approved.'
            );
    }

    $transaction->load('membershipLevel');

    $startDate = Carbon::today();

    if ($transaction->transaction_type === 'renewal') {
        $previousTransaction = MembershipTransaction::where(
            'member_id',
            $transaction->member_id
        )
            ->where('status', 'approved')
            ->whereNotNull('membership_end_date')
            ->latest('membership_end_date')
            ->first();

        if (
            $previousTransaction &&
            Carbon::parse(
                $previousTransaction->membership_end_date
            )->isFuture()
        ) {
            $startDate = Carbon::parse(
                $previousTransaction->membership_end_date
            )->addDay();
        }
    }

    $endDate = $startDate->copy()->addMonths(
        $transaction->membershipLevel->validity_period_months
    );

    $transaction->update([
        'status' => 'approved',
        'membership_start_date' => $startDate,
        'membership_end_date' => $endDate,
    ]);

    return redirect()
        ->route('transactions.show', $transaction)
        ->with(
            'success',
            'Transaction approved and membership dates generated successfully.'
        );
}

public function receipt(MembershipTransaction $transaction)
{
    $transaction->load([
        'member.membershipCategory',
        'membershipLevel',
        'payments',
    ]);

    return view(
        'transactions.receipt',
        compact('transaction')
    );
}
}