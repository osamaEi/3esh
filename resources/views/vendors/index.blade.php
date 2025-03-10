
@include('vendors.body.header')
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
                        <a href="{{ route('vendors.dashboard') }}" class="flex items-center p-3 text-purple-100 bg-purple-800 bg-opacity-50 rounded-lg hover:bg-purple-600 hover:text-white transition duration-300 ease-in-out transform hover:-translate-y-1 {{ request()->routeIs('vendors.dashboard') ? 'bg-purple-600 text-white' : '' }}">
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
                        
                        <a href="{{ route('vendors.discount-transactions.index') }}" class="flex items-center p-3 text-purple-100 bg-purple-800 bg-opacity-50 rounded-lg hover:bg-purple-600 hover:text-white transition duration-200 ease-in-out transform hover:-translate-y-0.5 {{ isActiveRouteVendor('vendors.employees') }}">
                            <i class="fas fa-users mr-3 text-purple-300"></i>
                            <span class="font-medium">Discount Transaction</span>
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