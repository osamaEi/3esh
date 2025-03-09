<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Live Plus - Vendor Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="font-sans">
    <!-- Header Navigation -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-6 flex justify-between items-center">
            <a href="{{ url('/') }}"  class="h-12 w-12">
                <img src="{{asset('photos/logo.png')}}" alt="Live Plus Logo" class="h-15 w-15 p-1">
            </a>
            <nav class="hidden md:flex space-x-8">
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-purple-700">Home</a>
                <a href="{{ url('/learn') }}" class="text-gray-700 hover:text-purple-700">Learn</a>
                <a href="{{ url('/faqs') }}" class="text-gray-700 hover:text-purple-700">FAQs</a>
                <a href="{{ url('/join') }}" class="text-gray-700 hover:text-purple-700">Join us</a>
            </nav>
            <a href="{{ url('/install') }}" class="bg-purple-700 text-white px-6 py-2 rounded-lg hover:bg-purple-800 transition duration-300">Install App</a>
        </div>
    </header>
    <main class="py-12">

    <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Vendor Employee Login</h2>

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
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
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
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
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
                <label for="remember" class="ml-2 text-sm text-gray-700">Remember Me</label>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" 
                        class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Login
                </button>
            </div>
        </form>
    </div>
    </main>
    <footer class="bg-black text-white py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div>
                    <img src="{{asset('photos/logo.png')}}" alt="Live Plus Logo" class="h-13 w-13 p-1 mb-4">
                    <p class="text-gray-400 mb-6">Transform your crypto business with Crypgo Premier, a template for startups and blockchain services.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Features</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Benefits</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Services</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Why us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">FAQs</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Other Pages</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Error 404</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Terms & Conditions</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Privacy Policy</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Download app</h4>
                    <div class="flex flex-col space-y-3">
                        <a href="#" class="flex items-center bg-black text-white border border-gray-700 px-4 py-2 rounded-lg hover:bg-gray-900 transition duration-300">
                            <i class="fab fa-google-play mr-2 text-2xl"></i>
                            <div>
                                <div class="text-xs">GET IT ON</div>
                                <div class="text-sm font-semibold">Google Play</div>
                            </div>
                        </a>
                        <a href="#" class="flex items-center bg-black text-white border border-gray-700 px-4 py-2 rounded-lg hover:bg-gray-900 transition duration-300">
                            <i class="fab fa-apple mr-2 text-2xl"></i>
                            <div>
                                <div class="text-xs">Download on the</div>
                                <div class="text-sm font-semibold">App Store</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <div class="text-gray-500 mb-4 md:mb-0">Terms & Agreements</div>
                <div class="text-gray-500 mb-4 md:mb-0">Developed by TQNIA All rights reserved</div>
                <div class="text-gray-500">Privacy Policy</div>
            </div>
        </div>
    </footer>