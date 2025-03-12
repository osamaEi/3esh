<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Subscription;
use App\Repositories\Contracts\SubscriptionRepositoryInterface;

class SubscribtionRepository implements SubscriptionRepositoryInterface
{
    public function getAll()
    {
        return Subscription::all();
    }

    public function findById($id)
    {
        return Subscription::findOrFail($id);
    }
    public function create(array $data)
    {
        return Subscription::create($data);
    }

    public function update($id, array $data)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->update($data);
        return $subscription;
    }

    public function delete($id)
    {
        $user = Subscription::findOrFail($id);
        return $user->delete();
    }

    public function getSubscriptionVendors($subscriptionId, $perPage = 15)
    {
        $subscription = Subscription::findOrFail($subscriptionId);
        return $subscription->vendors()->paginate($perPage);
    }
}
