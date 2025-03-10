@extends('admin.index')

@section('content')
<div class="container">
    <div class="card shadow-lg border-0 mt-4">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <h4><i class="fas fa-user"></i> {{__('User Details')}}</h4>
            <a href="{{ route('admin.users.index') }}" class="btn btn-light"><i class="fas fa-arrow-left"></i> {{__('Back to List')}}</a>
        </div>
        
        <div class="card-body">
            <div class="row">
                <!-- User Photo -->
                <div class="col-md-4 text-center">
                    @if($user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}" alt="User Photo" class="img-fluid rounded-circle shadow" width="180">
                    @else
                        <img src="{{ asset('images/default-user.png') }}" alt="Default Photo" class="img-fluid rounded-circle shadow" width="180">
                    @endif
                </div>

                <!-- User Info -->
                <div class="col-md-8">
                    <table class="table table-striped">
                        <tr>
                            <th><i class="fas fa-user"></i> {{__('Full Name')}}:</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-id-badge"></i> {{__('Position')}}:</th>
                            <td>{{ $user->position ?? 'Not specified' }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-envelope"></i> {{__('Email')}}:</th>
                            <td>{{ $user->email ?? 'Not provided' }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-phone"></i> {{__('Phone')}}:</th>
                            <td>{{ $user->phone ?? 'Not provided' }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-toggle-on"></i> {{__('Status')}}:</th>
                            <td>
                                @if($user->is_active)
                                    <span class="badge bg-success">{{__('Active')}}</span>
                                @else
                                    <span class="badge bg-danger">{{__('Inactive')}}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-ban"></i> {{__('Blocked')}}:</th>
                            <td>
                                @if($user->is_blocked)
                                    <span class="badge bg-danger">{{__('Blocked')}}</span>
                                @else
                                    <span class="badge bg-success">{{__('Not Blocked')}}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-calendar-check"></i> {{__('Created At')}}:</th>
                            <td>{{ $user->created_at->format('d M, Y') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="card-footer d-flex justify-content-end">
            <!-- Activate/Deactivate Buttons -->
            @if($user->is_active)
                <form action="{{ route('admin.users.deactivate', $user->id) }}" method="POST" class="me-2">
                    @csrf
                    @method('PUT') <!-- Method spoofing for PUT -->
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-toggle-off"></i> {{__('Deactivate')}}
                    </button>
                </form>
            @else
                <form action="{{ route('admin.users.activate', $user->id) }}" method="POST" class="me-2">
                    @csrf
                    @method('PUT') <!-- Method spoofing for PUT -->
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-toggle-on"></i> {{__('Activate')}}
                    </button>
                </form>
            @endif

            <!-- Block/Unblock Buttons -->
            @if($user->is_blocked)
                <form action="{{ route('admin.users.unblock', $user->id) }}" method="POST" class="me-2">
                    @csrf
                    @method('PUT') <!-- Method spoofing for PUT -->
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-unlock"></i> {{__('Unblock')}}
                    </button>
                </form>
            @else
                <form action="{{ route('admin.users.block', $user->id) }}" method="POST" class="me-2">
                    @csrf
                    @method('PUT') <!-- Method spoofing for PUT -->
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-ban"></i> {{__('Block')}}
                    </button>
                </form>
            @endif

            <!-- Edit Button -->
   

            
        </div>
    </div>
</div>
@endsection