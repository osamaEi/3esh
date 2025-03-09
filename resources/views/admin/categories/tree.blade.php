@extends('admin.index')

@section('content')
<div class="container">
    <div class="card-header text-white">
        <h2 class="mt-6">{{ __('Category Tree') }}</h2>
    </div>
    <div class="card shadow">
        <div class="card-body">
            <ul class="list-group">
                @foreach($categories as $category)
                    <li class="list-group-item">
                        <div class="d-flex align-items-center">
                            @if($category->photo)
                                <img src="{{ asset('storage/' . $category->photo) }}" alt="Category Photo" class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/no-image.png') }}" alt="No Photo" class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                            @endif
                            <strong>{{ $category->name }}</strong>
                        </div>

                        @if($category->children->count() > 0)
                            <ul class="list-group mt-2 ms-4">
                                @foreach($category->children as $child)
                                    <li class="list-group-item">
                                        <div class="d-flex align-items-center">
                                            @if($child->photo)
                                                <img src="{{ asset('storage/' . $child->photo) }}" alt="Child Category Photo" class="rounded me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                            @else
                                                <img src="{{ asset('images/no-image.png') }}" alt="No Photo" class="rounded me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                            @endif
                                            {{ $child->name }}
                                        </div>

                                        @if($child->children->count() > 0)
                                            <ul class="list-group mt-2 ms-4">
                                                @foreach($child->children as $subChild)
                                                    <li class="list-group-item">
                                                        <div class="d-flex align-items-center">
                                                            @if($subChild->photo)
                                                                <img src="{{ asset('storage/' . $subChild->photo) }}" alt="Sub Child Category Photo" class="rounded me-3" style="width: 30px; height: 30px; object-fit: cover;">
                                                            @else
                                                                <img src="{{ asset('images/no-image.png') }}" alt="No Photo" class="rounded me-3" style="width: 30px; height: 30px; object-fit: cover;">
                                                            @endif
                                                            {{ $subChild->name }}
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="d-grid mt-4">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> {{ __('Back to List') }}
        </a>
    </div>
</div>
@endsection
