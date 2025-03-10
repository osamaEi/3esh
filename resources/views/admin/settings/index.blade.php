@extends('admin.index')

@section('title', 'Manage Settings')

@section('content')
<div class="container-fluid px-4">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-primary bg-gradient">
            <div class="d-flex justify-content-between align-items-center">
                {{-- <h4 class="text-white mb-0">
                    <i class="fas fa-cogs me-2"></i>{{__('System Settings')}}
                </h4> --}}
                <a href="{{ route('admin.settings.create') }}" class="btn btn-light">
                    <i class="fas fa-plus-circle me-1"></i>{{__('Add New Setting')}}
                </a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-striped" id="settingsTable">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">#</th>
                            <th width="30%">{{__('Key')}}</th>
                            <th width="45%">{{__('Value')}}</th>
                            <th width="20%" class="text-center">{{__('Actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($settings as $index => $setting)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <span class="badge bg-secondary text-white py-2 px-3">
                                        {{ $setting->key }}
                                    </span>
                                </td>
                                <td>
                                    @if(Str::startsWith($setting->value, 'image:'))
                                        @php
                                            $imagePath = Str::after($setting->value, 'image:');
                                        @endphp
                                        <div class="value-container">
                                            <span class="badge bg-info text-white mb-2">
                                                <i class="fas fa-image me-1"></i>{{__('Image')}}
                                            </span>
                                            <div class="image-thumbnail">
                                                <img src="{{ asset('storage/' . $imagePath) }}" 
                                                     alt="{{ $setting->key }}" 
                                                     class="img-thumbnail" 
                                                     style="max-height: 60px; max-width: 100px;">
                                                <button type="button" class="btn btn-sm btn-outline-info ms-2 view-full-image" 
                                                        data-bs-toggle="modal" data-bs-target="#imageModal" 
                                                        data-image="{{ asset('storage/' . $imagePath) }}" 
                                                        data-key="{{ $setting->key }}">
                                                    <i class="fas fa-search-plus"></i> {{__('View Larger')}}
                                                </button>
                                            </div>
                                        </div>
                                    @elseif(strlen($setting->value) > 100)
                                        <div class="value-container">
                                            <span class="badge bg-secondary text-white mb-2">
                                                <i class="fas fa-font me-1"></i>{{__('Text')}}
                                            </span>
                                            <div class="value-preview">{{ substr($setting->value, 0, 100) }}...</div>
                                            <button type="button" class="btn btn-sm btn-outline-info view-full-value" 
                                                    data-bs-toggle="modal" data-bs-target="#valueModal" 
                                                    data-value="{{ $setting->value }}" data-key="{{ $setting->key }}">
                                                <i class="fas fa-eye"></i> {{__('View Full')}}
                                            </button>
                                        </div>
                                    @else
                                        <span class="badge bg-secondary text-white mb-2">
                                            <i class="fas fa-font me-1"></i>{{__('Text')}}
                                        </span>
                                        <div>{{ $setting->value }}</div>
                                    @endif
                                </td>
                                <td class="text-center">
                                        <a href="{{ route('admin.settings.edit', $setting->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>{{__('Edit')}}
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal" data-id="{{ $setting->id }}" 
                                                data-key="{{ $setting->key }}">
                                            <i class="fas fa-trash-alt"></i> {{__('Delete')}}
                                        </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    <div class="alert alert-info mb-0">
                                        <i class="fas fa-info-circle me-2"></i>{{__('No settings found. Add your first setting now!')}}
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Value Preview Modal -->
<div class="modal fade" id="valueModal" tabindex="-1" aria-labelledby="valueModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="valueModalLabel">{{__('Text Setting Value')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 class="setting-key mb-3"></h6>
                <pre class="setting-value bg-light p-3 rounded"></pre>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Image Preview Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="imageModalLabel">{{__('Image Setting Value')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h6 class="setting-key mb-3"></h6>
                <div class="p-3 bg-light rounded">
                    <img class="img-fluid setting-image" src="" alt="Setting Image">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                <a href="#" class="btn btn-primary" id="downloadImageBtn" download>
                    <i class="fas fa-download me-1"></i>{{__('Download Image')}}
                </a>
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
                <p>{{__('Are you sure you want to delete the setting')}} <strong id="deleteKey"></strong>?</p>
                <p class="text-danger"><i class="fas fa-exclamation-triangle me-2"></i>{{__('This action cannot be undone!')}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Cancel')}}</button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{__('Delete')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
   
        // Handle text value modal
        const valueModal = document.getElementById('valueModal');
        valueModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const value = button.getAttribute('data-value');
            const key = button.getAttribute('data-key');
            
            valueModal.querySelector('.setting-key').textContent = key;
            valueModal.querySelector('.setting-value').textContent = value;
        });
        
        // Handle image modal
        const imageModal = document.getElementById('imageModal');
        imageModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const imageSrc = button.getAttribute('data-image');
            const key = button.getAttribute('data-key');
            
            imageModal.querySelector('.setting-key').textContent = key;
            imageModal.querySelector('.setting-image').src = imageSrc;
            
            // Set download link
            const downloadBtn = document.getElementById('downloadImageBtn');
            downloadBtn.href = imageSrc;
            downloadBtn.download = key + '.jpg'; // Default extension
        });

        // Handle delete modal
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const key = button.getAttribute('data-key');
            
            document.getElementById('deleteKey').textContent = key;
            document.getElementById('deleteForm').action = `{{ route('admin.settings.destroy', '') }}/${id}`;
        });
    });
</script>
@endsection