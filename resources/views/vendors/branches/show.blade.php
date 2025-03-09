@extends('vendors.index')
@section('content')
    <div class="max-w-4xl mx-auto mt-10 px-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-800 flex items-center">
                <i class="fas fa-store mr-3 text-purple-600"></i> Branch Details: {{ $branch->name }}
            </h2>
            <a href="{{ route('vendors.branches.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-semibold rounded-lg shadow-md hover:bg-gray-700 transition duration-300 transform hover:-translate-y-1">
                <i class="fas fa-arrow-left mr-2"></i> Back to Branches
            </a>
        </div>

        <!-- Branch Details -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column: Text Details -->
                <div class="space-y-4">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">{{ $branch->name }}</h3>
                    
                    <p class="text-sm text-gray-600 flex items-center">
                        <i class="fas fa-map-marker-alt mr-2 text-purple-500"></i>
                        <strong>Address:</strong> <span class="ml-1">{{ $branch->address }}</span>
                    </p>
                    
                    <p class="text-sm text-gray-600 flex items-center">
                        <i class="fas fa-map-pin mr-2 text-purple-500"></i>
                        <strong>Latitude / Longitude:</strong> 
                        <span class="ml-1">{{ $branch->latitude ? number_format($branch->latitude, 6) : 'N/A' }} / {{ $branch->longitude ? number_format($branch->longitude, 6) : 'N/A' }}</span>
                    </p>
                    
                    <p class="text-sm text-gray-600 flex items-center">
                        <i class="fas fa-phone mr-2 text-purple-500"></i>
                        <strong>Phone:</strong> <span class="ml-1">{{ $branch->phone ?? 'N/A' }}</span>
                    </p>
                    
                    <p class="text-sm text-gray-600 flex items-center">
                        <i class="fas fa-envelope mr-2 text-purple-500"></i>
                        <strong>Email:</strong> <span class="ml-1">{{ $branch->email ?? 'N/A' }}</span>
                    </p>
                    
                    <p class="text-sm text-gray-600 flex items-center">
                        <i class="fas fa-user-tie mr-2 text-purple-500"></i>
                        <strong>Manager:</strong> <span class="ml-1">{{ $branch->manager_name ?? 'N/A' }}</span>
                    </p>
                    
                    <p class="text-sm text-gray-600 flex items-center">
                        <i class="fas fa-shield-alt mr-2 text-purple-500"></i>
                        <strong>Status:</strong>
                        <span class="ml-1 font-semibold">
                            @if ($branch->is_active && $branch->is_approved)
                                <span class="text-green-500 bg-green-100 px-2 py-1 rounded-full">Active & Approved</span>
                            @elseif (!$branch->is_approved)
                                <span class="text-yellow-500 bg-yellow-100 px-2 py-1 rounded-full">Pending Approval</span>
                            @else
                                <span class="text-red-500 bg-red-100 px-2 py-1 rounded-full">Inactive</span>
                            @endif
                        </span>
                    </p>
                    
                    <p class="text-sm text-gray-600 flex items-center">
                        <i class="fas fa-clock mr-2 text-purple-500"></i>
                        <strong>Operating Hours:</strong> 
                        <span class="ml-1">{{ $branch->opening_time ? $branch->opening_time : 'N/A' }} - {{ $branch->closing_time ? $branch->closing_time : 'N/A' }}</span>
                    </p>
                    
                    <p class="text-sm text-gray-600 flex items-center">
                        <i class="fas fa-calendar-day mr-2 text-purple-500"></i>
                        <strong>Working Days:</strong> 
                        <span class="ml-1">{{ $branch->working_days ? implode(', ', json_decode($branch->working_days, true)) : 'N/A' }}</span>
                    </p>
                    
                    <p class="text-sm text-gray-600 flex items-start">
                        <i class="fas fa-sticky-note mr-2 text-purple-500 mt-1"></i>
                        <strong>Notes:</strong> 
                        <span class="ml-1">{{ $branch->notes ?? 'N/A' }}</span>
                    </p>
                </div>

                <!-- Right Column: Photo -->
                <div class="flex justify-center items-center">
                    @if ($branch->photo)
                        <img src="{{ asset('storage/' . $branch->photo) }}" alt="Branch Photo" class="h-48 w-48 object-cover rounded-lg shadow-md">
                    @else
                        <div class="h-48 w-48 flex items-center justify-center bg-gray-100 rounded-lg shadow-md">
                            <span class="text-gray-500 text-sm">No Photo Available</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-6 flex justify-end space-x-4">
                <a href="{{ route('vendors.branches.edit', $branch->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-300 transform hover:-translate-y-1">
                    <i class="fas fa-edit mr-2"></i> Edit Branch
                </a>
            </div>
        </div>
    </div>
@endsection