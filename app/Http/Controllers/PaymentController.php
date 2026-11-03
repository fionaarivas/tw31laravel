<?php

namespace App\Http\Controllers;

use App\Models\MembershipTransaction;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Payment::with([
            'membershipTransaction.member',
        ]);

        if ($search) {
            $term = "%{$search}%";

            $query->where(function ($query) use ($term) {
                $query->where(
                    'payment_reference',
                    'like',
                    $term
                )
                ->orWhere(
                    'payment_method',
                    'like',
                    $term
                )
                ->orWhereHas(
                    'membershipTransaction',
                    function ($transaction) use ($term) {
                        $transaction
                            ->where(
                                'transaction_number',
                                'like',
                                $term
                            )
                            ->orWhereHas(
                                'member',
                                function ($member) use ($term) {
                                    $member->where(
                                        'name',
                                        'like',
                                        $term
                                    );
                                }
                            );
                    }
                );
            });
        }

        $payments = $query
            ->latest()
            ->get();

        return view(
            'payments.index',
            compact('payments', 'search')
        );
    }

    public function create()
    {
        $transactions = MembershipTransaction::with([
            'member',
            'membershipLevel',
        ])
        ->where('status', 'pending')
        ->orderByDesc('transaction_date')
        ->get();

        return view(
            'payments.create',
            compact('transactions')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'membership_transaction_id' => [
                'required',
                'exists:membership_transactions,id',
            ],
            'amount' => [
                'required',
                'numeric',
                'min:0.01',
            ],
            'payment_method' => [
                'required',
                'in:cash,bank_transfer,e_wallet,card',
            ],
            'payment_date' => [
                'required',
                'date',
            ],
            'notes' => [
                'nullable',
                'string',
            ],
        ]);

        $transaction = MembershipTransaction::findOrFail(
            $validated['membership_transaction_id']
        );

        if ($transaction->status !== 'pending') {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Only pending transactions can receive payments.'
                );
        }

        if (
            (float) $validated['amount'] >
            (float) $transaction->amount
        ) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Payment amount cannot be greater than the transaction amount.'
                );
        }

        $paymentReference = $this->generatePaymentReference();

        Payment::create([
            'payment_reference' => $paymentReference,
            'membership_transaction_id' =>
                $validated['membership_transaction_id'],
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'payment_date' => $validated['payment_date'],
            'notes' => $validated['notes'] ?? null,
        ]);

        $transaction->update([
            'status' => 'paid',
        ]);

        return redirect()
            ->route('payments.index')
            ->with(
                'success',
                'Payment recorded successfully. Transaction marked as paid.'
            );
    }

    public function show(Payment $payment)
    {
        $payment->load([
            'membershipTransaction.member',
            'membershipTransaction.membershipLevel',
        ]);

        return view(
            'payments.show',
            compact('payment')
        );
    }

    public function edit(Payment $payment)
    {
        $payment->load([
            'membershipTransaction.member',
        ]);

        return view(
            'payments.edit',
            compact('payment')
        );
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'amount' => [
                'required',
                'numeric',
                'min:0.01',
            ],
            'payment_method' => [
                'required',
                'in:cash,bank_transfer,e_wallet,card',
            ],
            'payment_date' => [
                'required',
                'date',
            ],
            'notes' => [
                'nullable',
                'string',
            ],
        ]);

        $transaction = $payment->membershipTransaction;

        if (
            (float) $validated['amount'] >
            (float) $transaction->amount
        ) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Payment amount cannot be greater than the transaction amount.'
                );
        }

        $payment->update($validated);

        return redirect()
            ->route('payments.index')
            ->with(
                'success',
                'Payment updated successfully.'
            );
    }

    public function destroy(Payment $payment)
    {
        $transaction = $payment->membershipTransaction;

        $payment->delete();

        if ($transaction->payments()->count() === 0) {
            $transaction->update([
                'status' => 'pending',
            ]);
        }

        return redirect()
            ->route('payments.index')
            ->with(
                'success',
                'Payment deleted successfully.'
            );
    }

    private function generatePaymentReference()
    {
        do {
            $reference =
                'PAY-' .
                now()->format('Ymd') .
                '-' .
                strtoupper(Str::random(6));
        } while (
            Payment::where(
                'payment_reference',
                $reference
            )->exists()
        );

        return $reference;
    }
}