@extends('vendors.index')
@section('content')
    <div class="max-w-7xl mx-auto mt-10 px-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-800 flex items-center">
                <i class="fas fa-store-alt mr-3 text-purple-600"></i> Branches
            </h2>
            <a href="{{ route('vendors.branches.create') }}" class="inline-flex items-center px-4 py-2 bg-purple-600 text-white font-semibold rounded-lg shadow-md hover:bg-purple-700 transition duration-300 transform hover:-translate-y-1">
                <i class="fas fa-plus mr-2"></i> Add Branch
            </a>
        </div>

        <!-- Branches Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border border-gray-200">
                    <thead class="bg-gradient-to-r from-purple-50 to-purple-100">
                        <tr>
                            <th class="p-4 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('Name') }}</th>
                            <th class="p-4 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('Address') }}</th>
                            <th class="p-4 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('Phone') }}</th>
                            <th class="p-4 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('Email') }}</th>
                            <th class="p-4 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('Manager') }}</th>
                            <th class="p-4 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('Photo') }}</th>
                            <th class="p-4 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('Status') }}</th>
                            <th class="p-4 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('Hours') }}</th>
                            <th class="p-4 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($branches as $branch)
                            <tr class="hover:bg-gray-50 transition duration-200">
                                <td class="p-4 text-sm text-gray-600 border-b border-gray-200">{{ $branch->name }}</td>
                                <td class="p-4 text-sm text-gray-600 border-b border-gray-200">{{ Str::limit($branch->address, 30) }}</td>
                             
                                <td class="p-4 text-sm text-gray-600 border-b border-gray-200">{{ $branch->phone ?? 'N/A' }}</td>
                                <td class="p-4 text-sm text-gray-600 border-b border-gray-200">{{ $branch->email ?? 'N/A' }}</td>
                                <td class="p-4 text-sm text-gray-600 border-b border-gray-200">{{ $branch->manager_name ?? 'N/A' }}</td>
                                <td class="p-4 text-sm text-gray-600 border-b border-gray-200">
                                    @if ($branch->photo)
                                        <img src="{{ asset('storage/' . $branch->photo) }}" alt="Branch Photo" class="h-10 w-10 object-cover rounded-full">
                                    @else
                                        <span>N/A</span>
                                    @endif
                                </td>
                                <td class="p-4 text-sm text-gray-600 border-b border-gray-200">
                                    @if ($branch->is_active && $branch->is_approved)
                                        <span class="inline-block px-3 py-1 text-xs font-semibold text-white bg-green-500 rounded-full shadow-sm">{{ __('Active & Approved') }}</span>
                                    @elseif (!$branch->is_approved)
                                        <span class="inline-block px-3 py-1 text-xs font-semibold text-white bg-yellow-500 rounded-full shadow-sm">{{ __('Pending') }}</span>
                                    @else
                                        <span class="inline-block px-3 py-1 text-xs font-semibold text-white bg-red-500 rounded-full shadow-sm">{{ __('Inactive') }}</span>
                                    @endif
                                </td>
                                <td class="p-4 text-sm text-gray-600 border-b border-gray-200">
                                    {{ $branch->opening_time ? $branch->opening_time : 'N/A' }} - 
                                    {{ $branch->closing_time ? $branch->closing_time : 'N/A' }}
                                </td>
                                {{-- <td class="p-4 text-sm text-gray-600 border-b border-gray-200">
                                    {{ $branch->working_days ? implode(', ', json_decode($branch->working_days, true)) : 'N/A' }}
                                </td> --}}
                                <td class="p-4 text-sm text-gray-600 border-b border-gray-200 flex space-x-3">
                                    <a href="{{ route('vendors.branches.show', $branch->id) }}" class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-gray-600 rounded-md hover:bg-gray-700 transition duration-200 shadow-sm">
                                        <i class="fas fa-eye mr-1"></i> {{ __('View') }}
                                    </a>
                                    <a href="{{ route('vendors.branches.edit', $branch->id) }}" class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 transition duration-200 shadow-sm">
                                        <i class="fas fa-edit mr-1"></i> {{ __('Edit') }}
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="p-4 text-sm text-gray-600 text-center border-b border-gray-200 bg-gray-50">
                                    <i class="fas fa-exclamation-circle mr-2 text-gray-500"></i> {{ __('No branches found.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection