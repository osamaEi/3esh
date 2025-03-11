@extends('admin.index')
@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">{{__('Branch Management')}}</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">{{__('Dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Branches')}}</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.branches.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>{{__('Add New Branch')}}
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                        <i class="fas fa-code-branch text-primary"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 text-muted">{{__('Total Branches')}}</h6>
                        <h4 class="mb-0">{{ $branches->count() }}</h4>
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
                        <h6 class="mb-0 text-muted">{{__('Active Branches')}}</h6>
                        <h4 class="mb-0">{{ $branches->where('is_active', true)->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
                        <i class="fas fa-times-circle text-danger"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 text-muted">{{__('Inactive Branches')}}</h6>
                        <h4 class="mb-0">{{ $branches->where('is_active', false)->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                        <i class="fas fa-store text-info"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 text-muted">{{__('Vendors')}}</h6>
                        <h4 class="mb-0">{{ $branches->pluck('vendor.business_name')->unique()->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-start border-4 border-success" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Search & Filter -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body py-3">
            <form action="{{ route('admin.branches.index') }}" method="GET">
                <div class="row align-items-center g-3">
                    <!-- Search Box -->
                    <div class="col-lg-4 col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-start-0" 
                                name="search" 
                                placeholder="{{__('Search branches...')}}" 
                                value="{{ request('search') }}">
                        </div>
                    </div>
                    
                    <!-- Vendor Filter -->
                    <div class="col-lg-3 col-md-6">
                        <select class="form-select" name="vendor">
                            <option value="">{{__('All Vendors')}}</option>
                            @foreach($branches->pluck('vendor.business_name', 'vendor.id')->unique() as $id => $name)
                                @if($name)
                                <option value="{{ $id }}" {{ request('vendor') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Status Filter -->
                    <div class="col-lg-3 col-md-6">
                        <select class="form-select" name="status">
                            <option value="">{{__('All Statuses')}}</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>
                                {{__('Active')}}
                            </option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>
                                {{__('Inactive')}}
                            </option>
                        </select>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="col-lg-2 col-md-6">
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
                            <th class="ps-3" width="60">ID</th>
                            <th>{{__('Branch Details')}}</th>
                            <th>{{__('Vendor')}}</th>
                            <th>{{__('Contact')}}</th>
                            <th>{{__('Manager')}}</th>
                            <th>{{__('Status')}}</th>
                            <th class="text-end pe-3">{{__('Actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($branches as $branch)
                            <tr class="border-bottom">
                                <td class="ps-3">{{ $branch->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                            <i class="fas fa-building"></i>
                                        </div>
                                        <div>
                                            <div class="fw-medium">{{ $branch->name }}</div>
                                            <div class="small text-muted text-truncate" style="max-width: 200px;">
                                                <i class="fas fa-map-marker-alt me-1"></i> {{ $branch->address }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($branch->vendor)
                                        <span class="badge bg-light text-dark border">
                                            <i class="fas fa-store me-1"></i> {{ $branch->vendor->business_name }}
                                        </span>
                                    @else
                                        <span class="badge bg-light text-muted">{{__('N/A')}}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($branch->phone)
                                        <div><i class="fas fa-phone text-muted me-2"></i>{{ $branch->phone }}</div>
                                    @endif
                                    @if($branch->email)
                                        <div><i class="fas fa-envelope text-muted me-2"></i>{{ $branch->email }}</div>
                                    @endif
                                </td>
                                <td>
                                    @if($branch->manager_name)
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-placeholder me-2 bg-info bg-opacity-10 text-info rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                                {{ strtoupper(substr($branch->manager_name, 0, 1)) }}
                                            </div>
                                            <div>{{ $branch->manager_name }}</div>
                                        </div>
                                    @else
                                        <span class="text-muted">{{__('Not assigned')}}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($branch->is_active)
                                        <span class="badge bg-success">{{__('Active')}}</span>
                                    @else
                                        <span class="badge bg-danger">{{__('Inactive')}}</span>
                                    @endif
                                </td>
                                <td class="text-end pe-3">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            {{__('Actions')}}
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                            <li>
                                                <a href="{{ route('admin.branches.show', $branch->id) }}" class="dropdown-item">
                                                    <i class="fas fa-eye text-primary me-2"></i>{{__('View')}}
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.branches.edit', $branch->id) }}" class="dropdown-item">
                                                    <i class="fas fa-edit text-warning me-2"></i>{{__('Edit')}}
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('admin.branches.destroy', $branch->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger" 
                                                            onclick="return confirm('{{__('Are you sure you want to delete this branch?')}}');">
                                                        <i class="fas fa-trash me-2"></i>{{__('Delete')}}
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
                                        <i class="fas fa-building text-muted" style="font-size: 3rem;"></i>
                                        <h5 class="mt-3">{{__('No branches found')}}</h5>
                                        <p class="text-muted">{{__('Add your first branch to get started')}}</p>
                                        <a href="{{ route('admin.branches.create') }}" class="btn btn-primary mt-2">
                                            <i class="fas fa-plus me-2"></i>{{__('Add New Branch')}}
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="small text-muted">
                    {{__('Showing')}} {{ count($branches) }} {{__('of')}} {{ count($branches) }} {{__('branches')}}
                </div>
                <div>
                    <!-- Pagination can be added here if needed -->
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Table hover effect */
    tbody tr {
        transition: all 0.2s ease;
    }
    tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
    
    /* Status badge styling */
    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
    }
    
    /* Card transitions */
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
        box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.09) !important;
    }
    
    /* Auto-hide alerts after 5 seconds */
    .alert {
        animation: fadeInOut 5s forwards;
    }
    
    @keyframes fadeInOut {
        0% { opacity: 0; }
        10% { opacity: 1; }
        90% { opacity: 1; }
        100% { opacity: 0; }
    }
</style>
@endsection