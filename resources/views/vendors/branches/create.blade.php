@extends('vendors.index')
@section('content')
    <div class="max-w-4xl mx-auto mt-10 px-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-800 flex items-center">
                <i class="fas fa-store-plus mr-3 text-purple-600"></i> {{__('Add New Branch')}}
            </h2>
            <a href="{{ route('vendors.branches.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-semibold rounded-lg shadow-md hover:bg-gray-700 transition duration-300 transform hover:-translate-y-1">
                <i class="fas fa-arrow-left mr-2"></i> {{__('Back to Branches')}}
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <form action="{{ route('vendors.branches.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Hidden Vendor ID -->
                <input type="hidden" name="vendor_id" value="{{ $vendorId }}">

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-store mr-1 text-purple-500"></i> {{__('Name')}}
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200" required>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Address -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-map-marker-alt mr-1 text-purple-500"></i> {{__('Address')}}
                    </label>
                    <textarea id="address" name="address" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200" rows="3">{{ old('address') }}</textarea>
                    @error('address')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Latitude -->
                <div>
                    <label for="latitude" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-map-pin mr-1 text-purple-500"></i> {{__('Latitude')}}
                    </label>
                    <input type="number" id="latitude" name="latitude" value="{{ old('latitude') }}" step="any" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200">
                    @error('latitude')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Longitude -->
                <div>
                    <label for="longitude" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-map-pin mr-1 text-purple-500"></i> {{__('Longitude')}}
                    </label>
                    <input type="number" id="longitude" name="longitude" value="{{ old('longitude') }}" step="any" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200">
                    @error('longitude')
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

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-envelope mr-1 text-purple-500"></i>{{__('Email')}}
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Manager Name -->
                <div>
                    <label for="manager_name" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-user-tie mr-1 text-purple-500"></i> {{__('Manager Name')}}
                    </label>
                    <input type="text" id="manager_name" name="manager_name" value="{{ old('manager_name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200">
                    @error('manager_name')
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

                <!-- Is Approved -->
             

                <!-- Is Active -->
                <div>
                    <label for="is_active" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-toggle-on mr-1 text-purple-500"></i> {{__('Is Active')}}
                    </label>
                    <select id="is_active" name="is_active" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200">
                        <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>{{__('Yes')}}</option>
                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>{{__('No')}}</option>
                    </select>
                    @error('is_active')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Opening Time -->
                <div>
                    <label for="opening_time" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-clock mr-1 text-purple-500"></i> {{__('Opening Time (HH:MM)')}}
                    </label>
                    <input type="time" id="opening_time" name="opening_time" value="{{ old('opening_time') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200">
                    @error('opening_time')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Closing Time -->
                <div>
                    <label for="closing_time" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-clock mr-1 text-purple-500"></i> {{__('Closing Time (HH:MM)')}}
                    </label>
                    <input type="time" id="closing_time" name="closing_time" value="{{ old('closing_time') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200">
                    @error('closing_time')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Working Days -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-calendar-day mr-1 text-purple-500"></i> {{__('Working Days')}}
                    </label>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                            <label class="flex items-center">
                                <input type="checkbox" name="working_days[]" value="{{ $day }}" {{ in_array($day, old('working_days', [])) ? 'checked' : '' }} class="mr-2 text-purple-500 focus:ring-purple-500">
                                <span class="text-sm text-gray-600">{{ $day }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('working_days')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Notes -->
                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-sticky-note mr-1 text-purple-500"></i> {{__('Notes')}}
                    </label>
                    <textarea id="notes" name="notes" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200" rows="3">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-purple-600 text-white font-semibold rounded-lg shadow-md hover:bg-purple-700 transition duration-300 transform hover:-translate-y-1">
                        <i class="fas fa-save mr-2"></i> {{__('Save Branch')}}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection