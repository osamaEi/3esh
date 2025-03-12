<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SubscriptionRequest;
use App\Repositories\Contracts\SubscriptionRepositoryInterface;

class SubscriptionController extends Controller
{
    protected $subscriptionRepository;

    public function __construct(SubscriptionRepositoryInterface $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    public function index()
    {
        $subscriptions = $this->subscriptionRepository->getAll();
        return view('admin.subscriptions.index', compact('subscriptions'));
    }

    public function create()
    {
        return view('admin.subscriptions.create');
    }

    public function store(SubscriptionRequest $request)
    {
        $data = $request->validated();
        
        // Handle photo upload
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('subscription_photos', 'public');
        }
        
        // Convert features from string to JSON if needed
        if (isset($data['features']) && is_string($data['features'])) {
            $data['features'] = json_decode($data['features'], true);
        }
        
        $this->subscriptionRepository->create($data);
        
        return redirect()->route('admin.subscriptions.index')->with('success', 'Subscription created successfully.');
    }
    public function show($id)
    {
        $subscription = $this->subscriptionRepository->findById($id);
        return view('admin.subscriptions.show', compact('subscription'));
    }

    public function edit($id)
    {
        $subscription = $this->subscriptionRepository->findById($id);
        return view('admin.subscriptions.edit', compact('subscription'));
    }

    public function update(SubscriptionRequest $request, $id)
    {
        $data = $request->validated();

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('subscription_photos', 'public');
        }

        $this->subscriptionRepository->update($id, $data);
        return redirect()->route('admin.subscriptions.index')->with('success', 'Subscription updated successfully.');
    }

    public function destroy($id)
    {
        $this->subscriptionRepository->delete($id);
        return redirect()->route('admin.subscriptions.index')->with('success', 'Subscription deleted successfully.');
    }
}
