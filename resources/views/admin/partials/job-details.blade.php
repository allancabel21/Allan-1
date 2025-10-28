<div class="space-y-6">
    <!-- Job Header -->
    <div class="border-b border-gray-200 pb-4">
        <div class="flex items-start justify-between">
            <div>
                <h3 class="text-2xl font-bold text-gray-900">{{ $jobPosting->title }}</h3>
                <p class="text-lg text-gray-600">{{ $jobPosting->company_name }}</p>
                <div class="flex items-center space-x-4 mt-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        <i class="fas fa-map-marker-alt mr-1"></i>
                        {{ $jobPosting->location }}
                    </span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <i class="fas fa-briefcase mr-1"></i>
                        {{ $jobPosting->employment_type }}
                    </span>
                    @if($jobPosting->status === 'active')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-1"></i>
                            Active
                        </span>
                    @elseif($jobPosting->status === 'pending')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            <i class="fas fa-clock mr-1"></i>
                            Pending
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            <i class="fas fa-times-circle mr-1"></i>
                            Inactive
                        </span>
                    @endif
                </div>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-500">Posted on</p>
                <p class="text-sm font-medium text-gray-900">{{ $jobPosting->created_at->format('M d, Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Job Information Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Basic Information -->
        <div class="bg-gray-50 rounded-lg p-4">
            <h4 class="font-semibold text-gray-900 mb-3">Basic Information</h4>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600">Job Title:</span>
                    <span class="text-gray-900">{{ $jobPosting->title }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Company:</span>
                    <span class="text-gray-900">{{ $jobPosting->company_name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Location:</span>
                    <span class="text-gray-900">{{ $jobPosting->location }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Employment Type:</span>
                    <span class="text-gray-900">{{ $jobPosting->employment_type }}</span>
                </div>
                @if($jobPosting->salary_range)
                <div class="flex justify-between">
                    <span class="text-gray-600">Salary Range:</span>
                    <span class="text-gray-900">{{ $jobPosting->salary_range }}</span>
                </div>
                @endif
                @if($jobPosting->experience_level)
                <div class="flex justify-between">
                    <span class="text-gray-600">Experience Level:</span>
                    <span class="text-gray-900">{{ $jobPosting->experience_level }}</span>
                </div>
                @endif
            </div>
        </div>

        <!-- Posted By Information -->
        <div class="bg-gray-50 rounded-lg p-4">
            <h4 class="font-semibold text-gray-900 mb-3">Posted By</h4>
            @if($jobPosting->postedBy)
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    @if($jobPosting->postedBy && $jobPosting->postedBy->graduate && $jobPosting->postedBy->graduate->profile_picture)
                        <img class="h-12 w-12 rounded-full object-cover" src="{{ asset('storage/' . $jobPosting->postedBy->graduate->profile_picture) }}" alt="">
                    @else
                        <div class="h-12 w-12 rounded-full bg-gray-300 flex items-center justify-center">
                            <i class="fas fa-user text-gray-600"></i>
                        </div>
                    @endif
                </div>
                <div>
                    <div class="text-sm font-medium text-gray-900">
                        {{ $jobPosting->postedBy->graduate ? ($jobPosting->postedBy->graduate->first_name . ' ' . $jobPosting->postedBy->graduate->last_name) : ($jobPosting->postedBy->name ?? 'Unknown User') }}
                    </div>
                    <div class="text-sm text-gray-500">{{ $jobPosting->postedBy->email ?? 'N/A' }}</div>
                    <div class="text-xs text-gray-400">
                        {{ $jobPosting->postedBy->created_at->format('M d, Y') ?? 'N/A' }}
                    </div>
                </div>
            </div>
            @else
            <div class="text-sm text-gray-500">Posted by system</div>
            @endif
        </div>
    </div>

    <!-- Job Description -->
    @if($jobPosting->description)
    <div class="bg-gray-50 rounded-lg p-4">
        <h4 class="font-semibold text-gray-900 mb-3">Job Description</h4>
        <div class="text-sm text-gray-700 whitespace-pre-wrap">{{ $jobPosting->description }}</div>
    </div>
    @endif

    <!-- Requirements -->
    @if($jobPosting->requirements)
    <div class="bg-gray-50 rounded-lg p-4">
        <h4 class="font-semibold text-gray-900 mb-3">Requirements</h4>
        <div class="text-sm text-gray-700 whitespace-pre-wrap">{{ $jobPosting->requirements }}</div>
    </div>
    @endif

    <!-- Benefits -->
    @if($jobPosting->benefits)
    <div class="bg-gray-50 rounded-lg p-4">
        <h4 class="font-semibold text-gray-900 mb-3">Benefits</h4>
        <div class="text-sm text-gray-700 whitespace-pre-wrap">{{ $jobPosting->benefits }}</div>
    </div>
    @endif

    <!-- Application Information -->
    <div class="bg-gray-50 rounded-lg p-4">
        <h4 class="font-semibold text-gray-900 mb-3">Application Information</h4>
        <div class="space-y-2 text-sm">
            <div class="flex justify-between">
                <span class="text-gray-600">Application Deadline:</span>
                <span class="text-gray-900">
                    @if($jobPosting->application_deadline)
                        {{ \Carbon\Carbon::parse($jobPosting->application_deadline)->format('M d, Y') }}
                    @else
                        No deadline set
                    @endif
                </span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Contact Email:</span>
                <span class="text-gray-900">{{ $jobPosting->contact_email ?? 'Not provided' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Contact Phone:</span>
                <span class="text-gray-900">{{ $jobPosting->contact_phone ?? 'Not provided' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Application Count:</span>
                <span class="text-gray-900">{{ $jobPosting->applications_count ?? 0 }} applications</span>
            </div>
        </div>
    </div>

    <!-- Additional Information -->
    <div class="bg-gray-50 rounded-lg p-4">
        <h4 class="font-semibold text-gray-900 mb-3">Additional Information</h4>
        <div class="space-y-2 text-sm">
            <div class="flex justify-between">
                <span class="text-gray-600">Job ID:</span>
                <span class="text-gray-900">#{{ $jobPosting->id }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Created:</span>
                <span class="text-gray-900">{{ $jobPosting->created_at->format('M d, Y H:i') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Last Updated:</span>
                <span class="text-gray-900">{{ $jobPosting->updated_at->format('M d, Y H:i') }}</span>
            </div>
            @if($jobPosting->is_featured)
            <div class="flex justify-between">
                <span class="text-gray-600">Featured:</span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                    <i class="fas fa-star mr-1"></i>
                    Yes
                </span>
            </div>
            @endif
        </div>
    </div>
</div>
