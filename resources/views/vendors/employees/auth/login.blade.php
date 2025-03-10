@include('vendors.body.header')
    <main class="py-12">

    <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">{{__('Vendor Employee Login')}}</h2>

        <!-- Error Message -->
        @if ($errors->has('email'))
            <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                {{ $errors->first('email') }}
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('vendors.login') }}">
            @csrf

            <!-- Email Field -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">{{__('Email Address')}}</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       class="mt-1 block w-full p-2 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                       required>
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">{{__('Password')}}</label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       class="mt-1 block w-full p-2 border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                       required>
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me Checkbox -->
            <div class="mb-6 flex items-center">
                <input type="checkbox" 
                       id="remember" 
                       name="remember" 
                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                <label for="remember" class="ml-2 text-sm text-gray-700">{{__('Remember Me')}}</label>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" 
                        class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        {{__('Login')}}
                </button>
            </div>
        </form>
    </div>
    </main>
   @include('vendors.body.footer')