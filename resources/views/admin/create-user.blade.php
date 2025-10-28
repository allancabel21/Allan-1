@extends('layouts.dashboard')

@section('title', 'Create User Account')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-900">Create New User Account</h1>
        <p class="text-sm text-gray-600 mt-1">Create a new user account and optionally send credentials via email</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
            @csrf
            
            <!-- Basic Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user mr-2"></i>Full Name *
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                           placeholder="Enter full name">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2"></i>Email Address *
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror"
                           placeholder="Enter email address">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user-tag mr-2"></i>User Role *
                    </label>
                    <select id="role" name="role" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('role') border-red-500 @enderror">
                        <option value="">Select Role</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                        <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                        <option value="graduate" {{ old('role') == 'graduate' ? 'selected' : '' }}>Graduate</option>
                    </select>
                    @error('role')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2"></i>Password
                    </label>
                    <input type="password" id="password" name="password" value="{{ old('password') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror"
                           placeholder="Leave blank for default password">
                    <p class="mt-1 text-sm text-gray-500">Default password: "password"</p>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Graduate Information (shown when role is graduate) -->
            <div id="graduate-info" class="space-y-6" style="display: none;">
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Graduate Information</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="student_id" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-id-card mr-2"></i>Student ID *
                            </label>
                            <input type="text" id="student_id" name="student_id" value="{{ old('student_id') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('student_id') border-red-500 @enderror"
                                   placeholder="Enter student ID">
                            @error('student_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="program" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-graduation-cap mr-2"></i>Program *
                            </label>
                            <input type="text" id="program" name="program" value="{{ old('program') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('program') border-red-500 @enderror"
                                   placeholder="Enter program of study">
                            @error('program')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label for="batch_year" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-calendar mr-2"></i>Batch Year *
                            </label>
                            <input type="number" id="batch_year" name="batch_year" value="{{ old('batch_year') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('batch_year') border-red-500 @enderror"
                                   placeholder="Enter batch year" min="2000" max="{{ date('Y') + 10 }}">
                            @error('batch_year')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="graduation_date" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-calendar-check mr-2"></i>Graduation Date
                            </label>
                            <input type="date" id="graduation_date" name="graduation_date" value="{{ old('graduation_date') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('graduation_date') border-red-500 @enderror">
                            @error('graduation_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Email Options -->
            <div class="border-t border-gray-200 pt-6">
                <div class="flex items-center">
                    <input type="checkbox" id="send_email" name="send_email" value="1" {{ old('send_email') ? 'checked' : '' }}
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="send_email" class="ml-2 block text-sm text-gray-700">
                        <i class="fas fa-envelope mr-1"></i>
                        Send account credentials via email
                    </label>
                </div>
                <p class="mt-1 text-sm text-gray-500">If checked, the user will receive their login credentials via email</p>
                <div class="mt-2 p-3 bg-yellow-50 border border-yellow-200 rounded-md">
                    <p class="text-sm text-yellow-800">
                        <i class="fas fa-info-circle mr-1"></i>
                        <strong>Note:</strong> If email fails to send, the credentials will be displayed on screen for you to share manually.
                    </p>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-4 pt-6">
                <a href="{{ route('admin.users') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-user-plus mr-2"></i>
                    Create User Account
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const roleSelect = document.getElementById('role');
    const graduateInfo = document.getElementById('graduate-info');
    const studentIdField = document.getElementById('student_id');
    const programField = document.getElementById('program');
    const batchYearField = document.getElementById('batch_year');

    function toggleGraduateInfo() {
        if (roleSelect.value === 'graduate') {
            graduateInfo.style.display = 'block';
            studentIdField.required = true;
            programField.required = true;
            batchYearField.required = true;
        } else {
            graduateInfo.style.display = 'none';
            studentIdField.required = false;
            programField.required = false;
            batchYearField.required = false;
        }
    }

    roleSelect.addEventListener('change', toggleGraduateInfo);
    
    // Initialize on page load
    toggleGraduateInfo();
});
</script>
@endsection
