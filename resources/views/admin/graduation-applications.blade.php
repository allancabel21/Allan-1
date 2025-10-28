@extends('layouts.dashboard')

@section('title', 'Graduation Applications Management')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-6">
            <div class="p-4 bg-gradient-to-br from-blue-600 to-purple-600 rounded-2xl shadow-lg">
                <i class="fas fa-graduation-cap text-white text-3xl"></i>
            </div>
            <div>
                <h1 class="text-4xl font-display font-bold text-gradient mb-2">Graduation Applications Management</h1>
                <p class="text-lg text-gray-600 font-body">Review and manage graduation applications from students</p>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="card-enhanced p-6">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg">
                    <div class="text-white text-2xl font-bold">📋</div>
                </div>
                <div class="ml-4">
                    <h3 class="text-2xl font-display font-bold text-gray-900">{{ $stats['total'] }}</h3>
                    <p class="text-sm text-gray-600 font-medium">Total Applications</p>
                </div>
            </div>
        </div>

        <div class="card-enhanced p-6">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl shadow-lg">
                    <div class="text-white text-2xl font-bold">⏳</div>
                </div>
                <div class="ml-4">
                    <h3 class="text-2xl font-display font-bold text-gray-900">{{ $stats['pending'] }}</h3>
                    <p class="text-sm text-gray-600 font-medium">Pending Review</p>
                </div>
            </div>
        </div>

        <div class="card-enhanced p-6">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl shadow-lg">
                    <div class="text-white text-2xl font-bold">✅</div>
                </div>
                <div class="ml-4">
                    <h3 class="text-2xl font-display font-bold text-gray-900">{{ $stats['approved'] }}</h3>
                    <p class="text-sm text-gray-600 font-medium">Approved</p>
                </div>
            </div>
        </div>

        <div class="card-enhanced p-6">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-br from-red-500 to-red-600 rounded-xl shadow-lg">
                    <div class="text-white text-2xl font-bold">❌</div>
                </div>
                <div class="ml-4">
                    <h3 class="text-2xl font-display font-bold text-gray-900">{{ $stats['rejected'] }}</h3>
                    <p class="text-sm text-gray-600 font-medium">Rejected</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Options -->
    <div class="card-enhanced p-6 mb-6">
        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4">
            <h3 class="text-lg font-display font-semibold text-gray-900">Filter & Search</h3>
            <div class="flex flex-wrap gap-3">
                <select id="statusFilter" class="input-enhanced text-sm">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
                <select id="typeFilter" class="input-enhanced text-sm">
                    <option value="">All Types</option>
                    <option value="degree">Degree</option>
                    <option value="diploma">Diploma</option>
                </select>
                <input type="text" id="searchInput" placeholder="Search by student name or ID..."
                       class="input-enhanced text-sm min-w-[200px]">
            </div>
        </div>
    </div>

    <!-- Applications Table -->
    <div class="table-enhanced">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="text-left py-4 px-6">Student</th>
                        <th class="text-left py-4 px-6">Application Type</th>
                        <th class="text-left py-4 px-6">Campus & Department</th>
                        <th class="text-left py-4 px-6">School Year</th>
                        <th class="text-left py-4 px-6">Status</th>
                        <th class="text-left py-4 px-6">Submitted</th>
                        <th class="text-left py-4 px-6">Actions</th>
                    </tr>
                </thead>
                <tbody id="applicationsTableBody">
                    @forelse($applications as $application)
                    <tr class="application-row transition-colors duration-200" 
                        data-status="{{ $application->status }}" 
                        data-type="{{ $application->application_type }}">
                        <td class="py-4 px-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12">
                                    <div class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg overflow-hidden">
                                        @if($application->graduate->profile_picture)
                                            <img src="{{ asset('storage/' . $application->graduate->profile_picture) }}" alt="Profile Picture" class="w-full h-full object-cover">
                                        @else
                                            <i class="fas fa-user text-white text-lg"></i>
                                        @endif
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-display font-semibold text-gray-900">
                                        {{ $application->graduate->first_name }} {{ $application->graduate->last_name }}
                                    </div>
                                    <div class="text-sm text-gray-500 font-body">
                                        {{ $application->graduate->student_id ?? 'N/A' }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="text-sm text-gray-900 font-body">
                                {{ $application->application_type_label }}
                            </div>
                            @if($application->major_in)
                                <div class="text-sm text-gray-500 font-body">
                                    {{ $application->major_in }}
                                </div>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            <div class="text-sm text-gray-900 font-body">
                                {{ $application->campus }}
                            </div>
                            <div class="text-sm text-gray-500 font-body">
                                {{ $application->college_unit_department }}
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="text-sm text-gray-900 font-body">
                                {{ $application->school_year }}
                            </div>
                            <div class="text-sm text-gray-500 font-body">
                                {{ $application->last_semester_label }}
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="badge-enhanced
                                @if($application->status === 'approved') bg-green-100 text-green-800
                                @elseif($application->status === 'rejected') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800 @endif">
                                {{ $application->status_label }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="text-sm text-gray-900 font-body">
                                {{ $application->created_at->format('M d, Y') }}
                            </div>
                            <div class="text-sm text-gray-500 font-body">
                                {{ $application->created_at->format('h:i A') }}
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center space-x-2">
                                <button onclick="viewApplication({{ $application->id }})" 
                                        class="text-blue-600 hover:text-blue-900 transition-colors">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                @if($application->status === 'pending')
                                    <button onclick="approveApplication({{ $application->id }})" 
                                            class="text-green-600 hover:text-green-900 transition-colors">
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                    <button onclick="rejectApplication({{ $application->id }})" 
                                            class="text-red-600 hover:text-red-900 transition-colors">
                                        <i class="fas fa-times"></i> Reject
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-8 text-gray-500 font-body">No graduation applications found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4">
            {{ $applications->links() }}
        </div>
    </div>
</div>

<!-- Application Details Modal -->
<div id="applicationModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="card-enhanced max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-8">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-2xl font-display font-bold text-gray-900">Application Details</h3>
                    <button onclick="closeApplicationModal()" class="text-gray-400 hover:text-gray-600 transition-colors p-2 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div id="applicationDetails">
                    <!-- Application details will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Approval Modal -->
<div id="approvalModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="card-enhanced max-w-md w-full mx-4">
            <div class="p-8">
                <div class="flex justify-center mb-6">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-green-600 text-xl"></i>
                    </div>
                </div>
                <div class="text-center mb-8">
                    <h3 class="text-xl font-display font-bold text-gray-900 mb-3">Approve Application</h3>
                    <p class="text-gray-600 font-body">Are you sure you want to approve this graduation application?</p>
                </div>
                <form id="approvalForm" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="approval_notes" class="block text-sm font-display font-semibold text-gray-700 mb-2">Notes (Optional)</label>
                        <textarea id="approval_notes" name="notes" rows="3" 
                                  class="input-enhanced w-full" 
                                  placeholder="Add any notes about the approval..."></textarea>
                    </div>
                    <div class="flex space-x-3">
                        <button type="button" onclick="closeApprovalModal()" 
                                class="flex-1 bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition-colors font-display font-semibold">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="flex-1 bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors font-display font-semibold">
                            Approve
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Rejection Modal -->
<div id="rejectionModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="card-enhanced max-w-md w-full mx-4">
            <div class="p-8">
                <div class="flex justify-center mb-6">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-times text-red-600 text-xl"></i>
                    </div>
                </div>
                <div class="text-center mb-8">
                    <h3 class="text-xl font-display font-bold text-gray-900 mb-3">Reject Application</h3>
                    <p class="text-gray-600 font-body">Please provide a reason for rejecting this application.</p>
                </div>
                <form id="rejectionForm" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="rejection_notes" class="block text-sm font-display font-semibold text-gray-700 mb-2">Reason for Rejection *</label>
                        <textarea id="rejection_notes" name="notes" rows="3" required
                                  class="input-enhanced w-full" 
                                  placeholder="Please explain why this application is being rejected..."></textarea>
                    </div>
                    <div class="flex space-x-3">
                        <button type="button" onclick="closeRejectionModal()" 
                                class="flex-1 bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition-colors font-display font-semibold">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="flex-1 bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition-colors font-display font-semibold">
                            Reject
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
let currentApplicationId = null;

function viewApplication(applicationId) {
    currentApplicationId = applicationId;
    // Load application details via AJAX
    fetch(`/admin/graduation-applications/${applicationId}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('applicationDetails').innerHTML = html;
            document.getElementById('applicationModal').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error loading application details:', error);
            alert('Error loading application details');
        });
}

function closeApplicationModal() {
    document.getElementById('applicationModal').classList.add('hidden');
    currentApplicationId = null;
}

function approveApplication(applicationId) {
    currentApplicationId = applicationId;
    document.getElementById('approvalForm').action = `/admin/graduation-applications/${applicationId}/approve`;
    document.getElementById('approvalModal').classList.remove('hidden');
}

function closeApprovalModal() {
    document.getElementById('approvalModal').classList.add('hidden');
    currentApplicationId = null;
}

function rejectApplication(applicationId) {
    currentApplicationId = applicationId;
    document.getElementById('rejectionForm').action = `/admin/graduation-applications/${applicationId}/reject`;
    document.getElementById('rejectionModal').classList.remove('hidden');
}

function closeRejectionModal() {
    document.getElementById('rejectionModal').classList.add('hidden');
    currentApplicationId = null;
}

// Filter functionality
document.getElementById('statusFilter').addEventListener('change', filterApplications);
document.getElementById('typeFilter').addEventListener('change', filterApplications);
document.getElementById('searchInput').addEventListener('input', filterApplications);

function filterApplications() {
    const statusFilter = document.getElementById('statusFilter').value;
    const typeFilter = document.getElementById('typeFilter').value;
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    
    const rows = document.querySelectorAll('.application-row');
    
    rows.forEach(row => {
        const status = row.dataset.status;
        const type = row.dataset.type;
        const studentName = row.querySelector('td:first-child').textContent.toLowerCase();
        
        const statusMatch = !statusFilter || status === statusFilter;
        const typeMatch = !typeFilter || type === typeFilter;
        const searchMatch = !searchInput || studentName.includes(searchInput);
        
        if (statusMatch && typeMatch && searchMatch) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}
</script>
@endsection
