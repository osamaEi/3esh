@extends('admin.index')

@section('content')
<div class="container mt-5">
    <a href="{{ route('admin.vendors.create') }}" class="btn btn-primary mb-4">
        <i class="fas fa-plus"></i> {{__('Create Vendor')}}
    </a>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">{{__('Logo')}}</th>

                            <th scope="col">{{__('Business Name')}}</th>
                            <th scope="col">{{__('Status')}}</th>
                            <th scope="col">{{__('Actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vendors as $vendor)
                        <tr>
                            <th scope="row">{{ $vendor->id }}</th>
                            <td> <img src="{{ asset('storage/'.$vendor->logo) }}" alt="Logo" class="img-fluid rounded">

                            <td>{{ $vendor->business_name }}</td>
                            <td>
                                @if ($vendor->blocked)
                                    <span class="badge bg-danger">{{__('Blocked')}}</span>
                                @elseif ($vendor->is_approved)
                                    <span class="badge bg-success">{{__('Approved')}}</span>
                                @else
                                    <span class="badge bg-warning">{{__('Pending')}}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.vendors.show', $vendor->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> {{__('View')}}
                                </a>
                                <a href="{{ route('admin.vendors.edit', $vendor->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> {{__('Edit')}}
                                </a>
                                <form action="{{ route('admin.vendors.destroy', $vendor->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i> {{__('Delete')}}
                                    </button>
                                </form>
                                @if (!$vendor->is_approved)
                                    <form action="{{ route('admin.vendors.approve', $vendor->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-check"></i> {{__('Approve')}}
                                        </button>
                                    </form>
                                @endif
                                @if (!$vendor->blocked)
                                    <form action="{{ route('admin.vendors.block', $vendor->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-ban"></i> {{__('Block')}}
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.vendors.unblock', $vendor->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-warning">
                                            <i class="fas fa-check-circle"></i> {{__('Unblock')}}
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection