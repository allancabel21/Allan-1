@extends('layouts.dashboard')

@section('page-title', 'Job Review')
@section('page-description', 'Review and approve job postings from graduates')

@section('content')
<div class="space-y-6">
    <!-- Pending Jobs -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Pending Job Reviews</h2>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                    {{ $pendingJobs->total() }} pending
                </span>
            </div>

            @if($pendingJobs->count() > 0)
                <div class="space-y-4">
                    @foreach($pendingJobs as $job)
                        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex-1">
                                    <h3 class="text-xl font-semibold text-gray-900">{{ $job->title }}</h3>
                                    <p class="text-lg text-gray-600">{{ $job->company }}</p>
                                    <p class="text-sm text-gray-500">
                                        Posted by: {{ $job->postedBy->name }} • 
                                        {{ $job->location }} • 
                                        {{ $job->employment_type }} • 
                                        {{ $job->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    @if($job->salary_min && $job->salary_max)
                                        <p class="text-lg font-semibold text-green-600">₱{{ number_format($job->salary_min) }} - ₱{{ number_format($job->salary_max) }}</p>
                                    @elseif($job->salary_min)
                                        <p class="text-lg font-semibold text-green-600">₱{{ number_format($job->salary_min) }}+</p>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-4">
                                <h4 class="font-semibold text-gray-900 mb-2">Description:</h4>
                                <p class="text-gray-700">{{ $job->description }}</p>
                            </div>

                            @if($job->requirements)
                                <div class="mb-4">
                                    <h4 class="font-semibold text-gray-900 mb-2">Requirements:</h4>
                                    <p class="text-gray-700">{{ $job->requirements }}</p>
                                </div>
                            @endif

                            @if($job->benefits)
                                <div class="mb-4">
                                    <h4 class="font-semibold text-gray-900 mb-2">Benefits:</h4>
                                    <p class="text-gray-700">{{ $job->benefits }}</p>
                                </div>
                            @endif

                            <div class="flex justify-between items-center">
                                <div class="flex space-x-2">
                                    @if($job->application_deadline)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-clock mr-1"></i>
                                            Deadline: {{ $job->application_deadline->format('M d, Y') }}
                                        </span>
                                    @endif
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-briefcase mr-1"></i>
                                        {{ $job->employment_type }}
                                    </span>
                                </div>
                                <div class="flex space-x-2">
                                    <button onclick="rejectJob({{ $job->id }})" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                                        <i class="fas fa-times mr-2"></i>
                                        Reject
                                    </button>
                                    <button onclick="approveJob({{ $job->id }})" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                        <i class="fas fa-check mr-2"></i>
                                        Approve
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $pendingJobs->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check-circle text-gray-400 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No Pending Reviews</h3>
                    <p class="text-gray-600">All job postings have been reviewed!</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Approved Jobs -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Recently Approved Jobs</h2>
            
            @if($approvedJobs->count() > 0)
                <div class="space-y-4">
                    @foreach($approvedJobs->take(5) as $job)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="font-semibold text-gray-900">{{ $job->title }}</h3>
                                    <p class="text-sm text-gray-600">{{ $job->company }} • {{ $job->location }}</p>
                                    <p class="text-xs text-gray-500">
                                        Approved by {{ $job->reviewedBy->name }} • {{ $job->reviewed_at->diffForHumans() }}
                                    </p>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check mr-1"></i>
                                    Approved
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600">No approved jobs yet.</p>
            @endif
        </div>
    </div>

    <!-- Rejected Jobs -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Recently Rejected Jobs</h2>
            
            @if($rejectedJobs->count() > 0)
                <div class="space-y-4">
                    @foreach($rejectedJobs->take(5) as $job)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900">{{ $job->title }}</h3>
                                    <p class="text-sm text-gray-600">{{ $job->company }} • {{ $job->location }}</p>
                                    <p class="text-xs text-gray-500">
                                        Rejected by {{ $job->reviewedBy->name }} • {{ $job->reviewed_at->diffForHumans() }}
                                    </p>
                                    @if($job->rejection_reason)
                                        <p class="text-sm text-red-600 mt-2">
                                            <strong>Reason:</strong> {{ $job->rejection_reason }}
                                        </p>
                                    @endif
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <i class="fas fa-times mr-1"></i>
                                    Rejected
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600">No rejected jobs yet.</p>
            @endif
        </div>
    </div>
</div>

<!-- Rejection Modal -->
<div id="rejection-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Reject Job Posting</h3>
                <form id="rejection-form">
                    <div class="mb-4">
                        <label for="rejection_reason" class="block text-sm font-medium text-gray-700 mb-2">
                            Reason for rejection:
                        </label>
                        <textarea id="rejection_reason" name="rejection_reason" rows="4" required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Please provide a reason for rejecting this job posting..."></textarea>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeRejectionModal()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                            Reject Job
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
let currentJobId = null;

function approveJob(jobId) {
    if (confirm('Are you sure you want to approve this job posting?')) {
        fetch(`/admin/jobs/${jobId}/approve`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Job approved successfully!');
                window.location.reload();
            } else {
                alert('Error: ' + (data.message || 'Failed to approve job'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error approving job. Please try again.');
        });
    }
}

function rejectJob(jobId) {
    currentJobId = jobId;
    document.getElementById('rejection-modal').classList.remove('hidden');
}

function closeRejectionModal() {
    document.getElementById('rejection-modal').classList.add('hidden');
    document.getElementById('rejection-form').reset();
    currentJobId = null;
}

document.getElementById('rejection-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    if (!currentJobId) return;
    
    const formData = new FormData(this);
    const submitButton = this.querySelector('button[type="submit"]');
    const originalText = submitButton.textContent;
    
    submitButton.textContent = 'Rejecting...';
    submitButton.disabled = true;
    
    fetch(`/admin/jobs/${currentJobId}/reject`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Job rejected successfully!');
            closeRejectionModal();
            window.location.reload();
        } else {
            alert('Error: ' + (data.message || 'Failed to reject job'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error rejecting job. Please try again.');
    })
    .finally(() => {
        submitButton.textContent = originalText;
        submitButton.disabled = false;
    });
});
</script>
@endsection
