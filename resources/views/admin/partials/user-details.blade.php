<div class="space-y-6">
    <!-- User Basic Information -->
    <div class="card-enhanced p-6">
        <h4 class="text-xl font-display font-bold text-gray-900 mb-6 flex items-center">
            <div class="p-2 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg mr-3">
                <i class="fas fa-user text-white"></i>
            </div>
            Basic Information
        </h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <p class="mt-1 text-sm text-gray-900">{{ $user->name }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <p class="mt-1 text-sm text-gray-900">{{ $user->email }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Role</label>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                    @if($user->role === 'admin') bg-red-100 text-red-800
                    @elseif($user->role === 'staff') bg-blue-100 text-blue-800
                    @else bg-green-100 text-green-800
                    @endif">
                    {{ ucfirst($user->role) }}
                </span>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Account Created</label>
                <p class="mt-1 text-sm text-gray-900">{{ $user->created_at->format('M d, Y \a\t g:i A') }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Last Updated</label>
                <p class="mt-1 text-sm text-gray-900">{{ $user->updated_at->format('M d, Y \a\t g:i A') }}</p>
            </div>
        </div>
    </div>

    @if($user->graduate)
        <!-- Personal Information -->
        <div class="card-enhanced p-6">
            <h4 class="text-xl font-display font-bold text-gray-900 mb-6 flex items-center">
                <div class="p-2 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg mr-3">
                    <i class="fas fa-id-card text-white"></i>
                </div>
                Personal Information
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Full Name</label>
                    <p class="mt-1 text-sm text-gray-900">
                        {{ trim(($user->graduate->first_name ?? '') . ' ' . ($user->graduate->middle_name ?? '') . ' ' . ($user->graduate->last_name ?? '') . ' ' . ($user->graduate->extension ?? '')) ?: 'Not provided' }}
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Gender</label>
                    <p class="mt-1 text-sm text-gray-900">{{ ucfirst($user->graduate->gender ?? 'Not provided') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                    <p class="mt-1 text-sm text-gray-900">
                        @if($user->graduate->birth_date)
                            {{ \Carbon\Carbon::parse($user->graduate->birth_date)->format('M d, Y') }}
                        @else
                            Not provided
                        @endif
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Place of Birth</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->place_of_birth ?? 'Not provided' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Civil Status</label>
                    <p class="mt-1 text-sm text-gray-900">{{ ucfirst($user->graduate->civil_status ?? 'Not provided') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nationality</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->nationality ?? 'Not provided' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Religion</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->religion ?? 'Not provided' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Blood Type</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->blood_type ?? 'Not provided' }}</p>
                </div>
            </div>
        </div>

        <!-- Family Information -->
        <div class="card-enhanced p-6">
            <h4 class="text-xl font-display font-bold text-gray-900 mb-6 flex items-center">
                <div class="p-2 bg-gradient-to-br from-green-500 to-green-600 rounded-lg mr-3">
                    <i class="fas fa-users text-white"></i>
                </div>
                Family Information
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Father's Name</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->father_name ?? 'Not provided' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Mother's Name</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->mother_name ?? 'Not provided' }}</p>
                </div>
            </div>
        </div>

        <!-- Address Information -->
        <div class="card-enhanced p-6">
            <h4 class="text-xl font-display font-bold text-gray-900 mb-6 flex items-center">
                <div class="p-2 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg mr-3">
                    <i class="fas fa-map-marker-alt text-white"></i>
                </div>
                Address Information
            </h4>
            <div class="space-y-4">
                <div>
                    <h5 class="text-md font-medium text-gray-800 mb-2">Present Address</h5>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Complete Address</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->present_address ?? 'Not provided' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">City/Municipality</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->municipality_city ?? 'Not provided' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Province/Region</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->province_region ?? 'Not provided' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Barangay</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->barangay ?? 'Not provided' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ZIP Code</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->zip_code ?? 'Not provided' }}</p>
                        </div>
                    </div>
                </div>
                <div>
                    <h5 class="text-md font-medium text-gray-800 mb-2">Permanent Address</h5>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Complete Address</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->permanent_address ?? 'Not provided' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">City/Municipality</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->permanent_city ?? 'Not provided' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Province/Region</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->permanent_province ?? 'Not provided' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Barangay</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->permanent_barangay ?? 'Not provided' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ZIP Code</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->permanent_zip_code ?? 'Not provided' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Graduate Profile Information -->
        <div class="card-enhanced p-6">
            <h4 class="text-xl font-display font-bold text-gray-900 mb-6 flex items-center">
                <div class="p-2 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg mr-3">
                    <i class="fas fa-graduation-cap text-white"></i>
                </div>
                Academic Information
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Student ID</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->student_id ?? 'Not provided' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Program</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->program ?? 'Not provided' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Batch Year</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->batch_year ?? 'Not provided' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Year Graduated</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->graduation_year ?? 'Not provided' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->contact_number ?? 'Not provided' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Current Status</label>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        @if($user->graduate->current_status === 'employed') bg-green-100 text-green-800
                        @elseif($user->graduate->current_status === 'unemployed') bg-red-100 text-red-800
                        @elseif($user->graduate->current_status === 'undergraduate') bg-blue-100 text-blue-800
                        @elseif($user->graduate->current_status === 'pursuing_higher_education') bg-purple-100 text-purple-800
                        @elseif($user->graduate->current_status === 'self_employed') bg-yellow-100 text-yellow-800
                        @else bg-gray-100 text-gray-800 @endif">
                        <i class="fas fa-circle mr-1 text-xs"></i>
                        {{ $user->graduate->current_status_label ?? 'Graduate' }}
                    </span>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">LinkedIn Profile</label>
                    <p class="mt-1 text-sm text-gray-900">
                        @if($user->graduate->linkedin_profile)
                            <a href="{{ $user->graduate->linkedin_profile }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                {{ $user->graduate->linkedin_profile }}
                            </a>
                        @else
                            Not provided
                        @endif
                    </p>
                </div>
            </div>
        </div>


        <!-- Employment & Career Information -->
        @if(in_array($user->graduate->current_status, ['employed', 'self_employed']))
        <div class="bg-gray-50 p-4 rounded-lg">
            <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-briefcase mr-2 text-green-600"></i>
                Employment & Career Information
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Employment Type</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->employment_type_label ?? 'Not provided' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Job Level</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->job_level_label ?? 'Not provided' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Current Position</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->current_position ?? 'Not provided' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Current Company</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->current_company ?? 'Not provided' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Employment Sector</label>
                    <p class="mt-1 text-sm text-gray-900">{{ ucfirst(str_replace('_', ' ', $user->graduate->employment_sector ?? 'Not provided')) }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Work Location</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->work_location ?? 'Not provided' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Employment Start Date</label>
                    <p class="mt-1 text-sm text-gray-900">
                        @if($user->graduate->employment_start_date)
                            {{ \Carbon\Carbon::parse($user->graduate->employment_start_date)->format('M d, Y') }}
                        @else
                            Not provided
                        @endif
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Work Arrangement</label>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        @if($user->graduate->is_remote_work) bg-green-100 text-green-800
                        @else bg-blue-100 text-blue-800 @endif">
                        @if($user->graduate->is_remote_work)
                            <i class="fas fa-home mr-1"></i>Remote
                        @else
                            <i class="fas fa-building mr-1"></i>On-site
                        @endif
                    </span>
                </div>
            </div>
            @if($user->graduate->job_description)
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700">Job Description</label>
                <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->job_description }}</p>
            </div>
            @endif
        </div>
        @endif

        <!-- Education Information -->
        @if($user->graduate->current_status === 'pursuing_higher_education')
        <div class="bg-gray-50 p-4 rounded-lg">
            <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-graduation-cap mr-2 text-purple-600"></i>
                Higher Education Information
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Pursuing Degree</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->pursuing_degree ?? 'Not provided' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Institution</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->institution_name ?? 'Not provided' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Expected Graduation</label>
                    <p class="mt-1 text-sm text-gray-900">
                        @if($user->graduate->expected_graduation)
                            {{ \Carbon\Carbon::parse($user->graduate->expected_graduation)->format('M d, Y') }}
                        @else
                            Not provided
                        @endif
                    </p>
                </div>
            </div>
        </div>
        @endif

        <!-- Career Development -->
        @if($user->graduate->career_goals || $user->graduate->skills || $user->graduate->interests)
        <div class="bg-gray-50 p-4 rounded-lg">
            <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-chart-line mr-2 text-orange-600"></i>
                Career Development
            </h4>
            <div class="space-y-4">
                @if($user->graduate->career_goals)
                <div>
                    <label class="block text-sm font-medium text-gray-700">Career Goals</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->career_goals }}</p>
                </div>
                @endif
                @if($user->graduate->skills)
                <div>
                    <label class="block text-sm font-medium text-gray-700">Skills & Competencies</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->skills }}</p>
                </div>
                @endif
                @if($user->graduate->interests)
                <div>
                    <label class="block text-sm font-medium text-gray-700">Professional Interests</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->interests }}</p>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Bio -->
        @if($user->graduate->bio)
        <div class="bg-gray-50 p-4 rounded-lg">
            <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-user-circle mr-2 text-blue-600"></i>
                About
            </h4>
            <p class="text-sm text-gray-900">{{ $user->graduate->bio }}</p>
        </div>
        @endif


        <!-- Verification Status -->
        <div class="bg-gray-50 p-4 rounded-lg">
            <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-shield-alt mr-2 text-blue-600"></i>
                Verification Status
            </h4>
            <div class="flex items-center space-x-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        @if($user->graduate->verification_status === 'verified') bg-green-100 text-green-800
                        @elseif($user->graduate->verification_status === 'pending') bg-yellow-100 text-yellow-800
                        @else bg-red-100 text-red-800
                        @endif">
                        @if($user->graduate->verification_status === 'verified')
                            <i class="fas fa-check-circle mr-2"></i>
                            Verified
                        @elseif($user->graduate->verification_status === 'pending')
                            <i class="fas fa-clock mr-2"></i>
                            Pending
                        @else
                            <i class="fas fa-times-circle mr-2"></i>
                            Rejected
                        @endif
                    </span>
                </div>
                @if($user->graduate->verification_notes)
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700">Verification Notes</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $user->graduate->verification_notes }}</p>
                    </div>
                @endif
            </div>
        </div>
    @else
        <!-- No Graduate Profile -->
        <div class="bg-gray-50 p-4 rounded-lg text-center">
            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-user-graduate text-gray-400 text-2xl"></i>
            </div>
            <h4 class="text-lg font-semibold text-gray-900 mb-2">No Graduate Profile</h4>
            <p class="text-gray-600">This user has not created a graduate profile yet.</p>
        </div>
    @endif
</div>
