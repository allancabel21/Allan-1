@extends('layouts.dashboard')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Thank You Section -->
    <div class="text-center py-16">
        <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-12">
            <!-- Success Icon -->
            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100 mb-6">
                <i class="fas fa-check text-4xl text-green-600"></i>
            </div>
            
            <!-- Thank You Message -->
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Thank You!</h1>
            <p class="text-xl text-gray-600 mb-6">Your Graduate Tracer Survey has been submitted successfully.</p>
            
            <!-- Additional Message -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
                <p class="text-blue-800">
                    <i class="fas fa-info-circle mr-2"></i>
                    Your responses will help us improve our programs and track graduate outcomes. We appreciate your time and feedback.
                </p>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('graduate.dashboard') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition-colors">
                    <i class="fas fa-home mr-2"></i> Back to Dashboard
                </a>
                <a href="{{ route('graduate.jobs') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium transition-colors">
                    <i class="fas fa-search mr-2"></i> Browse Jobs
                </a>
            </div>
        </div>
    </div>
</div>
@endsection