@extends('layouts.app')

@section('content')
<!-- University Header Section -->
<div class="bg-gradient-to-r from-blue-900 via-blue-800 to-blue-900 relative overflow-hidden" style="background-image: url('{{ asset('images/balubals.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed; min-height: 100vh; image-rendering: high-quality; image-rendering: -webkit-optimize-contrast; image-rendering: crisp-edges; backface-visibility: hidden; transform: translateZ(0);">
    <!-- Dark overlay for better text readability -->
    <div class="absolute inset-0 gray bg-opacity-50"></div>
    
    <!-- University Pattern Background -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23ffffff" fill-opacity="0.1"><path d="M50 0L100 25v50L50 100L0 75V25z"/></g></svg>');"></div>
    </div>
    
    <!-- University Logo and Title -->
    <div class="relative z-10 py-16 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center text-white mb-12">
                <!-- University Logo -->
                <div class="flex justify-center mb-8">
                    <div class="bg-white/20 backdrop-blur-sm rounded-full p-6 border-2 border-white/30">
                        <!-- Replace with your USTP logo -->
                        <img src="{{ asset('images/alumni.png') }}" alt="USTP Logo" class="w-20 h-20 object-contain">
                        <!-- Fallback icon if logo not found -->
                        <i class="fas fa-university text-6xl text-white" style="display: none;"></i>
                    </div>
                </div>
                
                <!-- University Name -->
                <h1 class="text-4xl md:text-5xl font-bold mb-4 tracking-wide text-yellow-400" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">
                    Alumni USTP Balubal Portal
                </h1>
                
                <!-- System Title -->
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20 max-w-4xl mx-auto">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4 text-yellow-400" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">
                        From Campus to Career
                    </h2>
                    <p class="text-lg text-blue-100 leading-relaxed" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.8);">
                        Tracking the professional's pathway of recent USTP Balubal graduates
                    </p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-12">
                @guest
                    <a href="{{ route('login') }}" class="bg-yellow-500 hover:bg-yellow-600 text-blue-900 px-8 py-4 rounded-xl text-lg font-bold transition-all duration-300 transform hover:scale-105 shadow-xl border-2 border-yellow-400">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Access Portal
                    </a>
                    <a href="mailto:admin@ustp.edu.ph" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-blue-900 px-8 py-4 rounded-xl text-lg font-bold transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-envelope mr-2"></i>
                        Contact Administrator
                    </a>
                @else
                    @if(auth()->user()->isGraduate())
                        <a href="{{ route('graduate.dashboard') }}" class="bg-yellow-500 hover:bg-yellow-600 text-blue-900 px-8 py-4 rounded-xl text-lg font-bold transition-all duration-300 transform hover:scale-105 shadow-xl border-2 border-yellow-400">
                            <i class="fas fa-graduation-cap mr-2"></i>
                            Graduate Portal
                        </a>
                    @elseif(auth()->user()->isStaff())
                        <a href="{{ route('staff.dashboard') }}" class="bg-yellow-500 hover:bg-yellow-600 text-blue-900 px-8 py-4 rounded-xl text-lg font-bold transition-all duration-300 transform hover:scale-105 shadow-xl border-2 border-yellow-400">
                            <i class="fas fa-users mr-2"></i>
                            Staff Portal
                        </a>
                    @elseif(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="bg-yellow-500 hover:bg-yellow-600 text-blue-900 px-8 py-4 rounded-xl text-lg font-bold transition-all duration-300 transform hover:scale-105 shadow-xl border-2 border-yellow-400">
                            <i class="fas fa-cog mr-2"></i>
                            Admin Portal
                        </a>
                    @endif
                @endguest
            </div>

            <!-- University Statistics -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-5xl mx-auto">
                <div class="bg-white/15 backdrop-blur-sm rounded-xl p-6 border border-white/25 text-center">
                    <div class="text-4xl font-bold text-yellow-400 mb-2">{{ $stats['total_graduates'] ?? '500+' }}</div>
                    <div class="text-blue-200 font-medium">Graduates Tracked</div>
                </div>
                <div class="bg-white/15 backdrop-blur-sm rounded-xl p-6 border border-white/25 text-center">
                    <div class="text-4xl font-bold text-yellow-400 mb-2">{{ $stats['employment_rate'] ?? '85' }}%</div>
                    <div class="text-blue-200 font-medium">Employment Rate</div>
                </div>
                <div class="bg-white/15 backdrop-blur-sm rounded-xl p-6 border border-white/25 text-center">
                    <div class="text-4xl font-bold text-yellow-400 mb-2">{{ $stats['total_jobs'] ?? '200+' }}</div>
                    <div class="text-blue-200 font-medium">Job Opportunities</div>
                </div>
                <div class="bg-white/15 backdrop-blur-sm rounded-xl p-6 border border-white/25 text-center">
                    <div class="text-4xl font-bold text-yellow-400 mb-2">15+</div>
                    <div class="text-blue-200 font-medium">Industry Partners</div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection