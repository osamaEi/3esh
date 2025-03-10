@include('vendors.body.header')
<!-- Hero Section with Two Photos on Right -->
<section class="container mx-auto px-4 py-12 md:py-24 flex flex-col md:flex-row items-center bg-white">
  <!-- Left Content -->
  <div class="md:w-1/2 mb-10 md:mb-0 pr-8">
      <h1 class="text-5xl font-bold mb-6 text-black">Start Spending The Smart Way</h1>
      <p class="text-lg mb-8 text-gray-700">
          Take Control of Your Finances Anytime, Anywhere with live plus. Discover the Smart Way to Use Your Money!
      </p>
      <div class="flex space-x-4">
          <a href="#" class="flex items-center bg-black text-white px-4 py-2 rounded-lg">
              <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                  <path fill="currentColor" d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zm-56.6-164.2c27.3-32.4 24.8-61.9 24-72.5-24.1 1.4-52 16.4-67.9 34.9-17.5 19.8-27.8 44.3-25.6 71.9 26.1 2 49.9-11.4 69.5-34.3z"/>
              </svg>
              <div>
                  <div class="text-xs">Download on the</div>
                  <div class="text-sm font-semibold">App Store</div>
              </div>
          </a>
          <a href="#" class="flex items-center bg-black text-white px-4 py-2 rounded-lg">
              <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <path fill="currentColor" d="M325.3 234.3L104.6 13l280.8 161.2-60.1 60.1zM47 0C34 6.8 25.3 19.2 25.3 35.3v441.3c0 16.1 8.7 28.5 21.7 35.3l256.6-256L47 0zm425.2 225.6l-58.9-34.1-65.7 64.5 65.7 64.5 60.1-34.1c18-14.3 18-46.5-1.2-60.8zM104.6 499l280.8-161.2-60.1-60.1L104.6 499z"/>
              </svg>
              <div>
                  <div class="text-xs">GET IT ON</div>
                  <div class="text-sm font-semibold">Google Play</div>
              </div>
          </a>
      </div>
  </div>
  
  <!-- Right Images - Two Photos Side by Side -->
  <div class="md:w-1/2 flex relative">
      <!-- Background purple rectangle -->
      <div class="absolute inset-0 bg-purple-200 rounded-3xl opacity-50"></div>
      
      <!-- Left Phone UI Image -->
      <div class="relative z-10 w-1/3 -mr-4 self-center" style="width:300px;">
          <img src="{{ asset('photos/1.png') }}" alt="App Interface" class="w-full h-auto">
      </div>
      
      <!-- Right Woman Image -->
      <div class="relative z-0 w-3/4">
          <img src="{{ asset('photos/woman.jpg') }}" alt="Woman using app" class="w-full h-auto">
      </div>
  </div>
</section>
    <!-- Benefits Section -->
    <section class=" bg-white">
        <div class="container mx-auto px-4 text-center mb-12">
            <h2 class="text-3xl font-bold mb-6">Make every penny count</h2>
            <p class="text-lg text-gray-600">Spend smarter, lower your bills, get cashback on everything you buy.</p>
        </div>
    </section>

    <!-- Features Section with Payment and Security Cards -->
<section class="container mx-auto px-4 flex flex-col md:flex-row gap-6 bg-white">
    <!-- Payment Feature Card -->
   <!-- Payment Feature Section with Full-Height Phone -->
<!-- Payment Feature Section with Full-Height Phone -->
<div class="relative bg-indigo-50 rounded-3xl overflow-hidden">
    <div class="flex flex-col md:flex-row">
      <!-- Left Content -->
      <div class="p-8 md:p-12 md:w-1/2 z-10">
        <h2 class="text-3xl font-bold mb-4">Pay with Kobodrop, quick, simple and easy</h2>
        <p class="text-gray-700">
          Paying your bills on Kobodrop has never been easier. Whether you are paying for electricity or internet, Kobodrop gets it done within seconds.
        </p>
      </div>
      
      <!-- Right Image (Phone) -->
      <div class="md:w-1/2 relative">
        <img 
          src="{{asset('photos/2.png')}}" 
          alt="Kobodrop Payment Method Screen" 
          class="absolute bottom-0 right-20 h-auto max-h-full md:max-h-none md:h-full mt-8 pt-[42px] -mb-[7px]"
        />
      </div>
    </div>
  </div>

    <!-- Security Feature Card -->
    <div class="bg-indigo-50 rounded-3xl p-8 md:p-12 flex flex-col items-center md:w-2/5">
        <div class="bg-indigo-100 rounded-full w-20 h-20 flex items-center justify-center mb-6">
            <svg class="w-10 h-10 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
        </div>
        <h2 class="text-3xl font-bold mb-4 text-center">Data level security</h2>
        <p class="text-gray-700 text-center">
            Your money is 100% safe and secure on Kobodrop. No hassles, no glitches, get access to your money anytime.
        </p>
    </div>
