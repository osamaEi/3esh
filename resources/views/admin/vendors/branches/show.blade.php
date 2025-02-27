@extends('admin.index')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Branch Details</h2>
            <div>
                <a href="{{ route('admin.branches.index') }}" class="btn btn-secondary">Back to List</a>
                <a href="{{ route('admin.branches.edit', $branch->id) }}" class="btn btn-primary">Edit Branch</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <td>{{ $branch->id }}</td>
                        </tr>
                        <tr>
                            <th>Vendor</th>
                            <td>{{ $branch->vendor->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $branch->name }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $branch->address }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $branch->phone ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $branch->email ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Manager</th>
                            <td>{{ $branch->manager_name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($branch->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                                
                                @if($branch->is_approved)
                                    <span class="badge bg-info">Approved</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Opening Time</th>
                            <td>{{ $branch->opening_time ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Closing Time</th>
                            <td>{{ $branch->closing_time ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Working Days</th>
                            <td>
                                @if(isset($branch->working_days) && is_array($branch->working_days))
                                    {{ implode(', ', $branch->working_days) }}
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Branch Photo</h4>
                        </div>
                        <div class="card-body text-center">
                            @if($branch->photo)
                                <img src="{{ asset('storage/' . $branch->photo) }}" alt="{{ $branch->name }}" class="img-fluid img-thumbnail" style="max-height: 300px;">
                            @else
                                <div class="alert alert-info">
                                    No photo available
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    @if($branch->latitude && $branch->longitude)
                    <div class="card mt-3">
                        <div class="card-header">
                            <h4>Location</h4>
                        </div>
                        <div class="card-body">
                            <div id="map" style="height: 300px;"></div>
                        </div>
                    </div>
                    @endif
                    
                    @if($branch->notes)
                    <div class="card mt-3">
                        <div class="card-header">
                            <h4>Notes</h4>
                        </div>
                        <div class="card-body">
                            {{ $branch->notes }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if($branch->latitude && $branch->longitude)
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize map - This is a placeholder. You'll need to implement your mapping solution
        // For example with Google Maps or Leaflet.js
        const map = initMap('map');
        const branchLocation = {
            lat: {{ $branch->latitude }},
            lng: {{ $branch->longitude }}
        };
        addMarker(map, branchLocation);
    });
</script>
@endpush
@endif
@endsection
