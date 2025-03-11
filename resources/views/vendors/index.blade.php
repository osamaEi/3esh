
@include('vendors.body.header')
    <!-- Main Content with Sidebar -->
    <main class="py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row">
            @if (Auth::guard('employee')->check())
                <aside class="w-full lg:w-64 bg-gradient-to-b from-purple-900 to-purple-700 text-white rounded-xl shadow-lg p-6 mb-6 lg:mb-0 lg:mr-6 transform transition-all duration-300 hover:shadow-xl">
                    <div class="flex items-center mb-6">
                        <i class="fas fa-store text-2xl mr-2 text-purple-200"></i>
                        <h3 class="text-xl font-bold tracking-wide">{{__('Vendor Hub')}}</h3>
                    </div>
                    <nav class="space-y-3">
                        <a href="{{ route('vendors.dashboard') }}" class="flex items-center p-3 text-purple-100 bg-purple-800 bg-opacity-50 rounded-lg hover:bg-purple-600 hover:text-white transition duration-300 ease-in-out transform hover:-translate-y-1 {{ request()->routeIs('vendors.dashboard') ? 'bg-purple-600 text-white' : '' }}">
                            <i class="fas fa-tachometer-alt mr-3 text-purple-300"></i>
                            <span class="font-medium">{{__('Dashboard')}}</span>
                        </a>
                        <a href="{{ route('vendors.branches.index') }}" class="flex items-center p-3 text-purple-100 bg-purple-800 bg-opacity-50 rounded-lg hover:bg-purple-600 hover:text-white transition duration-200 ease-in-out transform hover:-translate-y-0.5 {{ isActiveRouteVendor('vendors.branches') }}">
                            <i class="fas fa-tachometer-alt mr-3 text-purple-300"></i>
                            <span class="font-medium">{{__('Branches')}}</span>
                        </a>
                        <a href="{{ route('vendors.employees') }}" class="flex items-center p-3 text-purple-100 bg-purple-800 bg-opacity-50 rounded-lg hover:bg-purple-600 hover:text-white transition duration-200 ease-in-out transform hover:-translate-y-0.5 {{ isActiveRouteVendor('vendors.employees') }}">
                            <i class="fas fa-users mr-3 text-purple-300"></i>
                            <span class="font-medium">{{__('Employees')}}</span>
                        </a>
                        
                        <a href="{{ route('vendors.discount-transactions.index') }}" class="flex items-center p-3 text-purple-100 bg-purple-800 bg-opacity-50 rounded-lg hover:bg-purple-600 hover:text-white transition duration-200 ease-in-out transform hover:-translate-y-0.5 {{ isActiveRouteVendor('vendors.employees') }}">
                            <i class="fas fa-users mr-3 text-purple-300"></i>
                            <span class="font-medium">{{__('Discount Transaction')}}</span>
                        </a>
                        <form action="{{ route('vendors.logout') }}" method="POST" class="flex items-center">
                            @csrf
                            <button type="submit" class="w-full flex items-center p-3 text-purple-100 bg-purple-800 bg-opacity-50 rounded-lg hover:bg-purple-600 hover:text-white transition duration-200 ease-in-out transform hover:-translate-y-0.5 {{ isActiveRouteVendor('vendors.logout') }}">
                                <i class="fas fa-sign-out-alt mr-3 text-purple-300"></i>
                                <span class="font-medium">{{__('Logout')}}</span>
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
@include('vendors.body.footer')

    <!-- JavaScript for Dropdowns -->
  
</body>
</html>