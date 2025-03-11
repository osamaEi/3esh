@extends('admin.index')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">{{__('Vendor Management')}}</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Vendors')}}</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.vendors.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> {{__('Create Vendor')}}
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                        <i class="fas fa-store text-primary"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 text-muted">{{__('Total Vendors')}}</h6>
                        <h4 class="mb-0">{{ $vendors->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 text-muted">{{__('Approved')}}</h6>
                        <h4 class="mb-0">{{ $vendors->where('is_approved', true)->where('blocked', false)->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                        <i class="fas fa-clock text-warning"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 text-muted">{{__('Pending')}}</h6>
                        <h4 class="mb-0">{{ $vendors->where('is_approved', false)->where('blocked', false)->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
                        <i class="fas fa-ban text-danger"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 text-muted">{{__('Blocked')}}</h6>
                        <h4 class="mb-0">{{ $vendors->where('blocked', true)->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('admin.vendors.index') }}" method="GET">
                <div class="row align-items-center g-3">
                    <!-- Search Box -->
                    <div class="col-lg-5 col-md-12">
                        <div class="input-group">
                     
                            <input type="text" class="form-control border-start-0" 
                                   name="search" 
                                   placeholder="{{__('Search vendors...')}}" 
                                   value="{{ request('search') }}">
                        </div>
                    </div>
                    
                    <!-- Filters -->
                    <div class="col-lg-5 col-md-8">
                        <div class="d-flex gap-2">
                            <!-- Status Filter -->
                            <select class="form-select" name="status">
                                <option value="">{{__('All Statuses')}}</option>
                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>
                                    {{__('Approved')}}
                                </option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                    {{__('Pending')}}
                                </option>
                                <option value="blocked" {{ request('status') == 'blocked' ? 'selected' : '' }}>
                                    {{__('Blocked')}}
                                </option>
                            </select>
                            
                            <!-- Sort Order -->
                            <select class="form-select" name="sort">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>
                                    {{__('Newest First')}}
                                </option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                                    {{__('Oldest First')}}
                                </option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>
                                    {{__('Name (A-Z)')}}
                                </option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>
                                    {{__('Name (Z-A)')}}
                                </option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="col-lg-2 col-md-4">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter me-2"></i> {{__('Filter')}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Main Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-3">ID</th>
                            <th width="80">{{__('Logo')}}</th>
                            <th>{{__('Business Name')}}</th>
                            <th>{{__('Contact')}}</th>
                            <th>{{__('Joined')}}</th>
                            <th>{{__('Status')}}</th>
                            <th class="text-end pe-3">{{__('Actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($vendors as $vendor)
                        <tr class="border-bottom">
                            <td class="ps-3">{{ $vendor->id }}</td>
                            <td>
                                @if($vendor->logo)
                                    <img src="{{ asset('storage/'.$vendor->logo) }}" alt="Logo" 
                                         class="rounded-circle border" width="48" height="48" style="object-fit: cover;">
                                @else
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" 
                                         style="width: 48px; height: 48px;">
                                        <i class="fas fa-store text-secondary"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-medium">{{ $vendor->business_name }}</div>
                                @if($vendor->business_type)
                                    <div class="small text-muted">{{ $vendor->business_type }}</div>
                                @endif
                            </td>
                            <td>
                                <div class="small">
                                    @if($vendor->email)
                                        <div><i class="fas fa-envelope text-muted me-1"></i> {{ $vendor->email }}</div>
                                    @endif
                                    @if($vendor->phone)
                                        <div><i class="fas fa-phone text-muted me-1"></i> {{ $vendor->phone }}</div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="small">{{ $vendor->created_at->format('M d, Y') }}</div>
                            </td>
                            <td>
                                @if ($vendor->blocked)
                                    <span class="badge bg-danger">{{__('Blocked')}}</span>
                                @elseif ($vendor->is_approved)
                                    <span class="badge bg-success">{{__('Approved')}}</span>
                                @else
                                    <span class="badge bg-warning text-dark">{{__('Pending')}}</span>
                                @endif
                            </td>
                            <td class="text-end pe-3">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        {{__('Actions')}}
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                        <li>
                                            <a href="{{ route('admin.vendors.show', $vendor->id) }}" class="dropdown-item">
                                                <i class="fas fa-eye text-primary me-2"></i> {{__('View Details')}}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.vendors.edit', $vendor->id) }}" class="dropdown-item">
                                                <i class="fas fa-edit text-warning me-2"></i> {{__('Edit')}}
                                            </a>
                                        </li>
                                        @if (!$vendor->is_approved)
                                        <li>
                                            <form action="{{ route('admin.vendors.approve', $vendor->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item">
                                                    <i class="fas fa-check text-success me-2"></i> {{__('Approve')}}
                                                </button>
                                            </form>
                                        </li>
                                        @endif
                                        @if (!$vendor->blocked)
                                        <li>
                                            <form action="{{ route('admin.vendors.block', $vendor->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item" onclick="return confirm('{{__('Are you sure you want to block this vendor?')}}')">
                                                    <i class="fas fa-ban text-danger me-2"></i> {{__('Block')}}
                                                </button>
                                            </form>
                                        </li>
                                        @else
                                        <li>
                                            <form action="{{ route('admin.vendors.unblock', $vendor->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item">
                                                    <i class="fas fa-unlock text-info me-2"></i> {{__('Unblock')}}
                                                </button>
                                            </form>
                                        </li>
                                        @endif
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="{{ route('admin.vendors.destroy', $vendor->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger" 
                                                        onclick="return confirm('{{__('Are you sure you want to delete this vendor? This action cannot be undone.')}}')">
                                                    <i class="fas fa-trash me-2"></i> {{__('Delete')}}
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="py-4">
                                    <i class="fas fa-store text-muted" style="font-size: 3rem;"></i>
                                    <h5 class="mt-3">{{__('No vendors found')}}</h5>
                                    <p class="text-muted">{{__('Create your first vendor to get started')}}</p>
                                    <a href="{{ route('admin.vendors.create') }}" class="btn btn-primary mt-2">
                                        <i class="fas fa-plus me-2"></i> {{__('Create Vendor')}}
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($vendors->count() > 0)
        <div class="card-footer bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
       
            </div>
        </div>
        @endif
    </div>
</div>

<style>
    /* Clean pagination styling */
    .pagination {
        margin-bottom: 0;
    }
    .page-link {
        border-radius: 0.25rem;
        margin: 0 2px;
        color: #5a5a5a;
    }
    .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    
    /* Hover effect on table rows */
    tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
    
    /* Dropdown menu animations */
    .dropdown-menu {
        animation: fadeIn 0.2s ease-in-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection