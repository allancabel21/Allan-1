@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-blue-900 to-blue-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-4">Latest Updates</h1>
            <p class="text-xl text-blue-200 max-w-3xl mx-auto">
                Stay informed with the latest news, announcements, and opportunities from USTP Career Center.
            </p>
        </div>
    </div>

    <!-- News & Updates -->
    <div class="py-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Main News -->
                <div class="lg:col-span-2">
                    <h2 class="text-3xl font-bold text-gray-800 mb-8">Featured News</h2>
                    
                    <div class="space-y-8">
                        <!-- News Article 1 -->
                        <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                 alt="News Image" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>December 15, 2024</span>
                                    <span class="mx-2">•</span>
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">Career</span>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-800 mb-3">New Industry Partnership Program Launched</h3>
                                <p class="text-gray-600 leading-relaxed mb-4">
                                    USTP Career Center announces a new partnership program with leading technology companies, providing students with exclusive internship and job opportunities.
                                </p>
                                <a href="#" class="text-blue-500 hover:text-blue-600 font-semibold">
                                    Read More <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </article>
                        
                        <!-- News Article 2 -->
                        <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                 alt="News Image" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>December 10, 2024</span>
                                    <span class="mx-2">•</span>
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Research</span>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-800 mb-3">Student Research Project Wins International Award</h3>
                                <p class="text-gray-600 leading-relaxed mb-4">
                                    Congratulations to our students who won the International Innovation Award for their groundbreaking research in renewable energy technology.
                                </p>
                                <a href="#" class="text-blue-500 hover:text-blue-600 font-semibold">
                                    Read More <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div class="space-y-8">
                    <!-- Quick Links -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Quick Links</h3>
                        <ul class="space-y-3">
                            <li>
                                <a href="#" class="flex items-center text-gray-600 hover:text-blue-500 transition-colors">
                                    <i class="fas fa-briefcase w-4 h-4 mr-3"></i>
                                    Job Opportunities
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center text-gray-600 hover:text-blue-500 transition-colors">
                                    <i class="fas fa-calendar w-4 h-4 mr-3"></i>
                                    Upcoming Events
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center text-gray-600 hover:text-blue-500 transition-colors">
                                    <i class="fas fa-graduation-cap w-4 h-4 mr-3"></i>
                                    Alumni Success Stories
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center text-gray-600 hover:text-blue-500 transition-colors">
                                    <i class="fas fa-download w-4 h-4 mr-3"></i>
                                    Download Resources
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Upcoming Events -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Upcoming Events</h3>
                        <div class="space-y-4">
                            <div class="border-l-4 border-orange-500 pl-4">
                                <h4 class="font-semibold text-gray-800">Career Fair 2025</h4>
                                <p class="text-sm text-gray-600">January 20, 2025</p>
                            </div>
                            <div class="border-l-4 border-blue-500 pl-4">
                                <h4 class="font-semibold text-gray-800">Industry Workshop</h4>
                                <p class="text-sm text-gray-600">January 25, 2025</p>
                            </div>
                            <div class="border-l-4 border-green-500 pl-4">
                                <h4 class="font-semibold text-gray-800">Alumni Networking</h4>
                                <p class="text-sm text-gray-600">February 1, 2025</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