</section>
<!-- Payment Methods and Offers Section -->
<section class="container mx-auto px-4 py-12 bg-white">
    <div class="flex flex-col md:flex-row gap-6">
      <!-- Great Offers Card -->
      <div class="rounded-3xl p-8 md:w-1/3" style="background-color: #FFF4E2;">
        
        <div class="rounded-full w-32 h-32 flex items-center justify-center mb-6">
                <img src="{{asset('photos/4.png')}}" alt="Credit Card Icon" class=" h-16">
              </div>
        
        <h2 class="text-2xl font-bold mb-4">Greate offers</h2>
        <p class="text-gray-700">
          Kobodrop reduced payments maintenance and processing fees. No hidden fees
        </p>
      </div>
      
      <!-- Payment Methods Card -->
      <div class="rounded-3xl p-8 md:w-2/3" style="background-color: #F3F6F8;">
        <div class="flex flex-col md:flex-row">
          <div class="md:w-1/2 mb-6 md:mb-0">
            <h2 class="text-2xl font-bold mb-4">All payment methods are available.</h2>
            <p class="text-gray-700">
              Transfers, payments all work on Kobodrop. Get your alert message immediately after a completed transaction.
            </p>
          </div>
          
          <div class="md:w-1/2">
            <!-- Single image with all payment methods -->
            <div class=" rounded-lg p-4">
              <img src="{{asset('photos/3.png')}}" alt="Payment Methods" class="w-full">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
    <!-- Payment Methods -->


    <!-- Features Section -->
<!-- Features and Benefits Section -->
<section class="bg-white">
    <div class="container mx-auto px-4 grid md:grid-cols-2 gap-12 items-center">
      <!-- Mobile App Image with Design Elements -->
      <div class="relative" style="height: 471px;">
        <!-- Lines graphic around the phone -->
        {{-- <div class="absolute inset-0 w-85 h-100">
          <img src="{{asset('photos/6.png')}}" alt="Design Lines" class="w-full h-full object-contain">
        </div> --}}
        <!-- Phone Image -->
        <img src="{{asset('photos/5.png')}}" alt="Store Details Feature" class="relative z-10 mx-auto">
      </div>
      
      <!-- Features Content -->
      <div>
        <div class="mb-8">
          <p class="uppercase text-sm text-indigo-700 tracking-wider font-semibold mb-2">FEATURES</p>
          <h2 class="text-5xl font-bold mb-12 text-black">Check Out Our Benefits</h2>
          
          <!-- Feature 1 -->
          <div class="mb-10 bg-white">
            <div class="flex items-start mb-3">
              <div class="text-indigo-700 mr-4">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12 4L13.4328 8.2918H18L14.2836 10.9836L15.7164 15.2754L12 12.5836L8.28361 15.2754L9.71639 10.9836L6 8.2918H10.5672L12 4Z" fill="currentColor"/>
                </svg>
              </div>
              <h4 class="font-bold text-xl">Feature 1</h4>
            </div>
            <p class="text-gray-600 pl-10">Cum Et Convallis Risus Placerat Aliquam, Nunc. Scelerisque Aliquet Faucibus Tincidunt Eu Adipiscing Sociis Arcu Lorem Porttitor.</p>
          </div>
          
          <!-- Feature 2 -->
          <div class="mb-10 bg-white">
            <div class="flex items-start mb-3">
              <div class="text-indigo-700 mr-4">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2"/>
                  <path d="M12 15L12 9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                  <path d="M9 12L15 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
              </div>
              <h4 class="font-bold text-xl">Feature 2</h4>
            </div>
            <p class="text-gray-600 pl-10">Cum Et Convallis Risus Placerat Aliquam, Nunc. Scelerisque Aliquet Faucibus Tincidunt Eu Adipiscing Sociis Arcu Lorem Porttitor.</p>
          </div>
          
          <!-- Feature 3 -->
          <div class="mb-10 bg-white">
            <div class="flex items-start mb-3">
              <div class="text-indigo-700 mr-4">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="5" y="2" width="14" height="20" rx="2" stroke="currentColor" stroke-width="2"/>
                  <path d="M12 18H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
              </div>
              <h4 class="font-bold text-xl">Feature 3</h4>
            </div>
            <p class="text-gray-600 pl-10">Cum Et Convallis Risus Placerat Aliquam, Nunc. Scelerisque Aliquet Faucibus Tincidunt Eu Adipiscing Sociis Arcu Lorem Porttitor.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

 <!-- Why Choose Live Plus Section -->
