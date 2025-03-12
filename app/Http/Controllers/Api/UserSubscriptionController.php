<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserSubscriptionService;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserSubscriptionController extends Controller
{
    /**
     * The user subscription service instance.
     * 
     * @var UserSubscriptionService
     */
    protected $subscriptionService;

    /**
     * Create a new controller instance.
     * 
     * @param UserSubscriptionService $subscriptionService
     * @return void
     */
    public function __construct(UserSubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
        $this->middleware('auth:sanctum');
    }

    /**
     * Subscribe authenticated user to a plan.
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function subscribeToPlan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subscription_id' => 'required|exists:subscription_plans,id',
            'amount' => 'nullable|numeric|min:0',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }
        
        try {
            // Get authenticated user ID
            $userId = $request->user()->id;
            
            // Subscribe user to plan
            $result = $this->subscriptionService->subscribeUserToPlan(
                $userId,
                $request->subscription_id,
                $request->amount
            );
            
            return response()->json([
                'status' => true,
                'message' => 'Successfully subscribed to plan',
                'data' => $result
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
    
    /**
     * Get authenticated user's subscription information.
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMySubscriptions(Request $request)
    {
        try {
            // Get authenticated user ID
            $userId = $request->user()->id;
            
            // Get user's subscription info
            $subscriptionInfo = $this->subscriptionService->getUserSubscriptionInfo($userId);
            
            return response()->json([
                'status' => true,
                'message' => 'Subscription information retrieved successfully',
                'data' => $subscriptionInfo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Cancel subscription for authenticated user.
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancelSubscription(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subscription_id' => 'required|exists:subscription_plans,id',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }
        
        try {
            // Get authenticated user ID
            $userId = $request->user()->id;
            
            // Cancel subscription
            $result = $this->subscriptionService->cancelSubscription(
                $userId,
                $request->subscription_id
            );
            
            if (!$result) {
                return response()->json([
                    'status' => false,
                    'message' => 'You are not subscribed to this plan'
                ], 400);
            }
            
            return response()->json([
                'status' => true,
                'message' => 'Subscription cancelled successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Get available subscription plans.
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAvailablePlans(Request $request)
    {
        $perPage = $request->get('per_page', 15);
        
        // Get active subscription plans
        $plans = SubscriptionPlan::where('is_active', true)
            ->orderBy('price', 'asc')
            ->paginate($perPage);
        
        return response()->json([
            'status' => true,
            'message' => 'Available subscription plans retrieved successfully',
            'data' => $plans
        ]);
    }
}