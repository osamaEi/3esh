@extends('admin.index')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header  text-white">
            <h2 class="mt-6 text-center">{{ __('Edit Category') }}</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">{{ __('Description') }}</label>
                    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $category->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="parent_id" class="form-label">{{ __('Parent Category') }}</label>
                    <select name="parent_id" id="parent_id" class="form-select">
                        <option value="">{{ __('None') }}</option>
                        @foreach($parentCategories as $parent)
                            <option value="{{ $parent->id }}" {{ $parent->id == $category->parent_id ? 'selected' : '' }}>
                                {{ $parent->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="is_active" class="form-label">{{ __('Status') }}</label>
                    <select name="is_active" id="is_active" class="form-select">
                        <option value="1" {{ $category->is_active ? 'selected' : '' }}>{{ __('Active') }}</option>
                        <option value="0" {{ !$category->is_active ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">{{ __('Photo') }}</label>
                    <input type="file" name="photo" id="photo" class="form-control">
                    @if($category->photo)
                        <div class="mt-3">
                            <img src="{{ asset('storage/' . $category->photo) }}" alt="{{ $category->name }}" class="img-fluid rounded" width="150">
                        </div>
                    @endif
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> {{ __('Update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
