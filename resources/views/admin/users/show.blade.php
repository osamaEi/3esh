@extends('admin.index')

@section('content')
<div class="container">
    <div class="card shadow-lg border-0 mt-4">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <h4><i class="fas fa-user"></i> User Details</h4>
            <a href="{{ route('admin.users.index') }}" class="btn btn-light"><i class="fas fa-arrow-left"></i> Back to List</a>
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
                            <th><i class="fas fa-user"></i> Full Name:</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-id-badge"></i> Position:</th>
                            <td>{{ $user->position ?? 'Not specified' }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-envelope"></i> Email:</th>
                            <td>{{ $user->email ?? 'Not provided' }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-phone"></i> Phone:</th>
                            <td>{{ $user->phone ?? 'Not provided' }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-toggle-on"></i> Status:</th>
                            <td>
                                @if($user->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-ban"></i> Blocked:</th>
                            <td>
                                @if($user->is_blocked)
                                    <span class="badge bg-danger">Blocked</span>
                                @else
                                    <span class="badge bg-success">Not Blocked</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-calendar-check"></i> Created At:</th>
                            <td>{{ $user->created_at->format('d M, Y') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="card-footer d-flex justify-content-end">
            <!-- Activate/Deactivate Buttons -->
            @if($user->is_active)
                <form action="{{ route('users.deactivate', $user->id) }}" method="POST" class="me-2">
                    @csrf
                    @method('PUT') <!-- Method spoofing for PUT -->
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-toggle-off"></i> Deactivate
                    </button>
                </form>
            @else
                <form action="{{ route('users.activate', $user->id) }}" method="POST" class="me-2">
                    @csrf
                    @method('PUT') <!-- Method spoofing for PUT -->
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-toggle-on"></i> Activate
                    </button>
                </form>
            @endif

            <!-- Block/Unblock Buttons -->
            @if($user->is_blocked)
                <form action="{{ route('users.unblock', $user->id) }}" method="POST" class="me-2">
                    @csrf
                    @method('PUT') <!-- Method spoofing for PUT -->
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-unlock"></i> Unblock
                    </button>
                </form>
            @else
                <form action="{{ route('users.block', $user->id) }}" method="POST" class="me-2">
                    @csrf
                    @method('PUT') <!-- Method spoofing for PUT -->
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-ban"></i> Block
                    </button>
                </form>
            @endif

            <!-- Edit Button -->
   

            
        </div>
    </div>
</div>
@endsection