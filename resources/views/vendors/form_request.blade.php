
@include('vendors.body.header')
    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-xl font-semibold text-gray-800">{{__('Vendor Registration')}}</h2>
                        </div>

                        <div id="alert-container" class="mb-4 hidden">
                            <div id="success-alert" class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg hidden" role="alert"></div>
                            <div id="error-alert" class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg hidden" role="alert"></div>
                        </div>

                        <form id="vendor-registration-form" action="{{ route('vendors.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                            @csrf
                            
                            <!-- Vendor Information Section -->
                            <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">{{__('Business Information')}}</h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Business Name -->
                                    <div>
                                        <label for="business_name" class="block text-sm font-medium text-gray-700">{{__('Business Name')}} <span class="text-red-500">*</span></label>
                                        <input type="text" name="business_name" id="business_name" value="{{ old('business_name') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        <p class="mt-1 text-xs text-red-600 hidden" id="business_name-error"></p>
                                        @error('business_name')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700">{{__('Email Address')}} <span class="text-red-500">*</span></label>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        <p class="mt-1 text-xs text-red-600 hidden" id="email-error"></p>
                                        @error('email')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Contact Person -->
                                    <div>
                                        <label for="contact_person" class="block text-sm font-medium text-gray-700">Contact Person')}}</label>
                                        <input type="text" name="contact_person" id="contact_person" value="{{ old('contact_person') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        <p class="mt-1 text-xs text-red-600 hidden" id="contact_person-error"></p>
                                        @error('contact_person')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                    <!-- Logo Upload -->
                                    <div>
                                        <label for="logo" class="block text-sm font-medium text-gray-700">{{__('Company Logo')}}</label>
                                        <div class="mt-1 flex items-center">
                                            <div id="logo-preview" class="w-24 h-24 border border-gray-300 rounded-md overflow-hidden bg-gray-100 flex items-center justify-center">
                                                <svg class="h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <input type="file" name="logo" id="logo" class="hidden" accept="image/*">
                                            <button type="button" id="logo-btn" class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                {{__('Choose Logo')}}
                                            </button>
                                        </div>
                                        <p class="mt-1 text-xs text-red-600 hidden" id="logo-error"></p>
                                        @error('logo')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Photo Upload -->
                                    <div>
                                        <label for="photo" class="block text-sm font-medium text-gray-700">{{__('Business Photo')}}</label>
                                        <div class="mt-1 flex items-center">
                                            <div id="photo-preview" class="w-24 h-24 border border-gray-300 rounded-md overflow-hidden bg-gray-100 flex items-center justify-center">
                                                <svg class="h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <input type="file" name="photo" id="photo" class="hidden" accept="image/*">
                                            <button type="button" id="photo-btn" class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                {{__('Choose Photo')}}
                                            </button>
                                        </div>
                                        <p class="mt-1 text-xs text-red-600 hidden" id="photo-error"></p>
                                        @error('photo')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Employees Section -->
                            <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-medium text-gray-900">{{__('Employees')}}</h3>
                                    <button type="button" id="add-employee-btn" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <svg class="-ml-0.5 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                        </svg>
                                        {{__('Add Employee')}}
                                    </button>
                                </div>

                                <div id="employees-container">
                                    <!-- Employee template - This will be cloned by JS -->
                                    <div id="employee-template" class="employee-entry hidden border border-gray-200 rounded-md p-4 mb-4">
                                        <div class="flex justify-between items-center mb-4">
                                            <h4 class="text-md font-medium text-gray-700">{{__('Employee')}} <span class="employee-number">1</span></h4>
                                            <button type="button" class="remove-employee text-red-500 hover:text-red-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <!-- Employee Name -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">{{__('Name')}} <span class="text-red-500">*</span></label>
                                                <input type="text" name="employees[0][name]" class="employee-name mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                <p class="mt-1 text-xs text-red-600 hidden employee-name-error"></p>
                                            </div>

                                            <!-- Employee Position -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">{{__('Position')}}</label>
                                                <input type="text" name="employees[0][position]" class="employee-position mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            </div>

                                            <!-- Employee Email -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">{{__('Email')}}</label>
                                                <input type="email" name="employees[0][email]" class="employee-email mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                <p class="mt-1 text-xs text-red-600 hidden employee-email-error"></p>
                                            </div>

                                            <!-- Employee Phone -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">{{__('Phone')}}</label>
                                                <input type="text" name="employees[0][phone]" class="employee-phone mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            </div>


    <!-- Employee Password -->
    <div>
        <label class="block text-sm font-medium text-gray-700">{{__('Password')}} <span class="text-red-500">*</span></label>
        <input type="password" name="employees[0][password]" class="employee-password mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        <p class="mt-1 text-xs text-red-600 hidden employee-password-error"></p>
    </div>

    <!-- Employee Password Confirmation -->
    <div>
        <label class="block text-sm font-medium text-gray-700">{{__('Confirm Password')}} <span class="text-red-500">*</span></label>
        <input type="password" name="employees[0][password_confirmation]" class="employee-password-confirmation mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
    </div>
                                        </div>

                                        <div class="mt-4">
                                            <!-- Employee Photo -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">{{__('Photo')}}</label>
                                                <div class="mt-1 flex items-center">
                                                    <div class="employee-photo-preview w-16 h-16 border border-gray-300 rounded-md overflow-hidden bg-gray-100 flex items-center justify-center">
                                                        <svg class="h-8 w-8 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                        </svg>
                                                    </div>
                                                    <input type="file" name="employees[0][photo]" class="employee-photo hidden" accept="image/*">
                                                    <button type="button" class="employee-photo-btn ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                        {{__('Choose Photo')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- New employee entries will be added here -->
                                </div>

                                <p id="no-employees-message" class="text-gray-500 text-sm italic mt-2">No employees added yet. Click the "Add Employee" button to add employees')}}.</p>
                            </div>

                            <div class="flex justify-end space-x-3">
                                <button type="button" onclick="window.history.back()" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    {{__('Cancel')}}
                                </button>
                                <button type="submit" id="submit-btn" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    {{__('Submit Registration')}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
   @include('vendors.body.footer')

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Logo upload preview
            const logoInput = document.getElementById('logo');
            const logoBtn = document.getElementById('logo-btn');
            const logoPreview = document.getElementById('logo-preview');
            
            logoBtn.addEventListener('click', function() {
                logoInput.click();
            });
            
            logoInput.addEventListener('change', function() {
                if (logoInput.files && logoInput.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        logoPreview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                    };
                    reader.readAsDataURL(logoInput.files[0]);
                }
            });
            
            // Vendor photo upload preview
            const photoInput = document.getElementById('photo');
            const photoBtn = document.getElementById('photo-btn');
            const photoPreview = document.getElementById('photo-preview');
            
            photoBtn.addEventListener('click', function() {
                photoInput.click();
            });
            
            photoInput.addEventListener('change', function() {
                if (photoInput.files && photoInput.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        photoPreview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                    };
                    reader.readAsDataURL(photoInput.files[0]);
                }
            });
            
            // Employee management
            const addEmployeeBtn = document.getElementById('add-employee-btn');
            const employeesContainer = document.getElementById('employees-container');
            const employeeTemplate = document.getElementById('employee-template');
            const noEmployeesMessage = document.getElementById('no-employees-message');
            
            let employeeCount = 0;
            
            // Function to update the employees count display
            function updateEmployeeCount() {
                if (employeeCount > 0) {
                    noEmployeesMessage.classList.add('hidden');
                } else {
                    noEmployeesMessage.classList.remove('hidden');
                }
                
                // Update all employee numbers
                const employees = document.querySelectorAll('.employee-entry:not(#employee-template)');
                employees.forEach((employee, index) => {
                    employee.querySelector('.employee-number').textContent = index + 1;
                });
            }
            
            // Helper function to set up photo handlers for an employee entry
            function setupEmployeePhotoHandlers(employeeEntry) {
                const photoInput = employeeEntry.querySelector('.employee-photo');
                const photoBtn = employeeEntry.querySelector('.employee-photo-btn');
                const photoPreview = employeeEntry.querySelector('.employee-photo-preview');
                
                if (photoBtn && photoInput && photoPreview) {
                    photoBtn.addEventListener('click', function() {
                        photoInput.click();
                    });
                    
                    photoInput.addEventListener('change', function() {
                        if (photoInput.files && photoInput.files[0]) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                photoPreview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                            };
                            reader.readAsDataURL(photoInput.files[0]);
                        }
                    });
                }
            }
            
            // Add new employee
            addEmployeeBtn.addEventListener('click', function() {
                const newEmployee = employeeTemplate.cloneNode(true);
                employeeCount++;
                
                // Update attributes and classes
                newEmployee.classList.remove('hidden');
                newEmployee.id = `employee-${employeeCount}`;
                
                // Update form field names with correct index
                const inputs = newEmployee.querySelectorAll('input');
                inputs.forEach(input => {
                    if (input.name) {
                        input.name = input.name.replace('[0]', `[${employeeCount}]`);
                    }
                });
                
                // Set up photo handlers
                setupEmployeePhotoHandlers(newEmployee);
                
                // Set up remove button
                const removeBtn = newEmployee.querySelector('.remove-employee');
                removeBtn.addEventListener('click', function() {
                    newEmployee.remove();
                    employeeCount--;
                    updateEmployeeCount();
                });
                
                // Add to the container
                employeesContainer.appendChild(newEmployee);
                updateEmployeeCount();
            });
            
            // Form submission
            const form = document.getElementById('vendor-registration-form');
            const successAlert = document.getElementById('success-alert');
            const errorAlert = document.getElementById('error-alert');
            const alertContainer = document.getElementById('alert-container');
            const submitBtn = document.getElementById('submit-btn');
            
            form.addEventListener('submit', function(e) {
                // Use AJAX submission
                e.preventDefault();
                
                // Disable submit button to prevent multiple submissions
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-75');
                submitBtn.textContent = 'Submitting...';
                
                // Reset error messages
                document.querySelectorAll('.text-red-600').forEach(el => {
                    el.classList.add('hidden');
                    el.textContent = '';
                });
                
                // Hide alerts
                successAlert.classList.add('hidden');
                errorAlert.classList.add('hidden');
                
                const formData = new FormData(form);
                
                // AJAX submission
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(data => {
                            throw data;
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Show success message
                        alertContainer.classList.remove('hidden');
                        successAlert.classList.remove('hidden');
                        successAlert.textContent = data.message;
                        
                        // Redirect after a delay
                        if (data.redirect) {
                            setTimeout(() => {
                                window.location.href = data.redirect;
                            }, 2000);
                        }
                    }
                })
                .catch(errors => {
                    // Show error alert
                    alertContainer.classList.remove('hidden');
                    errorAlert.classList.remove('hidden');
                    
                    if (errors.errors) {
                        // Display validation errors
                        errorAlert.textContent = 'Please correct the errors below.';
                        
                        // Vendor errors
                        for (const field in errors.errors) {
                            // Check if this is an employee field
                            if (field.includes('employees')) {
                                // Extract employee index and field name
                                const matches = field.match(/employees\.(\d+)\.(\w+)/);
                                if (matches) {
                                    const index = parseInt(matches[1]);
                                    const fieldName = matches[2];
                                    const employeeEntries = document.querySelectorAll('.employee-entry:not(#employee-template)');
                                    if (employeeEntries[index]) {
                                        const errorElement = employeeEntries[index].querySelector(`.employee-${fieldName}-error`);
                                        if (errorElement) {
                                            errorElement.textContent = errors.errors[field][0];
                                            errorElement.classList.remove('hidden');
                                        }
                                    }
                                }
                            } else {
                                // Vendor fields
                                const errorElement = document.getElementById(`${field}-error`);
                                if (errorElement) {
                                    errorElement.textContent = errors.errors[field][0];
                                    errorElement.classList.remove('hidden');
                                }
                            }
                        }
                    } else {
                        // Generic error
                        errorAlert.textContent = 'An error occurred while processing your request. Please try again.';
                    }
                })
                .finally(() => {
                    // Re-enable submit button
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-75');
                    submitBtn.textContent = 'Submit Registration';
                });
            });
        });
    </script>
</body>
</html>