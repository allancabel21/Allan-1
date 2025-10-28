@extends('layouts.dashboard')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-xl font-semibold text-gray-900">Job Postings Management</h1>
                <p class="text-sm text-gray-600 mt-2">View and manage job postings in the system</p>
            </div>
            <button onclick="openCreateJobModal()" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm hover:bg-blue-700 transition-colors">
                <i class="fas fa-plus mr-2"></i>Create Job Posting
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-briefcase text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Jobs</p>
                    <p class="text-xl font-semibold text-gray-900">{{ $jobPostings->total() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Active Jobs</p>
                    <p class="text-xl font-semibold text-gray-900">{{ $jobPostings->where('status', 'active')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Pending Review</p>
                    <p class="text-xl font-semibold text-gray-900">{{ $jobPostings->where('status', 'pending')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <i class="fas fa-times-circle text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Inactive Jobs</p>
                    <p class="text-xl font-semibold text-gray-900">{{ $jobPostings->where('status', 'inactive')->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="flex flex-wrap items-center gap-4">
            <div class="flex items-center space-x-2">
                <label for="status-filter" class="text-sm font-medium text-gray-700">Status:</label>
                <select id="status-filter" class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="pending">Pending</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            
            <div class="flex items-center space-x-2">
                <label for="search" class="text-sm font-medium text-gray-700">Search:</label>
                <input type="text" id="search" placeholder="Search by title, company..." 
                       class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <button onclick="applyFilters()" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm hover:bg-blue-700 transition-colors">
                <i class="fas fa-search mr-1"></i>Filter
            </button>
            
            <button onclick="clearFilters()" class="bg-gray-600 text-white px-4 py-2 rounded-md text-sm hover:bg-gray-700 transition-colors">
                <i class="fas fa-times mr-1"></i>Clear
            </button>
        </div>
    </div>

    <!-- Job Postings Table -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">All Job Postings</h2>
        </div>

        @if($jobPostings->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Posted By</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applications</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Posted Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($jobPostings as $job)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $job->title }}</div>
                            <div class="text-sm text-gray-500">{{ $job->location }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $job->company_name }}</div>
                            <div class="text-sm text-gray-500">{{ $job->employment_type }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8">
                                    @if($job->postedBy && $job->postedBy->graduate && $job->postedBy->graduate->profile_picture)
                                        <img class="h-8 w-8 rounded-full object-cover" src="{{ asset('storage/' . $job->postedBy->graduate->profile_picture) }}" alt="">
                                    @else
                                        <div class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center">
                                            <i class="fas fa-user text-gray-600 text-xs"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $job->postedBy ? ($job->postedBy->graduate ? $job->postedBy->graduate->first_name . ' ' . $job->postedBy->graduate->last_name : $job->postedBy->name) : 'System' }}
                                    </div>
                                    <div class="text-sm text-gray-500">{{ $job->postedBy ? $job->postedBy->email : 'N/A' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($job->status === 'active')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Active
                                </span>
                            @elseif($job->status === 'pending')
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
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <i class="fas fa-users mr-1"></i>
                                {{ $job->applications_count ?? 0 }} applications
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $job->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <button onclick="viewJob({{ $job->id }})" 
                                        class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-md text-xs transition-colors">
                                    <i class="fas fa-eye mr-1"></i>View
                                </button>
                                
                                <button onclick="editJob({{ $job->id }})" 
                                        class="text-green-600 hover:text-green-900 bg-green-50 hover:bg-green-100 px-3 py-1 rounded-md text-xs transition-colors">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </button>
                                
                                @if($job->status === 'active')
                                <button onclick="updateJobStatus({{ $job->id }}, 'inactive')" 
                                        class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1 rounded-md text-xs transition-colors">
                                    <i class="fas fa-pause mr-1"></i>Deactivate
                                </button>
                                @elseif($job->status === 'inactive')
                                <button onclick="updateJobStatus({{ $job->id }}, 'active')" 
                                        class="text-green-600 hover:text-green-900 bg-green-50 hover:bg-green-100 px-3 py-1 rounded-md text-xs transition-colors">
                                    <i class="fas fa-play mr-1"></i>Activate
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $jobPostings->links() }}
        </div>
        @else
        <div class="px-6 py-12 text-center">
            <i class="fas fa-briefcase text-4xl text-gray-300 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No job postings found</h3>
            <p class="text-gray-500">There are no job postings in the system yet.</p>
        </div>
        @endif
    </div>
</div>

<!-- Job Details Modal -->
<div id="jobModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-2/3 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Job Posting Details</h3>
                <button onclick="closeJobModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div id="jobDetails" class="text-gray-600">
                <!-- Job details will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- Create Job Modal -->
<div id="createJobModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Create New Job Posting</h3>
                <button onclick="closeCreateJobModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form id="createJobForm" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Job Title</label>
                        <input type="text" name="title" id="title" required
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                    </div>
                    <div>
                        <label for="company" class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                        <input type="text" name="company" id="company" required
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                    </div>
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input type="text" name="location" id="location" required
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                    </div>
                    <div>
                        <label for="employment_type" class="block text-sm font-medium text-gray-700 mb-2">Employment Type</label>
                        <select name="employment_type" id="employment_type" required
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                            <option value="">Select Type</option>
                            <option value="Full-time">Full-time</option>
                            <option value="Part-time">Part-time</option>
                            <option value="Contract">Contract</option>
                            <option value="Internship">Internship</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Job Description</label>
                    <textarea name="description" id="description" rows="4" required
                              class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"></textarea>
                </div>
                <div>
                    <label for="requirements" class="block text-sm font-medium text-gray-700 mb-2">Requirements</label>
                    <textarea name="requirements" id="requirements" rows="3"
                              class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"></textarea>
                </div>
                <div>
                    <label for="benefits" class="block text-sm font-medium text-gray-700 mb-2">Benefits</label>
                    <textarea name="benefits" id="benefits" rows="3"
                              class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"></textarea>
                </div>
                <div>
                    <label for="application_deadline" class="block text-sm font-medium text-gray-700 mb-2">Application Deadline</label>
                    <input type="date" name="application_deadline" id="application_deadline"
                           class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeCreateJobModal()" 
                            class="bg-gray-600 text-white px-4 py-2 rounded-md text-sm hover:bg-gray-700 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm hover:bg-blue-700 transition-colors">
                        Create Job Posting
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Job Modal -->
<div id="editJobModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Edit Job Posting</h3>
                <button onclick="closeEditJobModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form id="editJobForm" class="space-y-4">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit-job-id" name="job_id">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="edit-title" class="block text-sm font-medium text-gray-700 mb-2">Job Title</label>
                        <input type="text" name="title" id="edit-title" required
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                    </div>
                    <div>
                        <label for="edit-company" class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                        <input type="text" name="company" id="edit-company" required
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                    </div>
                    <div>
                        <label for="edit-location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input type="text" name="location" id="edit-location" required
                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                    </div>
                    <div>
                        <label for="edit-employment_type" class="block text-sm font-medium text-gray-700 mb-2">Employment Type</label>
                        <select name="employment_type" id="edit-employment_type" required
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                            <option value="">Select Type</option>
                            <option value="Full-time">Full-time</option>
                            <option value="Part-time">Part-time</option>
                            <option value="Contract">Contract</option>
                            <option value="Internship">Internship</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="edit-description" class="block text-sm font-medium text-gray-700 mb-2">Job Description</label>
                    <textarea name="description" id="edit-description" rows="4" required
                              class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"></textarea>
                </div>
                <div>
                    <label for="edit-requirements" class="block text-sm font-medium text-gray-700 mb-2">Requirements</label>
                    <textarea name="requirements" id="edit-requirements" rows="3"
                              class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"></textarea>
                </div>
                <div>
                    <label for="edit-benefits" class="block text-sm font-medium text-gray-700 mb-2">Benefits</label>
                    <textarea name="benefits" id="edit-benefits" rows="3"
                              class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"></textarea>
                </div>
                <div>
                    <label for="edit-application_deadline" class="block text-sm font-medium text-gray-700 mb-2">Application Deadline</label>
                    <input type="date" name="application_deadline" id="edit-application_deadline"
                           class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeEditJobModal()" 
                            class="bg-gray-600 text-white px-4 py-2 rounded-md text-sm hover:bg-gray-700 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm hover:bg-blue-700 transition-colors">
                        Update Job Posting
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function viewJob(jobId) {
    // Show loading
    document.getElementById('jobDetails').innerHTML = '<div class="text-center py-4"><i class="fas fa-spinner fa-spin text-2xl text-gray-400"></i></div>';
    document.getElementById('jobModal').classList.remove('hidden');
    
    // Fetch job details
    fetch(`/staff/job-postings/${jobId}/details`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('jobDetails').innerHTML = data.html;
            } else {
                document.getElementById('jobDetails').innerHTML = '<div class="text-red-600">Error loading job details.</div>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('jobDetails').innerHTML = '<div class="text-red-600">Error loading job details.</div>';
        });
}

function closeJobModal() {
    document.getElementById('jobModal').classList.add('hidden');
}

function editJob(jobId) {
    // Fetch job data and open edit modal
    fetch(`/staff/job-postings/${jobId}/edit`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const job = data.job;
                
                // Populate the edit form
                document.getElementById('edit-job-id').value = job.id;
                document.getElementById('edit-title').value = job.title || '';
                document.getElementById('edit-company_name').value = job.company_name || '';
                document.getElementById('edit-location').value = job.location || '';
                document.getElementById('edit-employment_type').value = job.employment_type || '';
                document.getElementById('edit-description').value = job.description || '';
                document.getElementById('edit-requirements').value = job.requirements || '';
                document.getElementById('edit-benefits').value = job.benefits || '';
                document.getElementById('edit-application_deadline').value = job.application_deadline || '';
                
                // Show the edit modal
                document.getElementById('editJobModal').classList.remove('hidden');
            } else {
                alert('Error loading job data for editing.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error loading job data for editing.');
        });
}

function updateJobStatus(jobId, status) {
    const action = status === 'active' ? 'activate' : 'deactivate';
    const confirmMessage = `Are you sure you want to ${action} this job posting?`;
    
    if (confirm(confirmMessage)) {
        fetch(`/staff/job-postings/${jobId}/status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error updating job status: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error updating job status. Please try again.');
        });
    }
}

function openCreateJobModal() {
    document.getElementById('createJobModal').classList.remove('hidden');
}

function closeCreateJobModal() {
    document.getElementById('createJobModal').classList.add('hidden');
    document.getElementById('createJobForm').reset();
}

function closeEditJobModal() {
    document.getElementById('editJobModal').classList.add('hidden');
    document.getElementById('editJobForm').reset();
}

function applyFilters() {
    const status = document.getElementById('status-filter').value;
    const search = document.getElementById('search').value;
    
    let url = new URL(window.location);
    if (status) url.searchParams.set('status', status);
    if (search) url.searchParams.set('search', search);
    
    window.location.href = url.toString();
}

function clearFilters() {
    document.getElementById('status-filter').value = '';
    document.getElementById('search').value = '';
    window.location.href = window.location.pathname;
}

// Handle create job form submission
document.getElementById('createJobForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('/staff/job-postings', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
    })
    .then(response => {
        console.log('Response status:', response.status);
        console.log('Response headers:', response.headers);
        
        if (!response.ok) {
            // Try to get the response text to see what's being returned
            return response.text().then(text => {
                console.log('Error response text:', text);
                throw new Error(`HTTP error! status: ${response.status}, response: ${text.substring(0, 200)}...`);
            });
        }
        
        // Check if response is JSON
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            return response.text().then(text => {
                console.log('Non-JSON response:', text);
                throw new Error('Response is not JSON. Content-Type: ' + contentType);
            });
        }
        
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert('Job posting created successfully!');
            location.reload();
        } else {
            let errorMessage = data.message || 'Unknown error';
            if (data.errors) {
                errorMessage += '\n\nValidation errors:\n';
                for (const field in data.errors) {
                    errorMessage += `- ${field}: ${data.errors[field].join(', ')}\n`;
                }
            }
            alert('Error creating job posting: ' + errorMessage);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error creating job posting: ' + error.message);
    });
});

// Handle edit job form submission
document.getElementById('editJobForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const jobId = document.getElementById('edit-job-id').value;
    const formData = new FormData(this);
    
    fetch(`/staff/job-postings/${jobId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-HTTP-Method-Override': 'PUT'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Error updating job posting: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error updating job posting. Please try again.');
    });
});
</script>
@endsection
