@extends('admin.index')
@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4 style="margin-top: 25px;">{{__('Vendor Details')}}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong> {{__('Business Name')}}:</strong> {{ $vendor->business_name }}</p>
                    <p><strong> {{__('Email')}}:</strong> {{ $vendor->email }}</p>
                    <p><strong> {{__('Contact Person')}}:</strong> {{ $vendor->contact_person }}</p>
                    <p><strong> {{__('Status')}}:</strong>
                        @if ($vendor->blocked)
                            <span class="badge bg-danger"> {{__('Blocked')}}</span>
                        @elseif ($vendor->is_approved)
                            <span class="badge bg-success"> {{__('Approved')}}</span>
                        @else
                            <span class="badge bg-warning"> {{__('Pending')}}</span>
                        @endif
                    </p>
                </div>
                <div class="col-md-6">
                    @if ($vendor->logo)
                        <img src="{{ asset('storage/'.$vendor->logo) }}" alt="Logo" class="img-fluid rounded mb-3" style="max-height: 150px;">
                    @endif
                    @if ($vendor->photo)
                        <img src="{{ asset('storage/'.$vendor->photo) }}" alt="Photo" class="img-fluid rounded" style="max-height: 150px;">
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Branches Section -->
    <div class="card shadow-sm mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>{{ __('Branches') }}</h4>
            <div class="d-flex gap-2"> 
                <a href="{{ route('admin.branches.create', ['vendor_id' => $vendor->id]) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> {{ __('Add Branch') }}
                </a>
                <a href="{{ route('admin.employees.create', ['vendor_id' => $vendor->id]) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> {{ __('Add Employee') }}
                </a>
            </div>
        </div>
        
        <div class="card-body">
            @if($vendor->branches->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Address')}}</th>
                                <th>{{__('Phone')}}</th>
                                <th>{{__('Manager')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vendor->branches as $branch)
                                <tr>
                                    <td>{{ $branch->id }}</td>
                                    <td>{{ $branch->name }}</td>
                                    <td>{{ $branch->address }}</td>
                                    <td>{{ $branch->phone ?? 'N/A' }}</td>
                                    <td>{{ $branch->manager_name ?? 'N/A' }}</td>
                                    <td>
                                        @if($branch->is_active)
                                            <span class="badge bg-success">{{__('Active')}}</span>
                                        @else
                                            <span class="badge bg-danger">{{__('Inactive')}}</span>
                                        @endif
                                        
                                        @if($branch->is_approved)
                                            <span class="badge bg-info">{{__('Approved')}}</span>
                                        @else
                                            <span class="badge bg-warning">{{__('Pending')}}</span>
                                        @endif
                                    </td>
                                    <td>
                                            <a href="{{ route('admin.branches.show', $branch->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.branches.edit', $branch->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.branches.destroy', $branch->id) }}" method="POST" onsubmit="return confirm('{{__('Are you sure you want to delete this branch?')}}');" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    {{__('No branches found for this vendor.')}}
                </div>
            @endif
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.vendors.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> {{__('Back')}}
        </a>
    </div>
</div>
@endsection