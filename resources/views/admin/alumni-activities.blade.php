@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Alumni Activities Management</h1>
        <p class="text-gray-600">Manage alumni events, reunions, and mentorship programs</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <i class="fas fa-calendar-alt text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $stats['total'] }}</h3>
                    <p class="text-sm text-gray-600">Total Activities</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 rounded-lg">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $stats['published'] }}</h3>
                    <p class="text-sm text-gray-600">Published</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-2 bg-yellow-100 rounded-lg">
                    <i class="fas fa-edit text-yellow-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $stats['draft'] }}</h3>
                    <p class="text-sm text-gray-600">Draft</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-2 bg-purple-100 rounded-lg">
                    <i class="fas fa-clock text-purple-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $stats['upcoming'] }}</h3>
                    <p class="text-sm text-gray-600">Upcoming</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-2 bg-orange-100 rounded-lg">
                    <i class="fas fa-star text-orange-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $stats['featured'] }}</h3>
                    <p class="text-sm text-gray-600">Featured</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="flex justify-between items-center mb-6">
        <div class="flex space-x-4">
            <select id="typeFilter" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">All Types</option>
                <option value="homecoming">Homecoming</option>
                <option value="reunion">Reunion</option>
                <option value="mentorship">Mentorship</option>
                <option value="networking">Networking</option>
                <option value="workshop">Workshop</option>
                <option value="other">Other</option>
            </select>
            
            <select id="statusFilter" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">All Status</option>
                <option value="draft">Draft</option>
                <option value="published">Published</option>
                <option value="cancelled">Cancelled</option>
                <option value="completed">Completed</option>
            </select>

            <input type="text" id="searchInput" placeholder="Search activities..." 
                   class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        
        <a href="{{ route('admin.alumni-activities.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
            <i class="fas fa-plus mr-2"></i>Create Activity
        </a>
    </div>

    <!-- Activities Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Activity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Participants</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="activitiesTableBody">
                    @forelse($activities as $activity)
                    <tr class="hover:bg-gray-50 activity-row" data-type="{{ $activity->type }}" data-status="{{ $activity->status }}">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-calendar text-gray-600"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $activity->title }}
                                        @if($activity->is_featured)
                                        <i class="fas fa-star text-yellow-500 ml-1"></i>
                                        @endif
                                    </div>
                                    <div class="text-sm text-gray-500">{{ Str::limit($activity->description, 50) }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($activity->type === 'homecoming') bg-purple-100 text-purple-800
                                @elseif($activity->type === 'reunion') bg-blue-100 text-blue-800
                                @elseif($activity->type === 'mentorship') bg-green-100 text-green-800
                                @elseif($activity->type === 'networking') bg-orange-100 text-orange-800
                                @elseif($activity->type === 'workshop') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ $activity->type_label }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <div>{{ $activity->formatted_event_date }}</div>
                            @if($activity->start_time)
                            <div class="text-gray-500">{{ $activity->formatted_start_time }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <div>{{ $activity->current_participants }}
                                @if($activity->max_participants)
                                / {{ $activity->max_participants }}
                                @endif
                            </div>
                            @if($activity->max_participants)
                            <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ ($activity->current_participants / $activity->max_participants) * 100 }}%"></div>
                            </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <select class="status-select border border-gray-300 rounded px-2 py-1 text-xs" 
                                    data-activity-id="{{ $activity->id }}"
                                    onchange="updateActivityStatus({{ $activity->id }}, this.value)">
                                <option value="draft" {{ $activity->status === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ $activity->status === 'published' ? 'selected' : '' }}>Published</option>
                                <option value="cancelled" {{ $activity->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                <option value="completed" {{ $activity->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.alumni-activities.edit', $activity) }}" class="text-blue-600 hover:text-blue-900" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="deleteActivity({{ $activity->id }})" class="text-red-600 hover:text-red-900" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="text-gray-500">
                                <i class="fas fa-calendar-alt text-4xl mb-4"></i>
                                <h3 class="text-lg font-medium mb-2">No activities found</h3>
                                <p>Create your first alumni activity to get started.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($activities->hasPages())
        <div class="px-6 py-3 border-t border-gray-200">
            {{ $activities->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                </div>
                <div class="text-center">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Delete Activity</h3>
                    <p class="text-sm text-gray-500 mb-6">Are you sure you want to delete this activity? This action cannot be undone.</p>
                    <div class="flex space-x-3">
                        <button onclick="closeDeleteModal()" class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition-colors">
                            Cancel
                        </button>
                        <button onclick="confirmDelete()" class="flex-1 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let activityToDelete = null;

// Real-time filtering
document.getElementById('typeFilter').addEventListener('change', filterActivities);
document.getElementById('statusFilter').addEventListener('change', filterActivities);
document.getElementById('searchInput').addEventListener('input', filterActivities);

function filterActivities() {
    const typeFilter = document.getElementById('typeFilter').value;
    const statusFilter = document.getElementById('statusFilter').value;
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    
    const rows = document.querySelectorAll('.activity-row');
    
    rows.forEach(row => {
        const type = row.getAttribute('data-type');
        const status = row.getAttribute('data-status');
        const title = row.querySelector('.text-sm.font-medium').textContent.toLowerCase();
        const description = row.querySelector('.text-sm.text-gray-500').textContent.toLowerCase();
        
        const typeMatch = !typeFilter || type === typeFilter;
        const statusMatch = !statusFilter || status === statusFilter;
        const searchMatch = !searchInput || title.includes(searchInput) || description.includes(searchInput);
        
        if (typeMatch && statusMatch && searchMatch) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function updateActivityStatus(activityId, newStatus) {
    fetch(`/admin/alumni-activities/${activityId}/status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ status: newStatus })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Activity status updated successfully!', 'success');
            // Update the row's data attribute for filtering
            const row = document.querySelector(`[data-activity-id="${activityId}"]`).closest('tr');
            row.setAttribute('data-status', newStatus);
        } else {
            showNotification('Failed to update activity status', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Failed to update activity status', 'error');
    });
}

function deleteActivity(activityId) {
    activityToDelete = activityId;
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    activityToDelete = null;
    document.getElementById('deleteModal').classList.add('hidden');
}

function confirmDelete() {
    if (activityToDelete) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/alumni-activities/${activityToDelete}`;
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        
        const tokenField = document.createElement('input');
        tokenField.type = 'hidden';
        tokenField.name = '_token';
        tokenField.value = '{{ csrf_token() }}';
        
        form.appendChild(methodField);
        form.appendChild(tokenField);
        document.body.appendChild(form);
        form.submit();
    }
}

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${
        type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
    }`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Auto-refresh every 30 seconds for real-time updates
setInterval(() => {
    // Only refresh if no filters are active
    const typeFilter = document.getElementById('typeFilter').value;
    const statusFilter = document.getElementById('statusFilter').value;
    const searchInput = document.getElementById('searchInput').value;
    
    if (!typeFilter && !statusFilter && !searchInput) {
        location.reload();
    }
}, 30000);
</script>
@endsection
