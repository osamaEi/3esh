@extends('admin.index')

@section('content')
<div class="container-fluid">
    <div class="card shadow-lg">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="fas fa-list"></i> {{__('Subscription Plans')}}</h4>
            <a href="{{ route('admin.subscriptions.create') }}" class="btn btn-light">
                <i class="fas fa-plus"></i> {{__('Create New')}}
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Price')}}</th>
                        <th>{{__('Duration (Days)')}}</th>
                        <th>{{__('Status')}}</th>
                        <th>{{__('Actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subscriptions as $subscription)
                        <tr>
                            <td>{{ $subscription->id }}</td>
                            <td>{{ $subscription->name }}</td>
                            <td>${{ number_format($subscription->price, 2) }}</td>
                            <td>{{ $subscription->duration_days }}</td>
                            <td>
                                @if($subscription->is_active)
                                    <span class="badge bg-success">{{__('Active')}}</span>
                                @else
                                    <span class="badge bg-danger">{{__('Inactive')}}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.subscriptions.show', $subscription->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> {{__('View')}}
                                </a>
                                <a href="{{ route('admin.subscriptions.edit', $subscription->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> {{__('Edit')}}
                                </a>
                                <form action="{{ route('admin.subscriptions.destroy', $subscription->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this subscription?')">
                                        <i class="fas fa-trash"></i> {{__('Delete')}}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection