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
            <a href="{{ url('/') }}" class="h-12 w-12">
                <img src="{{ asset('photos/logo.png') }}" alt="Live Plus Logo" class="h-15 w-15 p-1">
            </a>

            @if (Auth::guard('employee')->check())
   <nav class="hidden md:flex space-x-8">
                    <a href="{{ url('/') }}" class="text-gray-700 hover:text-purple-700">Home</a>
                    <a href="{{ url('/learn') }}" class="text-gray-700 hover:text-purple-700">Learn</a>
                    <a href="{{ url('/faqs') }}" class="text-gray-700 hover:text-purple-700">FAQs</a>
                    <a href="{{ url('/join') }}" class="text-gray-700 hover:text-purple-700">Join us</a>
                </nav>                <div class="relative flex items-center space-x-4">
                    <!-- Dropdown Menu -->
                    <div class="relative">
                        <button id="menu-toggle" class="flex items-center text-gray-700 hover:text-purple-700 focus:outline-none">
                            <i class="fas fa-user mr-2"></i>
                            <span class="font-medium">{{ auth()->guard('employee')->user()->name ?? 'Guest' }}</span>
                        </button>
                        <div id="menu-dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-10 hidden">
                            <a href="{{ url('/') }}" class="block px-4 py-2 text-gray-700 hover:bg-purple-100 hover:text-purple-700">Home</a>
                            <a href="{{ url('/learn') }}" class="block px-4 py-2 text-gray-700 hover:bg-purple-100 hover:text-purple-700">Learn</a>
                            <a href="{{ url('/faqs') }}" class="block px-4 py-2 text-gray-700 hover:bg-purple-100 hover:text-purple-700">FAQs</a>
                            <a href="{{ url('/join') }}" class="block px-4 py-2 text-gray-700 hover:bg-purple-100 hover:text-purple-700">Join us</a>
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

    <!-- Main Content with Sidebar -->
    <main class="py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row">
            @if (Auth::guard('employee')->check())
                <aside class="w-full lg:w-64 bg-gradient-to-b from-purple-900 to-purple-700 text-white rounded-xl shadow-lg p-6 mb-6 lg:mb-0 lg:mr-6 transform transition-all duration-300 hover:shadow-xl">
                    <div class="flex items-center mb-6">
                        <i class="fas fa-store text-2xl mr-2 text-purple-200"></i>
                        <h3 class="text-xl font-bold tracking-wide">Vendor Hub</h3>
                    </div>
                    <nav class="space-y-3">
                        <a href="{{ route('vendors.dashboard') }}" class="flex items-center p-3 text-purple-100 bg-purple-800 bg-opacity-50 rounded-lg hover:bg-purple-600 hover:text-white transition duration-200 ease-in-out transform hover:-translate-y-0.5 {{ isActiveRouteVendor('vendors.dashboard') }}">
                            <i class="fas fa-tachometer-alt mr-3 text-purple-300"></i>
                            <span class="font-medium">Dashboard</span>
                        </a>
                        <a href="{{ route('vendors.branches.index') }}" class="flex items-center p-3 text-purple-100 bg-purple-800 bg-opacity-50 rounded-lg hover:bg-purple-600 hover:text-white transition duration-200 ease-in-out transform hover:-translate-y-0.5 {{ isActiveRouteVendor('vendors.branches') }}">
                            <i class="fas fa-tachometer-alt mr-3 text-purple-300"></i>
                            <span class="font-medium">Branches</span>
                        </a>
                        <a href="{{ route('vendors.employees') }}" class="flex items-center p-3 text-purple-100 bg-purple-800 bg-opacity-50 rounded-lg hover:bg-purple-600 hover:text-white transition duration-200 ease-in-out transform hover:-translate-y-0.5 {{ isActiveRouteVendor('vendors.employees') }}">
                            <i class="fas fa-users mr-3 text-purple-300"></i>
                            <span class="font-medium">Employees</span>
                        </a>
                        <form action="{{ route('vendors.logout') }}" method="POST" class="flex items-center">
                            @csrf
                            <button type="submit" class="w-full flex items-center p-3 text-purple-100 bg-purple-800 bg-opacity-50 rounded-lg hover:bg-purple-600 hover:text-white transition duration-200 ease-in-out transform hover:-translate-y-0.5 {{ isActiveRouteVendor('vendors.logout') }}">
                                <i class="fas fa-sign-out-alt mr-3 text-purple-300"></i>
                                <span class="font-medium">Logout</span>
                            </button>
                        </form>
                    </nav>
                </aside>
            @endif

            <!-- Main Content Area -->
            <div class="flex-1 max-w-4xl">
                @yield('content')
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-black text-white py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div>
                    <img src="{{ asset('photos/logo.png') }}" alt="Live Plus Logo" class="h-13 w-13 p-1 mb-4">
                    <p class="text-gray-400 mb-6">Transform your crypto business with Crypgo Premier, a template for startups and blockchain services.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
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

    <!-- JavaScript for Dropdowns -->
    @if (Auth::guard('employee')->check())
        <script>
            document.getElementById('menu-toggle').addEventListener('click', function () {
                const dropdown = document.getElementById('menu-dropdown');
                dropdown.classList.toggle('hidden');
            });

            document.getElementById('notifications-toggle').addEventListener('click', function () {
                const dropdown = document.getElementById('notifications-dropdown');
                dropdown.classList.toggle('hidden');
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function (event) {
                const menuToggle = document.getElementById('menu-toggle');
                const menuDropdown = document.getElementById('menu-dropdown');
                const notificationsToggle = document.getElementById('notifications-toggle');
                const notificationsDropdown = document.getElementById('notifications-dropdown');

                if (!menuToggle.contains(event.target) && !menuDropdown.contains(event.target)) {
                    menuDropdown.classList.add('hidden');
                }
                if (!notificationsToggle.contains(event.target) && !notificationsDropdown.contains(event.target)) {
                    notificationsDropdown.classList.add('hidden');
                }
            });
        </script>
    @endif
</body>
</html>