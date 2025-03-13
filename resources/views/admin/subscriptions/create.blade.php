@extends('admin.index')
@section('content')
<div class="container-fluid">
    <div class="card shadow-lg">
        <div class="card-header bg-secondary text-white">
            <h4 class="mt-5"><i class="fas fa-plus"></i> {{__('Create New Subscription Plan')}}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.subscriptions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">{{__('Name')}}</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">{{__('Price')}}</label>
                    <input type="number" name="price" id="price" class="form-control" step="0.01" required>
                </div>
                <div class="mb-3">
                    <label for="duration_days" class="form-label">{{__('Duration')}}</label>
                    <input type="number" name="duration_days" id="duration_days" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="features" class="form-label">{{__('Features')}}</label>
                    <textarea name="features" id="features" class="form-control" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">{{__('Photo')}}</label>
                    <input type="file" name="photo" id="photo" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="vendors" class="form-label">{{__('Vendors')}}</label>
                    <select name="vendor_ids[]" id="vendors" class="form-control select2" multiple>
                        @foreach($vendors as $vendor)
                            <option value="{{ $vendor->id }}">{{ $vendor->business_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="is_active" class="form-label">{{__('Status')}}</label>
                    <select name="is_active" id="is_active" class="form-control">
                        <option value="1">{{__('Active')}}</option>
                        <option value="0">{{__('Inactive')}}</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{__('Create')}}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endpush