<div class="bg-white rounded-lg shadow-md">
    <div class="p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Resume Management</h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Whoops!</strong>
                <span class="block sm:inline">There were some problems with your input.</span>
                <ul class="mt-3 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Generate New Resume -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Generate New Resume</h3>
            <form action="{{ route('graduate.resume.generate') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Resume Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title', '') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                    </div>
                    <div>
                        <label for="template_type" class="block text-sm font-medium text-gray-700">Template Type</label>
                        <select name="template_type" id="template_type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                            <option value="">Select Template</option>
                            <option value="standard" {{ old('template_type') == 'standard' ? 'selected' : '' }}>Standard</option>
                            <option value="modern" {{ old('template_type') == 'modern' ? 'selected' : '' }}>Modern</option>
                            <option value="creative" {{ old('template_type') == 'creative' ? 'selected' : '' }}>Creative</option>
                            <option value="compact" {{ old('template_type') == 'compact' ? 'selected' : '' }}>Compact (1-Page Print)</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>
                        Generate Resume
                    </button>
                </div>
            </form>
        </div>

        <!-- Existing Resumes -->
        @if($resumes->count() > 0)
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Your Resumes</h3>
                <div class="space-y-4">
                    @foreach($resumes as $resume)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-semibold text-gray-900">{{ $resume->title }}</h4>
                                    <p class="text-sm text-gray-600">Template: {{ ucfirst($resume->template_type) }}</p>
                                    <p class="text-sm text-gray-500">Created: {{ $resume->created_at->format('M d, Y') }}</p>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('graduate.resume.view', $resume->id) }}" target="_blank" class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition-colors">
                                        <i class="fas fa-eye mr-1"></i>
                                        View
                                    </a>
                                    <button onclick="downloadResume({{ $resume->id }})" class="inline-flex items-center px-3 py-1 bg-green-600 text-white text-sm rounded hover:bg-green-700 transition-colors">
                                        <i class="fas fa-download mr-1"></i>
                                        Download
                                    </button>
                                    <button onclick="deleteResume({{ $resume->id }}, '{{ $resume->title }}')" class="inline-flex items-center px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition-colors">
                                        <i class="fas fa-trash mr-1"></i>
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="text-center py-8">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-file-alt text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No Resumes Yet</h3>
                <p class="text-gray-600 mb-4">Generate your first resume to get started with your job search.</p>
            </div>
        @endif
    </div>
</div>

<script>
function downloadResume(resumeId) {
    // Open the resume in a new window for printing/downloading
    const url = `/graduate/resume/${resumeId}/view`;
    window.open(url, '_blank');
}

function deleteResume(resumeId, resumeTitle) {
    if (confirm(`Are you sure you want to delete the resume "${resumeTitle}"?\n\nThis action cannot be undone.`)) {
        // Create a form to submit DELETE request
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/graduate/resume/${resumeId}`;
        
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
        form.submit();
    }
}
</script>
