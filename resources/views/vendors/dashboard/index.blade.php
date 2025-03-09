@extends('vendors.index')
@section('content')
    <div class="max-w-4xl mx-auto mt-10 px-6">
        <h2 class="text-3xl font-extrabold text-gray-800 mb-8 flex items-center">
            <i class="fas fa-tachometer-alt mr-3 text-purple-600"></i> Vendor Dashboard
        </h2>

        @if ($vendor)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Vendor Info Card -->
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold text-gray-800">{{ $vendor->business_name }}</h3>
                        @if ($vendor->logo)
                            <img src="{{ asset('storage/' . $vendor->logo) }}" alt="Vendor Logo" class="h-12 w-12 object-cover rounded-full border-2 border-purple-200">
                        @else
                            <i class="fas fa-building text-3xl text-gray-400"></i>
                        @endif
                    </div>
                    <div class="space-y-3">
                        <p class="text-sm text-gray-600 flex items-center">
                            <i class="fas fa-envelope mr-2 text-purple-500"></i>
                            <strong>Email:</strong> <span class="ml-1">{{ $vendor->email }}</span>
                        </p>
                        <p class="text-sm text-gray-600 flex items-center">
                            <i class="fas fa-user mr-2 text-purple-500"></i>
                            <strong>Contact:</strong> <span class="ml-1">{{ $vendor->contact_person ?? 'N/A' }}</span>
                        </p>
                        <p class="text-sm text-gray-600 flex items-center">
                            <i class="fas fa-shield-alt mr-2 text-purple-500"></i>
                            <strong>Status:</strong>
                            <span class="ml-1 font-semibold">
                                @if ($vendor->is_active && !$vendor->blocked && $vendor->is_approved)
                                    <span class="text-green-500 bg-green-100 px-2 py-1 rounded-full">Active & Approved</span>
                                @elseif ($vendor->blocked)
                                    <span class="text-red-500 bg-red-100 px-2 py-1 rounded-full">Blocked</span>
                                @else
                                    <span class="text-yellow-500 bg-yellow-100 px-2 py-1 rounded-full">Pending Approval</span>
                                @endif
                            </span>
                        </p>
                    </div>
                </div>

                <!-- Quick Stats Card -->
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-chart-line mr-2 text-purple-600"></i> Overview
                    </h3>
                    <div class="space-y-4">
                        <p class="text-sm text-gray-600 flex items-center">
                            <i class="fas fa-store-alt mr-3 text-purple-500"></i>
                            <strong>Branches:</strong> 
                            <span class="ml-2 font-semibold text-purple-700">{{ $vendor->branches->count() }}</span>
                        </p>
                        <p class="text-sm text-gray-600 flex items-center">
                            <i class="fas fa-users mr-3 text-purple-500"></i>
                            <strong>Employees:</strong> 
                            <span class="ml-2 font-semibold text-purple-700">{{ $vendor->employees->count() }}</span>
                        </p>
                        <p class="text-sm text-gray-600 flex items-center">
                            <i class="fas fa-tags mr-3 text-purple-500"></i>
                            <strong>Categories:</strong> 
                            <span class="ml-2 text-gray-700">{{ $vendor->categories->pluck('name')->implode(', ') ?: 'None' }}</span>
                        </p>
                        <p class="text-sm text-gray-600 flex items-center">
                            <i class="fas fa-clock mr-3 text-purple-500"></i>
                            <strong>Last Updated:</strong> 
                            <span class="ml-2 text-gray-700">{{ $vendor->updated_at->diffForHumans() }}</span>
                        </p>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-red-50 p-6 rounded-lg shadow-md text-center">
                <p class="text-gray-600 font-medium">No vendor data available.</p>
            </div>
        @endif
    </div>
@endsection