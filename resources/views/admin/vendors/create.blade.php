@extends('admin.index')


@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.vendors.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="business_name" class="form-label">{{__('Business Name')}}</label>
                    <input type="text" name="business_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">{{__('Email')}}</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="logo" class="form-label">{{__('Logo')}}</label>
                    <input type="file" name="logo" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="categories" class="form-label">{{__('Categories')}}</label>
                    <select name="categories[]" class="form-select" multiple>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="contact_person" class="form-label">{{__('Contact Person')}}</label>
                    <input type="text" name="contact_person" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{__('Create')}}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection