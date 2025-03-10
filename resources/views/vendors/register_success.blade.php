@include(vendors.body.header)

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
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 text-center">{{__('Registration Submitted Successfully!')}}</h1>
                    <p class="mt-4 text-gray-600 text-center max-w-2xl">
                        {{__('Thank you for registering your business with Live Plus. Your application has been received and is pending review by our administrators.')}}
                    </p>
                </div>

                <!-- Registration Details -->
                @if($vendor)
                <div class="p-6 sm:p-10 border-t border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6">{{__('Registration Details')}}</h2>
                    
                    <div class="bg-gray-50 rounded-lg p-6 shadow-sm">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">{{__('Business Information')}}</h3>
                                <div class="mt-3 space-y-3">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">{{__('Business Name')}}</p>
                                        <p class="mt-1 text-base font-medium text-gray-900">{{ $vendor->business_name }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">{{__('Email')}}</p>
                                        <p class="mt-1 text-base text-gray-900">{{ $vendor->email }}</p>
                                    </div>
                                    @if($vendor->contact_person)
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">{{__('Contact Person')}}</p>
                                        <p class="mt-1 text-base text-gray-900">{{ $vendor->contact_person }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">{{__('Registration Information')}}</h3>
                                <div class="mt-3 space-y-3">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">{{__('Reference Number')}}</p>
                                        <p class="mt-1 text-base font-medium text-gray-900">VEN-{{ str_pad($vendor->id, 6, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">{{__('Date Submitted')}}</p>
                                        <p class="mt-1 text-base text-gray-900">{{ $vendor->created_at->format('F j, Y, g:i a') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">{{__('Status')}}</p>
                                        <p class="mt-1">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                {{__(' Pending Approval')}}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @if($vendor->employees && $vendor->employees->count() > 0)
                        <div class="mt-8">
                            <h3 class="text-sm font-medium text-gray-500 mb-3">{{__('Employees Submitted')}} ({{ $vendor->employees->count() }})</h3>
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
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">{{__('What Happens Next?')}}</h2>
                    
                    <ol class="space-y-6">
                        <li class="flex">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-8 w-8 rounded-full bg-indigo-100 text-indigo-600 font-semibold">1</div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-base font-medium text-gray-900">{{__('Application Review')}}</h3>
                                <p class="mt-1 text-sm text-gray-600">{{__('Our team will review your application and verify the information provided.')}}</p>
                            </div>
                        </li>
                        
                        <li class="flex">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-8 w-8 rounded-full bg-indigo-100 text-indigo-600 font-semibold">2</div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-base font-medium text-gray-900">{{__('Email Confirmation')}}</h3>
                                <p class="mt-1 text-sm text-gray-600">{{__('You will receive an email notification regarding your application status within 2-3 business days.')}}</p>
                            </div>
                        </li>
                        
                        <li class="flex">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-8 w-8 rounded-full bg-indigo-100 text-indigo-600 font-semibold">3</div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-base font-medium text-gray-900">{{__('Account Activation')}}</h3>
                                <p class="mt-1 text-sm text-gray-600">{{__('Once approved, you ll receive login credentials to access your vendor dashboard.')}}</p>
                            </div>
                        </li>
                    </ol>
                </div>

                <!-- Action Buttons -->
                <div class="px-6 sm:px-10 py-6 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                    <div class="text-sm text-gray-600">
                        {{__('Reference')}}: <span class="font-medium">VEN-{{ str_pad($vendor->id ?? '000000', 6, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                        <a href="{{ url('/') }}" class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="fas fa-home mr-2"></i> {{__('Return to Home')}}
                        </a>
                        <a href="{{ url('/faqs') }}" class="inline-flex justify-center items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="fas fa-question-circle mr-2"></i> {{__('View FAQs')}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    @include(vendors.body.footer)

</body>
</html>
