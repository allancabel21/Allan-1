@extends('layouts.dashboard')

@section('title', 'Alumni Membership')

@section('content')
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-display font-bold text-gradient mb-3">Alumni Membership</h1>
        <p class="text-lg text-gray-600 font-body">Join the USTP Alumni Association and enjoy exclusive benefits</p>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 p-6 rounded-lg mb-8 shadow-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-600 text-3xl mr-4"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-display font-semibold text-green-900">Success!</h3>
                    <p class="text-green-800 font-body mt-1">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 p-6 rounded-lg mb-8 shadow-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-600 text-3xl mr-4"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-display font-semibold text-red-900">Error!</h3>
                    <p class="text-red-800 font-body mt-1">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Current Membership Status -->
    @if($currentMembership)
    <div class="card-enhanced p-8 mb-8 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="p-4 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full mr-6 shadow-lg">
                    <i class="fas fa-check-circle text-white text-3xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-display font-bold text-gray-900">Active Membership</h2>
                    <p class="text-lg text-gray-600 font-body">{{ $currentMembership->membership_type_label }}</p>
                    <p class="text-sm text-gray-500 font-body">Valid until {{ $currentMembership->membership_end_date->format('M d, Y') }}</p>
                </div>
            </div>
            <div class="text-right">
                <div class="text-3xl font-display font-bold text-green-600">{{ $currentMembership->formatted_amount }}</div>
                <div class="text-sm text-gray-500 font-body">{{ $currentMembership->days_remaining }} days remaining</div>
            </div>
        </div>
        
        <!-- Membership Benefits -->
        <div class="mt-8">
            <h3 class="text-xl font-display font-semibold text-gray-900 mb-4">Your Benefits</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($currentMembership->getMembershipBenefits() as $benefit)
                <div class="flex items-center text-sm text-gray-700 font-body">
                    <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-check text-green-600 text-xs"></i>
                    </div>
                    {{ $benefit }}
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    
    <!-- Renewal Banner - Show for any expiring/expired membership -->
    @php
    $expiringMembership = null;
    if (isset($currentMembership) && $currentMembership) {
        $expiringMembership = $currentMembership;
    } elseif (isset($graduate)) {
        // Check for expired memberships
        $expired = $graduate->alumniMemberships()
            ->whereIn('status', ['verified', 'expired'])
            ->where('membership_end_date', '<', now()->toDateString())
            ->orderBy('membership_end_date', 'desc')
            ->first();
        if ($expired) {
            $expiringMembership = $expired;
        }
    }
    @endphp
    
    @if($expiringMembership && $expiringMembership->days_remaining <= 30)
    <div class="mb-8 bg-yellow-50 border-l-4 border-yellow-500 p-6 rounded-lg">
        <div class="flex items-center justify-between">
            <div>
                <h4 class="text-lg font-display font-semibold text-gray-900">Renew Your Alumni ID</h4>
                <p class="text-sm text-gray-600 mt-1">
                    @if($expiringMembership->days_remaining > 0)
                        Your membership will expire in {{ $expiringMembership->days_remaining }} days.
                    @else
                        Your membership has expired.
                    @endif
                </p>
            </div>
            <button onclick="openRenewalModal()" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                Renew Now
            </button>
        </div>
    </div>
    @endif
    
    <!-- Show pending memberships section if there are any -->
    @if($pendingMemberships->count() > 0)
    <div class="space-y-6 mb-8">
        @foreach($pendingMemberships as $pendingMembership)
        <div class="bg-gradient-to-r from-yellow-50 to-orange-100 rounded-lg shadow-lg p-6 border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="p-3 bg-yellow-100 rounded-full mr-4">
                        <i class="fas fa-clock text-yellow-600 text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900">Membership Under Review</h2>
                        <p class="text-gray-600">{{ $pendingMembership->membership_type_label }}</p>
                        <p class="text-sm text-gray-500">Status: {{ $pendingMembership->status_label }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-2xl font-bold text-yellow-600">{{ $pendingMembership->formatted_amount }}</div>
                    <div class="text-sm text-gray-500">Payment: {{ $pendingMembership->payment_method_label }}</div>
                </div>
            </div>
            
            @if($pendingMembership->status === 'pending')
            <div class="mt-6">
                <div class="bg-white rounded-lg p-4 border border-yellow-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Upload Payment Proof</h3>
                    @if(!$pendingMembership->payment_proof)
                    <p class="text-sm text-gray-600 mb-3">Please upload your payment proof screenshot or photo.</p>
                    <form class="payment-proof-form" data-membership-id="{{ $pendingMembership->id }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="payment_proof_{{ $pendingMembership->id }}" class="block text-sm font-medium text-gray-700 mb-2">Payment Proof (Screenshot/Photo)</label>
                            <input type="file" name="payment_proof" accept="image/*" required
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                            Upload Payment Proof
                        </button>
                    </form>
                    @else
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <p class="text-green-800 font-semibold">✓ Payment proof uploaded successfully</p>
                        <p class="text-sm text-green-700 mt-1">Waiting for admin review...</p>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
        @endforeach
    </div>
    @endif
    
    <!-- Check if user has active/pending for each membership type -->
    @php
    $userMembershipTypes = $graduate->alumniMemberships()
        ->whereIn('status', ['verified', 'paid', 'pending'])
        ->pluck('membership_type')
        ->toArray();
    @endphp
    
    <!-- Membership Plans -->
    <div class="mb-8">
        <h2 class="text-3xl font-display font-bold text-gray-900 mb-8 text-center">Choose Your Membership Plan</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($membershipPricing as $type => $plan)
            @php
            $hasMembership = in_array($type, $userMembershipTypes);
            @endphp
            <div class="card-enhanced p-8 transition-all duration-300 {{ $hasMembership ? 'opacity-50' : '' }}">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-display font-bold text-gray-900 mb-3">{{ ucfirst($type) == 'Yearbook' ? 'Yearbook Subscription' : 'Lifetime' }} Membership</h3>
                    <div class="text-4xl font-display font-bold text-gradient mb-3">₱{{ number_format($plan['amount'], 0) }}</div>
                    <p class="text-gray-600 font-body">{{ $plan['description'] }}</p>
                    @if($hasMembership)
                    <div class="mt-4 inline-block bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-semibold">
                        ✓ You have this membership
                    </div>
                    @endif
                </div>
                
                <div class="space-y-4 mb-8">
                    @php
                    $benefits = match($type) {
                        'lifetime' => [
                            'All premium benefits',
                            'Lifetime access to all services',
                            'VIP event access',
                            'Alumni board voting rights',
                            'Exclusive alumni merchandise',
                            'Priority support'
                        ],
                        'yearbook' => [
                            'Latest yearbook edition',
                            'Alumni directory access',
                            'Professional photos',
                            'Graduation memories',
                            'Networking opportunities',
                            'Access to exclusive content'
                        ]
                    };
                    @endphp
                    
                    @foreach($benefits as $benefit)
                    <div class="flex items-center text-sm text-gray-700 font-body">
                        <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                            <i class="fas fa-check text-green-600 text-xs"></i>
                        </div>
                        {{ $benefit }}
                    </div>
                    @endforeach
                </div>
                
                @if($hasMembership)
                <button disabled
                        class="w-full bg-gray-400 py-4 px-6 text-lg font-display font-semibold cursor-not-allowed text-white">
                    Already Purchased
                </button>
                @else
                <button onclick="openMembershipModal('{{ $type }}', {{ $plan['amount'] }})" 
                        class="w-full btn-primary py-4 px-6 text-lg font-display font-semibold"
                        style="cursor: pointer; pointer-events: auto;">
                    Apply for {{ ucfirst($type) }}
                </button>
                @endif
            </div>
            @endforeach
        </div>
    </div>

    <!-- Membership History -->
    @if($membershipHistory->count() > 0)
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Membership History</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Period</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($membershipHistory as $membership)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $membership->membership_type_label }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $membership->formatted_amount }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $membership->formatted_membership_period }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($membership->status === 'verified') bg-green-100 text-green-800
                                @elseif($membership->status === 'paid') bg-blue-100 text-blue-800
                                @elseif($membership->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($membership->status === 'expired') bg-gray-100 text-gray-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ $membership->status_label }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $membership->payment_method_label }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>

