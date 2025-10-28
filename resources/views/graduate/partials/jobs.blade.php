<div class="bg-white rounded-lg shadow-md">
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Job Opportunities</h2>
            <button onclick="toggleJobPostForm()" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                <i class="fas fa-plus mr-2"></i>
                Post a Job
            </button>
        </div>

        <!-- Search and Filter -->
        <div class="mb-6">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" placeholder="Search jobs..." class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex gap-2">
                    <select class="border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option>All Locations</option>
                        <option>Cagayan de Oro</option>
                        <option>Manila</option>
                        <option>Cebu</option>
                        <option>Davao</option>
                    </select>
                    <select class="border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option>All Types</option>
                        <option>Full-time</option>
                        <option>Part-time</option>
                        <option>Contract</option>
                        <option>Internship</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Job Posting Form (Hidden by default) -->
        <div id="job-post-form" class="hidden mb-8 bg-gray-50 rounded-lg p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Post a New Job</h3>
            <form id="job-posting-form" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Job Title *</label>
                        <input type="text" name="title" id="title" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="company" class="block text-sm font-medium text-gray-700 mb-1">Company *</label>
                        <input type="text" name="company" id="company" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Job Description *</label>
                    <textarea name="description" id="description" rows="4" required
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Describe the job responsibilities, duties, and what the role entails..."></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location *</label>
                        <input type="text" name="location" id="location" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="employment_type" class="block text-sm font-medium text-gray-700 mb-1">Employment Type *</label>
                        <select name="employment_type" id="employment_type" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Type</option>
                            <option value="full-time">Full-time</option>
                            <option value="part-time">Part-time</option>
                            <option value="contract">Contract</option>
                            <option value="internship">Internship</option>
                            <option value="remote">Remote</option>
                        </select>
                    </div>
                    <div>
                        <label for="application_deadline" class="block text-sm font-medium text-gray-700 mb-1">Application Deadline</label>
                        <input type="date" name="application_deadline" id="application_deadline"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="salary_min" class="block text-sm font-medium text-gray-700 mb-1">Minimum Salary (₱)</label>
                        <input type="number" name="salary_min" id="salary_min" min="0" step="1000"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="salary_max" class="block text-sm font-medium text-gray-700 mb-1">Maximum Salary (₱)</label>
                        <input type="number" name="salary_max" id="salary_max" min="0" step="1000"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div>
                    <label for="requirements" class="block text-sm font-medium text-gray-700 mb-1">Requirements</label>
                    <textarea name="requirements" id="requirements" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                              placeholder="List the required skills, qualifications, and experience..."></textarea>
                </div>

                <div>
                    <label for="benefits" class="block text-sm font-medium text-gray-700 mb-1">Benefits</label>
                    <textarea name="benefits" id="benefits" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                              placeholder="List the benefits and perks offered..."></textarea>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="toggleJobPostForm()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Submit for Review
                    </button>
                </div>
            </form>
        </div>

        <!-- Job Listings -->
        @if($jobPostings->count() > 0)
            <div class="space-y-6">
                @foreach($jobPostings as $job)
                    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900">{{ $job->title }}</h3>
                                <p class="text-lg text-gray-600">{{ $job->company }}</p>
                                <p class="text-sm text-gray-500">{{ $job->location }} • {{ $job->employment_type }}</p>
                            </div>
                            <div class="text-right">
                                @if($job->salary_min && $job->salary_max)
                                    <p class="text-lg font-semibold text-green-600">₱{{ number_format($job->salary_min) }} - ₱{{ number_format($job->salary_max) }}</p>
                                @elseif($job->salary_min)
                                    <p class="text-lg font-semibold text-green-600">₱{{ number_format($job->salary_min) }}+</p>
                                @endif
                                <p class="text-sm text-gray-500">Posted {{ $job->created_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        <div class="mb-4">
                            <p class="text-gray-700">{{ Str::limit($job->description, 200) }}</p>
                        </div>

                        @if($job->requirements)
                            <div class="mb-4">
                                <h4 class="font-semibold text-gray-900 mb-2">Requirements:</h4>
                                <p class="text-gray-700">{{ Str::limit($job->requirements, 150) }}</p>
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
                                <button onclick="viewJobDetails({{ $job->id }})" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                    <i class="fas fa-eye mr-2"></i>
                                    View Details
                                </button>
                                <button onclick="applyToJob({{ $job->id }})" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                    <i class="fas fa-paper-plane mr-2"></i>
                                    Apply Now
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $jobPostings->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-briefcase text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No Job Postings Available</h3>
                <p class="text-gray-600 mb-4">Check back later for new job opportunities.</p>
                <button onclick="loadContent('dashboard')" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Dashboard
                </button>
            </div>
        @endif
    </div>
</div>

<script>
function toggleJobPostForm() {
    const form = document.getElementById('job-post-form');
    form.classList.toggle('hidden');
}

function viewJobDetails(jobId) {
    // Create a modal to show job details
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 bg-gray-600 bg-opacity-50 z-50 flex items-center justify-center p-4';
    modal.innerHTML = `
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold text-gray-900">Job Details</h3>
                    <button onclick="closeJobModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div id="job-details-content">
                    <div class="text-center py-8">
                        <i class="fas fa-spinner fa-spin text-2xl text-blue-600 mb-2"></i>
                        <p class="text-gray-600">Loading job details...</p>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    // Fetch job details
    fetch(`/graduate/jobs/${jobId}/details`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('job-details-content').innerHTML = data.html;
            } else {
                document.getElementById('job-details-content').innerHTML = `
                    <div class="text-center py-8">
                        <i class="fas fa-exclamation-triangle text-2xl text-red-500 mb-2"></i>
                        <p class="text-gray-600">Error loading job details</p>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('job-details-content').innerHTML = `
                <div class="text-center py-8">
                    <i class="fas fa-exclamation-triangle text-2xl text-red-500 mb-2"></i>
                    <p class="text-gray-600">Error loading job details</p>
                </div>
            `;
        });
}

