@extends('admin.index')
@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">{{ __('User Management') }}</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('Users') }}</li>
                </ol>
            </nav>
        </div>
        {{-- <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>{{ __('Add New User') }}
        </a> --}}
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                        <i class="fas fa-users text-primary"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 text-muted">{{ __('Total Users') }}</h6>
                        <h4 class="mb-0">{{ $users->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                        <i class="fas fa-user-check text-success"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 text-muted">{{ __('Active Users') }}</h6>
                        <h4 class="mb-0">{{ $users->where('status', 'active')->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
                        <i class="fas fa-user-slash text-danger"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 text-muted">{{ __('Inactive Users') }}</h6>
                        <h4 class="mb-0">{{ $users->where('status', '!=', 'active')->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                        <i class="fas fa-user-clock text-info"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 text-muted">{{ __('New This Month') }}</h6>
                        <h4 class="mb-0">{{ $users->where('created_at', '>=', now()->startOfMonth())->count() }}</h4>
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
            <form action="{{ route('admin.users.index') }}" method="GET">
                <div class="row align-items-center g-3">
                    <!-- Search Box -->
                    <div class="col-lg-5 col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-start-0" 
                                name="search" 
                                placeholder="{{ __('Search by name or email...') }}" 
                                value="{{ request('search') }}">
                        </div>
                    </div>
                    
                    <!-- Status Filter -->
                    <div class="col-lg-3 col-md-6">
                        <select class="form-select" name="status">
                            <option value="">{{ __('All Statuses') }}</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>
                                {{ __('Active') }}
                            </option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>
                                {{ __('Inactive') }}
                            </option>
                        </select>
                    </div>
                    
                    <!-- Sort Order -->
                    <div class="col-lg-2 col-md-6">
                        <select class="form-select" name="sort">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>
                                {{ __('Newest First') }}
                            </option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                                {{ __('Oldest First') }}
                            </option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>
                                {{ __('Name A-Z') }}
                            </option>
                        </select>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="col-lg-2 col-md-6">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter me-2"></i> {{ __('Filter') }}
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
                            <th class="ps-3" width="60">{{ __('ID') }}</th>
                            <th>{{ __('User Info') }}</th>
                            <th>{{ __('Contact') }}</th>
                            <th>{{ __('Account Details') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th class="text-end pe-3">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="border-bottom">
                                <td class="ps-3">{{ $user->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-3 bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-medium">{{ $user->name }}</div>
                                            <div class="small text-muted">{{ __('User ID') }}: #{{ $user->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div><i class="fas fa-envelope text-muted me-2"></i>{{ $user->email }}</div>
                                    @if($user->phone)
                                        <div><i class="fas fa-phone text-muted me-2"></i>{{ $user->phone }}</div>
                                    @endif
                                </td>
                                <td>
                                    <div class="small">
                                        <div><i class="fas fa-calendar-alt text-muted me-2"></i>{{ __('Joined') }}: {{ $user->created_at->format('M d, Y') }}</div>
                                        <div><i class="fas fa-user-shield text-muted me-2"></i>{{ __('Role') }}: {{ ucfirst($user->role ?? 'User') }}</div>
                                    </div>
                                </td>
                                <td>
                                    @if($user->status == 'active')
                                        <span class="badge bg-success">{{ __('Active') }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ __('Inactive') }}</span>
                                    @endif
                                </td>
                                <td class="text-end pe-3">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            {{ __('Actions') }}
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                            <li>
                                                <a href="{{ route('admin.users.show', $user->id) }}" class="dropdown-item">
                                                    <i class="fas fa-eye text-primary me-2"></i>{{ __('View Profile') }}
                                                </a>
                                            </li>
                                            @if($user->status == 'active')
                                            <li>
                                                <form action="" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="inactive">
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fas fa-ban text-warning me-2"></i>{{ __('Deactivate') }}
                                                    </button>
                                                </form>
                                            </li>
                                            @else
                                            <li>
                                                <form action="" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="active">
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fas fa-check-circle text-success me-2"></i>{{ __('Activate') }}
                                                    </button>
                                                </form>
                                            </li>
                                            @endif
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger" 
                                                            onclick="return confirm('{{ __('Are you sure you want to delete this user? This action cannot be undone.') }}');">
                                                        <i class="fas fa-trash me-2"></i>{{ __('Delete') }}
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="py-4">
                                        <i class="fas fa-users text-muted" style="font-size: 3rem;"></i>
                                        <h5 class="mt-3">{{ __('No users found') }}</h5>
                                        <p class="text-muted">{{ __('There are no users matching your criteria') }}</p>
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
                    {{ __('Showing') }} {{ count($users) }} {{ __('of') }} {{ count($users) }} {{ __('users') }}
                </div>
                <div>
                    {{-- {{ $users->links() }} <!-- Pagination if needed --> --}}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* User avatar custom styling */
    .user-avatar {
        font-weight: 600;
    }
    
    /* Table hover effect */
    tbody tr {
        transition: all 0.2s ease;
    }
    tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
    
    /* Dropdown menu animation */
    .dropdown-menu {
        animation: fadeInMenu 0.2s ease-in-out;
    }
    
    @keyframes fadeInMenu {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Auto-hide alerts after 5 seconds */
    .alert {
        animation: fadeInOut 5s forwards;
    }
    
    @keyframes fadeInOut {
        0% { opacity: 0; }
        10% { opacity: 1; }
        90% { opacity: 1; }
        100% { opacity: 0; display: none; }
    }
</style>
@endsection