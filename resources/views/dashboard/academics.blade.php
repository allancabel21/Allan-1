@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-blue-900 to-blue-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-4">Academics</h1>
            <p class="text-xl text-blue-200 max-w-3xl mx-auto">
                Explore our comprehensive academic programs designed to prepare students for success in the modern world.
            </p>
        </div>
    </div>

    <!-- Programs Section -->
    <div class="py-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Academic Programs</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Choose from our diverse range of programs across various fields of science and technology.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Engineering Programs -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-cogs text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Engineering</h3>
                    <ul class="text-gray-600 space-y-2">
                        <li>• Computer Engineering</li>
                        <li>• Civil Engineering</li>
                        <li>• Electrical Engineering</li>
                        <li>• Mechanical Engineering</li>
                        <li>• Industrial Engineering</li>
                    </ul>
                </div>
                
                <!-- Information Technology -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-laptop-code text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Information Technology</h3>
                    <ul class="text-gray-600 space-y-2">
                        <li>• Computer Science</li>
                        <li>• Information Systems</li>
                        <li>• Cybersecurity</li>
                        <li>• Data Science</li>
                        <li>• Software Engineering</li>
                    </ul>
                </div>
                
                <!-- Business & Management -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-chart-line text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Business & Management</h3>
                    <ul class="text-gray-600 space-y-2">
                        <li>• Business Administration</li>
                        <li>• Entrepreneurship</li>
                        <li>• Project Management</li>
                        <li>• Digital Marketing</li>
                        <li>• Supply Chain Management</li>
                    </ul>
                </div>
                
                <!-- Health Sciences -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-red-500 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-heartbeat text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Health Sciences</h3>
                    <ul class="text-gray-600 space-y-2">
                        <li>• Nursing</li>
                        <li>• Medical Technology</li>
                        <li>• Pharmacy</li>
                        <li>• Physical Therapy</li>
                        <li>• Public Health</li>
                    </ul>
                </div>
                
                <!-- Environmental Science -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-leaf text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Environmental Science</h3>
                    <ul class="text-gray-600 space-y-2">
                        <li>• Environmental Engineering</li>
                        <li>• Sustainable Development</li>
                        <li>• Climate Science</li>
                        <li>• Renewable Energy</li>
                        <li>• Conservation Biology</li>
                    </ul>
                </div>
                
                <!-- Graduate Programs -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-purple-500 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-graduation-cap text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Graduate Programs</h3>
                    <ul class="text-gray-600 space-y-2">
                        <li>• Master of Science</li>
                        <li>• Master of Engineering</li>
                        <li>• Master of Business Administration</li>
                        <li>• Doctor of Philosophy</li>
                        <li>• Professional Certificates</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
