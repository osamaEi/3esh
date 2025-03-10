@extends('vendors.index')
@section('content')
    <div class="max-w-4xl mx-auto mt-10 px-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-800 flex items-center">
                <i class="fas fa-user-plus mr-3 text-purple-600"></i> {{__('Add New Employee')}}
            </h2>
            <a href="{{ route('vendors.employees') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-semibold rounded-lg shadow-md hover:bg-gray-700 transition duration-300 transform hover:-translate-y-1">
                <i class="fas fa-arrow-left mr-2"></i> {{__('Back to Employees')}}
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <form action="{{ route('vendors.employees.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Hidden Vendor ID -->
                <input type="hidden" name="vendor_id" value="{{ $vendorId }}">

                <!-- Branch ID -->
                <div>
                    <label for="branch_id" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-store-alt mr-1 text-purple-500"></i> {{__('Branch')}}
                    </label>
                    <select id="branch_id" name="branch_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200">
                        <option value="">{{__('Select a Branch (Optional)')}}</option>
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                        @endforeach
                    </select>
                    @error('branch_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-user mr-1 text-purple-500"></i> {{__('Name')}}
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200" required>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Position -->
                <div>
                    <label for="position" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-briefcase mr-1 text-purple-500"></i> {{__('Position')}}
                    </label>
                    <input type="text" id="position" name="position" value="{{ old('position') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200">
                    @error('position')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-envelope mr-1 text-purple-500"></i> {{__('Email')}}
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-phone mr-1 text-purple-500"></i> {{__('Phone')}}
                    </label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200">
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-lock mr-1 text-purple-500"></i> {{__('Password')}}
                    </label>
                    <input type="password" id="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200" required>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Photo -->
                <div>
                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-camera mr-1 text-purple-500"></i> {{__('Photo')}}
                    </label>
                    <input type="file" id="photo" name="photo" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200 text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-purple-100 file:text-purple-700 hover:file:bg-purple-200">
                    @error('photo')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-purple-600 text-white font-semibold rounded-lg shadow-md hover:bg-purple-700 transition duration-300 transform hover:-translate-y-1">
                        <i class="fas fa-save mr-2"></i> {{__('Save Employee')}}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection