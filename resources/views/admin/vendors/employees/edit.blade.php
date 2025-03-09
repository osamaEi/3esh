@extends('admin.index')

@section('content')
<div class="container">
    <div class="card shadow-lg border-0 mt-4">
        <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
            <h4><i class="fas fa-edit"></i> Edit Employee</h4>
            <a href="{{ route('admin.employees.index') }}" class="btn btn-light"><i class="fas fa-arrow-left"></i> Back to List</a>
        </div>

        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Left Side -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label"><i class="fas fa-user"></i> Full Name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $employee->name) }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $employee->email) }}">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label"><i class="fas fa-phone"></i> Phone</label>
                            <input type="tel" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $employee->phone) }}">
                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label"><i class="fas fa-lock"></i> Password (Leave blank to keep current)</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- Right Side -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="vendor_id" class="form-label"><i class="fas fa-store"></i> Vendor</label>
                            <select name="vendor_id" id="vendor_id" class="form-control @error('vendor_id') is-invalid @enderror">
                                <option value="">Select Vendor</option>
                                @foreach($vendors as $vendor)
                                    <option value="{{ $vendor->id }}" {{ old('vendor_id', $employee->vendor_id) == $vendor->id ? 'selected' : '' }}>
                                        {{ $vendor->business_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('vendor_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
{{-- 
                        <div class="mb-3">
                            <label for="branch_id" class="form-label"><i class="fas fa-map-marker-alt"></i> Branch</label>
                            <select name="branch_id" id="branch_id" class="form-control @error('branch_id') is-invalid @enderror">
                                <option value="">Select Branch</option>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}" {{ old('branch_id', $employee->branch_id) == $branch->id ? 'selected' : '' }}>
                                        {{ $branch->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('branch_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div> --}}

                        <div class="mb-3">
                            <label for="position" class="form-label"><i class="fas fa-id-badge"></i> Position</label>
                            <input type="text" name="position" id="position" class="form-control @error('position') is-invalid @enderror" value="{{ old('position', $employee->position) }}">
                            @error('position') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="photo" class="form-label"><i class="fas fa-camera"></i> Profile Photo</label>
                            <input type="file" name="photo" id="photo" class="form-control @error('photo') is-invalid @enderror">
                            @error('photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            @if($employee->photo)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $employee->photo) }}" alt="Profile Photo" class="img-thumbnail" width="100">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
