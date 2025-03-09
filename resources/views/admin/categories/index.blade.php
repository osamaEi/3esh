@extends('admin.index')
@section('title', 'Manage Categories')
@section('content')
<div class="container-fluid px-4">
    <!-- Enhanced Breadcrumb -->
    <div class="bg-white p-3 rounded mb-4 shadow-sm border-start border-4 border-primary">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-folder"></i> Categories
                </li>
            </ol>
        </nav>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Main Card -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0 text-primary">
                <i class="fas fa-folder me-2"></i>{{ __('All Categories') }}
            </h5>
            <div>
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
                            <th class="ps-3" width="60">ID</th>
                            <th width="100">{{ __('Photo') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Description') }}</th>
                            <th>{{ __('Parent') }}</th>
                            <th width="100">{{ __('Status') }}</th>
                            <th class="text-end pe-3" width="180">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td class="ps-3">{{ $category->id }}</td>
                                <td>
                                    @if($category->photo)
                                        <img src="{{ asset('storage/' . $category->photo) }}" alt="{{ $category->name }}" 
                                             class="rounded-3" width="60" height="60" style="object-fit: cover;">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center rounded-3" 
                                             style="width: 60px; height: 60px;">
                                            <i class="fas fa-image text-secondary"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-medium">{{ $category->name }}</td>
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
                                        <span class="badge bg-light text-dark">{{ __('Root Category') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" 
                                               id="status{{ $category->id }}" 
                                               {{ $category->is_active ? 'checked' : '' }} disabled>
                                        <label class="form-check-label" for="status{{ $category->id }}">
                                            <span class="badge {{ $category->is_active ? 'bg-success' : 'bg-danger' }}">
                                                {{ $category->is_active ? __('Active') : __('Inactive') }}
                                            </span>
                                        </label>
                                    </div>
                                </td>
                                <td class="text-end pe-3">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-info" 
                                                data-bs-toggle="modal" data-bs-target="#viewModal{{ $category->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                    onclick="return confirm('{{ __('Are you sure you want to delete this category?') }}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @if(count($categories) == 0)
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-folder-open text-secondary mb-3" style="font-size: 3rem;"></i>
                                        <h5 class="fw-normal text-secondary">{{ __('No categories found') }}</h5>
                                        <p class="text-muted">{{ __('Create your first category to get started') }}</p>
                                        <a href="{{ route('categories.create') }}" class="btn btn-primary mt-2">
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
        <div class="card-footer bg-white border-top-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    {{ __('Showing') }} {{ $categories->firstItem() ?? 0 }} {{ __('to') }} 
                    {{ $categories->lastItem() ?? 0 }} {{ __('of') }} {{ $categories->total() }} {{ __('entries') }}
                </div>
                <div>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Modals -->
@foreach($categories as $category)
    <div class="modal fade" id="viewModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $category->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        @if($category->photo)
                            <img src="{{ asset('storage/' . $category->photo) }}" alt="{{ $category->name }}" 
                                 class="img-fluid rounded-3 mb-3" style="max-height: 200px;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center rounded-3 mx-auto mb-3" 
                                 style="width: 150px; height: 150px;">
                                <i class="fas fa-image text-secondary" style="font-size: 3rem;"></i>
                            </div>
                        @endif
                    </div>
                    
                    <div class="row mb-2">
                        <div class="col-4 text-secondary">{{ __('ID') }}:</div>
                        <div class="col-8">{{ $category->id }}</div>
                    </div>
                    
                    <div class="row mb-2">
                        <div class="col-4 text-secondary">{{ __('Name') }}:</div>
                        <div class="col-8">{{ $category->name }}</div>
                    </div>
                    
                    <div class="row mb-2">
                        <div class="col-4 text-secondary">{{ __('Description') }}:</div>
                        <div class="col-8">{{ $category->description ?: __('No description') }}</div>
                    </div>
                    
                    <div class="row mb-2">
                        <div class="col-4 text-secondary">{{ __('Parent') }}:</div>
                        <div class="col-8">
                            @if($category->parent_id)
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-folder-open me-1"></i>{{ $category->parent->name }}
                                </span>
                            @else
                                <span class="badge bg-light text-dark">{{ __('Root Category') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="row mb-2">
                        <div class="col-4 text-secondary">{{ __('Status') }}:</div>
                        <div class="col-8">
                            <span class="badge {{ $category->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $category->is_active ? __('Active') : __('Inactive') }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="row mb-2">
                        <div class="col-4 text-secondary">{{ __('Created') }}:</div>
                        <div class="col-8">{{ $category->created_at->format('M d, Y H:i') }}</div>
                    </div>
                    
                    <div class="row mb-2">
                        <div class="col-4 text-secondary">{{ __('Updated') }}:</div>
                        <div class="col-8">{{ $category->updated_at->format('M d, Y H:i') }}</div>
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
@endsection