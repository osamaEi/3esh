<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\SubscriptionRepositoryInterface;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * The subscription repository instance.
     * 
     * @var SubscriptionRepositoryInterface
     */
    protected $subscriptionRepository;

    /**
     * Create a new controller instance.
     * 
     * @param SubscriptionRepositoryInterface $subscriptionRepository
     * @return void
     */
    public function __construct(SubscriptionRepositoryInterface $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    /**
     * Get all subscription plans.
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
   
   
        
        $subscriptions = $this->subscriptionRepository->getAll();
        
        return response()->json([
            'status' => true,
            'message' => 'Subscription plans retrieved successfully',
            'data' => $subscriptions
        ]);
    }

    /**
     * Get vendors associated with a specific subscription plan.
     * 
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSubscriptionVendors($id, Request $request)
    {
        try {
            $subscription = $this->subscriptionRepository->findById($id);
            $perPage = $request->get('per_page', 15);
            
            $vendors = $this->subscriptionRepository->getSubscriptionVendors($id, $perPage);
            
            return response()->json([
                'status' => true,
                'message' => 'Vendors retrieved successfully',
                'subscription' => [
                    'id' => $subscription->id,
                    'name' => $subscription->name
                ],
                'data' => $vendors
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Subscription plan not found'
            ], 404);
        }
    }
}