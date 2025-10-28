@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-blue-900 to-blue-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-4">Global Initiatives</h1>
            <p class="text-xl text-blue-200 max-w-3xl mx-auto">
                Connecting with the world through international partnerships, exchange programs, and global research collaborations.
            </p>
        </div>
    </div>

    <!-- International Programs -->
    <div class="py-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">International Programs</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Expand your horizons through our comprehensive international programs and partnerships.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Student Exchange -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-plane text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Student Exchange</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Study abroad opportunities with partner universities worldwide, gaining international experience and cultural exposure.
                    </p>
                </div>
                
                <!-- International Research -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-globe text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">International Research</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Collaborative research projects with international institutions, addressing global challenges and advancing knowledge.
                    </p>
                </div>
                
                <!-- Global Internships -->
                <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-briefcase text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Global Internships</h3>
                    <p class="text-gray-600 leading-relaxed">
                        International internship opportunities with leading companies and organizations around the world.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Partner Universities -->
    <div class="py-20 bg-blue-900 text-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Partner Universities</h2>
                <p class="text-xl text-blue-200 max-w-3xl mx-auto">
                    We collaborate with prestigious institutions worldwide to provide exceptional global opportunities.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-20 h-20 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-university text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Asia-Pacific</h3>
                    <p class="text-blue-200">25+ partner universities</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-university text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Europe</h3>
                    <p class="text-blue-200">15+ partner universities</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-university text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">North America</h3>
                    <p class="text-blue-200">10+ partner universities</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-university text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Other Regions</h3>
                    <p class="text-blue-200">5+ partner universities</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
