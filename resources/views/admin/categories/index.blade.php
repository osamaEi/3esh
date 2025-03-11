@extends('admin.index')
@section('title', 'Manage Categories')
@section('content')
<div class="container-fluid px-4">
    <!-- Premium Breadcrumb -->
    <div class="bg-gradient-to-r from-primary to-primary-light p-3 rounded-lg mb-4 shadow-md border-start border-4 border-primary">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none hover-opacity">
                        <i class="fas fa-home"></i> {{__('Dashboard')}}
                    </a>
                </li>
                <li class="breadcrumb-item active text-white" aria-current="page">
                    <i class="fas fa-folder"></i> {{__('Categories')}}
                </li>
            </ol>
        </nav>
    </div>

    <!-- Animated Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-start border-4 border-success animate__animated animate__fadeInDown" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Stats Cards Row -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 bg-primary bg-opacity-10 text-primary h-100 shadow-sm hover-shadow transition-300">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-primary fw-bold mb-0">{{__('Total Categories')}}</h6>
                            <h2 class="my-2 fw-bold">{{ $categories->total() }}</h2>
                            <p class="mb-0 text-muted small">{{__('All categories in the system')}}</p>
                        </div>
                        <div class="icon-box bg-primary text-white rounded-circle p-3">
                            <i class="fas fa-folder fa-fw"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 bg-success bg-opacity-10 text-success h-100 shadow-sm hover-shadow transition-300">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-success fw-bold mb-0">{{__('Active Categories')}}</h6>
                            <h2 class="my-2 fw-bold">{{ $categories->where('is_active', true)->count() }}</h2>
                            <p class="mb-0 text-muted small">{{__('Categories visible to users')}}</p>
                        </div>
                        <div class="icon-box bg-success text-white rounded-circle p-3">
                            <i class="fas fa-check-circle fa-fw"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 bg-danger bg-opacity-10 text-danger h-100 shadow-sm hover-shadow transition-300">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-danger fw-bold mb-0">{{__('Inactive Categories')}}</h6>
                            <h2 class="my-2 fw-bold">{{ $categories->where('is_active', false)->count() }}</h2>
                            <p class="mb-0 text-muted small">{{__('Hidden from users')}}</p>
                        </div>
                        <div class="icon-box bg-danger text-white rounded-circle p-3">
                            <i class="fas fa-ban fa-fw"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 bg-info bg-opacity-10 text-info h-100 shadow-sm hover-shadow transition-300">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-info fw-bold mb-0">{{__('Root Categories')}}</h6>
                            <h2 class="my-2 fw-bold">{{ $categories->whereNull('parent_id')->count() }}</h2>
                            <p class="mb-0 text-muted small">{{__('Top-level categories')}}</p>
                        </div>
                        <div class="icon-box bg-info text-white rounded-circle p-3">
                            <i class="fas fa-sitemap fa-fw"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filter Row -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('admin.categories.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="{{__('Search categories...')}}" value="{{ request()->search }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select" name="status">
                        <option value="">{{__('All Statuses')}}</option>
                        <option value="1" {{ request()->status == '1' ? 'selected' : '' }}>{{__('Active')}}</option>
                        <option value="0" {{ request()->status == '0' ? 'selected' : '' }}>{{__('Inactive')}}</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" name="parent">
                        <option value="">{{__('All Levels')}}</option>
                        <option value="root" {{ request()->parent == 'root' ? 'selected' : '' }}>{{__('Root Categories')}}</option>
                        <option value="child" {{ request()->parent == 'child' ? 'selected' : '' }}>{{__('Child Categories')}}</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter me-1"></i> {{__('Filter')}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Main Card -->
    <div class="card shadow-lg border-0 mb-4 overflow-hidden">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0 text-primary">
                <i class="fas fa-folder me-2"></i>{{ __('All Categories') }}
            </h5>
            <div>
                <button type="button" class="btn btn-outline-secondary me-2" data-bs-toggle="modal" data-bs-target="#importModal">
                    <i class="fas fa-file-import me-1"></i> {{ __('Import') }}
                </button>
            
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> {{ __('Create New') }}
                </a>
                <a href="{{ route('admin.categories.tree') }}" class="btn btn-info ms-2">
                    <i class="fas fa-sitemap me-1"></i> {{ __('View Tree') }}
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-3" width="60">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="selectAll">
                                </div>
                            </th>
                            <th width="100">{{ __('Photo') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Description') }}</th>
                            <th>{{ __('Parent') }}</th>
                            <th>{{ __('Products') }}</th>
                            <th width="100">{{ __('Status') }}</th>
                            <th class="text-end pe-3" width="180">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr class="hover-shadow-sm transition-150">
                                <td class="ps-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $category->id }}" name="selected[]">
                                    </div>
                                </td>
                                <td>
                                    @if($category->photo)
                                        <div class="category-image-container">
                                            <img src="{{ asset('storage/' . $category->photo) }}" alt="{{ $category->name }}" 
                                                class="rounded-3 img-thumbnail" width="60" height="60" style="object-fit: cover;">
                                            <div class="category-image-overlay">
                                                <a href="{{ asset('storage/' . $category->photo) }}" data-lightbox="category-{{ $category->id }}" class="category-image-action">
                                                    <i class="fas fa-search-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center rounded-3" 
                                            style="width: 60px; height: 60px;">
                                            <i class="fas fa-image text-secondary"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-medium">
                                    <div>{{ $category->name }}</div>
                                    <div class="small text-muted">ID: {{ $category->id }}</div>
                                </td>
                                <td>
                                    <span class="text-muted d-inline-block text-truncate" style="max-width: 250px;">
                                        {{ $category->description ?: __('No description') }}
                                    </span>
                                </td>
                                <td>
                                    @if($category->parent_id)
                                        <span class="badge bg-light text-dark border">
                                            <i class="fas fa-folder-open me-1"></i>{{ $category->parent->name }}
                                        </span>
                                    @else
                                        <span class="badge bg-info bg-opacity-10 text-info">{{ __('Root Category') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ $category->products_count ?? 0 }}</span>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input status-toggle" 
                                               type="checkbox" role="switch" 
                                               id="status{{ $category->id }}" 
                                               data-id="{{ $category->id }}"
                                               {{ $category->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status{{ $category->id }}">
                                            <span class="badge {{ $category->is_active ? 'bg-success' : 'bg-danger' }}">
                                                {{ $category->is_active ? __('Active') : __('Inactive') }}
                                            </span>
                                        </label>
                                    </div>
                                </td>
                                <td class="text-end pe-3">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.categories.edit', $category->id) }}">
                                                    <i class="fas fa-edit text-primary me-2"></i> {{ __('Edit') }}
                                                </a>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#viewModal{{ $category->id }}">
                                                    <i class="fas fa-eye text-info me-2"></i> {{ __('View Details') }}
                                                </button>
                                            </li>
                                         
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger" 
                                                            onclick="return confirmDelete(event, '{{ $category->name }}')">
                                                        <i class="fas fa-trash me-2"></i> {{ __('Delete') }}
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @if(count($categories) == 0)
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center p-4">
                                        <div class="empty-state-icon mb-3">
                                            <i class="fas fa-folder-open text-secondary"></i>
                                        </div>
                                        <h5 class="fw-normal text-secondary">{{ __('No categories found') }}</h5>
                                        <p class="text-muted">{{ __('Create your first category to get started') }}</p>
                                        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mt-2">
                                            <i class="fas fa-plus me-1"></i> {{ __('Create New Category') }}
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white py-3">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex align-items-center mb-2 mb-md-0">
                    <div class="me-3">
                        <select class="form-select form-select-sm" id="bulkAction">
                            <option value="">{{ __('Bulk Actions') }}</option>
                            <option value="activate">{{ __('Activate Selected') }}</option>
                            <option value="deactivate">{{ __('Deactivate Selected') }}</option>
                            <option value="delete">{{ __('Delete Selected') }}</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="applyBulkAction">
                        {{ __('Apply') }}
                    </button>
                </div>
                <div>
                    <div class="d-flex align-items-center">
                        <div class="text-muted small me-3">
                            {{ __('Showing') }} {{ $categories->firstItem() ?? 0 }} {{ __('to') }} 
                            {{ $categories->lastItem() ?? 0 }} {{ __('of') }} {{ $categories->total() }} {{ __('entries') }}
                        </div>
                        <div>
                            {{ $categories->onEachSide(1)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Modals -->
@foreach($categories as $category)
    <div class="modal fade" id="viewModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light">
                    <h5 class="modal-title">
                        <i class="fas fa-folder-open text-primary me-2"></i>{{ $category->name }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        @if($category->photo)
                            <img src="{{ asset('storage/' . $category->photo) }}" alt="{{ $category->name }}" 
                                 class="img-fluid rounded-3 shadow mb-3" style="max-height: 200px;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center rounded-3 mx-auto mb-3" 
                                 style="width: 150px; height: 150px;">
                                <i class="fas fa-image text-secondary" style="font-size: 3rem;"></i>
                            </div>
                        @endif
                    </div>
                    
                    <div class="detail-list">
                        <div class="detail-item">
                            <div class="detail-label">{{ __('ID') }}</div>
                            <div class="detail-value">{{ $category->id }}</div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">{{ __('Name') }}</div>
                            <div class="detail-value">{{ $category->name }}</div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">{{ __('Slug') }}</div>
                            <div class="detail-value">{{ $category->slug }}</div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">{{ __('Description') }}</div>
                            <div class="detail-value">{{ $category->description ?: __('No description') }}</div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">{{ __('Parent') }}</div>
                            <div class="detail-value">
                                @if($category->parent_id)
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-folder-open me-1"></i>{{ $category->parent->name }}
                                    </span>
                                @else
                                    <span class="badge bg-info bg-opacity-10 text-info">{{ __('Root Category') }}</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">{{ __('Status') }}</div>
                            <div class="detail-value">
                                <span class="badge {{ $category->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $category->is_active ? __('Active') : __('Inactive') }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">{{ __('Products') }}</div>
                            <div class="detail-value">
                                <span class="badge bg-secondary">{{ $category->products_count ?? 0 }}</span>
                            </div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">{{ __('Created') }}</div>
                            <div class="detail-value">{{ $category->created_at->format('M d, Y H:i') }}</div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">{{ __('Updated') }}</div>
                            <div class="detail-value">{{ $category->updated_at->format('M d, Y H:i') }}</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-1"></i> {{ __('Edit') }}
                    </a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ __('Close') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endforeach

<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title">
                    <i class="fas fa-file-import text-primary me-2"></i>{{ __('Import Categories') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
          
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    /* Transitions */
    .transition-150 { transition: all 0.15s ease; }
    .transition-300 { transition: all 0.3s ease; }
    
    /* Hover effects */
    .hover-shadow:hover { box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important; }
    .hover-shadow-sm:hover { box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important; }
    .hover-opacity:hover { opacity: 0.8; }
    .hover-shadow:hover { box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important; }
    
    /* Category image with overlay */
    .category-image-container {
        position: relative;
        display: inline-block;
    }
    
    .category-image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.2s ease;
        border-radius: 0.3rem;
    }
    
    .category-image-container:hover .category-image-overlay {
        opacity: 1;
    }
    
    .category-image-action {
        color: white;
        font-size: 1.2rem;
    }
    
    /* Detail list styling */
    .detail-list {
        margin: 0;
        padding: 0;
    }
    
    .detail-item {
        display: flex;
        border-bottom: 1px solid #f0f0f0;
        padding: 0.75rem 0;
    }
    
    .detail-item:last-child {
        border-bottom: none;
    }
    
    .detail-label {
        flex: 0 0 30%;
        color: #6c757d;
        font-weight: 500;
    }
    
    .detail-value {
        flex: 0 0 70%;
    }
    
    /* Empty state icon */
    .empty-state-icon {
        font-size: 4rem;
        height: 5rem;
        width: 5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: #f8f9fa;
        color: #adb5bd;
    }
    
    /* Icon box */
    .icon-box {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Premium pagination styling */
    .pagination {
        --bs-pagination-color: var(--bs-primary);
        --bs-pagination-hover-color: var(--bs-primary);
        --bs-pagination-focus-color: var(--bs-primary);
        --bs-pagination-active-bg: var(--bs-primary);
        --bs-pagination-active-border-color: var(--bs-primary);
    }
</style>

<!-- Custom Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Select all checkbox functionality
        const selectAllCheckbox = document.getElementById('selectAll');
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function() {
                const checkboxes = document.querySelectorAll('input[name="selected[]"]');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });
        }
        
        // Status toggle functionality
        const statusToggles = document.querySelectorAll('.status-toggle');
        statusToggles.forEach(toggle => {
            toggle.addEventListener('change', function() {
                const categoryId = this.dataset.id;
                const isActive = this.checked ? 1 : 0;
                
                // AJAX request to update status
                fetch(`{{ url('admin/categories') }}/${categoryId}/toggle-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ is_active: isActive })
                })
                .then(response => response.json())
                .then(data => {
                    // Show toast notification
                    const toast = document.createElement('div');
                    toast.className = 'position-fixed bottom-0 end-0 p-3';
                    toast.style.zIndex = '5';
                    toast.innerHTML = `
                        <div class="toast show align-items-center text-white bg-${isActive ? 'success' : 'danger'} border-0">
                            <div class="d-flex">
                                <div class="toast-body">
                                    <i class="fas fa-${isActive ? 'check' : 'times'}-circle me-2"></i>
                                    {{ __('Category') }} ${isActive ? '{{ __("activated") }}' : '{{ __("deactivated") }}'}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                            </div>
                        </div>
                    `;
                    document.body.appendChild(toast);
                    
                    // Update label
                    const label = toggle.nextElementSibling.querySelector('.badge');
                    label.className = `badge ${isActive ? 'bg-success' : 'bg-danger'}`;
                    label.textContent = isActive ? '{{ __("Active") }}' : '{{ __("Inactive") }}';
                    
                    // Remove toast after 3 seconds
                    setTimeout(() => {
                        document.body.removeChild(toast);
                    }, 3000);
                })
                .catch(error => {
                    console.error('Error updating category status:', error);
                    alert('{{ __("An error occurred while updating the status") }}');
                });
            });
        });
        
        // Bulk action functionality
        const applyBulkAction = document.getElementById('applyBulkAction');
        if (applyBulkAction) {
            applyBulkAction.addEventListener('click', function() {
                const bulkAction = document.getElementById('bulkAction').value;
                if (!bulkAction) {
                    alert('{{ __("Please select an action") }}');
                    return;
                }
                
                const selectedCheckboxes = document.querySelectorAll('input[name="selected[]"]:checked');
                if (selectedCheckboxes.length === 0) {
                    alert('{{ __("Please select at least one category") }}');
                    return;
                }
                
                const selectedIds = Array.from(selectedCheckboxes).map(checkbox => checkbox.value);
                
                if (bulkAction === 'delete') {
                    if (!confirm('{{ __("Are you sure you want to delete the selected categories?") }}')) {
                        return;
                    }
                }
                
                // Create form and submit
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '';
                
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);
                
                const actionInput = document.createElement('input');
                actionInput.type = 'hidden';
                actionInput.name = 'action';
                actionInput.value = bulkAction;
                form.appendChild(actionInput);
                
                selectedIds.forEach(id => {
                    const idInput = document.createElement('input');
                    idInput.type = 'hidden';
                    idInput.name = 'ids[]';
                    idInput.value = id;
                    form.appendChild(idInput);
                });
                
                document.body.appendChild(form);
                form.submit();
            });
        }
        
        // Delete confirmation
        window.confirmDelete = function(event, categoryName) {
            return confirm(`{{ __("Are you sure you want to delete") }} "${categoryName}"? {{ __("This action cannot be undone.") }}`);
        };
        
        // Initialize tooltips
        const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        tooltips.forEach(tooltip => {
            new bootstrap.Tooltip(tooltip);
        });
        
        // Auto-hide alerts after 5 seconds
        const alerts = document.querySelectorAll('.alert:not(.alert-info)');
        alerts.forEach(alert => {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    });
</script>
@endsection