<section class="relative overflow-hidden bg-white">
    <div class="container mx-auto px-4">
      <div class="flex flex-col md:flex-row items-center">
        <!-- Left Content -->
        <div class="md:w-1/2 md:pr-12 mb-10 md:mb-0">
          <p class="uppercase text-sm text-gray-500 tracking-wider font-semibold mb-2">ADVANTAGES</p>
          <h2 class="text-4xl md:text-5xl font-bold mb-6">Why Choose Live Plus?</h2>
          <p class="text-gray-600 mb-6">
            Arcu At Dictum Sapien, Mollis. Vulputate Sit Id Accumsan, Ultricies. In Ultricies Malesuada Elit Mauris Etiam Quis. Duis Tristique Lectus. Et Blandit Viverra Nisl Velit. Sed Mattis Pharetra Dolor Suspendisse Sit. Nunc, Gravida Eu Lectus Eget Eget Ac Dolor Neque Lorem Sapien, Suspendisse Aliquam.
          </p>
        </div>
        
        <!-- Right Phone Display -->
        <div class="md:w-1/2 relative">
            <div class="relative">
                <!-- Lines graphic around the phone -->
                {{-- <div class="absolute inset-0 w-full h-full">
                  <img src="{{asset('photos/6.png')}}" alt="Design Lines" class="w-full h-full object-contain">
                </div> --}}
                <!-- Phone Image -->
                <img src="{{asset('photos/5.png')}}" alt="Store Details Feature" class="relative z-10 mx-auto">
              </div>

        </div>
      </div>
    </div>
  </section>

    <!-- Get Started Section -->
<!-- Ready To Get Started Section with Spacing -->
<section class="bg-white">
    <div class="container mx-auto px-4">
      <div class="max-w-7xl mx-auto">
        <!-- Content with left and right spacing -->
        <div class="mx-4 md:mx-12 lg:mx-20">
          <img src="{{asset('photos/7.png')}}" alt="Ready To Get Started" class="w-full rounded-3xl">
        </div>
      </div>
    </div>
  </section>

    <!-- Testimonials Section -->
    {{-- <section class="py-16 bg-gray-100 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="relative">
                    <div class="grid grid-cols-2 gap-4 max-w-md">
                        <div class="h-24 w-24 rounded-full bg-gray-200 relative">
                            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 rounded-full"></div>
                        </div>
                        <div class="h-24 w-24 rounded-full bg-gray-200 relative mt-12">
                            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 rounded-full"></div>
                        </div>
                        <div class="h-24 w-24 rounded-full bg-gray-200 relative mt-6">
                            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 rounded-full"></div>
                        </div>
                        <div class="h-24 w-24 rounded-full bg-gray-200 relative">
                            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 rounded-full"></div>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h2 class="text-3xl font-bold mb-8">What do they think</h2>
                    
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <div class="flex items-center mb-4">
                            <img src="https://via.placeholder.com/50x50" alt="User" class="h-12 w-12 rounded-full mr-4">
                            <div>
                                <h4 class="font-bold">Samantha Sench</h4>
                                <p class="text-sm text-gray-600">Student at university</p>
                            </div>
                        </div>
                        <p class="text-gray-700">" Hi, it's Samantha. After using it made me a lot of benefits, starting with convenience of setting a deadline of tasks and schedule after that the app is very simple using. "</p>
                    </div>
                    
                    <div class="flex justify-start mt-4">
                        <button class="mr-4 text-gray-600 hover:text-black">
                            <i class="fas fa-arrow-left"></i>
                        </button>
                        <button class="text-gray-600 hover:text-black">
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Contact Form -->
    <section class="py-16">
        <div class="container mx-auto">
            <div class="mb-8 max-w-4xl mx-auto">
                <p class="uppercase text-sm text-gray-600 tracking-wider font-semibold mb-2">JOIN US</p>
                <h2 class="text-4xl font-bold">Send Your Information To Join Us</h2>
            </div>
            
            <form class="max-w-4xl mx-auto">
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                        <input type="text" id="name" placeholder="Enter phone number" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" placeholder="Enter Email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                    </div>
                    
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone number</label>
                        <input type="tel" id="phone" placeholder="Enter phone number" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                    </div>
                    
                    <div>
                        <label for="branches" class="block text-sm font-medium text-gray-700 mb-2">Number of branches</label>
                        <input type="number" id="branches" placeholder="Enter Number of branches" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                    </div>
                </div>
                
                <div class="mb-6">
                    <label for="attachments" class="block text-sm font-medium text-gray-700 mb-2">Attachments for the commercial register</label>
                    <div class="border border-dashed border-gray-300 rounded-lg p-12 text-center">
                        <p class="text-gray-500">Please upload attachments for the commercial register</p>
                    </div>
                </div>
                
                <button type="submit" class="bg-purple-700 text-white px-6 py-3 rounded-lg font-medium hover:bg-purple-800 transition duration-300">Send Now</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    @include('vendors.body.footer')

</body>
</html>