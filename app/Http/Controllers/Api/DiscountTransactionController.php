<?php

namespace App\Http\Controllers\API;

use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Models\DiscountTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator; // Make sure to use the Facade
class DiscountTransactionController extends Controller
{
    public function createTransaction(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'vendor_id' => 'required|exists:vendors,id',
            'branch_id' => 'nullable|exists:branches,id',
            'amount' => 'required|numeric|min:1',
            'discount_percentage' => 'required|numeric|between:0,100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Get the authenticated user
        $user = auth()->user();
        
        // Calculate discount amount
        $discountAmount = ($request->amount * $request->discount_percentage) / 100;
        
        // Generate confirmation code (6 digits)
        $confirmationCode = mt_rand(100000, 999999);
        
        // Create new transaction
        $transaction = DiscountTransaction::create([
            'vendor_id' => $request->vendor_id,
            'branch_id' => $request->branch_id,
            'user_id' => $user->id,
            'amount' => $request->amount,
            'discount_percentage' => $request->discount_percentage,
            'discount_amount' => $discountAmount,
            'confirmation_code' => $confirmationCode,
            'is_confirmed' => false,
        ]);
        
        // Send notification to vendor employees using Firebase
        $this->notifyVendorEmployees($request->vendor_id, $transaction);
        
        return response()->json([
            'success' => true,
            'message' => 'Transaction created successfully',
            'data' => [
                'transaction_id' => $transaction->id,
                'confirmation_code' => $confirmationCode
            ]
        ]);
    }
    
    /**
     * Notify vendor employees about new transaction
     */
    private function notifyVendorEmployees($vendorId, $transaction)
    {
        // Get all employees of the vendor
        $vendor = Vendor::findOrFail($vendorId);
        $employees = $vendor->employees; // Assuming you have a relationship set up
        
        // Firebase notification logic here
        // This is just a placeholder - you'll need to implement your Firebase notification logic
        foreach ($employees as $employee) {
            // Send Firebase notification to each employee
            $this->sendFirebaseNotification(
                $employee->device_token,
                'New Discount Transaction',
                'A new discount transaction is waiting for confirmation',
                [
                    'transaction_id' => $transaction->id,
                    'amount' => $transaction->amount,
                    'discount' => $transaction->discount_percentage . '%'
                ]
            );
        }
    }
    
    /**
     * Send Firebase notification (placeholder method)
     */
    private function sendFirebaseNotification($token, $title, $body, $data = [])
    {
        // Implement your Firebase notification logic here
        // This is just a placeholder function
        
        // Example using Firebase PHP SDK or cURL request to Firebase API
    }  //
}
