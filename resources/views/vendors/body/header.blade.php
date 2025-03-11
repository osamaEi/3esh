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
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">

    <style>
        body, html {
            font-family: 'Cairo', sans-serif !important;
        }
        
        .menu-transition {
            transition: all 0.3s ease;
        }
        
        .notification-badge {
            animation: pulse 1.5s infinite;
        }
        /* Add this to your existing CSS */
[dir="rtl"] .dropdown-menu {
    right: auto;
    left: 0;
}
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        .mobile-menu {
            transform: translateY(-100%);
            transition: transform 0.3s ease-in-out;
        }
        
        .mobile-menu.active {
            transform: translateY(0);
        }
        
        /* Fix for dropdown positioning */
        .dropdown-menu {
            position: absolute;
            z-index: 50;
            display: none;
        }
        
        .dropdown-menu.show {
            display: block;
        }
    </style>
</head>

<body class="font-sans bg-gray-50">
    <!-- Header Navigation -->
    <header class="bg-white">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <!-- Logo with improved sizing and hover effect -->
            <a href="{{ url('/') }}" class="flex items-center transition-transform duration-300 hover:scale-105">
                <img src="{{ asset('photos/logo.png') }}" alt="Live Plus Logo" class="h-14 w-auto">
            </a>
            
            <!-- Desktop Navigation with improved spacing and animations -->
            <nav class="hidden md:flex space-x-10 rtl:space-x-reverse">
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-purple-700 font-medium transition-colors duration-300 border-b-2 border-transparent hover:border-purple-700 py-1 {{ request()->is('/') ? 'text-purple-700 border-purple-700' : '' }}">
                    {{__('Home')}}
                </a>
                <a href="{{ url('/learn') }}" class="text-gray-700 hover:text-purple-700 font-medium transition-colors duration-300 border-b-2 border-transparent hover:border-purple-700 py-1 {{ request()->is('learn') ? 'text-purple-700 border-purple-700' : '' }}">
                    {{__('Learn')}}
                </a>
                <a href="{{ route('vendors.login') }}" class="text-gray-700 hover:text-purple-700 font-medium transition-colors duration-300 border-b-2 border-transparent hover:border-purple-700 py-1 {{ request()->is('faqs') ? 'text-purple-700 border-purple-700' : '' }}">
                    {{__('Vendor')}}
                </a>
            
                @if(Auth::guard('employee')->check())
                
                <a href="{{ route('vendors.dashboard') }}" class="text-gray-700 hover:text-purple-700 font-medium transition-colors duration-300 border-b-2 border-transparent hover:border-purple-700 py-1 {{ request()->routeIs('vendors.register') ? 'text-purple-700 border-purple-700' : '' }}">
                    {{__('Dashboard')}}
                </a>
                @else
                <a href="{{ route('vendors.register') }}" class="text-gray-700 hover:text-purple-700 font-medium transition-colors duration-300 border-b-2 border-transparent hover:border-purple-700 py-1 {{ request()->routeIs('vendors.register') ? 'text-purple-700 border-purple-700' : '' }}">
                    {{__('Join us')}}
                </a>
                
                @endif
                <!-- Language Dropdown with improved UI -->
                <div class="relative inline-block text-left">
                    <button id="languageDropdownButton" class="flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg shadow-sm hover:bg-gray-200 focus:outline-none transition-colors duration-300">
                        <span class="mr-2 font-medium">
                            @if(Session::get('locale') === 'ar') 🇦🇪 العربية @else 🇺🇸 English @endif
                        </span>
                        <i class="fas fa-chevron-down text-gray-500"></i>
                    </button>
                    <div id="languageDropdownMenu" class="dropdown-menu mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden">
                        <a href="{{ route('lang.switch', 'en') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition-colors duration-200 {{ Session::get('locale') === 'en' ? 'bg-purple-50 font-bold text-purple-700' : '' }}">
                            🇺🇸 English
                        </a>
                        <a href="{{ route('lang.switch', 'ar') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition-colors duration-200 {{ Session::get('locale') === 'ar' ? 'bg-purple-50 font-bold text-purple-700' : '' }}">
                            🇦🇪 العربية
                        </a>
                    </div>
                </div>
            </nav>
            
            <!-- Mobile Menu Button -->
            <button id="mobile-menu-button" class="md:hidden flex items-center text-gray-700 focus:outline-none">
                <i class="fas fa-bars text-xl"></i>
            </button>
            
            <!-- User Actions -->
            @if (Auth::guard('employee')->check())
                <div class="hidden md:flex items-center space-x-6 rtl:space-x-reverse">
                    <!-- Notifications -->
                    <div class="relative">
                        <button id="notifications-toggle" class="text-gray-700 hover:text-purple-700 focus:outline-none relative transition-colors duration-300">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="notification-badge absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">
                                3
                            </span>
                        </button>
                        <div id="notifications-dropdown" class="dropdown-menu right-0 mt-2 w-80 bg-white rounded-lg shadow-lg py-2">
                            <div class="px-4 py-2 text-sm font-medium text-gray-700 border-b border-gray-200 flex justify-between items-center">
                                <span>Notifications</span>
                                <a href="#" class="text-purple-600 text-xs hover:underline">Mark all as read</a>
                            </div>
                            <div class="max-h-64 overflow-y-auto">
                                <a href="#" class="block px-4 py-3 text-sm border-b border-gray-100 hover:bg-purple-50">
                                    <div class="font-medium text-gray-800">New employee added</div>
                                    <div class="text-gray-500 text-xs mt-1">2 minutes ago</div>
                                </a>
                                <a href="#" class="block px-4 py-3 text-sm border-b border-gray-100 hover:bg-purple-50">
                                    <div class="font-medium text-gray-800">Settings updated</div>
                                    <div class="text-gray-500 text-xs mt-1">1 hour ago</div>
                                </a>
                                <a href="#" class="block px-4 py-3 text-sm hover:bg-purple-50">
                                    <div class="font-medium text-gray-800">Client request pending</div>
                                    <div class="text-gray-500 text-xs mt-1">3 hours ago</div>
                                </a>
                            </div>
                            <div class="px-4 py-2 border-t border-gray-200">
                                <a href="#" class="text-purple-600 text-sm font-medium hover:underline block text-center">
                                    View all notifications
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- User Dropdown -->
                    <div class="relative">
                        <button id="menu-toggle" class="flex items-center text-gray-700 hover:text-purple-700 focus:outline-none transition-colors duration-300">
                            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-2">
                                <i class="fas fa-user text-purple-700"></i>
                            </div>
                            <span class="font-medium">{{ auth()->guard('employee')->user()->name ?? 'Guest' }}</span>
                            <i class="fas fa-chevron-down ml-2 text-gray-500 text-xs"></i>
                        </button>
                        <div id="menu-dropdown" class="dropdown-menu right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2">
                          
                           
                            <form action="{{ route('vendors.logout') }}" method="POST" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-3 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition-colors duration-200">
                                    <i class="fas fa-sign-out-alt mr-3 text-purple-500"></i>
                                    <span class="font-medium">{{__('Logout')}}</span>
                                </button>
                            </form>                            
                        </div>
                    </div>
                </div>
            @else
                <div class="hidden md:block">
                    <a href="{{ url('/install') }}" class="bg-purple-700 text-white px-6 py-2 rounded-lg hover:bg-purple-800 transition duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        Install App
                    </a>
                </div>
            @endif
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="mobile-menu md:hidden bg-white shadow-lg absolute w-full z-30">
            <div class="px-4 py-3 space-y-4">
                <a href="{{ url('/') }}" class="block py-2 text-gray-700 font-medium {{ request()->is('/') ? 'text-purple-700' : '' }}">
                    {{__('Home')}}
                </a>
                <a href="{{ url('/learn') }}" class="block py-2 text-gray-700 font-medium {{ request()->is('learn') ? 'text-purple-700' : '' }}">
                    {{__('Learn')}}
                </a>
                <a href="{{ url('/faqs') }}" class="block py-2 text-gray-700 font-medium {{ request()->is('faqs') ? 'text-purple-700' : '' }}">
                    {{__('FAQs')}}
                </a>

                @if(Auth::guard('employee')->check())
                <a href="{{ route('vendors.dashboard') }}" class="block py-2 text-gray-700 font-medium {{ request()->routeIs('vendors.register') ? 'text-purple-700' : '' }}">
                    {{__('Dashboard')}}
                </a>
                @else
                <a href="{{ route('vendors.register') }}" class="block py-2 text-gray-700 font-medium {{ request()->routeIs('vendors.register') ? 'text-purple-700' : '' }}">
                    {{__('Join us')}}
                </a>
                
                @endif
                <!-- Language Selection for Mobile -->
                <div class="py-2">
                    <p class="text-gray-500 text-sm mb-2">{{__('Select Language')}}</p>
                    <div class="flex space-x-2 rtl:space-x-reverse">
                        <a href="{{ route('lang.switch', 'en') }}" class="px-3 py-2 rounded-md {{ Session::get('locale') === 'en' ? 'bg-purple-100 text-purple-700 font-medium' : 'bg-gray-100 text-gray-700' }}">
                            🇺🇸 English
                        </a>
                        <a href="{{ route('lang.switch', 'ar') }}" class="px-3 py-2 rounded-md {{ Session::get('locale') === 'ar' ? 'bg-purple-100 text-purple-700 font-medium' : 'bg-gray-100 text-gray-700' }}">
                            🇦🇪 العربية
                        </a>
                    </div>
                </div>
                
                @if (Auth::guard('employee')->check())
                    <!-- User Actions for Mobile -->
                    <div class="border-t border-gray-200 pt-3">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user text-purple-700"></i>
                            </div>
                            <span class="font-medium">{{ auth()->guard('employee')->user()->name ?? 'Guest' }}</span>
                        </div>
                        <a href="{{ url('/profile') }}" class="block py-2 text-gray-700">
                            <i class="fas fa-user-circle mr-3 text-purple-500"></i>
                            Profile
                        </a>
                        <a href="{{ url('/notifications') }}" class="block py-2 text-gray-700 relative">
                            <i class="fas fa-bell mr-3 text-purple-500"></i>
                            Notifications
                            <span class="absolute top-2 left-6 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">
                                3
                            </span>
                        </a>
                        <a href="{{ url('/settings') }}" class="block py-2 text-gray-700">
                            <i class="fas fa-cog mr-3 text-purple-500"></i>
                            Settings
                        </a>
                        <form action="{{ route('vendors.logout') }}" method="POST" class="block pt-2">
                            @csrf
                            <button type="submit" class="w-full text-left py-2 text-gray-700">
                                <i class="fas fa-sign-out-alt mr-3 text-purple-500"></i>
                                <span class="font-medium">Logout</span>
                            </button>
                        </form>
                    </div>
                @else
                    <div class="pt-2">
                        <a href="{{ url('/install') }}" class="block w-full bg-purple-700 text-white px-6 py-3 rounded-lg text-center font-medium hover:bg-purple-800 transition duration-300">
                            Install App
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </header>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Fix for dropdown functionality
            function setupDropdown(toggleId, menuId) {
                const toggleBtn = document.getElementById(toggleId);
                const menu = document.getElementById(menuId);
                
                if (!toggleBtn || !menu) return;
                
                toggleBtn.addEventListener("click", function (e) {
                    e.stopPropagation();
                    
                    // Close all other dropdowns first
                    document.querySelectorAll('.dropdown-menu').forEach(function(dropdown) {
                        if (dropdown.id !== menuId) {
                            dropdown.classList.remove('show');
                        }
                    });
                    
                    // Toggle the current dropdown
                    menu.classList.toggle('show');
                });
            }
            
            // Setup all dropdowns
            setupDropdown("languageDropdownButton", "languageDropdownMenu");
            setupDropdown("menu-toggle", "menu-dropdown");
            setupDropdown("notifications-toggle", "notifications-dropdown");
            
            // Mobile menu toggle
            const mobileMenuButton = document.getElementById("mobile-menu-button");
            const mobileMenu = document.getElementById("mobile-menu");
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener("click", function () {
                    mobileMenu.classList.toggle("active");
                });
            }
            
            // Close all dropdowns when clicking outside
            document.addEventListener("click", function (e) {
                document.querySelectorAll('.dropdown-menu').forEach(function(dropdown) {
                    dropdown.classList.remove('show');
                });
            });
            
            // Prevent dropdown closing when clicking inside
            document.querySelectorAll('.dropdown-menu').forEach(function(dropdown) {
                dropdown.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            });
        });
    </script>
