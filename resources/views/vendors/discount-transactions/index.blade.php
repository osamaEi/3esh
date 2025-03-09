@extends('vendors.index')
@section('content')
    <div class="max-w-6xl mx-auto mt-10 px-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-800 flex items-center">
                <i class="fas fa-ticket-alt mr-3 text-purple-600"></i> Discount Transactions
            </h2>
            <a href="{{ route('vendors.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-semibold rounded-lg shadow-md hover:bg-gray-700 transition duration-300 transform hover:-translate-y-1">
                <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
            </a>
        </div>

        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg shadow-md flex items-center">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg shadow-md flex items-center">
                <i class="fas fa-exclamation-triangle mr-2"></i> {{ $errors->first('message') }}
            </div>
        @endif

        <!-- Transactions Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border border-gray-200">
                    <thead class="bg-gradient-to-r from-purple-50 to-purple-100">
                        <tr>
                            <th class="p-4 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('User') }}</th>
                            <th class="p-4 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('Branch') }}</th>
                            <th class="p-4 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('Amount') }}</th>
                            <th class="p-4 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('Discount %') }}</th>
                            <th class="p-4 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('Discount Amount') }}</th>
                            <th class="p-4 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('Confirmation Code') }}</th>
                            <th class="p-4 text-sm font-semibold text-gray-700 border-b border-gray-200">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $transaction)
                            <tr class="hover:bg-gray-50 transition duration-200">
                                <td class="p-4 text-sm text-gray-600 border-b border-gray-200">{{ $transaction->user->name ?? 'N/A' }}</td>
                                <td class="p-4 text-sm text-gray-600 border-b border-gray-200">{{ $transaction->branch->name ?? 'N/A' }}</td>
                                <td class="p-4 text-sm text-gray-600 border-b border-gray-200">{{ number_format($transaction->amount, 2) }}</td>
                                <td class="p-4 text-sm text-gray-600 border-b border-gray-200">{{ $transaction->discount_percentage }}%</td>
                                <td class="p-4 text-sm text-gray-600 border-b border-gray-200">{{ number_format($transaction->discount_amount, 2) }}</td>
                                <td class="p-4 text-sm text-gray-600 border-b border-gray-200">
                                    <form action="{{ route('vendors.discount-transactions.confirm', $transaction->id) }}" method="POST" class="flex items-center space-x-2">
                                        @csrf
                                        <input type="text" name="confirmation_code" value="{{ old('confirmation_code') }}" class="px-2 py-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200 w-32" placeholder="Enter code" required>
                                        <button type="submit" class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-purple-600 rounded-md hover:bg-purple-700 transition duration-200 shadow-sm">
                                            <i class="fas fa-check mr-1"></i> Confirm
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-4 text-sm text-gray-600 text-center border-b border-gray-200 bg-gray-50">
                                    <i class="fas fa-exclamation-circle mr-2 text-gray-500"></i> {{ __('No unconfirmed transactions found.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection