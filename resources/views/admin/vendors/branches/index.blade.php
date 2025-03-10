@extends('admin.index')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>{{__('Branches')}}</h2>
            <a href="{{ route('admin.branches.create') }}" class="btn btn-primary">{{__('Add New Branch')}}</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{__('Vendor')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Address')}}</th>
                            <th>{{__('Phone')}}</th>
                            <th>{{__('Manager')}}</th>
                            <th>{{__('Actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($branches as $branch)
                            <tr>
                                <td>{{ $branch->id }}</td>
                                <td>{{ $branch->vendor->business_name ?? 'N/A' }}</td>
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
                                    
                   
                                </td>
                                <td>
                                        <a href="{{ route('admin.branches.show', $branch->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> {{__('View')}}
                                        </a>
                                        <a href="{{ route('admin.branches.edit', $branch->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i> {{__('Edit')}}
                                        </a>
                                        <form action="{{ route('admin.branches.destroy', $branch->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this branch?');" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i> {{__('Delete')}}
                                            </button>
                                        </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">{{__('No branches found')}}.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
            </div>
        </div>
    </div>
</div>
@endsection