@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center mb-4">
            <a href="{{ route('admin.alumni-activities') }}" class="text-blue-600 hover:text-blue-800 mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Edit Alumni Activity</h1>
        </div>
        <p class="text-gray-600">Update the alumni activity details</p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.alumni-activities.update', $alumniActivity) }}" method="POST" id="activityForm">
            @csrf
            @method('PATCH')
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Basic Information -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">Basic Information</h3>
                    
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Activity Title *</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $alumniActivity->title) }}" required
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Activity Type *</label>
                        <select id="type" name="type" required
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Select type</option>
                            <option value="homecoming" {{ old('type', $alumniActivity->type) === 'homecoming' ? 'selected' : '' }}>Annual Homecoming</option>
                            <option value="reunion" {{ old('type', $alumniActivity->type) === 'reunion' ? 'selected' : '' }}>Batch Reunion</option>
                            <option value="mentorship" {{ old('type', $alumniActivity->type) === 'mentorship' ? 'selected' : '' }}>Mentorship Session</option>
                            <option value="networking" {{ old('type', $alumniActivity->type) === 'networking' ? 'selected' : '' }}>Networking Event</option>
                            <option value="workshop" {{ old('type', $alumniActivity->type) === 'workshop' ? 'selected' : '' }}>Workshop</option>
                            <option value="other" {{ old('type', $alumniActivity->type) === 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="batch-year-field" style="{{ old('type', $alumniActivity->type) === 'reunion' ? 'display: block;' : 'display: none;' }}">
                        <label for="batch_year" class="block text-sm font-medium text-gray-700 mb-2">Batch Year</label>
                        <input type="text" id="batch_year" name="batch_year" value="{{ old('batch_year', $alumniActivity->batch_year) }}" placeholder="e.g., 2020"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('batch_year')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                        <textarea id="description" name="description" rows="4" required
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $alumniActivity->description) }}</textarea>
                        @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Event Details -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">Event Details</h3>
                    
                    <div>
                        <label for="event_date" class="block text-sm font-medium text-gray-700 mb-2">Event Date *</label>
                        <input type="date" id="event_date" name="event_date" value="{{ old('event_date', $alumniActivity->event_date->format('Y-m-d')) }}" required
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('event_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700 mb-2">Start Time</label>
                            <input type="time" id="start_time" name="start_time" value="{{ old('start_time', $alumniActivity->start_time ? $alumniActivity->start_time->format('H:i') : '') }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('start_time')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="end_time" class="block text-sm font-medium text-gray-700 mb-2">End Time</label>
                            <input type="time" id="end_time" name="end_time" value="{{ old('end_time', $alumniActivity->end_time ? $alumniActivity->end_time->format('H:i') : '') }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('end_time')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location *</label>
                        <input type="text" id="location" name="location" value="{{ old('location', $alumniActivity->location) }}" required
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('location')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="venue" class="block text-sm font-medium text-gray-700 mb-2">Venue</label>
                        <input type="text" id="venue" name="venue" value="{{ old('venue', $alumniActivity->venue) }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('venue')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Registration Details -->
            <div class="mt-8 space-y-6">
                <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">Registration Details</h3>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label for="registration_fee" class="block text-sm font-medium text-gray-700 mb-2">Registration Fee (₱)</label>
                        <input type="number" id="registration_fee" name="registration_fee" value="{{ old('registration_fee', $alumniActivity->registration_fee) }}" min="0" step="0.01"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('registration_fee')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="max_participants" class="block text-sm font-medium text-gray-700 mb-2">Max Participants</label>
                        <input type="number" id="max_participants" name="max_participants" value="{{ old('max_participants', $alumniActivity->max_participants) }}" min="1"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('max_participants')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="registration_deadline" class="block text-sm font-medium text-gray-700 mb-2">Registration Deadline</label>
                    <input type="datetime-local" id="registration_deadline" name="registration_deadline" 
                           value="{{ old('registration_deadline', $alumniActivity->registration_deadline ? $alumniActivity->registration_deadline->format('Y-m-d\TH:i') : '') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('registration_deadline')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Additional Information -->
            <div class="mt-8 space-y-6">
                <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">Additional Information</h3>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label for="requirements" class="block text-sm font-medium text-gray-700 mb-2">Requirements</label>
                        <textarea id="requirements" name="requirements" rows="3"
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('requirements', $alumniActivity->requirements) }}</textarea>
                        @error('requirements')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="benefits" class="block text-sm font-medium text-gray-700 mb-2">Benefits</label>
                        <textarea id="benefits" name="benefits" rows="3"
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('benefits', $alumniActivity->benefits) }}</textarea>
                        @error('benefits')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="mt-8 space-y-6">
                <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">Contact Information</h3>
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div>
                        <label for="contact_person" class="block text-sm font-medium text-gray-700 mb-2">Contact Person</label>
                        <input type="text" id="contact_person" name="contact_person" value="{{ old('contact_person', $alumniActivity->contact_person) }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('contact_person')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-2">Contact Email</label>
                        <input type="email" id="contact_email" name="contact_email" value="{{ old('contact_email', $alumniActivity->contact_email) }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('contact_email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-2">Contact Phone</label>
                        <input type="tel" id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $alumniActivity->contact_phone) }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('contact_phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Status and Settings -->
            <div class="mt-8 space-y-6">
                <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">Status and Settings</h3>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                        <select id="status" name="status" required
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Select status</option>
                            <option value="draft" {{ old('status', $alumniActivity->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $alumniActivity->status) === 'published' ? 'selected' : '' }}>Published</option>
                            <option value="cancelled" {{ old('status', $alumniActivity->status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            <option value="completed" {{ old('status', $alumniActivity->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $alumniActivity->is_featured) ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="is_featured" class="ml-2 block text-sm text-gray-900">
                            Featured Activity
                        </label>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="mt-8 flex justify-end space-x-4">
                <a href="{{ route('admin.alumni-activities') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Update Activity
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('type').addEventListener('change', function() {
    const batchYearField = document.getElementById('batch-year-field');
    if (this.value === 'reunion') {
        batchYearField.style.display = 'block';
    } else {
        batchYearField.style.display = 'none';
    }
});

// Set minimum date to today
document.getElementById('event_date').min = new Date().toISOString().split('T')[0];

// Real-time form validation
document.getElementById('activityForm').addEventListener('submit', function(e) {
    const eventDate = new Date(document.getElementById('event_date').value);
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    
    if (eventDate < today) {
        e.preventDefault();
        alert('Event date cannot be in the past.');
        return false;
    }
    
    const startTime = document.getElementById('start_time').value;
    const endTime = document.getElementById('end_time').value;
    
    if (startTime && endTime && startTime >= endTime) {
        e.preventDefault();
        alert('End time must be after start time.');
        return false;
    }
});

// Auto-save draft functionality
let autoSaveTimeout;
function autoSave() {
    clearTimeout(autoSaveTimeout);
    autoSaveTimeout = setTimeout(() => {
        const formData = new FormData(document.getElementById('activityForm'));
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        
        fetch('{{ route("admin.alumni-activities.update", $alumniActivity) }}', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Changes saved automatically');
            }
        })
        .catch(error => {
            console.error('Auto-save failed:', error);
        });
    }, 5000); // Auto-save every 5 seconds
}

// Add auto-save to form inputs
document.querySelectorAll('#activityForm input, #activityForm textarea, #activityForm select').forEach(input => {
    input.addEventListener('input', autoSave);
});
</script>
@endsection
