@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-blue-900 to-blue-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-4">About USTP</h1>
            <p class="text-xl text-blue-200 max-w-3xl mx-auto">
                Discover our mission, vision, and commitment to excellence in science and technology education.
            </p>
        </div>
    </div>

    <!-- Content Section -->
    <div class="py-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-4xl font-bold text-gray-800 mb-6">Our Story</h2>
                    <p class="text-lg text-gray-600 leading-relaxed mb-6">
                        The University of Science and Technology of Southern Philippines (USTP) stands as a beacon of innovation and excellence in higher education. Established with a vision to bridge the gap between academic knowledge and real-world applications, USTP has become a leading institution in science and technology education.
                    </p>
                    <p class="text-lg text-gray-600 leading-relaxed mb-8">
                        Our Career Center and Industry Relations Office plays a pivotal role in this mission, ensuring that our students are not just academically prepared, but also industry-ready for the challenges of tomorrow.
                    </p>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-lg shadow-lg">
                            <h3 class="text-xl font-bold text-gray-800 mb-3">Our Mission</h3>
                            <p class="text-gray-600">
                                To provide quality education and produce globally competitive graduates in science and technology.
                            </p>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-lg">
                            <h3 class="text-xl font-bold text-gray-800 mb-3">Our Vision</h3>
                            <p class="text-gray-600">
                                A leading science and technology university in the Asia-Pacific region.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                         alt="USTP Campus" 
                         class="rounded-lg shadow-2xl">
                    <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-orange-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-3xl text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
