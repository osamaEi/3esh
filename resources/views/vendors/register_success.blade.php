<!-- resources/views/vendors/register_success.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful - Live Plus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="font-sans bg-gray-100">
    <!-- Header Navigation -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-6 flex justify-between items-center">
            <a href="{{ url('/') }}">
                <img src="{{asset('photos/logo.png')}}" alt="Live Plus Logo" class="h-13 w-13 p-1">
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

    <!-- Success Content -->
    <main class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Success Header with Check Icon -->
                <div class="bg-green-50 p-6 sm:p-10 flex flex-col items-center">
                    <div class="rounded-full bg-green-100 p-3 mb-4">
                        <svg class="h-12 w-12 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 text-center">Registration Submitted Successfully!</h1>
                    <p class="mt-4 text-gray-600 text-center max-w-2xl">
                        Thank you for registering your business with Live Plus. Your application has been received and is pending review by our administrators.
                    </p>
                </div>

                <!-- Registration Details -->
                @if($vendor)
                <div class="p-6 sm:p-10 border-t border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6">Registration Details</h2>
                    
                    <div class="bg-gray-50 rounded-lg p-6 shadow-sm">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Business Information</h3>
                                <div class="mt-3 space-y-3">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Business Name</p>
                                        <p class="mt-1 text-base font-medium text-gray-900">{{ $vendor->business_name }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Email</p>
                                        <p class="mt-1 text-base text-gray-900">{{ $vendor->email }}</p>
                                    </div>
                                    @if($vendor->contact_person)
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Contact Person</p>
                                        <p class="mt-1 text-base text-gray-900">{{ $vendor->contact_person }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Registration Information</h3>
                                <div class="mt-3 space-y-3">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Reference Number</p>
                                        <p class="mt-1 text-base font-medium text-gray-900">VEN-{{ str_pad($vendor->id, 6, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Date Submitted</p>
                                        <p class="mt-1 text-base text-gray-900">{{ $vendor->created_at->format('F j, Y, g:i a') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Status</p>
                                        <p class="mt-1">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Pending Approval
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @if($vendor->employees && $vendor->employees->count() > 0)
                        <div class="mt-8">
                            <h3 class="text-sm font-medium text-gray-500 mb-3">Employees Submitted ({{ $vendor->employees->count() }})</h3>
                            <div class="bg-white overflow-hidden shadow-sm rounded-md">
                                <ul class="divide-y divide-gray-200">
                                    @foreach($vendor->employees as $employee)
                                    <li class="px-6 py-4 flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden bg-gray-200 flex items-center justify-center">
                                            @if($employee->photo)
                                                <img src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $employee->name }}" class="h-10 w-10 object-cover">
                                            @else
                                                <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="ml-4 flex-1">
                                            <div class="text-sm font-medium text-gray-900">{{ $employee->name }}</div>
                                            <div class="text-sm text-gray-500">
                                                @if($employee->position)
                                                    {{ $employee->position }}
                                                    @if($employee->email || $employee->phone) · @endif
                                                @endif
                                                @if($employee->email)
                                                    {{ $employee->email }}
                                                    @if($employee->phone) · @endif
                                                @endif
                                                @if($employee->phone)
                                                    {{ $employee->phone }}
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Next Steps -->
                <div class="p-6 sm:p-10 bg-indigo-50 border-t border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">What Happens Next?</h2>
                    
                    <ol class="space-y-6">
                        <li class="flex">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-8 w-8 rounded-full bg-indigo-100 text-indigo-600 font-semibold">1</div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-base font-medium text-gray-900">Application Review</h3>
                                <p class="mt-1 text-sm text-gray-600">Our team will review your application and verify the information provided.</p>
                            </div>
                        </li>
                        
                        <li class="flex">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-8 w-8 rounded-full bg-indigo-100 text-indigo-600 font-semibold">2</div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-base font-medium text-gray-900">Email Confirmation</h3>
                                <p class="mt-1 text-sm text-gray-600">You will receive an email notification regarding your application status within 2-3 business days.</p>
                            </div>
                        </li>
                        
                        <li class="flex">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-8 w-8 rounded-full bg-indigo-100 text-indigo-600 font-semibold">3</div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-base font-medium text-gray-900">Account Activation</h3>
                                <p class="mt-1 text-sm text-gray-600">Once approved, you'll receive login credentials to access your vendor dashboard.</p>
                            </div>
                        </li>
                    </ol>
                </div>

                <!-- Action Buttons -->
                <div class="px-6 sm:px-10 py-6 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                    <div class="text-sm text-gray-600">
                        Reference: <span class="font-medium">VEN-{{ str_pad($vendor->id ?? '000000', 6, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                        <a href="{{ url('/') }}" class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="fas fa-home mr-2"></i> Return to Home
                        </a>
                        <a href="{{ url('/faqs') }}" class="inline-flex justify-center items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="fas fa-question-circle mr-2"></i> View FAQs
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-black text-white py-16 mt-12">
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
</body>
</html>
