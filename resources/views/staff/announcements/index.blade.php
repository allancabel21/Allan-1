@extends('layouts.dashboard')

@section('page-title', 'Announcement Management')
@section('page-description', 'Manage system announcements')

@section('content')
<div id="content-area">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Announcement Management</h1>
            <p class="text-gray-600 mt-1">Create and manage system announcements</p>
        </div>
        <a href="{{ route('staff.announcements.create') }}" 
           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
            <i class="fas fa-plus mr-2"></i>Create Announcement
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($announcements->count() > 0)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created By</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Published</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($announcements as $announcement)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ Str::limit($announcement->title, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $announcement->type_color }}">
                                    {{ $announcement->type_label }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $announcement->status_color }}">
                                    {{ $announcement->status_label }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $announcement->priority_color }}">
                                    {{ $announcement->priority_label }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $announcement->creator->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $announcement->published_at ? $announcement->published_at->format('M d, Y') : 'Not published' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('staff.announcements.edit', $announcement) }}" 
                                       class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($announcement->status === 'draft')
                                        <form method="POST" action="{{ route('staff.announcements.publish', $announcement) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="text-green-600 hover:text-green-900" 
                                                    onclick="return confirm('Are you sure you want to publish this announcement?')">
                                                <i class="fas fa-paper-plane"></i>
                                            </button>
                                        </form>
                                    @elseif($announcement->status === 'published')
                                        <form method="POST" action="{{ route('staff.announcements.archive', $announcement) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="text-yellow-600 hover:text-yellow-900" 
                                                    onclick="return confirm('Are you sure you want to archive this announcement?')">
                                                <i class="fas fa-archive"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <button onclick="deleteAnnouncement({{ $announcement->id }}, '{{ addslashes($announcement->title) }}')" 
                                            class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $announcements->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-12 text-center">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-bullhorn text-gray-400 text-2xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No Announcements</h3>
            <p class="text-gray-500 mb-6">Get started by creating your first announcement.</p>
            <a href="{{ route('staff.announcements.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
                <i class="fas fa-plus mr-2"></i>Create Announcement
            </a>
        </div>
    @endif
</div>

<!-- Delete Announcement Confirmation Modal -->
<div id="delete-announcement-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4">
            <div class="p-8">
                <!-- Warning Icon -->
                <div class="flex justify-center mb-6">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm">
                            <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Title and Message -->
                <div class="text-center mb-8">
                    <h3 class="text-xl font-display font-bold text-gray-900 mb-3">Delete Announcement</h3>
                    <p class="text-gray-600 font-body leading-relaxed">
                        Are you sure you want to delete this announcement? This action cannot be undone and will permanently remove:
                    </p>
                    <ul class="text-sm text-gray-500 mt-3 space-y-1">
                        <li>• Announcement content</li>
                        <li>• All associated data</li>
                        <li>• Publication history</li>
                    </ul>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex space-x-3">
                    <button onclick="closeDeleteAnnouncementModal()" 
                            class="flex-1 bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition-colors font-display font-semibold">
                        Cancel
                    </button>
                    <button onclick="confirmDeleteAnnouncement()" 
                            class="flex-1 bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition-colors font-display font-semibold">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let announcementToDelete = null;

function deleteAnnouncement(announcementId, announcementTitle) {
    announcementToDelete = announcementId;
    document.getElementById('delete-announcement-modal').classList.remove('hidden');
}

function closeDeleteAnnouncementModal() {
    announcementToDelete = null;
    document.getElementById('delete-announcement-modal').classList.add('hidden');
}

function confirmDeleteAnnouncement() {
    if (announcementToDelete) {
        // Create a form to submit DELETE request
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/staff/announcements/${announcementToDelete}`;
        
        // Add CSRF token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        form.appendChild(csrfToken);
        
        // Add method override for DELETE
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        form.appendChild(methodField);
        
        document.body.appendChild(form);
        form.submit();
    }
}
</script>

@endsection
