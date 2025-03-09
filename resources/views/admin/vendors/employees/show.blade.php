@extends('admin.index')

@section('content')
<div class="container">
    <div class="card shadow-lg border-0 mt-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4><i class="fas fa-user"></i> Employee Details</h4>
            <a href="{{ route('admin.employees.index') }}" class="btn btn-light"><i class="fas fa-arrow-left"></i> Back to List</a>
        </div>
        
        <div class="card-body">
            <div class="row">
                <!-- Employee Photo -->
                <div class="col-md-4 text-center">
                    @if($employee->photo)
                        <img src="{{ asset('storage/' . $employee->photo) }}" alt="Employee Photo" class="img-fluid rounded-circle shadow" width="180">
                    @else
                        <img src="{{ asset('images/default-user.png') }}" alt="Default Photo" class="img-fluid rounded-circle shadow" width="180">
                    @endif
                </div>

                <!-- Employee Info -->
                <div class="col-md-8">
                    <table class="table table-striped">
                        <tr>
                            <th><i class="fas fa-user"></i> Full Name:</th>
                            <td>{{ $employee->name }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-id-badge"></i> Position:</th>
                            <td>{{ $employee->position ?? 'Not specified' }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-envelope"></i> Email:</th>
                            <td>{{ $employee->email ?? 'Not provided' }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-phone"></i> Phone:</th>
                            <td>{{ $employee->phone ?? 'Not provided' }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-store"></i> Vendor:</th>
                            <td>{{ $employee->vendor->business_name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-map-marker-alt"></i> Branch:</th>
                            <td>{{ $employee->branch->name ?? 'Not assigned' }}</td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-calendar-check"></i> Created At:</th>
                            <td>{{ $employee->created_at->format('d M, Y') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="card-footer d-flex justify-content-end">
            <a href="{{ route('admin.employees.edit', $employee->id) }}" class="btn btn-warning me-2">
                <i class="fas fa-edit fa-sm"></i> Edit
            </a>
            <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this employee?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
