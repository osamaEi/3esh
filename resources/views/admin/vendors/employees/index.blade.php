@extends('admin.index')
@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">{{ __('Employee Management') }}</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('Employees') }}</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.employees.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>{{ __('Add New Employee') }}
        </a>
    </div>

    <!-- Summary Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                        <i class="fas fa-users text-primary"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 text-muted">{{ __('Total Employees') }}</h6>
                        <h4 class="mb-0">{{ $employees->count() }}</h4>
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
                        <h6 class="mb-0 text-muted">{{ __('Active Employees') }}</h6>
                        <h4 class="mb-0">{{ $employees->where('status', 'active')->count() }}</h4>
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
                        <h6 class="mb-0 text-muted">{{ __('Inactive Employees') }}</h6>
                        <h4 class="mb-0">{{ $employees->where('status', '!=', 'active')->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                        <i class="fas fa-building text-info"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 text-muted">{{ __('Departments') }}</h6>
                        <h4 class="mb-0">{{ $employees->pluck('department.name')->unique()->count() }}</h4>
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

    <!-- Search and Filter -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body py-3">
            <form action="{{ route('admin.employees.index') }}" method="GET">
                <div class="row align-items-center g-3">
                    <!-- Search Box -->
                    <div class="col-lg-4 col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-start-0" 
                                name="search" 
                                placeholder="{{ __('Search employees...') }}" 
                                value="{{ request('search') }}">
                        </div>
                    </div>
                    
                    <!-- Department Filter -->
                    <div class="col-lg-3 col-md-6">
                        <select class="form-select" name="department">
                            <option value="">{{ __('All Departments') }}</option>
                            @foreach($employees->pluck('department.name')->unique() as $department)
                                <option value="{{ $department }}" {{ request('department') == $department ? 'selected' : '' }}>
                                    {{ $department }}
                                </option>
                            @endforeach
                        </select>
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

    <!-- Main Content Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-3" width="60">{{ __('ID') }}</th>
                            <th>{{ __('Employee') }}</th>
                            <th>{{ __('Contact Info') }}</th>
                            <th>{{ __('Position') }}</th>
                            <th>{{ __('Department') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th class="text-end pe-3">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $employee)
                            <tr class="border-bottom">
                                <td class="ps-3">{{ $employee->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-placeholder me-3 bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            {{ strtoupper(substr($employee->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-medium">{{ $employee->name }}</div>
                                            <div class="small text-muted">ID: #{{ $employee->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <div><i class="fas fa-envelope text-muted me-2"></i>{{ $employee->email }}</div>
                                        @if($employee->phone)
                                            <div><i class="fas fa-phone text-muted me-2"></i>{{ $employee->phone }}</div>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $employee->position ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <i class="fas fa-building me-1"></i>{{ $employee->department->name ?? 'N/A' }}
                                    </span>
                                </td>
                                <td>
                                    @if($employee->status == 'active')
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
                                                <a href="{{ route('admin.employees.show', $employee->id) }}" class="dropdown-item">
                                                    <i class="fas fa-eye text-primary me-2"></i>{{ __('View') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.employees.edit', $employee->id) }}" class="dropdown-item">
                                                    <i class="fas fa-edit text-warning me-2"></i>{{ __('Edit') }}
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger" 
                                                            onclick="return confirm('{{ __('Are you sure you want to delete this employee?') }}');">
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
                                <td colspan="7" class="text-center py-5">
                                    <div class="py-4">
                                        <i class="fas fa-users text-muted" style="font-size: 3rem;"></i>
                                        <h5 class="mt-3">{{ __('No employees found') }}</h5>
                                        <p class="text-muted">{{ __('Add your first employee to get started') }}</p>
                                        <a href="{{ route('admin.employees.create') }}" class="btn btn-primary mt-2">
                                            <i class="fas fa-plus me-2"></i>{{ __('Add New Employee') }}
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
                    {{ __('Showing') }} {{ count($employees) }} {{ __('of') }} {{ count($employees) }} {{ __('employees') }}
                </div>
                <div>
                    {{-- {{ $employees->links() }} <!-- Pagination if needed --> --}}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Clean table styling */
    .table {
        --bs-table-hover-bg: rgba(0, 0, 0, 0.02);
    }
    
    /* Avatar styling */
    .avatar-placeholder {
        font-weight: 600;
    }
    
    /* General enhancements */
    .dropdown-menu {
        --bs-dropdown-min-width: 12rem;
    }
    
    /* Subtle hover effects */
    tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
</style>
@endsection