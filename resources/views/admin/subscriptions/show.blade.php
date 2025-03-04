@extends('admin.index')

@section('content')
<div class="container-fluid">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-eye"></i> Subscription Plan Details</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Name:</strong> {{ $subscription->name }}</p>
                    <p><strong>Price:</strong> ${{ number_format($subscription->price, 2) }}</p>
                    <p><strong>Duration:</strong> {{ $subscription->duration_days }} days</p>
                    <p><strong>Features:</strong> {{ $subscription->features }}</p>
                    <p><strong>Status:</strong> 
                        @if($subscription->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </p>
                </div>
                <div class="col-md-6">
                    @if($subscription->photo)
                        <img src="{{ asset('storage/' . $subscription->photo) }}" alt="Subscription Photo" class="img-fluid rounded">
                    @else
                        <p>No photo available.</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <a href="{{ route('admin.subscriptions.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
</div>
@endsection