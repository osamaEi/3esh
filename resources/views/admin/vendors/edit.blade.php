@extends('admin.index')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('vendors.update', $vendor->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="business_name" class="form-label">{{ __('Business Name') }}</label>
                    <input type="text" name="business_name" class="form-control" value="{{ old('business_name', $vendor->business_name) }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $vendor->email) }}" required>
                </div>
                <div class="mb-3">
                    <label for="logo" class="form-label">{{ __('Logo') }}</label>
                    <input type="file" name="logo" class="form-control">
                    @if ($vendor->logo)
                        <img src="{{ asset('storage/'.$vendor->logo) }}" alt="{{ $vendor->business_name }}" class="mt-2" style="max-height: 100px;">
                    @endif
                </div>
                <div class="mb-3">
                    <label for="categories" class="form-label">{{ __('Categories') }}</label>
                    <select name="categories[]" class="form-select" multiple>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" 
                                {{ in_array($category->id, $vendor->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="contact_person" class="form-label">{{ __('Contact Person') }}</label>
                    <input type="text" name="contact_person" class="form-control" value="{{ old('contact_person', $vendor->contact_person) }}">
                </div>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> {{ __('Update') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
