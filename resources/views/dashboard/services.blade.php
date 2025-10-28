@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-blue-900 to-blue-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-4">Our Services</h1>
            <p class="text-xl text-blue-200 max-w-3xl mx-auto">
                Comprehensive career development and industry connection services designed to empower your professional journey.
            </p>
        </div>
    </div>

    <!-- Services Grid -->
    <div class="py-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Career Counseling -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-user-graduate text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Career Counseling</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        One-on-one guidance to help you identify your career path, set professional goals, and develop a strategic plan for success.
                    </p>
                    <ul class="text-gray-600 space-y-2 mb-6">
                        <li>• Career assessment and planning</li>
                        <li>• Resume and cover letter review</li>
                        <li>• Interview preparation</li>
                        <li>• Professional development planning</li>
                    </ul>
                    <a href="#" class="inline-flex items-center text-blue-500 hover:text-blue-600 font-semibold">
                        Learn More <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                
                <!-- Job Placement -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-briefcase text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Job Placement</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Connect with top employers and find opportunities that match your skills, interests, and career aspirations.
                    </p>
                    <ul class="text-gray-600 space-y-2 mb-6">
                        <li>• Job matching services</li>
                        <li>• Employer networking events</li>
                        <li>• Internship opportunities</li>
                        <li>• Graduate program placements</li>
                    </ul>
                    <a href="#" class="inline-flex items-center text-green-500 hover:text-green-600 font-semibold">
                        Learn More <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                
                <!-- Industry Partnerships -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-handshake text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Industry Partnerships</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Build meaningful connections with industry leaders and gain access to exclusive opportunities and resources.
                    </p>
                    <ul class="text-gray-600 space-y-2 mb-6">
                        <li>• Corporate partnerships</li>
                        <li>• Industry mentorship programs</li>
                        <li>• Collaborative projects</li>
                        <li>• Guest speaker series</li>
                    </ul>
                    <a href="#" class="inline-flex items-center text-orange-500 hover:text-orange-600 font-semibold">
                        Learn More <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                
                <!-- Skills Development -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-purple-500 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-tools text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Skills Development</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Enhance your professional competencies through workshops, training programs, and certification courses.
                    </p>
                    <ul class="text-gray-600 space-y-2 mb-6">
                        <li>• Technical skills workshops</li>
                        <li>• Soft skills training</li>
                        <li>• Professional certifications</li>
                        <li>• Leadership development</li>
                    </ul>
                    <a href="#" class="inline-flex items-center text-purple-500 hover:text-purple-600 font-semibold">
                        Learn More <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                
                <!-- Alumni Network -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-red-500 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-network-wired text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Alumni Network</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Connect with successful alumni for mentorship, networking opportunities, and career guidance.
                    </p>
                    <ul class="text-gray-600 space-y-2 mb-6">
                        <li>• Alumni mentorship program</li>
                        <li>• Networking events</li>
                        <li>• Alumni directory access</li>
                        <li>• Success story sharing</li>
                    </ul>
                    <a href="#" class="inline-flex items-center text-red-500 hover:text-red-600 font-semibold">
                        Learn More <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                
                <!-- Research Collaboration -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-indigo-500 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-microscope text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Research Collaboration</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Participate in cutting-edge research projects and collaborate with faculty and industry partners.
                    </p>
                    <ul class="text-gray-600 space-y-2 mb-6">
                        <li>• Research opportunities</li>
                        <li>• Industry research projects</li>
                        <li>• Publication support</li>
                        <li>• Conference presentations</li>
                    </ul>
                    <a href="#" class="inline-flex items-center text-indigo-500 hover:text-indigo-600 font-semibold">
                        Learn More <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="py-20 bg-blue-900 text-white">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-4">Ready to Get Started?</h2>
            <p class="text-xl text-blue-200 mb-8 max-w-3xl mx-auto">
                Contact our Career Center team to learn more about our services and how we can help you achieve your professional goals.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="mailto:careercenter@ustp.edu.ph" class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-4 rounded-lg text-lg font-semibold transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-envelope mr-2"></i>
                    Contact Us
                </a>
                <a href="tel:+63-88-856-1738" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-blue-900 px-8 py-4 rounded-lg text-lg font-semibold transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-phone mr-2"></i>
                    Call Us
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
