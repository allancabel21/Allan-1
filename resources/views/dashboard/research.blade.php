@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-blue-900 to-blue-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-4">Research, Innovation & Entrepreneurship</h1>
            <p class="text-xl text-blue-200 max-w-3xl mx-auto">
                Driving innovation through cutting-edge research and fostering entrepreneurial spirit among our students and faculty.
            </p>
        </div>
    </div>

    <!-- Research Areas -->
    <div class="py-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Research Focus Areas</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Our research initiatives span across multiple disciplines, addressing real-world challenges and creating innovative solutions.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- AI & Machine Learning -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-robot text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">AI & Machine Learning</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Developing intelligent systems and algorithms to solve complex problems in healthcare, agriculture, and smart cities.
                    </p>
                </div>
                
                <!-- Renewable Energy -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-solar-panel text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Renewable Energy</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Advancing sustainable energy technologies including solar, wind, and hydroelectric power systems.
                    </p>
                </div>
                
                <!-- Biotechnology -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-purple-500 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-dna text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Biotechnology</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Exploring genetic engineering, pharmaceutical development, and agricultural biotechnology solutions.
                    </p>
                </div>
                
                <!-- Smart Manufacturing -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-industry text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Smart Manufacturing</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Implementing Industry 4.0 technologies including IoT, automation, and digital manufacturing processes.
                    </p>
                </div>
                
                <!-- Environmental Science -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-teal-500 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-leaf text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Environmental Science</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Studying climate change, pollution control, and sustainable development practices for a greener future.
                    </p>
                </div>
                
                <!-- Cybersecurity -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-red-500 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-shield-alt text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Cybersecurity</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Developing advanced security protocols and systems to protect digital infrastructure and data.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Innovation Hub -->
    <div class="py-20 bg-blue-900 text-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Innovation Hub</h2>
                <p class="text-xl text-blue-200 max-w-3xl mx-auto">
                    Our state-of-the-art facilities provide the perfect environment for research, innovation, and entrepreneurship.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-20 h-20 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-flask text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Research Labs</h3>
                    <p class="text-blue-200">50+ specialized laboratories</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-lightbulb text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Innovation Center</h3>
                    <p class="text-blue-200">Startup incubation space</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Expert Faculty</h3>
                    <p class="text-blue-200">200+ research faculty</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-trophy text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Awards & Recognition</h3>
                    <p class="text-blue-200">100+ research awards</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
