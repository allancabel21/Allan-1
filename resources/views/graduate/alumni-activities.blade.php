@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Alumni Activities</h1>
        <p class="text-gray-600">Discover upcoming events, reunions, and mentorship opportunities</p>
    </div>

    <!-- Mentorship Activities -->
    @php
    $mentorshipActivities = $allActivities->filter(function($activity) {
        return $activity->type === 'mentorship';
    });
    @endphp
    
    @if($mentorshipActivities->count() > 0)
    <div class="mb-8">
        <h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
            <i class="fas fa-handshake text-green-600 mr-2"></i>
            Mentorship Programs
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($mentorshipActivities as $activity)
            <div class="bg-gradient-to-br from-green-50 to-emerald-100 rounded-lg shadow-lg border-l-4 border-green-500 overflow-hidden">
                @if($activity->image)
                <div class="h-48 overflow-hidden">
                    <img src="{{ asset('storage/' . $activity->image) }}" alt="{{ $activity->title }}" class="w-full h-full object-cover">
                </div>
                @endif
                <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center space-x-2">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Mentorship
                        </span>
                    </div>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $activity->title }}</h3>
                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($activity->description, 100) }}</p>
                <div class="space-y-2 text-sm text-gray-500 mb-4">
                    <div class="flex items-center">
                        <i class="fas fa-calendar mr-2"></i>
                        {{ $activity->formatted_event_date }}
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        {{ $activity->location }}
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-tag mr-2"></i>
                        {{ $activity->formatted_registration_fee }}
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex space-x-2">
                        <button onclick="viewActivityDetails({{ $activity->id }})" class="bg-gray-600 text-white px-3 py-2 rounded-lg hover:bg-gray-700 transition-colors text-sm font-medium">
                            <i class="fas fa-eye mr-1"></i>View Details
                        </button>
                        @if($activity->can_register)
                        <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors text-sm font-medium">
                            Join Now
                        </button>
                        @elseif($activity->is_full)
                        <span class="text-red-600 text-sm font-medium">Registration Full</span>
                        @else
                        <span class="text-gray-500 text-sm">Registration Closed</span>
                        @endif
                    </div>
                    <span class="text-xs text-gray-500">
                        {{ $activity->current_participants }}
                        @if($activity->max_participants)
                        / {{ $activity->max_participants }} participants
                        @endif
                    </span>
                </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Batch Activities -->
    @if($batchActivities->count() > 0)
    <div class="mb-8">
        <h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
            <i class="fas fa-users text-blue-500 mr-2"></i>
            Your Batch Activities (Class of {{ $graduate->batch_year ?? 'N/A' }})
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($batchActivities as $activity)
            <div class="bg-white rounded-lg shadow p-6 border border-gray-200 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center space-x-2">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            <i class="fas fa-users mr-1"></i>Class of {{ $activity->batch_year }}
                        </span>
                    </div>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $activity->title }}</h3>
                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($activity->description, 120) }}</p>
                <div class="space-y-2 text-sm text-gray-500 mb-4">
                    <div class="flex items-center">
                        <i class="fas fa-calendar mr-2"></i>
                        {{ $activity->formatted_event_date }}
                        @if($activity->start_time)
                        at {{ $activity->formatted_start_time }}
                        @endif
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        {{ $activity->location }}
                        @if($activity->venue)
                        - {{ $activity->venue }}
                        @endif
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-tag mr-2"></i>
                        {{ $activity->formatted_registration_fee }}
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex space-x-2">
                        <button onclick="viewActivityDetails({{ $activity->id }})" class="bg-gray-600 text-white px-3 py-2 rounded-lg hover:bg-gray-700 transition-colors text-sm font-medium">
                            <i class="fas fa-eye mr-1"></i>View Details
                        </button>
                        @if($activity->can_register)
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium">
                            Join Event
                        </button>
                        @elseif($activity->is_full)
                        <span class="text-red-600 text-sm font-medium">Registration Full</span>
                        @else
                        <span class="text-gray-500 text-sm">Registration Closed</span>
                        @endif
                    </div>
                    <span class="text-xs text-gray-500">
                        {{ $activity->current_participants }}
                        @if($activity->max_participants)
                        / {{ $activity->max_participants }} participants
                        @endif
                    </span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- All Activities -->
    <div class="mb-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                <i class="fas fa-calendar-alt text-green-500 mr-2"></i>
                All Upcoming Activities
            </h2>
            
            <!-- Filter Options -->
            <div class="flex space-x-4">
                <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Types</option>
                    @foreach($activityTypes as $type)
                    <option value="{{ $type->type }}">{{ ucfirst($type->type) }} ({{ $type->count }})</option>
                    @endforeach
                </select>
                
                <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Dates</option>
                    <option value="this-week">This Week</option>
                    <option value="this-month">This Month</option>
                    <option value="next-month">Next Month</option>
                </select>
            </div>
        </div>

        @if($allActivities->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($allActivities as $activity)
            <div class="bg-white rounded-lg shadow border border-gray-200 hover:shadow-md transition-shadow overflow-hidden">
                @if($activity->image)
                <div class="h-48 overflow-hidden">
                    <img src="{{ asset('storage/' . $activity->image) }}" alt="{{ $activity->title }}" class="w-full h-full object-cover">
                </div>
                @endif
                <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center space-x-2">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                            @if($activity->type === 'homecoming') bg-purple-100 text-purple-800
                            @elseif($activity->type === 'reunion') bg-blue-100 text-blue-800
                            @elseif($activity->type === 'mentorship') bg-green-100 text-green-800
                            @elseif($activity->type === 'networking') bg-orange-100 text-orange-800
                            @elseif($activity->type === 'workshop') bg-yellow-100 text-yellow-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ $activity->type_label }}
                        </span>
                        @if($activity->is_featured)
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            <i class="fas fa-star mr-1"></i>Featured
                        </span>
                        @endif
                    </div>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $activity->title }}</h3>
                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($activity->description, 100) }}</p>
                <div class="space-y-2 text-sm text-gray-500 mb-4">
                    <div class="flex items-center">
                        <i class="fas fa-calendar mr-2"></i>
                        {{ $activity->formatted_event_date }}
                        @if($activity->start_time)
                        at {{ $activity->formatted_start_time }}
                        @endif
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        {{ $activity->location }}
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-tag mr-2"></i>
                        {{ $activity->formatted_registration_fee }}
                    </div>
                    @if($activity->batch_year)
                    <div class="flex items-center">
                        <i class="fas fa-users mr-2"></i>
                        Class of {{ $activity->batch_year }}
                    </div>
                    @endif
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex space-x-2">
                        <button onclick="viewActivityDetails({{ $activity->id }})" class="bg-gray-600 text-white px-3 py-2 rounded-lg hover:bg-gray-700 transition-colors text-sm font-medium">
                            <i class="fas fa-eye mr-1"></i>View Details
                        </button>
                        @if($activity->can_register)
                        <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors text-sm font-medium">
                            Register
                        </button>
                        @elseif($activity->is_full)
                        <span class="text-red-600 text-sm font-medium">Full</span>
                        @else
                        <span class="text-gray-500 text-sm">Closed</span>
                        @endif
                    </div>
                    <span class="text-xs text-gray-500">
                        {{ $activity->current_participants }}
                        @if($activity->max_participants)
                        / {{ $activity->max_participants }}
                        @endif
                    </span>
                </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($allActivities->hasPages())
        <div class="mt-8">
            {{ $allActivities->links() }}
        </div>
        @endif
        @else
        <div class="text-center py-12">
            <i class="fas fa-calendar-alt text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-medium text-gray-900 mb-2">No upcoming activities</h3>
            <p class="text-gray-500">Check back later for new alumni events and activities.</p>
        </div>
        @endif
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-calendar-alt text-blue-600 text-xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">{{ $allActivities->total() }}</h3>
            <p class="text-sm text-gray-600">Total Activities</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-users text-green-600 text-xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">{{ $batchActivities->count() }}</h3>
            <p class="text-sm text-gray-600">Your Batch Events</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-star text-yellow-600 text-xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">{{ $featuredActivities->count() }}</h3>
            <p class="text-sm text-gray-600">Featured Events</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-graduation-cap text-purple-600 text-xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">{{ $activityTypes->count() }}</h3>
            <p class="text-sm text-gray-600">Activity Types</p>
        </div>
    </div>
</div>

<!-- Activity Details Modal -->
<div id="activityModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-2/3 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Activity Details</h3>
                <button onclick="closeActivityModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div id="activityDetails" class="text-gray-600">
                <!-- Activity details will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
// Filter functionality
document.querySelectorAll('select').forEach(select => {
    select.addEventListener('change', function() {
        // Add filter logic here
        console.log('Filter changed:', this.value);
    });
});

// Activity Details Modal Functions
function viewActivityDetails(activityId) {
    document.getElementById('activityDetails').innerHTML = '<div class="text-center py-4"><i class="fas fa-spinner fa-spin text-2xl text-gray-400"></i></div>';
    document.getElementById('activityModal').classList.remove('hidden');
    
    // Fetch activity details
    fetch(`/graduate/alumni-activities/${activityId}/details`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('activityDetails').innerHTML = data.html;
            } else {
                document.getElementById('activityDetails').innerHTML = '<div class="text-red-600">Error loading activity details.</div>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('activityDetails').innerHTML = '<div class="text-red-600">Error loading activity details.</div>';
        });
}

function closeActivityModal() {
    document.getElementById('activityModal').classList.add('hidden');
}
</script>
@endsection
