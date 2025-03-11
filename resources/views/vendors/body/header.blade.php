<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ session()->get('locale') == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        <x-site_title />
    </title>
    
    
    <x-favicon />

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;700;900&display=swap" rel="stylesheet">


</head>

<style>

body, html {
    font-family: 'Cairo', sans-serif !important;
}

</style>
<body class="font-sans">
    <!-- Header Navigation -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-6 flex justify-between items-center">
            <a href="{{ url('/') }}" class="h-12 w-12">
                <img src="{{ asset('photos/logo.png') }}" alt="Live Plus Logo" class="h-15 w-15 p-1">
            </a>
           
            @if (Auth::guard('employee')->check())
                <nav class="hidden md:flex space-x-8 rtl:space-x-reverse">
                    <a href="{{ url('/') }}" class="text-gray-700 hover:text-purple-700">{{__('Home')}}</a>
                    <a href="{{ url('/learn') }}" class="text-gray-700 hover:text-purple-700">{{__('Learn')}}</a>
                    <a href="{{ url('/faqs') }}" class="text-gray-700 hover:text-purple-700">{{__('FAQs')}}</a>
                    <a href="{{ route('vendors.register') }}" class="text-gray-700 hover:text-purple-700">{{__('Join us')}}</a>
                
                    <div class="relative inline-block text-left">
                        <button id="languageDropdownButton" class="flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-md shadow-md hover:bg-gray-200 focus:outline-none">
                            <span class="mr-2">
                                @if(Session::get('locale') === 'ar') 🇦🇪 العربية @else 🇺🇸 English @endif
                            </span>
                            <i class="fas fa-chevron-down text-gray-500"></i>
                        </button>
                    
                        <div id="languageDropdownMenu" class="hidden absolute mt-2 w-40 bg-white border border-gray-200 rounded-md shadow-lg overflow-hidden">
                            <a href="{{ route('lang.switch', 'en') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ Session::get('locale') === 'en' ? 'font-bold' : '' }}">
                                🇺🇸 English
                            </a>
                            <a href="{{ route('lang.switch', 'ar') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ Session::get('locale') === 'ar' ? 'font-bold' : '' }}">
                                🇦🇪 العربية
                            </a>
                        </div>
                    </div>
                    
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            const dropdownButton = document.getElementById("languageDropdownButton");
                            const dropdownMenu = document.getElementById("languageDropdownMenu");
                    
                            dropdownButton.addEventListener("click", function () {
                                dropdownMenu.classList.toggle("hidden");
                            });
                    
                            document.addEventListener("click", function (event) {
                                if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                                    dropdownMenu.classList.add("hidden");
                                }
                            });
                        });
                    </script>
                    
                      
                     
                    
                    
                    
    
    
                </nav>                <div class="relative flex items-center space-x-4">
                    <!-- Dropdown Menu -->
                    <div class="relative">
                        <button id="menu-toggle" class="flex items-center text-gray-700 hover:text-purple-700 focus:outline-none">
                            <i class="fas fa-user mr-2"></i>
                            <span class="font-medium">{{ auth()->guard('employee')->user()->name ?? 'Guest' }}</span>
                        </button>
                        <div id="menu-dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-10 hidden">
                            <a href="{{ url('/') }}" class="block px-4 py-2 text-gray-700 hover:bg-purple-100 hover:text-purple-700">
                                <i class="fas fa-sign-out-alt mr-3 text-purple-300"></i>

                                profile</a>
                            <form action="{{ route('vendors.logout') }}" method="POST" class="flex items-center">
                                @csrf
                                <button type="submit" class="w-full flex items-center p-3    hover:text-white transition duration-200 ease-in-out transform hover:-translate-y-0.5 {{ isActiveRouteVendor('vendors.logout') }}">
                                    <i class="fas fa-sign-out-alt mr-3 text-purple-300"></i>
                                    <span class="font-medium">Logout</span>
                                </button>
                            </form>                            
                        </div>
                    </div>

                    <!-- Notifications -->
                    <div class="relative">
                        <button id="notifications-toggle" class="text-gray-700 hover:text-purple-700 focus:outline-none relative">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">3</span>
                        </button>
                        <div id="notifications-dropdown" class="absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg py-2 z-10 hidden">
                            <div class="px-4 py-2 text-sm text-gray-700 border-b border-gray-200">Notifications</div>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-100">New employee added</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-100">Settings updated</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-100">Client request pending</a>
                        </div>
                    </div>
                </div>
                 <!-- Default Navigation for Guests -->
              
            @else
               
                <a href="{{ url('/install') }}" class="bg-purple-700 text-white px-6 py-2 rounded-lg hover:bg-purple-800 transition duration-300">Install App</a>
            @endif
        </div>
    </header>