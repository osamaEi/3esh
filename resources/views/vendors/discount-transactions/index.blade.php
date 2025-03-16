@extends('vendors.index')
@section('content')
    <div class="max-w-6xl mx-auto mt-10 px-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-800 flex items-center">
                <i class="fas fa-ticket-alt mr-3 text-purple-600"></i> {{__('Discount Transactions')}}
            </h2>
            <a href="{{ route('vendors.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-semibold rounded-lg shadow-md hover:bg-gray-700 transition duration-300 transform hover:-translate-y-1">
                <i class="fas fa-arrow-left mr-2"></i> {{__('Back to Dashboard')}}
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
                                @if($transaction->is_confirmed == 0)
                                <td class="p-4 text-sm border-b border-gray-200">
                                    <form action="{{ route('vendors.discount-transactions.confirm', $transaction->id) }}" method="POST" class="flex items-center space-x-2">
                                        @csrf
                                        <div class="relative w-full max-w-xs">
                                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <i class="fas fa-key text-gray-400"></i>
                                            </div>
                                            <input 
                                                type="text" 
                                                name="confirmation_code" 
                                                value="{{ old('confirmation_code') }}" 
                                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300 placeholder-gray-400"
                                                placeholder="{{__('Enter code')}}" 
                                                required
                                                autocomplete="off"
                                            >
                                        </div>
                                        <button 
                                            type="submit" 
                                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-purple-600 to-purple-800 rounded-lg hover:from-purple-700 hover:to-purple-900 focus:ring-4 focus:ring-purple-300 focus:outline-none transition-all duration-300 shadow-lg transform hover:scale-105"
                                        >
                                            <i class="fas fa-check-circle mr-2"></i> {{__('Confirm')}}
                                        </button>
                                    </form>
                                    
                                    <p class="mt-2 text-xs text-gray-500">
                                        <i class="fas fa-info-circle mr-1"></i> {{__('Enter the confirmation code provided by the customer')}}
                                    </p>
                                </td>
                            @else
                                <td class="p-4 text-sm border-b border-gray-200">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center mr-2">
                                            <i class="fas fa-check text-green-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-green-600">{{__('ORDER COMPLETED')}}</p>
                                            <p class="text-xs text-gray-500">{{ $transaction->updated_at->format('M d, Y h:i A') }}</p>
                                        </div>
                                    </div>
                                </td>
                            @endif
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