<!-- Membership Application Modal -->
<div id="membershipModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="card-enhanced max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-8">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-2xl font-display font-bold text-gray-900">Apply for Alumni Membership</h3>
                    <button onclick="closeMembershipModal()" class="text-gray-400 hover:text-gray-600 transition-colors p-2 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <!-- Progress Steps -->
                <div class="mb-6">
                    <div class="flex items-center justify-center space-x-2">
                        <div class="flex items-center">
                            <div id="step1-indicator" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-medium">1</div>
                            <span class="ml-2 text-sm font-medium text-blue-600">Personal Info</span>
                        </div>
                        <div class="w-6 h-px bg-gray-300"></div>
                        <div class="flex items-center">
                            <div id="step2-indicator" class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-medium">2</div>
                            <span class="ml-2 text-sm font-medium text-gray-500">Professional</span>
                        </div>
                        <div class="w-6 h-px bg-gray-300"></div>
                        <div class="flex items-center">
                            <div id="step3-indicator" class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-medium">3</div>
                            <span class="ml-2 text-sm font-medium text-gray-500">Additional</span>
                        </div>
                        <div class="w-6 h-px bg-gray-300"></div>
                        <div class="flex items-center">
                            <div id="step4-indicator" class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-medium">4</div>
                            <span class="ml-2 text-sm font-medium text-gray-500">Payment</span>
                        </div>
                    </div>
                </div>
                
                <form id="membershipForm" method="POST" action="{{ route('graduate.alumni-membership.store') }}">
                    @csrf
                    <input type="hidden" id="membership_type" name="membership_type">
                    
                    <!-- Step 1: Personal Information -->
                    <div id="step1" class="space-y-4">
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-user text-blue-600 mr-2"></i>
                                <div>
                                    <h4 class="text-sm font-semibold text-blue-900">Personal Information</h4>
                                    <p class="text-sm text-blue-700">Please provide your personal details for alumni registration.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="full_name" class="block text-sm font-display font-semibold text-gray-700 mb-2">Full Name *</label>
                                <input type="text" id="full_name" name="full_name" required
                                       value="{{ trim((auth()->user()->graduate->first_name ?? '') . ' ' . (auth()->user()->graduate->middle_name ?? '') . ' ' . (auth()->user()->graduate->last_name ?? '') . ' ' . (auth()->user()->graduate->extension ?? '')) }}"
                                       placeholder="Enter your full name"
                                       class="w-full input-enhanced"
                                       style="pointer-events: auto; cursor: text;">
                            </div>
                            
                            <div>
                                <label for="student_id" class="block text-sm font-display font-semibold text-gray-700 mb-2">Student/Alumni ID</label>
                                <input type="text" id="student_id" name="student_id"
                                       value="{{ auth()->user()->graduate->student_id ?? '' }}"
                                       placeholder="Enter your student ID (if applicable)"
                                       class="w-full input-enhanced"
                                       style="pointer-events: auto; cursor: text;">
                            </div>
                            
                            <div>
                                <label for="course_degree" class="block text-sm font-display font-semibold text-gray-700 mb-2">Course/Degree *</label>
                                <input type="text" id="course_degree" name="course_degree" required
                                       value="{{ auth()->user()->graduate->program ?? '' }}"
                                       placeholder="Enter your course/degree"
                                       class="w-full input-enhanced"
                                       style="pointer-events: auto; cursor: text;">
                            </div>
                            
                            <div>
                                <label for="batch_year" class="block text-sm font-display font-semibold text-gray-700 mb-2">Batch/Year Graduated *</label>
                                <input type="number" id="batch_year" name="batch_year" required
                                       value="{{ auth()->user()->graduate->batch_year ?? '' }}"
                                       placeholder="e.g., 2020"
                                       class="w-full input-enhanced">
                            </div>
                            
                            <div>
                                <label for="date_of_birth" class="block text-sm font-display font-semibold text-gray-700 mb-2">Date of Birth *</label>
                                <input type="date" id="date_of_birth" name="date_of_birth" required
                                       value="{{ auth()->user()->graduate->birth_date ?? '' }}"
                                       class="w-full input-enhanced">
                            </div>
                            
                            <div>
                                <label for="gender" class="block text-sm font-display font-semibold text-gray-700 mb-2">Gender *</label>
                                <select id="gender" name="gender" required class="w-full input-enhanced">
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ (auth()->user()->graduate->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ (auth()->user()->graduate->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ (auth()->user()->graduate->gender ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="contact_number" class="block text-sm font-display font-semibold text-gray-700 mb-2">Contact Number *</label>
                                <input type="tel" id="contact_number" name="contact_number" required
                                       value="{{ auth()->user()->graduate->contact_number ?? '' }}"
                                       placeholder="Enter your contact number"
                                       class="w-full input-enhanced">
                            </div>
                            
                            <div>
                                <label for="email_address" class="block text-sm font-display font-semibold text-gray-700 mb-2">Email Address *</label>
                                <input type="email" id="email_address" name="email_address" required
                                       value="{{ auth()->user()->email }}"
                                       placeholder="Enter your email address"
                                       class="w-full input-enhanced">
                            </div>
                            
                            <div class="md:col-span-2">
                                <label for="address" class="block text-sm font-display font-semibold text-gray-700 mb-2">Address (City/Province/Country) *</label>
                                <textarea id="address" name="address" rows="3" required
                                          placeholder="Enter your complete address"
                                          class="w-full input-enhanced">{{ auth()->user()->graduate->present_address ?? '' }}</textarea>
                            </div>
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="button" onclick="nextStep()" 
                                    class="btn-primary px-8 py-3">
                                Next: Professional Information
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 2: Professional Information -->
                    <div id="step2" class="space-y-4 hidden">
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-briefcase text-green-600 mr-2"></i>
                                <div>
                                    <h4 class="text-sm font-semibold text-green-900">Professional Information</h4>
                                    <p class="text-sm text-green-700">Please provide your current professional details.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="current_occupation" class="block text-sm font-display font-semibold text-gray-700 mb-2">Current Occupation *</label>
                                <input type="text" id="current_occupation" name="current_occupation" required
                                       value="{{ auth()->user()->graduate->current_position ?? '' }}"
                                       placeholder="Enter your current occupation"
                                       class="w-full input-enhanced">
                            </div>
                            
                            <div>
                                <label for="company_organization" class="block text-sm font-display font-semibold text-gray-700 mb-2">Company/Organization</label>
                                <input type="text" id="company_organization" name="company_organization"
                                       value="{{ auth()->user()->graduate->current_company ?? '' }}"
                                       placeholder="Enter your company/organization"
                                       class="w-full input-enhanced">
                            </div>
                            
                            <div>
                                <label for="position_job_title" class="block text-sm font-display font-semibold text-gray-700 mb-2">Position/Job Title</label>
                                <input type="text" id="position_job_title" name="position_job_title"
                                       value="{{ auth()->user()->graduate->current_position ?? '' }}"
                                       placeholder="Enter your position/job title"
                                       class="w-full input-enhanced">
                            </div>
                            
                            <div>
                                <label for="industry" class="block text-sm font-display font-semibold text-gray-700 mb-2">Industry</label>
                                <input type="text" id="industry" name="industry"
                                       value="{{ auth()->user()->graduate->employment_sector ?? '' }}"
                                       placeholder="Enter your industry"
                                       class="w-full input-enhanced">
                            </div>
                            
                            <div class="md:col-span-2">
                                <label for="work_address" class="block text-sm font-display font-semibold text-gray-700 mb-2">Work Address</label>
                                <textarea id="work_address" name="work_address" rows="2"
                                          placeholder="Enter your work address"
                                          class="w-full input-enhanced">{{ auth()->user()->graduate->work_location ?? '' }}</textarea>
                            </div>
                            
                            <div>
                                <label for="years_experience" class="block text-sm font-display font-semibold text-gray-700 mb-2">Years of Experience</label>
                                <select id="years_experience" name="years_experience" class="w-full input-enhanced">
                                    <option value="">Select Experience</option>
                                    <option value="0-1">0-1 years</option>
                                    <option value="2-3">2-3 years</option>
                                    <option value="4-5">4-5 years</option>
                                    <option value="6-10">6-10 years</option>
                                    <option value="11-15">11-15 years</option>
                                    <option value="16-20">16-20 years</option>
                                    <option value="20+">20+ years</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="flex justify-between">
                            <button type="button" onclick="prevStep()" 
                                    class="bg-gray-300 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-400 transition-colors font-display font-semibold">
                                Previous
                            </button>
                            <button type="button" onclick="nextStep()" 
                                    class="btn-primary px-8 py-3">
                                Next: Additional Details
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 3: Additional Details -->
                    <div id="step3" class="space-y-4 hidden">
                        <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-star text-purple-600 mr-2"></i>
                                <div>
                                    <h4 class="text-sm font-semibold text-purple-900">Additional Details</h4>
                                    <p class="text-sm text-purple-700">Help us understand your skills and interests for better alumni engagement.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="skills_expertise" class="block text-sm font-display font-semibold text-gray-700 mb-2">Skills and Expertise</label>
                                <textarea id="skills_expertise" name="skills_expertise" rows="3"
                                          placeholder="List your key skills and areas of expertise"
                                          class="w-full input-enhanced">{{ auth()->user()->graduate->skills ?? '' }}</textarea>
                            </div>
                            
                            <div>
                                <label for="achievements_awards" class="block text-sm font-display font-semibold text-gray-700 mb-2">Achievements or Awards</label>
                                <textarea id="achievements_awards" name="achievements_awards" rows="3"
                                          placeholder="List any notable achievements or awards"
                                          class="w-full input-enhanced"></textarea>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-display font-semibold text-gray-700 mb-2">Willingness to volunteer or mentor students</label>
                                <div class="space-y-2">
                                    <label class="flex items-center">
                                        <input type="radio" name="volunteer_mentor" value="yes" class="mr-2">
                                        <span class="text-sm text-gray-700">Yes, I'm interested in volunteering/mentoring</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="volunteer_mentor" value="maybe" class="mr-2">
                                        <span class="text-sm text-gray-700">Maybe, depending on the opportunity</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="volunteer_mentor" value="no" class="mr-2">
                                        <span class="text-sm text-gray-700">No, not at this time</span>
                                    </label>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-display font-semibold text-gray-700 mb-2">Preferred Activities (Select all that apply)</label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="preferred_activities[]" value="networking_events" class="mr-2">
                                        <span class="text-sm text-gray-700">Networking Events</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="preferred_activities[]" value="community_service" class="mr-2">
                                        <span class="text-sm text-gray-700">Community Service</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="preferred_activities[]" value="job_fairs" class="mr-2">
                                        <span class="text-sm text-gray-700">Job Fairs</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="preferred_activities[]" value="mentoring" class="mr-2">
                                        <span class="text-sm text-gray-700">Mentoring</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="preferred_activities[]" value="workshops" class="mr-2">
                                        <span class="text-sm text-gray-700">Workshops & Seminars</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="preferred_activities[]" value="reunions" class="mr-2">
                                        <span class="text-sm text-gray-700">Reunions & Social Events</span>
                                    </label>
                                </div>
                            </div>
                            
                            <div>
                                <label for="membership_reason" class="block text-sm font-display font-semibold text-gray-700 mb-2">Why do you want to join the alumni association? *</label>
                                <textarea id="membership_reason" name="membership_reason" rows="3" required
                                          placeholder="Please tell us why you want to join the alumni association..."
                                          class="w-full input-enhanced"></textarea>
                            </div>
                        </div>
                        
                        <div class="flex justify-between">
                            <button type="button" onclick="prevStep()" 
                                    class="bg-gray-300 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-400 transition-colors font-display font-semibold">
                                Previous
                            </button>
                            <button type="button" onclick="nextStep()" 
                                    class="btn-primary px-8 py-3">
                                Next: Payment Details
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 4: Payment -->
                    <div id="step4" class="space-y-4 hidden">
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-credit-card text-green-600 mr-2"></i>
                                <div>
                                    <h4 class="text-sm font-semibold text-green-900">Payment Information</h4>
                                    <p class="text-sm text-green-700">Please provide your payment details to complete the application.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="payment_method" class="block text-sm font-display font-semibold text-gray-700 mb-2">Payment Method *</label>
                            <select id="payment_method" name="payment_method" required
                                    class="w-full input-enhanced">
                                <option value="">Select payment method</option>
                                <option value="gcash">GCash</option>
                                <option value="paymaya">PayMaya</option>
                                <option value="bank_transfer">Bank Transfer</option>
                            </select>
                        </div>
                        
                        <div class="mb-4" id="payment_reference_div">
                            <label for="payment_reference" class="block text-sm font-display font-semibold text-gray-700 mb-2">
                                <span id="payment_reference_label">Payment Reference Number</span> 
                                <span id="payment_reference_required" class="text-red-500">*</span>
                            </label>
                            <input type="text" id="payment_reference" name="payment_reference"
                                   placeholder="Enter GCash reference number or bank transaction ID"
                                   class="w-full input-enhanced">
                            <p class="text-xs text-gray-500 mt-1 font-body" id="payment_reference_help">
                                Please make the payment first and enter the reference number here.
                            </p>
                        </div>
                        
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4" id="payment_instructions">
                            <div class="flex items-start">
                                <i class="fas fa-exclamation-triangle text-yellow-600 mr-2 mt-1"></i>
                                <div class="flex-1">
                                    <h4 class="text-sm font-semibold text-yellow-900 mb-2">Payment Instructions</h4>
                                    <div class="text-sm text-yellow-800" id="payment_instructions_content">
                                        <p><strong>GCash:</strong> Send payment to 0917-123-4567 (Alumni Association)</p>
                                        <p><strong>PayMaya:</strong> Send payment to 0917-123-4567 (Alumni Association)</p>
                                        <p><strong>Bank Transfer:</strong> BDO Account: 1234567890 (Alumni Association)</p>
                                        <p class="mt-2">After payment, you will be asked to upload proof of payment.</p>
                                    </div>
                                    <!-- QR Code will be displayed here -->
                                    <div id="qr_code_section" class="mt-4 hidden">
                                        <div class="bg-white p-4 rounded-lg border-2 border-yellow-500 inline-block">
                                            <p class="text-xs text-yellow-900 font-semibold mb-2 text-center">Scan to Pay via GCash</p>
                                            <img id="gcash_qr_code" src="{{ asset('images/mygcash.jpg') }}" alt="GCash QR Code" class="w-48 h-48 mx-auto border border-gray-300 rounded">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-between">
                            <button type="button" onclick="prevStep()" 
                                    class="bg-gray-300 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-400 transition-colors font-display font-semibold">
                                Back: Information
                            </button>
                            <button type="submit" 
                                    class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition-colors font-display font-semibold">
                                Submit Application
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
let currentStep = 1;

function updateStepIndicators() {
    // Reset all indicators
    for (let i = 1; i <= 4; i++) {
        const indicator = document.getElementById(`step${i}-indicator`);
        const label = indicator.nextElementSibling;
        
        if (i < currentStep) {
            // Completed steps
            indicator.classList.remove('bg-blue-600', 'bg-gray-300', 'text-white', 'text-gray-600');
            indicator.classList.add('bg-green-600', 'text-white');
            label.classList.remove('text-blue-600', 'text-gray-500');
            label.classList.add('text-green-600');
        } else if (i === currentStep) {
            // Current step
            indicator.classList.remove('bg-green-600', 'bg-gray-300', 'text-white', 'text-gray-600');
            indicator.classList.add('bg-blue-600', 'text-white');
            label.classList.remove('text-green-600', 'text-gray-500');
            label.classList.add('text-blue-600');
        } else {
            // Future steps
            indicator.classList.remove('bg-blue-600', 'bg-green-600', 'text-white');
            indicator.classList.add('bg-gray-300', 'text-gray-600');
            label.classList.remove('text-blue-600', 'text-green-600');
            label.classList.add('text-gray-500');
        }
    }
}

function openMembershipModal(type, amount) {
    console.log('Opening modal for:', type, amount);
    
    // Check if modal exists
    const modal = document.getElementById('membershipModal');
    if (!modal) {
        console.error('Modal element not found');
        return;
    }
    
    // Reset to step 1
    currentStep = 1;
    
    // Set membership type
    const membershipTypeInput = document.getElementById('membership_type');
    if (membershipTypeInput) {
        membershipTypeInput.value = type;
    }
    
    // Hide all steps except step 1
    for (let i = 1; i <= 4; i++) {
        const step = document.getElementById(`step${i}`);
        if (step) {
            step.classList.add('hidden');
        }
    }
    
    const step1 = document.getElementById('step1');
    if (step1) {
        step1.classList.remove('hidden');
    }
    
    // Reset step indicators
    updateStepIndicators();
    
    // Show modal
    modal.classList.remove('hidden');
    
    // Test if form fields are editable
    setTimeout(() => {
        const fullNameField = document.getElementById('full_name');
        if (fullNameField) {
            fullNameField.focus();
            console.log('Full name field focused, should be editable');
        }
    }, 100);
}

function closeMembershipModal() {
    document.getElementById('membershipModal').classList.add('hidden');
    // Reset to step 1
    currentStep = 1;
    
    // Hide all steps except step 1
    for (let i = 1; i <= 4; i++) {
        document.getElementById(`step${i}`).classList.add('hidden');
    }
    document.getElementById('step1').classList.remove('hidden');
    
    // Reset step indicators
    updateStepIndicators();
}

function nextStep() {
    // Validate current step before proceeding
    if (!validateCurrentStep()) {
        return;
    }
    
    // Hide current step
    document.getElementById(`step${currentStep}`).classList.add('hidden');
    
    // Move to next step
    currentStep++;
    document.getElementById(`step${currentStep}`).classList.remove('hidden');
    
    // Update step indicators
    updateStepIndicators();
}

function prevStep() {
    // Hide current step
    document.getElementById(`step${currentStep}`).classList.add('hidden');
    
    // Move to previous step
    currentStep--;
    document.getElementById(`step${currentStep}`).classList.remove('hidden');
    
    // Update step indicators
    updateStepIndicators();
}

function validateCurrentStep() {
    switch(currentStep) {
        case 1:
            const fullName = document.getElementById('full_name').value;
            const courseDegree = document.getElementById('course_degree').value;
            const batchYear = document.getElementById('batch_year').value;
            const dateOfBirth = document.getElementById('date_of_birth').value;
            const gender = document.getElementById('gender').value;
            const contactNumber = document.getElementById('contact_number').value;
            const emailAddress = document.getElementById('email_address').value;
            const address = document.getElementById('address').value;
            
            if (!fullName || !courseDegree || !batchYear || !dateOfBirth || !gender || !contactNumber || !emailAddress || !address) {
                alert('Please fill in all required fields in Personal Information before proceeding.');
                return false;
            }
            break;
            
        case 2:
            const currentOccupation = document.getElementById('current_occupation').value;
            
            if (!currentOccupation) {
                alert('Please fill in your current occupation before proceeding.');
                return false;
            }
            break;
            
        case 3:
            const membershipReason = document.getElementById('membership_reason').value;
            
            if (!membershipReason) {
                alert('Please tell us why you want to join the alumni association before proceeding.');
                return false;
            }
            break;
    }
    
    return true;
}

// Handle payment method changes
document.addEventListener('DOMContentLoaded', function() {
    const paymentMethodSelect = document.getElementById('payment_method');
    const paymentReferenceInput = document.getElementById('payment_reference');
    const paymentReferenceLabel = document.getElementById('payment_reference_label');
    const paymentReferenceRequired = document.getElementById('payment_reference_required');
    const paymentReferenceHelp = document.getElementById('payment_reference_help');
    const paymentInstructionsContent = document.getElementById('payment_instructions_content');
    
    if (paymentMethodSelect) {
        paymentMethodSelect.addEventListener('change', function() {
            const selectedMethod = this.value;
            
            switch(selectedMethod) {
                case 'gcash':
                    paymentReferenceLabel.textContent = 'GCash Reference Number';
                    paymentReferenceInput.placeholder = 'Enter GCash reference number';
                    paymentReferenceInput.required = true;
                    paymentReferenceRequired.style.display = 'inline';
                    paymentReferenceHelp.textContent = 'Please make the payment first and enter the GCash reference number here.';
                    paymentInstructionsContent.innerHTML = `
                        <p><strong>GCash:</strong> Scan the QR code below to send payment</p>
                        <p class="mt-2">After payment, you will be asked to upload proof of payment.</p>
                    `;
                    // Show QR code for GCash
                    document.getElementById('qr_code_section').classList.remove('hidden');
                    break;
                    
                case 'paymaya':
                    paymentReferenceLabel.textContent = 'PayMaya Reference Number';
                    paymentReferenceInput.placeholder = 'Enter PayMaya reference number';
                    paymentReferenceInput.required = true;
                    paymentReferenceRequired.style.display = 'inline';
                    paymentReferenceHelp.textContent = 'Please make the payment first and enter the PayMaya reference number here.';
                    paymentInstructionsContent.innerHTML = `
                        <p><strong>GCash:</strong> Send payment to 0917-123-4567 (Alumni Association)</p>
                        <p><strong>PayMaya:</strong> Send payment to 0917-123-4567 (Alumni Association)</p>
                        <p><strong>Bank Transfer:</strong> BDO Account: 1234567890 (Alumni Association)</p>
                        <p class="mt-2">After payment, you will be asked to upload proof of payment.</p>
                    `;
                    // Hide QR code for other payment methods
                    document.getElementById('qr_code_section').classList.add('hidden');
                    break;
                    
                case 'bank_transfer':
                    paymentReferenceLabel.textContent = 'Bank Transaction ID';
                    paymentReferenceInput.placeholder = 'Enter bank transaction ID';
                    paymentReferenceInput.required = true;
                    paymentReferenceRequired.style.display = 'inline';
                    paymentReferenceHelp.textContent = 'Please make the payment first and enter the bank transaction ID here.';
                    paymentInstructionsContent.innerHTML = `
                        <p><strong>GCash:</strong> Send payment to 0917-123-4567 (Alumni Association)</p>
                        <p><strong>PayMaya:</strong> Send payment to 0917-123-4567 (Alumni Association)</p>
                        <p><strong>Bank Transfer:</strong> BDO Account: 1234567890 (Alumni Association)</p>
                        <p class="mt-2">After payment, you will be asked to upload proof of payment.</p>
                    `;
                    // Hide QR code for other payment methods
                    document.getElementById('qr_code_section').classList.add('hidden');
                    break;
                    
                default:
                    paymentReferenceLabel.textContent = 'Payment Reference Number';
                    paymentReferenceInput.placeholder = 'Enter payment reference number';
                    paymentReferenceInput.required = true;
                    paymentReferenceRequired.style.display = 'inline';
                    paymentReferenceHelp.textContent = 'Please make the payment first and enter the reference number here.';
                    paymentInstructionsContent.innerHTML = `
                        <p><strong>GCash:</strong> Send payment to 0917-123-4567 (Alumni Association)</p>
                        <p><strong>PayMaya:</strong> Send payment to 0917-123-4567 (Alumni Association)</p>
                        <p><strong>Bank Transfer:</strong> BDO Account: 1234567890 (Alumni Association)</p>
                        <p class="mt-2">After payment, you will be asked to upload proof of payment.</p>
                    `;
                    // Hide QR code for other payment methods
                    document.getElementById('qr_code_section').classList.add('hidden');
            }
        });
    }
});

// Payment proof upload - handle all forms
document.querySelectorAll('.payment-proof-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const membershipId = this.dataset.membershipId;
        const submitButton = this.querySelector('button[type="submit"]');
        
        if (!membershipId) {
            alert('Error: Membership not found');
            return;
        }
    
    // Disable submit button and show loading
    submitButton.disabled = true;
    submitButton.textContent = 'Uploading...';
    
    fetch(`/graduate/alumni-membership/${membershipId}/payment`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Upload response:', data);
        if (data.success) {
            alert(data.message);
            location.reload();
        } else {
            alert(data.message || 'Error uploading payment proof');
        }
    })
    .catch(error => {
        console.error('Upload error:', error);
        console.error('Error details:', error.message);
        alert('Error uploading payment proof: ' + error.message);
    })
    .finally(() => {
        // Re-enable submit button
        submitButton.disabled = false;
        submitButton.textContent = 'Upload Payment Proof';
    });
    });
});

