<!DOCTYPE html>
<html lang="en">
@include('admin.body.header')

<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center">
    <!-- Theme Mode Setup -->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode") || localStorage.getItem("data-bs-theme") || defaultThemeMode;
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>

    <!-- Root -->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!-- Background Image -->
        <style>
            body {
                background-image: url('{{ asset('assets/media/auth/bg10.jpeg') }}');
                background-size: cover;
                background-position: center;
                transition: background-image 0.5s ease;
            }
            [data-bs-theme="dark"] body {
                background-image: url('{{ asset('assets/media/auth/bg10-dark.jpeg') }}');
            }
        </style>

        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!-- Aside (Left Section) -->
            <div class="d-flex flex-lg-row-fluid">
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                    <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20 animate__animated animate__fadeIn" 
                         src="{{ asset('photos/logo.png') }}" alt="Logo" />
                </div>
            </div>

            <!-- Body (Right Section) -->
            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                <!-- Wrapper with Glassmorphism -->
                <div class="bg-body bg-opacity-90 backdrop-blur-lg d-flex flex-column flex-center rounded-4 w-md-600px p-10 shadow-2xl border border-gray-100/20">
                    <!-- Content -->
                    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                        <!-- Form Wrapper -->
                        <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                            <!-- Form -->
                            <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST" action="{{ route('admin.login.store') }}">
                                @csrf

                                <!-- Header -->
                                <div class="text-center mb-11 animate__animated animate__fadeInDown">
                                    <h1 class="text-4xl font-extrabold text-gray-800 bg-gradient-to-r from-purple-600 to-indigo-600 text-transparent bg-clip-text">
                                        {{__('Sign In')}}
                                    </h1>
                                    <div class="text-gray-500 fw-semibold fs-6 mt-2">{{__('Welcome Back!')}}</div>
                                </div>

                                <!-- Separator -->
                                <div class="separator separator-content my-14">
                                    <span class="w-125px text-gray-500 fw-semibold fs-7 bg-gradient-to-r from-transparent via-gray-300 to-transparent h-px"></span>
                                </div>

                                <!-- Email Input -->
                                <div class="fv-row mb-8">
                                    <input type="email" placeholder="{{__('Email')}}" name="email" id="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                                           class="form-control bg-transparent border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-transparent rounded-lg px-4 py-3 transition duration-300 shadow-sm hover:shadow-md" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
                                </div>

                                <!-- Password Input -->
                                <div class="fv-row mb-8">
                                    <input type="password" placeholder="{{__('Password')}}" name="password" id="password" required autocomplete="current-password" 
                                           class="form-control bg-transparent border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-transparent rounded-lg px-4 py-3 transition duration-300 shadow-sm hover:shadow-md" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
                                </div>

                                <!-- Remember Me -->
                                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                                        <input id="remember_me" type="checkbox" name="remember" 
                                               class="rounded border-gray-300 text-purple-600 shadow-sm focus:ring-purple-500 h-5 w-5 transition duration-200" />
                                        <span class="ms-2 text-sm text-gray-600 hover:text-purple-600 transition-colors duration-200"> {{__('Remember me')}}</span>
                                    </label>
                                </div>

                                <!-- Submit Button -->
                                <div class="d-grid mb-10">
                                    <button type="submit" class="btn btn-primary bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold py-3 rounded-lg shadow-md hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 transform hover:-translate-y-1">
                                        {{__('Log In')}}
                                    </button>
                                </div>

                                <!-- Sign Up Link -->
                                <div class="text-gray-500 text-center fw-semibold fs-6 animate__animated animate__fadeInUp">
                                    {{__('Not a Member yet?')}}
                                    <a href="{{ route('admin.register.view') }}" class="link-primary text-purple-600 hover:text-purple-800 transition-colors duration-200"> {{__('Sign up')}}</a>
                                </div>
                            </form>
                        </div>

                        <!-- Footer -->
                        <footer class="text-center py-4 animate__animated animate__fadeIn">
                            <div class="d-flex flex-column align-items-center">
                                <div class="d-flex align-items-center">
                                    <h3 class="text-gray-400 fw-semibold fs-7">
                                        {{__('Developed By')}} 
                                        <img src="{{ asset('assets/footer_logo.png') }}" alt="Footer Logo" class="inline-block h-5 mx-1" />
                                        {{__('All Rights Reserved')}}
                                    </h3>
                                </div>
                            </div>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascript -->
    <script>var hostUrl = "{{ asset('assets/') }}/";</script>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/authentication/sign-in/general.js') }}"></script>

    <!-- Animate.css (Optional for animations) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</body>
</html>