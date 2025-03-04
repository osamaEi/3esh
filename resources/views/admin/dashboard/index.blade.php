@extends('admin.index')
@section('content')
@php
    // Count vendors
    $vendorCount = \App\Models\Vendor::count();
    
    // Count users
    $userCount = \App\Models\User::count();
    
    // Count subscriptions
    $subscriptionCount = \App\Models\Subscription::count();
    
    // Count categories
    $categoryCount = \App\Models\Category::count();
    
    // Count subcategories
   // $subcategoryCount = \App\Models\Subcategory::count();
    
    // Calculate growth (example - replace with actual logic)
    $vendorGrowth = 12; // 12% growth
    $userGrowth = 8; // 8% growth
    $subscriptionGrowth = 15; // 15% growth
    $categoryGrowth = 5; // 5% growth
    $subcategoryGrowth = 9; // 9% growth
@endphp

<!-- Dashboard Header -->
<div class="container-fluid px-4 py-5">
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Dashboard Overview</h1>
        </div>
        <div class="col-auto">
            <div class="page-utilities">
                <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                    <div class="col-auto">
                        <select class="form-select">
                            <option selected value="option-1">Today</option>
                            <option value="option-2">This Week</option>
                            <option value="option-3">This Month</option>
                            <option value="option-4">This Quarter</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-primary" href="#"><i class="fas fa-file-download me-2"></i>Download Report</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-5">
        <!-- Vendors -->
        <div class="col-md-4 col-xl-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h4 class="card-title text-muted m-0">Vendors</h4>
                        <div class="icon-shape rounded-circle bg-primary-subtle p-3">
                            <i class="fas fa-store fa-fw text-primary fs-4"></i>
                        </div>
                    </div>
                    <h2 class="card-title fw-bold mb-1">{{ number_format($vendorCount) }}</h2>
                    <div class="d-flex align-items-center">
                        <span class="badge bg-success-subtle text-success me-2">
                            <i class="fas fa-arrow-up me-1"></i>{{ $vendorGrowth }}%
                        </span>
                        <span class="text-muted small">since last month</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users -->
        <div class="col-md-4 col-xl-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h4 class="card-title text-muted m-0">Users</h4>
                        <div class="icon-shape rounded-circle bg-success-subtle p-3">
                            <i class="fas fa-users fa-fw text-success fs-4"></i>
                        </div>
                    </div>
                    <h2 class="card-title fw-bold mb-1">{{ number_format($userCount) }}</h2>
                    <div class="d-flex align-items-center">
                        <span class="badge bg-success-subtle text-success me-2">
                            <i class="fas fa-arrow-up me-1"></i>{{ $userGrowth }}%
                        </span>
                        <span class="text-muted small">since last month</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Subscriptions -->
        <div class="col-md-4 col-xl-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h4 class="card-title text-muted m-0">Subscriptions</h4>
                        <div class="icon-shape rounded-circle bg-info-subtle p-3">
                            <i class="fas fa-repeat fa-fw text-info fs-4"></i>
                        </div>
                    </div>
                    <h2 class="card-title fw-bold mb-1">{{ number_format($subscriptionCount) }}</h2>
                    <div class="d-flex align-items-center">
                        <span class="badge bg-success-subtle text-success me-2">
                            <i class="fas fa-arrow-up me-1"></i>{{ $subscriptionGrowth }}%
                        </span>
                        <span class="text-muted small">since last month</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories -->
        <div class="col-md-4 col-xl-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h4 class="card-title text-muted m-0">Categories</h4>
                        <div class="icon-shape rounded-circle bg-warning-subtle p-3">
                            <i class="fas fa-tags fa-fw text-warning fs-4"></i>
                        </div>
                    </div>
                    <h2 class="card-title fw-bold mb-1">{{ number_format($categoryCount) }}</h2>
                    <div class="d-flex align-items-center">
                        <span class="badge bg-success-subtle text-success me-2">
                            <i class="fas fa-arrow-up me-1"></i>{{ $categoryGrowth }}%
                        </span>
                        <span class="text-muted small">since last month</span>
                    </div>
                </div>
            </div>
        </div>

  
    </div>

</div>
@endsection