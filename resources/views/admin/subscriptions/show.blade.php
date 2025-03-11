@extends('admin.index')
@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">{{__('Dashboard')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.subscriptions.index') }}" class="text-decoration-none">{{__('Subscription Plans')}}</a></li>
            <li class="breadcrumb-item active">{{ $subscription->name }}</li>
        </ol>
    </nav>
    
    <!-- Main Content -->
    <div class="card border-0 shadow-sm overflow-hidden">
        <!-- Header with Cover Image Background -->
        <div class="position-relative">
            <div class="bg-gradient-to-r from-primary to-info text-white p-5">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-1 fw-bold">{{ $subscription->name }}</h3>
                        <p class="mb-0 opacity-75">{{__('Subscription Plan Details')}}</p>
                    </div>
                    <div class="text-end">
                        <div class="h2 fw-bold mb-0">${{ number_format($subscription->price, 2) }}</div>
                        <div class="opacity-75">{{__('for')}} {{ $subscription->duration_days }} {{__('days')}}</div>
                    </div>
                </div>
            </div>
            
            @if($subscription->is_active)
                <div class="position-absolute top-0 end-0 m-4">
                    <span class="badge bg-success fs-6 px-3 py-2 shadow-sm">{{__('Active')}}</span>
                </div>
            @else
                <div class="position-absolute top-0 end-0 m-4">
                    <span class="badge bg-danger fs-6 px-3 py-2 shadow-sm">{{__('Inactive')}}</span>
                </div>
            @endif
        </div>
        
        <!-- Content -->
        <div class="card-body p-4">
            <div class="row g-4">
                <!-- Plan Information -->
                <div class="col-lg-7">
                    <div class="card h-100 border-0 bg-light">
                        <div class="card-body">
                            <h5 class="card-title mb-4">
                                <i class="fas fa-info-circle text-primary me-2"></i>{{__('Plan Information')}}
                            </h5>
                            
                            <div class="mb-4">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="text-muted">{{__('Price')}}</div>
                                    <div class="fw-bold">${{ number_format($subscription->price, 2) }}</div>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="text-muted">{{__('Duration')}}</div>
                                    <div class="fw-bold">{{ $subscription->duration_days }} {{__('days')}}</div>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="text-muted">{{__('Created')}}</div>
                                    <div>{{ $subscription->created_at->format('M d, Y') }}</div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="text-muted">{{__('Last Updated')}}</div>
                                    <div>{{ $subscription->updated_at->format('M d, Y') }}</div>
                                </div>
                            </div>
                            
                            <h5 class="card-title mt-4 mb-3">
                                <i class="fas fa-star text-warning me-2"></i>{{__('Features')}}
                            </h5>
                            
                            <div class="features-list">
                                @php
                                    $featuresList = explode(',', $subscription->features);
                                @endphp
                                
                                @foreach($featuresList as $feature)
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="me-2 text-success"><i class="fas fa-check-circle"></i></div>
                                        <div>{{ trim($feature) }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Plan Image and Actions -->
                <div class="col-lg-5">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-0">
                            @if($subscription->photo)
                                <img src="{{ asset('storage/' . $subscription->photo) }}" alt="{{ $subscription->name }}" class="img-fluid rounded-top" style="width: 100%; object-fit: cover;">
                            @else
                                <div class="d-flex justify-content-center align-items-center bg-light rounded-top" style="height: 250px;">
                                    <div class="text-center">
                                        <i class="fas fa-image text-secondary" style="font-size: 4rem;"></i>
                                        <p class="mt-3 text-muted">{{__('No image available')}}</p>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="p-4">
                                <h5 class="mb-4">{{__('Actions')}}</h5>
                                <div class="d-grid gap-2">
                                    <a href="{{ route('admin.subscriptions.edit', $subscription->id) }}" class="btn btn-primary">
                                        <i class="fas fa-edit me-2"></i>{{__('Edit Plan')}}
                                    </a>
                                    <a href="" class="btn btn-info text-white">
                                        <i class="fas fa-users me-2"></i>{{__('View Subscribers')}}
                                    </a>
                                    
                                    @if($subscription->is_active)
                                        <form action="" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-outline-danger w-100">
                                                <i class="fas fa-times-circle me-2"></i>{{__('Deactivate Plan')}}
                                            </button>
                                        </form>
                                    @else
                                        <form action="" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-outline-success w-100">
                                                <i class="fas fa-check-circle me-2"></i>{{__('Activate Plan')}}
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Statistics -->
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-4">
                                <i class="fas fa-chart-bar text-primary me-2"></i>{{__('Subscription Statistics')}}
                            </h5>
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <div class="p-3 rounded bg-primary bg-opacity-10">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="rounded-circle bg-primary text-white p-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                                    <i class="fas fa-users"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="text-muted small">{{__('Active Subscribers')}}</div>
                                                <div class="fw-bold h5 mb-0">{{ $subscription->active_users_count ?? 0 }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="p-3 rounded bg-success bg-opacity-10">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="rounded-circle bg-success text-white p-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                                    <i class="fas fa-dollar-sign"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="text-muted small">{{__('Revenue Generated')}}</div>
                                                <div class="fw-bold h5 mb-0">${{ number_format($subscription->total_revenue ?? 0, 2) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="p-3 rounded bg-info bg-opacity-10">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="rounded-circle bg-info text-white p-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                                    <i class="fas fa-sync-alt"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="text-muted small">{{__('Renewal Rate')}}</div>
                                                <div class="fw-bold h5 mb-0">{{ $subscription->renewal_rate ?? 0 }}%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="p-3 rounded bg-warning bg-opacity-10">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="rounded-circle bg-warning text-white p-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="text-muted small">{{__('Avg. Subscription Length')}}</div>
                                                <div class="fw-bold h5 mb-0">{{ $subscription->avg_subscription_months ?? 0 }} months</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="card-footer bg-white py-3 d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ route('admin.subscriptions.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>{{__('Back to All Plans')}}
                </a>
            </div>
            <div>
                <span class="text-muted small">ID: {{ $subscription->id }}</span>
            </div>
        </div>
    </div>
</div>

<style>
    /* Gradient background */
    .bg-gradient-to-r {
        background: linear-gradient(to right, var(--bs-primary), var(--bs-info));
    }
    
    /* Card hover effect */
    .card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    /* Feature list styling */
    .features-list {
        max-height: 300px;
        overflow-y: auto;
    }
    
    /* Badge styling */
    .badge {
        font-weight: 500;
    }
</style>
@endsection