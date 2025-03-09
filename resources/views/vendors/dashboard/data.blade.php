@extends('vendors.index')
@section('content')
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Vendor Branches</h2>

        @if ($vendor)
            <div class="overflow-x-auto">
                <table class="w-full text-left border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-sm font-semibold text-gray-700 border-b border-gray-200">Name</th>
                            <th class="p-3 text-sm font-semibold text-gray-700 border-b border-gray-200">Address</th>
                            <th class="p-3 text-sm font-semibold text-gray-700 border-b border-gray-200">Phone</th>
                            <th class="p-3 text-sm font-semibold text-gray-700 border-b border-gray-200">Manager</th>
                            <th class="p-3 text-sm font-semibold text-gray-700 border-b border-gray-200">Status</th>
                            <th class="p-3 text-sm font-semibold text-gray-700 border-b border-gray-200">Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($branches as $branch)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 text-sm text-gray-600 border-b border-gray-200">{{ $branch->name }}</td>
                                <td class="p-3 text-sm text-gray-600 border-b border-gray-200">{{ $branch->address }}</td>
                                <td class="p-3 text-sm text-gray-600 border-b border-gray-200">{{ $branch->phone ?? 'N/A' }}</td>
                                <td class="p-3 text-sm text-gray-600 border-b border-gray-200">{{ $branch->manager_name ?? 'N/A' }}</td>
                                <td class="p-3 text-sm text-gray-600 border-b border-gray-200">
                                    @if ($branch->is_active && $branch->is_approved)
                                        <span class="text-green-500">Active</span>
                                    @elseif (!$branch->is_approved)
                                        <span class="text-yellow-500">Pending</span>
                                    @else
                                        <span class="text-red-500">Inactive</span>
                                    @endif
                                </td>
                                <td class="p-3 text-sm text-gray-600 border-b border-gray-200">
                                    {{ $branch->opening_time ? $branch->opening_time->format('H:i') : 'N/A' }} - 
                                    {{ $branch->closing_time ? $branch->closing_time->format('H:i') : 'N/A' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-3 text-sm text-gray-600 text-center border-b border-gray-200">No branches found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-600">No vendor data available.</p>
        @endif
    </div>
@endsection