function applyToJob(jobId) {
    if (confirm('Are you sure you want to apply for this job?')) {
        // Create application modal
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-gray-600 bg-opacity-50 z-50 flex items-center justify-center p-4';
        modal.innerHTML = `
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold text-gray-900">Apply for Job</h3>
                        <button onclick="closeJobModal()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <form id="job-application-form">
                        <input type="hidden" name="job_id" value="${jobId}">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Cover Letter</label>
                            <textarea name="cover_letter" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Write a brief cover letter..."></textarea>
                        </div>
                        <div class="flex justify-end space-x-3">
                            <button type="button" onclick="closeJobModal()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                                Submit Application
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        `;
        
        document.body.appendChild(modal);
        
        // Handle form submission
        document.getElementById('job-application-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.textContent;
            
            submitButton.textContent = 'Submitting...';
            submitButton.disabled = true;
            
            fetch('/graduate/jobs/apply', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Application submitted successfully!');
                    closeJobModal();
                } else {
                    alert('Error: ' + (data.message || 'Failed to submit application'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error submitting application. Please try again.');
            })
            .finally(() => {
                submitButton.textContent = originalText;
                submitButton.disabled = false;
            });
        });
    }
}

function closeJobModal() {
    const modal = document.querySelector('.fixed.inset-0.bg-gray-600');
    if (modal) {
        modal.remove();
    }
}

document.getElementById('job-posting-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const submitButton = this.querySelector('button[type="submit"]');
    const originalText = submitButton.textContent;
    
    submitButton.textContent = 'Submitting...';
    submitButton.disabled = true;
    
    fetch('{{ route("graduate.jobs.store") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Job posted successfully! It will be reviewed by an admin before being published.');
            this.reset();
            toggleJobPostForm();
            // Reload the page to show the new job posting
            window.location.reload();
        } else {
            alert('Error: ' + (data.message || 'Failed to post job'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error posting job. Please try again.');
    })
    .finally(() => {
        submitButton.textContent = originalText;
        submitButton.disabled = false;
    });
});
</script>