// Form submission handler
document.addEventListener('DOMContentLoaded', function() {
    console.log('Page loaded, functions should be available');
    
    // Test if function exists
    if (typeof openMembershipModal === 'function') {
        console.log('openMembershipModal function is available');
    } else {
        console.error('openMembershipModal function is NOT available');
    }
});
    
// Add form submission handler (outside DOMContentLoaded to ensure it runs)
(function() {
    const membershipForm = document.getElementById('membershipForm');
    if (membershipForm) {
        membershipForm.addEventListener('submit', function(e) {
            console.log('Form submission triggered');
            console.log('Current step:', currentStep);
            
            // Validate all fields before submitting
            if (!validateCurrentStep()) {
                console.error('Validation failed');
                e.preventDefault();
                return false;
            }
            
            // Check if we're on the last step
            if (currentStep !== 4) {
                console.error('Not on final step');
                e.preventDefault();
                alert('Please complete all steps before submitting.');
                return false;
            }
            
            console.log('Form validation passed, submitting...');
            
            // Show loading state
            const submitButton = this.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.textContent = 'Submitting...';
            }
            
            // Let the form submit normally to the server
            // The server will redirect back with success message
            return true;
        });
    }
})();

// Renewal Modal Functions
function openRenewalModal() {
    // Set renewal mode flag
    window.renewalMode = true;
    
    // Get the membership type from the expiring membership
    @php
    $renewalType = 'lifetime'; // default
    if (isset($expiringMembership) && $expiringMembership) {
        $renewalType = $expiringMembership->membership_type;
    } elseif (isset($currentMembership) && $currentMembership) {
        $renewalType = $currentMembership->membership_type;
    }
    @endphp
    
    // Open the same membership application modal but for renewal
    openMembershipModal('{{ $renewalType }}', 0);
    
    // Change the modal title to indicate renewal
    const modalTitle = document.querySelector('#membershipModal h2');
    if (modalTitle) {
        modalTitle.textContent = 'Renew Your Alumni ID';
    }
    
    // Update the form to submit to renewal route
    const form = document.getElementById('membershipForm');
    if (form) {
        form.action = "{{ route('graduate.alumni-membership.renew') }}";
    }
}

// Handle renewal form submission
document.addEventListener('DOMContentLoaded', function() {
    const membershipForm = document.getElementById('membershipForm');
    if (membershipForm) {
        let isRenewalMode = false;
        
        // Check if renewal button was clicked
        if (typeof window.renewalMode !== 'undefined') {
            isRenewalMode = true;
        }
        
        membershipForm.addEventListener('submit', function(e) {
            if (isRenewalMode) {
                // Change form action to renewal route
                this.action = "{{ route('graduate.alumni-membership.renew') }}";
            }
        });
    }
});
</script>
@endsection
