@extends('admin.index')

@section('title', 'Edit Setting')

@section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-primary bg-gradient">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="text-white mb-0">
                            <i class="fas fa-edit me-2"></i>{{__('Edit Setting')}}
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


                    <form action="{{ route('settings.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="key" class="form-label fw-bold">{{__('Setting Key')}} <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('key') is-invalid @enderror" 
                                       id="key" name="key" value="{{ old('key', $setting->key) }}" required>
                            </div>
                            @error('key')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="value_type" class="form-label fw-bold">{{__('Value Type')}}</label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="value_type" id="value_type_text" value="text" 
                                       {{ !Str::startsWith($setting->value, 'image:') ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary" for="value_type_text">
                                    <i class="fas fa-font me-1"></i>{{__('Text')}}
                                </label>
                                <input type="radio" class="btn-check" name="value_type" id="value_type_image" value="image"
                                       {{ Str::startsWith($setting->value, 'image:') ? 'checked' : '' }}>
                                <label class="btn btn-outline-primary" for="value_type_image">
                                    <i class="fas fa-image me-1"></i>{{__('Image')}}
                                </label>
                            </div>
                        </div>

                        <div class="mb-4 {{ Str::startsWith($setting->value, 'image:') ? 'd-none' : '' }}" id="text_value_container">
                            <label for="value" class="form-label fw-bold">{{__('Setting Value')}}</label>
                            <div class="input-group">
                                <textarea class="form-control @error('value') is-invalid @enderror" 
                                          id="value" name="value" rows="6">{{ old('value', !Str::startsWith($setting->value, 'image:') ? $setting->value : '') }}</textarea>
                            </div>
                            @error('value')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 {{ !Str::startsWith($setting->value, 'image:') ? 'd-none' : '' }}" id="image_value_container">
                            <label for="image_value" class="form-label fw-bold">{{__('Setting Value')}}</label>
                            
                            @if(Str::startsWith($setting->value, 'image:'))
                                @php
                                    $imagePath = Str::after($setting->value, 'image:');
                                @endphp
                                <div class="current-image mb-3">
                                    <p class="mb-2"><strong>{{__('Current Image')}}</strong></p>
                                    <div class="text-center p-3 border rounded bg-light mb-2">
                                        <img src="{{ asset('storage/' . $imagePath) }}" 
                                             alt="{{ $setting->key }}" 
                                             class="img-fluid img-thumbnail" 
                                             style="max-height: 200px;">
                                    </div>
                                </div>
                            @endif
                            
                            <div class="input-group mb-3">
                                <input type="file" class="form-control @error('image_value') is-invalid @enderror" 
                                       id="image_value" name="image_value" accept="image/*">
                                <input type="hidden" name="current_image" value="{{ Str::startsWith($setting->value, 'image:') ? Str::after($setting->value, 'image:') : '' }}">
                            </div>
                            
                            <div class="image-preview-container text-center p-3 border rounded bg-light d-none mb-2">
                                <img id="image_preview" src="#" alt="New Preview" class="img-fluid img-thumbnail" style="max-height: 200px;">
                                <button type="button" class="btn btn-sm btn-danger mt-2" id="remove_image">
                                    <i class="fas fa-trash-alt me-1"></i>{{__('Remove')}}
                                </button>
                            </div>
                            
                            @error('image_value')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="fas fa-trash-alt me-1"></i>{{__('Delete')}}
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>{{__('Update Setting')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">{{__('Confirm Delete')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the setting <strong>{{ $setting->key }}</strong>?</p>
                <p class="text-danger"><i class="fas fa-exclamation-triangle me-2"></i>This action cannot be undone!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('settings.destroy', $setting->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
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
        
        // Auto resize textarea based on content
        const valueTextarea = document.getElementById('value');
        function resizeTextarea() {
            valueTextarea.style.height = 'auto';
            valueTextarea.style.height = valueTextarea.scrollHeight + 'px';
        }
        
        valueTextarea.addEventListener('input', resizeTextarea);
        // Initial resize
        resizeTextarea();
        
        // Toggle between text and image value types
        document.querySelectorAll('input[name="value_type"]').forEach(input => {
            input.addEventListener('change', function() {
                toggleValueType(this.value);
            });
        });
        
        // Image preview for new uploads
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
        
        // Remove new image
        document.getElementById('remove_image').addEventListener('click', function() {
            imageInput.value = '';
            previewContainer.classList.add('d-none');
        });
    });
</script>
@endsection