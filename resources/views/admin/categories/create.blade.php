@extends('admin.index')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header text-white">
            <h2 class="mt-6 text-center">{{ __('Create New Category') }}</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">{{ __('Description') }}</label>
                    <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="parent_id" class="form-label">{{ __('Parent Category') }}</label>
                    <select name="parent_id" id="parent_id" class="form-select">
                        <option value="">{{ __('None') }}</option>
                        @foreach($parentCategories as $parent)
                            <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="is_active" class="form-label">{{ __('Status') }}</label>
                    <select name="is_active" id="is_active" class="form-select">
                        <option value="1">{{ __('Active') }}</option>
                        <option value="0">{{ __('Inactive') }}</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">{{ __('Photo') }}</label>
                    <div class="custom-file">
                        <input type="file" name="photo" id="photo" class="custom-file-input d-none" onchange="updateFileName(this)">
                        <label for="photo" class="btn btn-primary">{{ __('Choose File') }}</label>
                        <span id="file-name" class="ms-2">{{ __('No file chosen') }}</span>
                    </div>
                </div>
                

                <div class="d-grid">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> {{ __('Create') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function updateFileName(input) {
        let fileName = input.files.length > 0 ? input.files[0].name : "{{ __('No file chosen') }}";
        document.getElementById('file-name').textContent = fileName;
    }
</script>

@endsection
