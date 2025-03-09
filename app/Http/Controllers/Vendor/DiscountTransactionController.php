<?php

namespace App\Http\Controllers\Vendor;


use Illuminate\Http\Request;
use App\Models\DiscountTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DiscountTransactionController extends Controller
{
    public function index()
    {
        $employee = Auth::guard('employee')->user();
        if (!$employee) {
            return redirect()->route('vendor.login')->withErrors(['message' => 'You must be logged in.']);
        }

        // Fetch unconfirmed transactions for the vendor
        $transactions = DiscountTransaction::where('vendor_id', $employee->vendor_id)
            ->where('is_confirmed', false)
            ->with(['user', 'branch', 'employee']) // Load relationships
            ->get();

        return view('vendors.discount-transactions.index', compact('transactions'));
    }

    public function confirm(Request $request, DiscountTransaction $transaction)
    {
        $employee = Auth::guard('employee')->user();
        if (!$employee || $transaction->vendor_id !== $employee->vendor_id) {
            return redirect()->route('vendors.discount-transactions.index')->withErrors(['message' => 'Unauthorized action.']);
        }

        $request->validate([
            'confirmation_code' => 'required|string|max:255',
        ]);

        // Check if the code matches and the transaction is unconfirmed
        if ($transaction->confirmation_code === $request->confirmation_code && !$transaction->is_confirmed) {
            $transaction->update([
                'is_confirmed' => true,
                'employee_id' => $employee->id, // Record who confirmed it
            ]);
            return redirect()->route('vendors.discount-transactions.index')->with('success', 'Order is done.');
        }

        return redirect()->route('vendors.discount-transactions.index')->withErrors(['message' => 'Invalid confirmation code.']);
    }
}