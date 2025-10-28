@extends('layouts.dashboard')

@section('title', 'Edit Announcement')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Edit Announcement</h1>
                <p class="text-gray-600 mt-1">Update announcement details and settings</p>
            </div>
            <a href="{{ route('admin.announcements.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Back to Announcements
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
        <form action="{{ route('admin.announcements.update', $announcement) }}" method="POST" class="p-8">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                            Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('title') border-red-500 @enderror" 
                               id="title" name="title" 
                               value="{{ old('title', $announcement->title) }}" 
                               placeholder="Enter announcement title"
                               required>
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">
                            Content <span class="text-red-500">*</span>
                        </label>
                        <textarea class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('content') border-red-500 @enderror" 
                                  id="content" name="content" 
                                  rows="12" 
                                  placeholder="Write your announcement content here..."
                                  required>{{ old('content', $announcement->content) }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Sidebar Settings -->
                <div class="space-y-6">
                    <!-- Type -->
                    <div>
                        <label for="type" class="block text-sm font-semibold text-gray-700 mb-2">
                            Type <span class="text-red-500">*</span>
                        </label>
                        <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('type') border-red-500 @enderror" 
                                id="type" name="type" required>
                            <option value="">Select Type</option>
                            <option value="general" {{ old('type', $announcement->type) == 'general' ? 'selected' : '' }}>General</option>
                            <option value="important" {{ old('type', $announcement->type) == 'important' ? 'selected' : '' }}>Important</option>
                            <option value="urgent" {{ old('type', $announcement->type) == 'urgent' ? 'selected' : '' }}>Urgent</option>
                            <option value="event" {{ old('type', $announcement->type) == 'event' ? 'selected' : '' }}>Event</option>
                        </select>
                        @error('type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Priority -->
                    <div>
                        <label for="priority" class="block text-sm font-semibold text-gray-700 mb-2">Priority</label>
                        <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('priority') border-red-500 @enderror" 
                                id="priority" name="priority">
                            <option value="low" {{ old('priority', $announcement->priority) == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ old('priority', $announcement->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ old('priority', $announcement->priority) == 'high' ? 'selected' : '' }}>High</option>
                        </select>
                        @error('priority')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Target Audience -->
                    <div>
                        <label for="target_audience" class="block text-sm font-semibold text-gray-700 mb-2">Target Audience</label>
                        <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('target_audience') border-red-500 @enderror" 
                                id="target_audience" name="target_audience">
                            <option value="all" {{ old('target_audience', $announcement->target_audience) == 'all' ? 'selected' : '' }}>All Users</option>
                            <option value="graduates" {{ old('target_audience', $announcement->target_audience) == 'graduates' ? 'selected' : '' }}>Graduates Only</option>
                            <option value="staff" {{ old('target_audience', $announcement->target_audience) == 'staff' ? 'selected' : '' }}>Staff Only</option>
                            <option value="admin" {{ old('target_audience', $announcement->target_audience) == 'admin' ? 'selected' : '' }}>Admin Only</option>
                        </select>
                        @error('target_audience')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                        <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('status') border-red-500 @enderror" 
                                id="status" name="status">
                            <option value="draft" {{ old('status', $announcement->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $announcement->status) == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ old('status', $announcement->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Publish Date -->
                    <div>
                        <label for="published_at" class="block text-sm font-semibold text-gray-700 mb-2">Publish Date (Optional)</label>
                        <input type="datetime-local" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('published_at') border-red-500 @enderror" 
                               id="published_at" name="published_at" 
                               value="{{ old('published_at', $announcement->published_at ? $announcement->published_at->format('Y-m-d\TH:i') : '') }}">
                        <p class="text-sm text-gray-500 mt-1">
                            <i class="fas fa-info-circle mr-1"></i>
                            If status is "Published", it will be published immediately regardless of this date.
                        </p>
                        @error('published_at')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Expiry Date -->
                    <div>
                        <label for="expires_at" class="block text-sm font-semibold text-gray-700 mb-2">Expiry Date (Optional)</label>
                        <input type="datetime-local" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('expires_at') border-red-500 @enderror" 
                               id="expires_at" name="expires_at" 
                               value="{{ old('expires_at', $announcement->expires_at ? $announcement->expires_at->format('Y-m-d\TH:i') : '') }}">
                        @error('expires_at')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 pt-6 border-t border-gray-200 flex items-center justify-end space-x-4">
                <a href="{{ route('admin.announcements.index') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">
                    <i class="fas fa-times mr-2"></i> Cancel
                </a>
                <button type="submit" 
                        class="inline-flex items-center px-6 py-3 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    <i class="fas fa-save mr-2"></i> Update Announcement
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Show/hide publish date field based on status
    document.getElementById('status').addEventListener('change', function() {
        const publishDateField = document.getElementById('published_at');
        const publishDateDiv = publishDateField.closest('div');
        
        if (this.value === 'published') {
            // Show info that it will be published immediately
            publishDateDiv.querySelector('.text-sm.text-gray-500').style.display = 'block';
        } else {
            // Hide the info for draft/archived
            publishDateDiv.querySelector('.text-sm.text-gray-500').style.display = 'none';
        }
    });
    
    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('status').dispatchEvent(new Event('change'));
    });
</script>
@endpush
