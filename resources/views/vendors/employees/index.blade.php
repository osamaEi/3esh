@extends('vendors.index')
@section('content')
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="w-full text-left border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('Name') }}</th>
                        <th class="p-3 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('Email') }}</th>
                        <th class="p-3 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('Phone') }}</th>
                        <th class="p-3 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('Position') }}</th>
                        <th class="p-3 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('Department') }}</th>
                        <th class="p-3 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('Status') }}</th>
                        <th class="p-3 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 text-sm text-gray-600 border-b border-gray-200">{{ $employee->name }}</td>
                            <td class="p-3 text-sm text-gray-600 border-b border-gray-200">{{ $employee->email }}</td>
                            <td class="p-3 text-sm text-gray-600 border-b border-gray-200">{{ $employee->phone ?? 'N/A' }}</td>
                            <td class="p-3 text-sm text-gray-600 border-b border-gray-200">{{ $employee->position ?? 'N/A' }}</td>
                            <td class="p-3 text-sm text-gray-600 border-b border-gray-200">{{ $employee->department->name ?? 'N/A' }}</td>
                            <td class="p-3 text-sm text-gray-600 border-b border-gray-200">
                                @if($employee->status == 'active')
                                    <span class="inline-block px-2 py-1 text-xs font-semibold text-white bg-green-500 rounded-full">{{ __('Active') }}</span>
                                @else
                                    <span class="inline-block px-2 py-1 text-xs font-semibold text-white bg-red-500 rounded-full">{{ __('Inactive') }}</span>
                                @endif
                            </td>
                            <td class="p-3 text-sm text-gray-600 border-b border-gray-200 flex space-x-2">
                              
                                <form action="" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this employee?') }}');" class="inline-flex">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 transition duration-200">
                                        <i class="fas fa-trash mr-1"></i> {{ __('Delete') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-3 text-sm text-gray-600 text-center border-b border-gray-200">{{ __('No employees found.') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection