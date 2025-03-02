@extends('admin.index')


@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Edit Branch</h2>
            <div>
                <a href="{{ route('admin.branches.index') }}" class="btn btn-secondary">{{__('Back to List')}}</a>
                <a href="{{ route('admin.branches.show', $branch->id) }}" class="btn btn-info">{{__('View Branch')}}</a>
            </div>
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

            <form action="{{ route('admin.branches.update', $branch->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="vendor_id" class="form-label">Vendor <span class="text-danger">*</span></label>
                            <select name="vendor_id" id="vendor_id" class="form-control @error('vendor_id') is-invalid @enderror" required>
                                <option value="">{{__('Select Vendor')}}</option>
                                @foreach($vendors as $vendor)
                                    <option value="{{ $vendor->id }}" {{ (old('vendor_id', $branch->vendor_id) == $vendor->id) ? 'selected' : '' }}>
                                        {{ $vendor->business_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('vendor_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">{{__('Branch Name')}} <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $branch->name) }}" required maxlength="255">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">{{__('Address')}} <span class="text-danger">*</span></label>
                            <textarea name="address" id="address" rows="3" class="form-control @error('address') is-invalid @enderror" required>{{ old('address', $branch->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="latitude" class="form-label">{{__('Latitude')}}</label>
                                    <input type="number" step="any" name="latitude" id="latitude" class="form-control @error('latitude') is-invalid @enderror" value="{{ old('latitude', $branch->latitude) }}">
                                    @error('latitude')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="longitude" class="form-label">{{__('Longitude')}}</label>
                                    <input type="number" step="any" name="longitude" id="longitude" class="form-control @error('longitude') is-invalid @enderror" value="{{ old('longitude', $branch->longitude) }}">
                                    @error('longitude')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">{{__('Phone')}}</label>
                            <input type="tel" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $branch->phone) }}" maxlength="30">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{__('Email')}}</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $branch->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="manager_name" class="form-label">{{__('Manager Name')}}</label>
                            <input type="text" name="manager_name" id="manager_name" class="form-control @error('manager_name') is-invalid @enderror" value="{{ old('manager_name', $branch->manager_name) }}" maxlength="255">
                            @error('manager_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="photo" class="form-label">{{__('Branch Photo')}} (JPG, JPEG, PNG, max 2MB)</label>
                            @if($branch->photo)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $branch->photo) }}" alt="{{ $branch->name }}" class="img-thumbnail" style="max-height: 100px;">
                                </div>
                            @endif
                            <input type="file" name="photo" id="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/jpeg,image/jpg,image/png">
                            <small class="form-text text-muted">Leave empty to keep the current photo.</small>
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="opening_time" class="form-label">{{__('Opening Time')}} (HH:MM)</label>
                                    <input type="time" name="opening_time" id="opening_time" class="form-control @error('opening_time') is-invalid @enderror" 
                                        value="{{ old('opening_time', $branch->opening_time ? date('H:i', strtotime($branch->opening_time)) : '') }}">
                                    <small class="form-text text-muted">Format: 24-hour time (e.g., 09:00)</small>
                                    @error('opening_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="closing_time" class="form-label">{{__('Closing Time')}} (HH:MM)</label>
                                    <input type="time" name="closing_time" id="closing_time" class="form-control @error('closing_time') is-invalid @enderror" 
                                        value="{{ old('closing_time', $branch->closing_time ? date('H:i', strtotime($branch->closing_time)) : '') }}">
                                    <small class="form-text text-muted">Format: 24-hour time (e.g., 17:00)</small>
                                    @error('closing_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{__('Working Days')}}</label>
                            <div class="d-flex flex-wrap">
                                @php
                                    // Decode working days if it's a JSON string
                                    $workingDays = $branch->working_days ?? [];
                                    if (is_string($workingDays)) {
                                        $workingDays = json_decode($workingDays, true) ?? [];
                                    }
                                @endphp
                                
                                @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                    <div class="form-check me-3 mb-2">
                                        <input class="form-check-input" type="checkbox" name="working_days[]" id="day-{{ $loop->index }}" value="{{ $day }}"
                                            {{ is_array(old('working_days', $workingDays)) && in_array($day, old('working_days', $workingDays)) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="day-{{ $loop->index }}">
                                            {{ $day }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('working_days')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">{{__('Notes')}}</label>
                            <textarea name="notes" id="notes" rows="3" class="form-control @error('notes') is-invalid @enderror">{{ old('notes', $branch->notes) }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_approved" id="is_approved" value="1" {{ old('is_approved', $branch->is_approved) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_approved">
                                        {{__('Approved')}}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $branch->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        {{__('Active')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">{{__('Update Branch')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Optional: You can add JavaScript for location picking with a map here
</script>
@endpush