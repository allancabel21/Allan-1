<div class="space-y-6">
    <!-- Job Header -->
    <div class="border-b border-gray-200 pb-4">
        <div class="flex justify-between items-start">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">{{ $job->title }}</h2>
                <p class="text-xl text-gray-600 mt-1">{{ $job->company }}</p>
                <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                    <span class="flex items-center">
                        <i class="fas fa-map-marker-alt mr-1"></i>
                        {{ $job->location }}
                    </span>
                    <span class="flex items-center">
                        <i class="fas fa-briefcase mr-1"></i>
                        {{ ucfirst($job->employment_type) }}
                    </span>
                    <span class="flex items-center">
                        <i class="fas fa-user mr-1"></i>
                        Posted by {{ $job->postedBy->name }}
                    </span>
                </div>
            </div>
            <div class="text-right">
                @if($job->salary_min && $job->salary_max)
                    <p class="text-2xl font-bold text-green-600">₱{{ number_format($job->salary_min) }} - ₱{{ number_format($job->salary_max) }}</p>
                @elseif($job->salary_min)
                    <p class="text-2xl font-bold text-green-600">₱{{ number_format($job->salary_min) }}+</p>
                @else
                    <p class="text-lg text-gray-500">Salary not specified</p>
                @endif
                <p class="text-sm text-gray-500 mt-1">Posted {{ $job->created_at->diffForHumans() }}</p>
            </div>
        </div>
    </div>

    <!-- Job Description -->
    <div>
        <h3 class="text-lg font-semibold text-gray-900 mb-3">Job Description</h3>
        <div class="prose max-w-none">
            <p class="text-gray-700 whitespace-pre-line">{{ $job->description }}</p>
        </div>
    </div>

    <!-- Requirements -->
    @if($job->requirements)
    <div>
        <h3 class="text-lg font-semibold text-gray-900 mb-3">Requirements</h3>
        <div class="prose max-w-none">
            <p class="text-gray-700 whitespace-pre-line">{{ $job->requirements }}</p>
        </div>
    </div>
    @endif

    <!-- Benefits -->
    @if($job->benefits)
    <div>
        <h3 class="text-lg font-semibold text-gray-900 mb-3">Benefits</h3>
        <div class="prose max-w-none">
            <p class="text-gray-700 whitespace-pre-line">{{ $job->benefits }}</p>
        </div>
    </div>
    @endif

    <!-- Application Deadline -->
    @if($job->application_deadline)
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
        <div class="flex items-center">
            <i class="fas fa-clock text-yellow-600 mr-2"></i>
            <div>
                <h4 class="font-semibold text-yellow-800">Application Deadline</h4>
                <p class="text-yellow-700">{{ $job->application_deadline->format('F d, Y') }}</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Job Tags -->
    <div class="flex flex-wrap gap-2">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
            <i class="fas fa-briefcase mr-1"></i>
            {{ ucfirst($job->employment_type) }}
        </span>
        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
            <i class="fas fa-map-marker-alt mr-1"></i>
            {{ $job->location }}
        </span>
        @if($job->application_deadline)
        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
            <i class="fas fa-clock mr-1"></i>
            Deadline: {{ $job->application_deadline->format('M d') }}
        </span>
        @endif
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
        <button onclick="closeJobModal()" class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors">
            Close
        </button>
        <button onclick="applyToJob({{ $job->id }})" class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
            <i class="fas fa-paper-plane mr-2"></i>
            Apply Now
        </button>
    </div>
</div>
