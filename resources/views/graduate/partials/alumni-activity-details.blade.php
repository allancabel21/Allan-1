<div class="space-y-6">
    <!-- Activity Header -->
    <div class="border-b border-gray-200 pb-4">
        <div class="flex items-start justify-between mb-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $alumniActivity->title }}</h2>
                <div class="flex items-center space-x-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                        @if($alumniActivity->type === 'homecoming') bg-purple-100 text-purple-800
                        @elseif($alumniActivity->type === 'reunion') bg-blue-100 text-blue-800
                        @elseif($alumniActivity->type === 'mentorship') bg-green-100 text-green-800
                        @elseif($alumniActivity->type === 'networking') bg-orange-100 text-orange-800
                        @elseif($alumniActivity->type === 'workshop') bg-yellow-100 text-yellow-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ $alumniActivity->type_label }}
                    </span>
                    @if($alumniActivity->is_featured)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                        <i class="fas fa-star mr-1"></i>Featured
                    </span>
                    @endif
                    @if($alumniActivity->batch_year)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        <i class="fas fa-users mr-1"></i>Class of {{ $alumniActivity->batch_year }}
                    </span>
                    @endif
                </div>
            </div>
            <div class="text-right">
                @if($alumniActivity->can_register)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                    <i class="fas fa-check-circle mr-1"></i>Registration Open
                </span>
                @elseif($alumniActivity->is_full)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                    <i class="fas fa-times-circle mr-1"></i>Registration Full
                </span>
                @else
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                    <i class="fas fa-lock mr-1"></i>Registration Closed
                </span>
                @endif
            </div>
        </div>
    </div>

    <!-- Activity Description -->
    <div>
        <h3 class="text-lg font-semibold text-gray-900 mb-3">Description</h3>
        <div class="prose max-w-none">
            <p class="text-gray-700 leading-relaxed">{{ $alumniActivity->description }}</p>
        </div>
    </div>

    <!-- Event Details -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-gray-50 rounded-lg p-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Event Information</h3>
            <div class="space-y-3">
                <div class="flex items-center">
                    <i class="fas fa-calendar text-blue-600 w-5 mr-3"></i>
                    <div>
                        <p class="font-medium text-gray-900">{{ $alumniActivity->formatted_event_date }}</p>
                        @if($alumniActivity->start_time)
                        <p class="text-sm text-gray-600">{{ $alumniActivity->formatted_start_time }}
                            @if($alumniActivity->end_time)
                            - {{ $alumniActivity->formatted_end_time }}
                            @endif
                        </p>
                        @endif
                    </div>
                </div>
                
                <div class="flex items-center">
                    <i class="fas fa-map-marker-alt text-red-600 w-5 mr-3"></i>
                    <div>
                        <p class="font-medium text-gray-900">{{ $alumniActivity->location }}</p>
                        @if($alumniActivity->venue)
                        <p class="text-sm text-gray-600">{{ $alumniActivity->venue }}</p>
                        @endif
                    </div>
                </div>
                
                <div class="flex items-center">
                    <i class="fas fa-tag text-green-600 w-5 mr-3"></i>
                    <div>
                        <p class="font-medium text-gray-900">{{ $alumniActivity->formatted_registration_fee }}</p>
                    </div>
                </div>
                
                @if($alumniActivity->max_participants)
                <div class="flex items-center">
                    <i class="fas fa-users text-purple-600 w-5 mr-3"></i>
                    <div>
                        <p class="font-medium text-gray-900">{{ $alumniActivity->current_participants }} / {{ $alumniActivity->max_participants }} participants</p>
                        <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ ($alumniActivity->current_participants / $alumniActivity->max_participants) * 100 }}%"></div>
                        </div>
                    </div>
                </div>
                @endif
                
                @if($alumniActivity->registration_deadline)
                <div class="flex items-center">
                    <i class="fas fa-clock text-orange-600 w-5 mr-3"></i>
                    <div>
                        <p class="font-medium text-gray-900">Registration Deadline</p>
                        <p class="text-sm text-gray-600">{{ $alumniActivity->registration_deadline->format('M d, Y g:i A') }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Contact Information -->
        <div class="bg-blue-50 rounded-lg p-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Contact Information</h3>
            <div class="space-y-3">
                @if($alumniActivity->contact_person)
                <div class="flex items-center">
                    <i class="fas fa-user text-blue-600 w-5 mr-3"></i>
                    <div>
                        <p class="font-medium text-gray-900">Contact Person</p>
                        <p class="text-sm text-gray-600">{{ $alumniActivity->contact_person }}</p>
                    </div>
                </div>
                @endif
                
                @if($alumniActivity->contact_email)
                <div class="flex items-center">
                    <i class="fas fa-envelope text-blue-600 w-5 mr-3"></i>
                    <div>
                        <p class="font-medium text-gray-900">Email</p>
                        <a href="mailto:{{ $alumniActivity->contact_email }}" class="text-sm text-blue-600 hover:text-blue-800">
                            {{ $alumniActivity->contact_email }}
                        </a>
                    </div>
                </div>
                @endif
                
                @if($alumniActivity->contact_phone)
                <div class="flex items-center">
                    <i class="fas fa-phone text-blue-600 w-5 mr-3"></i>
                    <div>
                        <p class="font-medium text-gray-900">Phone</p>
                        <a href="tel:{{ $alumniActivity->contact_phone }}" class="text-sm text-blue-600 hover:text-blue-800">
                            {{ $alumniActivity->contact_phone }}
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Additional Information -->
    @if($alumniActivity->requirements || $alumniActivity->benefits)
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @if($alumniActivity->requirements)
        <div>
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Requirements</h3>
            <div class="prose max-w-none">
                <p class="text-gray-700 leading-relaxed">{{ $alumniActivity->requirements }}</p>
            </div>
        </div>
        @endif
        
        @if($alumniActivity->benefits)
        <div>
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Benefits</h3>
            <div class="prose max-w-none">
                <p class="text-gray-700 leading-relaxed">{{ $alumniActivity->benefits }}</p>
            </div>
        </div>
        @endif
    </div>
    @endif

    <!-- Action Buttons -->
    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
        <button onclick="closeActivityModal()" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
            Close
        </button>
        @if($alumniActivity->can_register)
        <button class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
            <i class="fas fa-user-plus mr-2"></i>Register Now
        </button>
        @endif
    </div>
</div>
