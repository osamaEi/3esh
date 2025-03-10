@extends('vendors.index')
@section('content')
    <div class="max-w-4xl mx-auto mt-10 px-6">
        <!-- Header with Title and Create Button -->
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-800 flex items-center">
                <i class="fas fa-users mr-3 text-purple-600"></i> {{__('Employees')}}
            </h2>
            <a href="{{ route('vendors.employees.create') }}" class="inline-flex items-center px-4 py-2 bg-purple-600 text-white font-semibold rounded-lg shadow-md hover:bg-purple-700 transition duration-300 transform hover:-translate-y-1">
                <i class="fas fa-plus mr-2"></i> {{__('Create Employee')}}
            </a>
        </div>

        <!-- Employees Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border border-gray-200">
                    <thead class="bg-gradient-to-r from-purple-50 to-purple-100">
                        <tr>
                            <th class="p-4 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('Name') }}</th>
                            <th class="p-4 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('Email') }}</th>
                            <th class="p-4 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('Phone') }}</th>
                            <th class="p-4 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('Position') }}</th>
                            <th class="p-4 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('Department') }}</th>
                            <th class="p-4 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('Status') }}</th>
                            <th class="p-4 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $employee)
                            <tr class="hover:bg-gray-50 transition duration-200">
                                <td class="p-4 text-sm text-gray-600 border-b border-gray-200">{{ $employee->name }}</td>
                                <td class="p-4 text-sm text-gray-600 border-b border-gray-200">{{ $employee->email }}</td>
                                <td class="p-4 text-sm text-gray-600 border-b border-gray-200">{{ $employee->phone ?? 'N/A' }}</td>
                                <td class="p-4 text-sm text-gray-600 border-b border-gray-200">{{ $employee->position ?? 'N/A' }}</td>
                                <td class="p-4 text-sm text-gray-600 border-b border-gray-200">{{ $employee->department->name ?? 'N/A' }}</td>
                                <td class="p-4 text-sm text-gray-600 border-b border-gray-200">
                                    @if($employee->status == 'active')
                                        <span class="inline-block px-3 py-1 text-xs font-semibold text-white bg-green-500 rounded-full shadow-sm">{{ __('Active') }}</span>
                                    @else
                                        <span class="inline-block px-3 py-1 text-xs font-semibold text-white bg-red-500 rounded-full shadow-sm">{{ __('Inactive') }}</span>
                                    @endif
                                </td>
                                <td class="p-4 text-sm text-gray-600 border-b border-gray-200 flex space-x-3">
                                    <a href="{{ route('vendors.employees.edit', $employee->id) }}" class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 transition duration-200 shadow-sm">
                                        <i class="fas fa-edit mr-1"></i> {{ __('Edit') }}
                                    </a>
                                    <form action="{{ route('vendors.employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this employee?') }}');" class="inline-flex">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 transition duration-200 shadow-sm">
                                            <i class="fas fa-trash mr-1"></i> {{ __('Delete') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-4 text-sm text-gray-600 text-center border-b border-gray-200 bg-gray-50">
                                    <i class="fas fa-exclamation-circle mr-2 text-gray-500"></i> {{ __('No employees found.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection