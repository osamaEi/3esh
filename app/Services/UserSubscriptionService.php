<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserOffers;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserSubscriptionService
{
    /**
     * Subscribe a user to a plan and update their balance
     *
     * @param int $userId
     * @param int $subscriptionId
     * @param float|null $amount Payment amount (optional)
     * @return array
     * @throws \Exception
     */
    public function subscribeUserToPlan($userId, $subscriptionId, $amount = null)
    {
        // Wrap everything in a transaction
        return DB::transaction(function () use ($userId, $subscriptionId, $amount) {
            $user = User::findOrFail($userId);
            $subscription = Subscription::findOrFail($subscriptionId);
            
            // Check if user is already subscribed to this plan
            if ($user->subscriptionPlans()->where('subscription_plans.id', $subscriptionId)->exists()) {
                throw new \Exception('User is already subscribed to this plan');
            }
            
            // Create the subscription relationship
            $user->subscriptionPlans()->attach($subscriptionId);
            
            // Determine the amount if not provided
            $actualAmount = $amount ?? $subscription->price;
            
            // Get or create user offer record
            $userOffer = UserOffers::firstOrNew(['user_id' => $userId]);
            
            // Update balance and amount
            $currentBalance = $userOffer->balance ?? 0;
            $userOffer->balance = $currentBalance - $actualAmount;
            $userOffer->amount = $actualAmount;
            $userOffer->save();
            
            // Return subscription and balance info
            return [
                'user' => $user->only(['id', 'name', 'email']),
                'subscription' => $subscription,
                'payment' => [
                    'amount' => $actualAmount,
                    'current_balance' => $userOffer->balance
                ]
            ];
        });
    }
    
    /**
     * Get user subscription and balance information
     *
     * @param int $userId
     * @return array
     */
    public function getUserSubscriptionInfo($userId)
    {
        $user = User::findOrFail($userId);
        
        // Get user's active subscriptions
        $subscriptions = $user->subscriptionPlans()->get();
        
        // Get user offer details
        $userOffer = UserOffers::where('user_id', $userId)->first();
        
        return [
            'user' => $user->only(['id', 'name', 'email']),
            'subscriptions' => $subscriptions,
            'balance' => $userOffer ? $userOffer->balance : 0,
            'last_payment_amount' => $userOffer ? $userOffer->amount : 0
        ];
    }
    
    /**
     * Cancel a user's subscription
     *
     * @param int $userId
     * @param int $subscriptionId
     * @return bool
     */
    public function cancelSubscription($userId, $subscriptionId)
    {
        $user = User::findOrFail($userId);
        return $user->subscriptionPlans()->detach($subscriptionId) > 0;
    }
}