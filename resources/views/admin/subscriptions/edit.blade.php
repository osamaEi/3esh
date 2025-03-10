@extends('admin.index')

@section('content')
<div class="container-fluid">
    <div class="card shadow-lg">
        <div class="card-header bg-secondary text-white">
            <h4 class="mt-5"><i class="fas fa-edit"></i> {{__('Edit Subscription Plan')}}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.subscriptions.update', $subscription->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">{{__('Name')}}</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $subscription->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">{{__('Price')}}</label>
                    <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ $subscription->price }}" required>
                </div>
                <div class="mb-3">
                    <label for="duration_days" class="form-label">{{__('Duration (Days)')}}</label>
                    <input type="number" name="duration_days" id="duration_days" class="form-control" value="{{ $subscription->duration_days }}" required>
                </div>
                <div class="mb-3">
                    <label for="features" class="form-label">{{__('Features')}}</label>
                    <textarea name="features" id="features" class="form-control" rows="3">{{ $subscription->features }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">{{__('Photo')}}</label>
                    <input type="file" name="photo" id="photo" class="form-control">
                    @if($subscription->photo)
                        <img src="{{ asset('storage/' . $subscription->photo) }}" alt="Subscription Photo" class="img-fluid mt-2" width="150">
                    @endif
                </div>
                <div class="mb-3">
                    <label for="is_active" class="form-label">{{__('Status')}}</label>
                    <select name="is_active" id="is_active" class="form-control">
                        <option value="1" {{ $subscription->is_active ? 'selected' : '' }}>{{__('Active')}}</option>
                        <option value="0" {{ !$subscription->is_active ? 'selected' : '' }}>{{__('Inactive')}}</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{__('Update')}}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection