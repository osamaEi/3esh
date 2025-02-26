@extends('admin.index')

@section('title', 'Create New Setting')

@section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-primary bg-gradient">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="text-white mb-0">
                            <i class="fas fa-plus-circle me-2"></i>{{__('Create New Setting')}}
                        </h4>
                       
                    </div>
                </div>
                <div class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-exclamation-triangle me-2"></i>Error!</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('settings.store') }}" method="POST" id="settingForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="key" class="form-label fw-bold">{{__('Setting Key')}} <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('key') is-invalid @enderror" 
                                       id="key" name="key" value="{{ old('key') }}" required 
                                       placeholder="Enter a unique key (e.g., site_title, mail_driver)">
                            </div>
                            @error('key')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="value_type" class="form-label fw-bold">{{__('Value')}}'</label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="value_type" id="value_type_text" value="text" checked>
                                <label class="btn btn-outline-primary" for="value_type_text">
                                    <i class="fas fa-font me-1"></i>{{__('Text')}}
                                </label>
                                <input type="radio" class="btn-check" name="value_type" id="value_type_image" value="image">
                                <label class="btn btn-outline-primary" for="value_type_image">
                                    <i class="fas fa-image me-1"></i>{{__('Image')}}
                                </label>
                            </div>
                        </div>

                        <div class="mb-4" id="text_value_container">
                            <label for="value" class="form-label fw-bold">{{__('Setting Value')}}</label>
                            <div class="input-group">
                                <textarea class="form-control @error('value') is-invalid @enderror" 
                                          id="value" name="value" rows="5" 
                                          placeholder="Enter the setting value">{{ old('value') }}</textarea>
                            </div>
                            @error('value')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 d-none" id="image_value_container">
                            <label for="image_value" class="form-label fw-bold">{{__('Setting')}}</label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control @error('image_value') is-invalid @enderror" 
                                       id="image_value" name="image_value" accept="image/*">
                            </div>
                            <div class="image-preview-container text-center p-3 border rounded bg-light d-none mb-2">
                                <img id="image_preview" src="#" alt="Preview" class="img-fluid img-thumbnail" style="max-height: 200px;">
                                <button type="button" class="btn btn-sm btn-danger mt-2" id="remove_image">
                                    <i class="fas fa-trash-alt me-1"></i>{{__('Remove')}}
                                </button>
                            </div>
                            @error('image_value')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4 text-end">
                            <button type="button" class="btn btn-secondary me-2" onclick="resetForm()">
                                <i class="fas fa-undo me-1"></i>{{__('Reset')}}
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>{{__('Save Setting')}}
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-light border-0">
             
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function resetForm() {
        document.getElementById('settingForm').reset();
        toggleValueType('text');
        document.querySelector('.image-preview-container').classList.add('d-none');
    }
    
    function toggleValueType(type) {
        if (type === 'text') {
            document.getElementById('text_value_container').classList.remove('d-none');
            document.getElementById('image_value_container').classList.add('d-none');
        } else if (type === 'image') {
            document.getElementById('text_value_container').classList.add('d-none');
            document.getElementById('image_value_container').classList.remove('d-none');
        }
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        // Auto format key to snake_case
        const keyInput = document.getElementById('key');
        keyInput.addEventListener('input', function() {
            // Convert spaces to underscores and lowercase
            this.value = this.value.replace(/\s+/g, '_').toLowerCase();
            // Remove special characters except underscore
            this.value = this.value.replace(/[^a-z0-9_]/g, '');
        });
        
        // Toggle between text and image value types
        document.querySelectorAll('input[name="value_type"]').forEach(input => {
            input.addEventListener('change', function() {
                toggleValueType(this.value);
            });
        });
        
        // Image preview
        const imageInput = document.getElementById('image_value');
        const imagePreview = document.getElementById('image_preview');
        const previewContainer = document.querySelector('.image-preview-container');
        
        imageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    previewContainer.classList.remove('d-none');
                }
                
                reader.readAsDataURL(this.files[0]);
            }
        });
        
        // Remove image
        document.getElementById('remove_image').addEventListener('click', function() {
            imageInput.value = '';
            previewContainer.classList.add('d-none');
        });
    });
</script>
@endsection