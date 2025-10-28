<div class="space-y-6">
    <!-- Profile Header -->
    <div class="flex items-center space-x-4">
        <div class="flex-shrink-0">
            @if($graduate->profile_picture)
                <img class="h-16 w-16 rounded-full object-cover" src="{{ asset('storage/' . $graduate->profile_picture) }}" alt="">
            @else
                <div class="h-16 w-16 rounded-full bg-gray-300 flex items-center justify-center">
                    <i class="fas fa-user text-2xl text-gray-600"></i>
                </div>
            @endif
        </div>
        <div>
            <h3 class="text-xl font-semibold text-gray-900">{{ $graduate->first_name }} {{ $graduate->last_name }}</h3>
            <p class="text-gray-600">{{ $graduate->user->email ?? 'N/A' }}</p>
            <div class="flex items-center space-x-4 mt-2">
                @if($graduate->is_employed)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <i class="fas fa-check-circle mr-1"></i>
                        Employed
                    </span>
                @else
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        <i class="fas fa-times-circle mr-1"></i>
                        Unemployed
                    </span>
                @endif
                
                @if($graduate->verification_status === 'verified')
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <i class="fas fa-check-circle mr-1"></i>
                        Verified
                    </span>
                @elseif($graduate->verification_status === 'pending')
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        <i class="fas fa-clock mr-1"></i>
                        Pending Verification
                    </span>
                @else
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                        <i class="fas fa-question-circle mr-1"></i>
                        Not Verified
                    </span>
                @endif
            </div>
        </div>
    </div>

    <!-- Personal Information -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-gray-50 rounded-lg p-4">
            <h4 class="font-semibold text-gray-900 mb-3">Personal Information</h4>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600">Date of Birth:</span>
                    <span class="text-gray-900">{{ $graduate->birth_date ? \Carbon\Carbon::parse($graduate->birth_date)->format('M d, Y') : 'Not provided' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Place of Birth:</span>
                    <span class="text-gray-900">{{ $graduate->place_of_birth ?? 'Not provided' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Civil Status:</span>
                    <span class="text-gray-900">{{ $graduate->civil_status ?? 'Not provided' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Citizenship:</span>
                    <span class="text-gray-900">{{ $graduate->citizenship ?? 'Filipino' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Contact Number:</span>
                    <span class="text-gray-900">{{ $graduate->contact_number ?? 'Not provided' }}</span>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 rounded-lg p-4">
            <h4 class="font-semibold text-gray-900 mb-3">Academic Information</h4>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600">Program:</span>
                    <span class="text-gray-900">{{ $graduate->program ?? 'Not specified' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Batch Year:</span>
                    <span class="text-gray-900">{{ $graduate->batch_year ?? 'Not specified' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Student ID:</span>
                    <span class="text-gray-900">{{ $graduate->student_id ?? 'Not provided' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Graduation Date:</span>
                    <span class="text-gray-900">{{ $graduate->graduation_date ? \Carbon\Carbon::parse($graduate->graduation_date)->format('M d, Y') : 'Not provided' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Employment Information -->
    @if($graduate->is_employed)
    <div class="bg-gray-50 rounded-lg p-4">
        <h4 class="font-semibold text-gray-900 mb-3">Current Employment</h4>
        <div class="space-y-2 text-sm">
            <div class="flex justify-between">
                <span class="text-gray-600">Position:</span>
                <span class="text-gray-900">{{ $graduate->current_position ?? 'Not specified' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Company:</span>
                <span class="text-gray-900">{{ $graduate->current_company ?? 'Not specified' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Start Date:</span>
                <span class="text-gray-900">{{ $graduate->employment_start_date ? \Carbon\Carbon::parse($graduate->employment_start_date)->format('M d, Y') : 'Not provided' }}</span>
            </div>
        </div>
    </div>
    @endif

    <!-- Address Information -->
    <div class="bg-gray-50 rounded-lg p-4">
        <h4 class="font-semibold text-gray-900 mb-3">Address Information</h4>
        <div class="space-y-2 text-sm">
            <div class="flex justify-between">
                <span class="text-gray-600">Present Address:</span>
                <span class="text-gray-900">{{ $graduate->present_address ?? 'Not provided' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">City/Municipality:</span>
                <span class="text-gray-900">{{ $graduate->municipality_city ?? 'Not provided' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Province:</span>
                <span class="text-gray-900">{{ $graduate->province ?? 'Not provided' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Zip Code:</span>
                <span class="text-gray-900">{{ $graduate->zip_code ?? 'Not provided' }}</span>
            </div>
        </div>
    </div>

    <!-- Additional Information -->
    @if($graduate->bio)
    <div class="bg-gray-50 rounded-lg p-4">
        <h4 class="font-semibold text-gray-900 mb-3">Bio/Summary</h4>
        <p class="text-sm text-gray-700">{{ $graduate->bio }}</p>
    </div>
    @endif

    <!-- Account Information -->
    <div class="bg-gray-50 rounded-lg p-4">
        <h4 class="font-semibold text-gray-900 mb-3">Account Information</h4>
        <div class="space-y-2 text-sm">
            <div class="flex justify-between">
                <span class="text-gray-600">Account Created:</span>
                <span class="text-gray-900">{{ $graduate->user->created_at->format('M d, Y') ?? 'N/A' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Last Updated:</span>
                <span class="text-gray-900">{{ $graduate->updated_at->format('M d, Y') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Email Verified:</span>
                <span class="text-gray-900">
                    @if($graduate->user && $graduate->user->email_verified_at)
                        <span class="text-green-600">Yes ({{ $graduate->user->email_verified_at->format('M d, Y') }})</span>
                    @else
                        <span class="text-red-600">No</span>
                    @endif
                </span>
            </div>
        </div>
    </div>
</div>
