@extends('layouts.dashboard')

@section('page-title', 'Staff Dashboard')
@section('page-description', 'Career services and graduate management')

@section('content')
<div id="content-area">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <i class="fas fa-user-graduate text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-500">Total Graduates</h3>
                    <p class="text-xl font-semibold text-gray-900">{{ $stats['total_graduates'] }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 rounded-lg">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-500">Verified Graduates</h3>
                    <p class="text-xl font-semibold text-gray-900">{{ $stats['verified_graduates'] }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-2 bg-yellow-100 rounded-lg">
                    <i class="fas fa-hourglass-half text-yellow-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-500">Pending Verifications</h3>
                    <p class="text-xl font-semibold text-gray-900">{{ $stats['pending_verifications'] }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-2 bg-red-100 rounded-lg">
                    <i class="fas fa-briefcase text-red-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-500">Total Job Postings</h3>
                    <p class="text-xl font-semibold text-gray-900">{{ $stats['total_job_postings'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Recent Graduates</h2>
            @if($recent_graduates->isEmpty())
                <p class="text-gray-600">No recent graduates to display.</p>
            @else
                <ul class="divide-y divide-gray-200">
                    @foreach($recent_graduates as $graduate)
                        <li class="py-3 flex justify-between items-center">
                            <div>
                                <p class="text-lg font-semibold text-gray-900">{{ $graduate->user->name }}</p>
                                <p class="text-sm text-gray-600">{{ $graduate->program }} ({{ $graduate->batch_year }})</p>
                            </div>
                            <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $graduate->verification_status === 'verified' ? 'bg-green-100 text-green-800' : ($graduate->verification_status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ ucfirst($graduate->verification_status) }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Recent Job Postings</h2>
            @if($recent_job_postings->isEmpty())
                <p class="text-gray-600">No recent job postings to display.</p>
            @else
                <ul class="divide-y divide-gray-200">
                    @foreach($recent_job_postings as $job)
                        <li class="py-3">
                            <p class="text-lg font-semibold text-gray-900">{{ $job->title }} at {{ $job->company }}</p>
                            <p class="text-sm text-gray-600">{{ $job->location }} - {{ $job->employment_type }}</p>
                            <p class="text-xs text-gray-500">Posted by: {{ $job->postedBy->name }} on {{ $job->created_at->format('M d, Y') }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection