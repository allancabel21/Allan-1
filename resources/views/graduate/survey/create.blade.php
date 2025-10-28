@extends('layouts.dashboard')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Alumni Survey Management</h1>
        <p class="text-gray-600">Manage and monitor all alumni survey responses and submissions.</p>
        
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            </div>
        @endif
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-clipboard-list text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Surveys</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\AlumniSurvey::count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Completed</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\AlumniSurvey::count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">This Month</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\AlumniSurvey::whereMonth('created_at', now()->month)->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Response Rate</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Graduate::count() > 0 ? round((\App\Models\AlumniSurvey::count() / \App\Models\Graduate::count()) * 100, 1) : 0 }}%</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Button and Filters -->
    <div class="bg-white rounded-lg shadow border border-gray-200 mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-4">
                    <div class="flex items-center space-x-2">
                        <label class="text-sm font-medium text-gray-700">Status:</label>
                        <select class="border border-gray-300 rounded-md px-3 py-1 text-sm">
                            <option>All Status</option>
                            <option>Recent</option>
                            <option>This Month</option>
                        </select>
                    </div>
                    <div class="flex items-center space-x-2">
                        <label class="text-sm font-medium text-gray-700">Search:</label>
                        <input type="text" placeholder="Search by name, email..." class="border border-gray-300 rounded-md px-3 py-1 text-sm w-64">
                    </div>
                </div>
                <div class="flex items-center space-x-2 mt-2 sm:mt-0">
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">
                        <i class="fas fa-search mr-1"></i> Filter
                    </button>
                    <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 text-sm">
                        <i class="fas fa-times mr-1"></i> Clear
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Survey Responses Table -->
    <div class="bg-white rounded-lg shadow border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">All Survey Responses</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Respondent</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse(\App\Models\AlumniSurvey::with('user')->latest()->get() as $survey)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $survey->user->name ?? 'Unknown' }}</div>
                                    <div class="text-sm text-gray-500">Graduate</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $survey->user->email ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check mr-1"></i> Completed
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $survey->created_at ? $survey->created_at->format('M d, Y') : 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                <button onclick="viewSurvey({{ $survey->id }})" class="text-blue-600 hover:text-blue-900 cursor-pointer" title="View Survey Details">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                <button onclick="deleteSurvey({{ $survey->id }})" class="text-red-600 hover:text-red-900 cursor-pointer" title="Delete Survey">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                                <button onclick="testSurvey({{ $survey->id }})" class="text-green-600 hover:text-green-900 cursor-pointer text-xs" title="Test Survey Access">
                                    <i class="fas fa-bug"></i> Test
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="text-gray-500">
                                <i class="fas fa-clipboard-list text-4xl mb-4"></i>
                                <p class="text-lg font-medium">No survey responses yet</p>
                                <p class="text-sm">Survey responses will appear here once graduates complete the form.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Access to Survey Form -->
    <div class="mt-8 bg-blue-50 rounded-lg p-6 border border-blue-200">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-blue-900">Need to take the survey?</h3>
                <p class="text-blue-700 mt-1">Complete the Graduate Tracer Survey to help us track outcomes and improve our programs.</p>
            </div>
            <a href="{{ route('graduate.survey.create') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                <i class="fas fa-plus mr-2"></i> Take Survey
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function viewSurvey(surveyId) {
    console.log('Opening survey modal for ID:', surveyId);
    
    // Create a modal to display survey details
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center';
    modal.innerHTML = `
        <div class="bg-white rounded-lg p-6 max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold">Survey Response Details</h3>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div id="survey-content">
                <div class="text-center py-8">
                    <i class="fas fa-spinner fa-spin text-2xl text-blue-600 mb-2"></i>
                    <p>Loading survey details...</p>
                </div>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    // Fetch the survey content and display it in the modal
    fetch(`/admin/surveys/${surveyId}`)
        .then(response => {
            console.log('Response status:', response.status);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.text();
        })
        .then(html => {
            console.log('Received HTML length:', html.length);
            
            // Extract the survey content from the response
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            
            // Look for the survey content div
            let content = doc.querySelector('#survey-content');
            
            if (!content) {
                // If not found, look for the main content
                content = doc.querySelector('.space-y-6');
            }
            
            if (!content) {
                // If still not found, use the body
                content = doc.body;
            }
            
            console.log('Found content element:', content);
            
            if (content) {
                document.getElementById('survey-content').innerHTML = content.innerHTML;
                console.log('✅ Survey content loaded successfully in modal');
            } else {
                throw new Error('Could not find survey content in response');
            }
        })
        .catch(error => {
            console.error('Error loading survey:', error);
            document.getElementById('survey-content').innerHTML = `
                <div class="text-center py-8 text-red-600">
                    <i class="fas fa-exclamation-triangle text-2xl mb-2"></i>
                    <p>Error loading survey details: ${error.message}</p>
                </div>
            `;
        });
}

let surveyToDelete = null;

function deleteSurvey(surveyId) {
    surveyToDelete = surveyId;
    document.getElementById('delete-survey-modal').classList.remove('hidden');
}

function closeDeleteSurveyModal() {
    surveyToDelete = null;
    document.getElementById('delete-survey-modal').classList.add('hidden');
}

function confirmDeleteSurvey() {
    if (surveyToDelete) {
        console.log('Deleting survey:', surveyToDelete);
        
        // Create a form to submit the delete request
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/surveys/${surveyToDelete}`;
        form.style.display = 'none';
        
        // Add CSRF token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        form.appendChild(csrfToken);
        
        // Add method override for DELETE
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        form.appendChild(methodField);
        
        document.body.appendChild(form);
        
        console.log('Form created:', form);
        console.log('Form action:', form.action);
        console.log('CSRF token:', csrfToken.value);
        console.log('Method override:', methodField.value);
        
        // Submit the form
        console.log('Submitting form...');
        form.submit();
    }
}

function testSurvey(surveyId) {
    console.log('Testing survey access for ID:', surveyId);
    
    // Test direct access to the route
    fetch(`/admin/surveys/${surveyId}`)
        .then(response => {
            console.log('Test response status:', response.status);
            console.log('Test response headers:', response.headers);
            return response.text();
        })
        .then(html => {
            console.log('Test response HTML length:', html.length);
            console.log('Test response preview:', html.substring(0, 500));
            
            // Check if the response contains the survey content
            if (html.includes('Survey Response Details')) {
                console.log('✅ Survey content found in response');
            } else {
                console.log('❌ Survey content NOT found in response');
            }
            
            alert(`Test completed! Check console for details.\nResponse length: ${html.length} characters`);
        })
        .catch(error => {
            console.error('Test error:', error);
            alert(`Test failed: ${error.message}`);
        });
}

function updateStatistics() {
    // Reload the page to get updated statistics
    // This is a simple approach - in a more complex app, you'd fetch just the stats
    setTimeout(() => {
        window.location.reload();
    }, 1000);
}

function closeModal() {
    const modal = document.querySelector('.fixed.inset-0');
    if (modal) {
        modal.remove();
    }
}

// Close modal when clicking outside
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('fixed') && e.target.classList.contains('inset-0')) {
        closeModal();
    }
});
</script>

<!-- Delete Survey Confirmation Modal -->
<div id="delete-survey-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4">
            <div class="p-8">
                <!-- Warning Icon -->
                <div class="flex justify-center mb-6">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm">
                            <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Title and Message -->
                <div class="text-center mb-8">
                    <h3 class="text-xl font-display font-bold text-gray-900 mb-3">Delete Survey Response</h3>
                    <p class="text-gray-600 font-body leading-relaxed">
                        Are you sure you want to delete this survey response? This action cannot be undone and will permanently remove:
                    </p>
                    <ul class="text-sm text-gray-500 mt-3 space-y-1">
                        <li>• Survey response data</li>
                        <li>• All submitted answers</li>
                        <li>• Related information</li>
                    </ul>
                    <p class="text-sm text-green-600 mt-3 font-medium">
                        <i class="fas fa-info-circle mr-1"></i>The user account will be preserved.
                    </p>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex space-x-3">
                    <button onclick="closeDeleteSurveyModal()" 
                            class="flex-1 bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition-colors font-display font-semibold">
                        Cancel
                    </button>
                    <button onclick="confirmDeleteSurvey()" 
                            class="flex-1 bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition-colors font-display font-semibold">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endpush