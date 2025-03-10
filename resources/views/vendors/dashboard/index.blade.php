@extends('vendors.index')
@section('content')
    <div class="max-w-5xl mx-auto mt-12 px-6">
        <!-- Header with Gradient and Animation -->
        <div class="relative mb-10">
            <h2 class="text-4xl font-extrabold text-gray-800 flex items-center justify-center bg-gradient-to-r from-purple-600 to-indigo-600 text-transparent bg-clip-text animate-pulse">
                <i class="fas fa-tachometer-alt mr-4 text-purple-600"></i> Vendor Dashboard')}}
            </h2>
            <div class="absolute inset-0 -z-10 h-1 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-full opacity-50 blur-md"></div>
        </div>

        @if ($vendor)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Vendor Info Card with Glassmorphism -->
                <div class="relative bg-white bg-opacity-80 backdrop-blur-md p-6 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100">
                    <div class="absolute inset-0 bg-gradient-to-br from-gray-50 to-gray-100 opacity-50 rounded-2xl -z-10"></div>
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-bold text-gray-800 tracking-tight">{{ $vendor->business_name }}</h3>
                        @if ($vendor->logo)
                            <img src="{{ asset('storage/' . $vendor->logo) }}" alt="Vendor Logo" class="h-16 w-16 object-cover rounded-full border-4 border-purple-300 shadow-md transform hover:scale-110 transition-transform duration-300">
                        @else
                            <i class="fas fa-building text-4xl text-gray-400 opacity-75 hover:text-purple-500 transition-colors duration-300"></i>
                        @endif
                    </div>
                    <div class="space-y-4">
                        <p class="text-sm text-gray-700 flex items-center">
                            <i class="fas fa-envelope mr-3 text-purple-500"></i>
                            <strong class="font-semibold">{{__('Email')}}:</strong> 
                            <span class="ml-2 text-gray-600 hover:text-purple-600 transition-colors duration-200">{{ $vendor->email }}</span>
                        </p>
                        <p class="text-sm text-gray-700 flex items-center">
                            <i class="fas fa-user mr-3 text-purple-500"></i>
                            <strong class="font-semibold">{{__('Contact')}}:</strong> 
                            <span class="ml-2 text-gray-600 hover:text-purple-600 transition-colors duration-200">{{ $vendor->contact_person ?? 'N/A' }}</span>
                        </p>
                        <p class="text-sm text-gray-700 flex items-center">
                            <i class="fas fa-shield-alt mr-3 text-purple-500"></i>
                            <strong class="font-semibold">{{__('Status')}}:</strong>
                            <span class="ml-2 font-semibold">
                                @if ($vendor->is_active && !$vendor->blocked && $vendor->is_approved)
                                    <span class="text-green-600 bg-green-100 px-3 py-1 rounded-full shadow-sm hover:bg-green-200 transition-all duration-300">Active & Approved</span>
                                @elseif ($vendor->blocked)
                                    <span class="text-red-600 bg-red-100 px-3 py-1 rounded-full shadow-sm hover:bg-red-200 transition-all duration-300">Blocked</span>
                                @else
                                    <span class="text-yellow-600 bg-yellow-100 px-3 py-1 rounded-full shadow-sm hover:bg-yellow-200 transition-all duration-300">Pending Approval</span>
                                @endif
                            </span>
                        </p>
                    </div>
                </div>

                <!-- Quick Stats Card with Neumorphism -->
                <div class="relative bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-2xl shadow-[inset_4px_4px_8px_rgba(147,51,234,0.1),inset_-4px_-4px_8px_rgba(255,255,255,0.9)] hover:shadow-[inset_6px_6px_12px_rgba(147,51,234,0.2),inset_-6px_-6px_12px_rgba(255,255,255,1)] transition-all duration-500 transform hover:-translate-y-2 border border-purple-200">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-chart-line mr-3 text-purple-600 animate-spin-slow"></i> {{__('Overview')}}
                    </h3>
                    <div class="space-y-5">
                        <p class="text-sm text-gray-700 flex items-center">
                            <i class="fas fa-store-alt mr-4 text-purple-500"></i>
                            <strong class="font-semibold">{{__('Branches')}}:</strong> 
                            <span class="ml-2 font-semibold text-purple-700 bg-purple-100 px-3 py-1 rounded-full shadow-sm transform hover:scale-105 transition-transform duration-300">{{ $vendor->branches->count() }}</span>
                        </p>
                        <p class="text-sm text-gray-700 flex items-center">
                            <i class="fas fa-users mr-4 text-purple-500"></i>
                            <strong class="font-semibold">{{__('Employees')}}:</strong> 
                            <span class="ml-2 font-semibold text-purple-700 bg-purple-100 px-3 py-1 rounded-full shadow-sm transform hover:scale-105 transition-transform duration-300">{{ $vendor->employees->count() }}</span>
                        </p>
                        <p class="text-sm text-gray-700 flex items-center">
                            <i class="fas fa-tags mr-4 text-purple-500"></i>
                            <strong class="font-semibold">{{__('Categories')}}:</strong> 
                            <span class="ml-2 text-gray-600 hover:text-purple-600 transition-colors duration-200">{{ $vendor->categories->pluck('name')->implode(', ') ?: 'None' }}</span>
                        </p>
                        <p class="text-sm text-gray-700 flex items-center">
                            <i class="fas fa-clock mr-4 text-purple-500"></i>
                            <strong class="font-semibold">{{__('Last Updated')}}:</strong> 
                            <span class="ml-2 text-gray-600 italic hover:text-purple-600 transition-colors duration-200">{{ $vendor->updated_at->diffForHumans() }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex justify-center space-x-6">
                <a href="{{ route('vendors.branches.index') }}" class="inline-flex items-center px-6 py-3 bg-purple-600 text-white font-semibold rounded-lg shadow-md hover:bg-purple-700 transition-all duration-300 transform hover:-translate-y-1">
                    <i class="fas fa-store-alt mr-2"></i> {{__('Manage Branches')}}
                </a>
                <a href="{{ route('vendors.employees') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition-all duration-300 transform hover:-translate-y-1">
                    <i class="fas fa-users mr-2"></i> {{__('Manage Employees')}}
                </a>
            </div>
        @else
            <div class="bg-red-50 p-8 rounded-xl shadow-md text-center border border-red-200 animate-fade-in">
                <p class="text-gray-700 font-medium text-lg flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle mr-3 text-red-500"></i> {{__('No vendor data available.')}}'
                </p>
            </div>
        @endif
    </div>

    <!-- Custom CSS for Animations -->
    <style>
        @keyframes spin-slow {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .animate-spin-slow {
            animation: spin-slow 8s linear infinite;
        }
        @keyframes fade-in {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.8s ease-out;
        }
    </style>
@endsection