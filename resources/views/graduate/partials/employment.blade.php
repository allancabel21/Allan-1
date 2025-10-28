<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">Employment Information</h2>

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

        <form action="{{ route('graduate.employment.update') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="is_employed" class="flex items-center">
                    <input type="checkbox" name="is_employed" id="is_employed" value="1" {{ old('is_employed', $graduate->is_employed ?? false) ? 'checked' : '' }}
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <span class="ml-3 text-sm font-medium text-gray-700">I am currently employed</span>
                </label>
            </div>

            <div id="employment-details" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6" style="{{ old('is_employed', $graduate->is_employed ?? false) ? '' : 'display: none;' }}">
                <div>
                    <label for="current_position" class="block text-sm font-medium text-gray-700 mb-2">Current Position</label>
                    <input type="text" name="current_position" id="current_position" value="{{ old('current_position', $graduate->current_position ?? '') }}"
                           class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm text-gray-900 placeholder-gray-500">
                </div>
                <div>
                    <label for="current_company" class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                    <input type="text" name="current_company" id="current_company" value="{{ old('current_company', $graduate->current_company ?? '') }}"
                           class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm text-gray-900 placeholder-gray-500">
                </div>
                <div>
                    <label for="employment_start_date" class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                    <input type="date" name="employment_start_date" id="employment_start_date" value="{{ old('employment_start_date', $graduate->employment_start_date ? $graduate->employment_start_date->format('Y-m-d') : '') }}"
                           class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm text-gray-900">
                </div>
                <div>
                    <label for="salary" class="block text-sm font-medium text-gray-700 mb-2">Salary (Optional)</label>
                    <input type="number" name="salary" id="salary" value="{{ old('salary', $graduate->salary ?? '') }}"
                           class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm text-gray-900 placeholder-gray-500">
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    Update Employment Status
                </button>
            </div>
        </form>

        @if($employmentRecords->count() > 0)
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Employment History</h3>
                <div class="space-y-4">
                    @foreach($employmentRecords as $record)
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
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
    </div>
</div>

<script>
    document.getElementById('is_employed').addEventListener('change', function() {
        const employmentDetails = document.getElementById('employment-details');
        if (this.checked) {
            employmentDetails.style.display = 'grid';
        } else {
            employmentDetails.style.display = 'none';
        }
    });
</script>
