@extends('layouts.dashboard')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold text-gray-900">Graduate Details</h1>
                <p class="text-sm text-gray-600 mt-1">Complete information about {{ $graduate->first_name }} {{ $graduate->last_name }}</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('staff.graduates') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md text-sm hover:bg-gray-700 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Graduates
                </a>
                @if($graduate->verification_status === 'pending')
                <button onclick="verifyGraduate({{ $graduate->id }})" class="bg-green-600 text-white px-4 py-2 rounded-md text-sm hover:bg-green-700 transition-colors">
                    <i class="fas fa-check mr-2"></i>Verify Graduate
                </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Profile Header -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="flex items-center space-x-6">
            <div class="flex-shrink-0">
                @if($graduate->profile_picture)
                    <img class="h-24 w-24 rounded-full object-cover" src="{{ asset('storage/' . $graduate->profile_picture) }}" alt="">
                @else
                    <div class="h-24 w-24 rounded-full bg-gray-300 flex items-center justify-center">
                        <i class="fas fa-user text-3xl text-gray-600"></i>
                    </div>
                @endif
            </div>
            <div class="flex-1">
                <h2 class="text-2xl font-semibold text-gray-900">{{ $graduate->first_name }} {{ $graduate->last_name }}</h2>
                <p class="text-sm text-gray-600">{{ $graduate->user->email ?? 'N/A' }}</p>
                <p class="text-sm text-gray-600">Student ID: {{ $graduate->student_id ?? 'Not provided' }}</p>
                <div class="flex items-center space-x-4 mt-3">
                    @if($graduate->is_employed)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-2"></i>
                            Employed
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                            <i class="fas fa-times-circle mr-2"></i>
                            Unemployed
                        </span>
                    @endif
                    
                    @if($graduate->verification_status === 'verified')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-2"></i>
                            Verified
                        </span>
                    @elseif($graduate->verification_status === 'pending')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                            <i class="fas fa-clock mr-2"></i>
                            Pending Verification
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                            <i class="fas fa-question-circle mr-2"></i>
                            Not Verified
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Information Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Personal Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Personal Information</h3>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">Date of Birth:</span>
                    <span class="text-sm text-gray-900">{{ $graduate->birth_date ? \Carbon\Carbon::parse($graduate->birth_date)->format('M d, Y') : 'Not provided' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">Place of Birth:</span>
                    <span class="text-sm text-gray-900">{{ $graduate->place_of_birth ?? 'Not provided' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">Civil Status:</span>
                    <span class="text-sm text-gray-900">{{ $graduate->civil_status ?? 'Not provided' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">Citizenship:</span>
                    <span class="text-sm text-gray-900">{{ $graduate->citizenship ?? 'Filipino' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">Contact Number:</span>
                    <span class="text-sm text-gray-900">{{ $graduate->contact_number ?? 'Not provided' }}</span>
                </div>
            </div>
        </div>

        <!-- Academic Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Academic Information</h3>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">Program:</span>
                    <span class="text-sm text-gray-900">{{ $graduate->program ?? 'Not specified' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">Batch Year:</span>
                    <span class="text-sm text-gray-900">{{ $graduate->batch_year ?? 'Not specified' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">Student ID:</span>
                    <span class="text-sm text-gray-900">{{ $graduate->student_id ?? 'Not provided' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">Graduation Date:</span>
                    <span class="text-sm text-gray-900">{{ $graduate->graduation_date ? \Carbon\Carbon::parse($graduate->graduation_date)->format('M d, Y') : 'Not provided' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Employment Information -->
    @if($graduate->is_employed)
    <div class="bg-white rounded-lg shadow p-6 mt-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Current Employment</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Position:</span>
                <span class="text-sm text-gray-900">{{ $graduate->current_position ?? 'Not specified' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Company:</span>
                <span class="text-sm text-gray-900">{{ $graduate->current_company ?? 'Not specified' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Start Date:</span>
                <span class="text-sm text-gray-900">{{ $graduate->employment_start_date ? \Carbon\Carbon::parse($graduate->employment_start_date)->format('M d, Y') : 'Not provided' }}</span>
            </div>
            @if($graduate->salary)
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Salary:</span>
                <span class="text-sm text-gray-900">₱{{ number_format($graduate->salary) }}</span>
            </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Employment History -->
    @if($graduate->employmentRecords && $graduate->employmentRecords->count() > 0)
    <div class="bg-white rounded-lg shadow p-6 mt-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Employment History</h3>
        <div class="space-y-4">
            @foreach($graduate->employmentRecords as $record)
            <div class="border border-gray-200 rounded-lg p-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900">{{ $record->position }}</h4>
                        <p class="text-sm text-gray-600 mt-1">{{ $record->company_name }}</p>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ $record->start_date->format('M Y') }} - 
                            {{ $record->end_date ? $record->end_date->format('M Y') : 'Present' }}
                        </p>
                    </div>
                    @if($record->salary)
                        <span class="text-sm font-medium text-gray-900">₱{{ number_format($record->salary) }}</span>
                    @endif
                </div>
                @if($record->job_description)
                    <p class="mt-3 text-sm text-gray-600">{{ $record->job_description }}</p>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Resumes -->
    @if($graduate->resumes && $graduate->resumes->count() > 0)
    <div class="bg-white rounded-lg shadow p-6 mt-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Resumes</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($graduate->resumes as $resume)
            <div class="border border-gray-200 rounded-lg p-4">
                <h4 class="text-sm font-semibold text-gray-900">{{ ucfirst($resume->template_type) }} Resume</h4>
                <p class="text-xs text-gray-500 mt-1">Created: {{ $resume->created_at->format('M d, Y') }}</p>
                <div class="mt-3 flex space-x-2">
                    <a href="{{ route('graduate.resume.view', $resume->id) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-xs">
                        <i class="fas fa-eye mr-1"></i>View
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Address Information -->
    <div class="bg-white rounded-lg shadow p-6 mt-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Address Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Present Address:</span>
                <span class="text-sm text-gray-900">{{ $graduate->present_address ?? 'Not provided' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">City/Municipality:</span>
                <span class="text-sm text-gray-900">{{ $graduate->municipality_city ?? 'Not provided' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Province:</span>
                <span class="text-sm text-gray-900">{{ $graduate->province ?? 'Not provided' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Zip Code:</span>
                <span class="text-sm text-gray-900">{{ $graduate->zip_code ?? 'Not provided' }}</span>
            </div>
        </div>
    </div>

    <!-- Account Information -->
    <div class="bg-white rounded-lg shadow p-6 mt-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Account Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Account Created:</span>
                <span class="text-sm text-gray-900">{{ $graduate->user->created_at->format('M d, Y') ?? 'N/A' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Last Updated:</span>
                <span class="text-sm text-gray-900">{{ $graduate->updated_at->format('M d, Y') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Email Verified:</span>
                <span class="text-sm text-gray-900">
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

<script>
function verifyGraduate(graduateId) {
    if (confirm('Are you sure you want to verify this graduate?')) {
        fetch(`/staff/graduates/${graduateId}/verify`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error verifying graduate: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error verifying graduate. Please try again.');
        });
    }
}
</script>
@endsection
