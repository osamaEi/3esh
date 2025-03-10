<footer class="bg-black text-white py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
            <div>
                <img src="{{asset('photos/logo.png')}}" alt="Live Plus Logo" class="h-13 w-13 p-1 mb-4">
                <p class="text-gray-400 mb-6">{{__('Transform your crypto business with Crypgo Premier, a template for startups and blockchain services.')}}</p>
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
                <h4 class="text-lg font-semibold mb-4">{{__('Links')}}</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white">{{__('Features')}}</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">{{__('Benefits')}}</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">{{__('Services')}}</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">{{__('Why us')}}</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">{{__('FAQs')}}</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="text-lg font-semibold mb-4">{{__('Other Pages')}}</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white">{{__('Error 404')}}</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">{{__('Terms & Conditions')}}</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">{{__('Privacy Policy')}}</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="text-lg font-semibold mb-4">{{__('Download app')}}</h4>
                <div class="flex flex-col space-y-3">
                    <a href="#" class="flex items-center bg-black text-white border border-gray-700 px-4 py-2 rounded-lg hover:bg-gray-900 transition duration-300">
                        <i class="fab fa-google-play mr-2 text-2xl"></i>
                        <div>
                            <div class="text-xs">{{__('GET IT ON')}}</div>
                            <div class="text-sm font-semibold">{{__('Google Play')}}</div>
                        </div>
                    </a>
                    <a href="#" class="flex items-center bg-black text-white border border-gray-700 px-4 py-2 rounded-lg hover:bg-gray-900 transition duration-300">
                        <i class="fab fa-apple mr-2 text-2xl"></i>
                        <div>
                            <div class="text-xs">{{__('Download on the')}}</div>
                            <div class="text-sm font-semibold">{{__('App Store')}}</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
            <div class="text-gray-500 mb-4 md:mb-0">{{__('Terms & Agreements')}}</div>
            <div class="text-gray-500 mb-4 md:mb-0">{{__('Developed by TQNIA All rights reserved')}}</div>
            <div class="text-gray-500">{{__('Privacy Policy')}}</div>
        </div>
    </div>
</footer>