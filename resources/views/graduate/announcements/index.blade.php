@extends('layouts.dashboard')

@section('page-title', 'Announcements')
@section('page-description', 'Stay updated with the latest announcements')

@section('content')
<div id="content-area">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Announcements</h1>
        <p class="text-gray-600 mt-1">Stay updated with the latest news and updates from USTP</p>
    </div>

    @if($announcements->count() > 0)
        <div class="space-y-6">
            @foreach($announcements as $announcement)
            <div class="bg-white rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $announcement->type_color }}">
                                    {{ $announcement->type_label }}
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $announcement->priority_color }}">
                                    {{ $announcement->priority_label }}
                                </span>
                                @if($announcement->isExpired())
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Expired
                                    </span>
                                @endif
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $announcement->title }}</h3>
                            <p class="text-gray-600 text-sm mb-3">{{ Str::limit($announcement->content, 200) }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                            <span><i class="fas fa-user mr-1"></i>{{ $announcement->creator->name }}</span>
                            <span><i class="fas fa-calendar mr-1"></i>{{ $announcement->published_at->format('M d, Y') }}</span>
                            @if($announcement->expires_at)
                                <span><i class="fas fa-clock mr-1"></i>Expires {{ $announcement->expires_at->format('M d, Y') }}</span>
                            @endif
                        </div>
                        <a href="{{ route('graduate.announcements.show', $announcement) }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
                            <i class="fas fa-eye mr-2"></i>Read More
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $announcements->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-12 text-center">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-bullhorn text-gray-400 text-2xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No Announcements</h3>
            <p class="text-gray-500">There are no announcements at the moment. Check back later for updates.</p>
        </div>
    @endif
</div>
@endsection
