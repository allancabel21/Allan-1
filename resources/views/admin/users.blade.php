@extends('layouts.dashboard')

@section('page-title', 'User Management')
@section('page-description', 'Manage user accounts and verification status')

@section('content')
<div class="space-y-6">
    <!-- Users Table -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-900">User Management</h2>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.users.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow-sm transition-colors">
                        <i class="fas fa-user-plus mr-2"></i>
                        Create User
                    </a>
                    <input type="text" placeholder="Search users..." class="px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <select class="px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Users</option>
                        <option value="admin">Admins</option>
                        <option value="staff">Staff</option>
                        <option value="graduate">Graduates</option>
                    </select>
                </div>
            </div>

            @if($users->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 bg-yellow-400 rounded-full flex items-center justify-center">
                                                    @if($user->graduate && $user->graduate->profile_picture)
                                                        <img src="{{ asset('storage/' . $user->graduate->profile_picture) }}" alt="Profile Picture" class="h-10 w-10 rounded-full object-cover">
                                                    @else
                                                        <i class="fas fa-user text-blue-900"></i>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            @if($user->role === 'admin') bg-red-100 text-red-800
                                            @elseif($user->role === 'staff') bg-blue-100 text-blue-800
                                            @else bg-green-100 text-green-800
                                            @endif">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($user->graduate)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                @if($user->graduate->verification_status === 'verified') bg-green-100 text-green-800
                                                @elseif($user->graduate->verification_status === 'pending') bg-yellow-100 text-yellow-800
                                                @else bg-red-100 text-red-800
                                                @endif">
                                                {{ ucfirst($user->graduate->verification_status ?? 'unverified') }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                No Profile
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $user->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            @if($user->graduate && $user->graduate->verification_status === 'pending')
                                                <button onclick="verifyUser({{ $user->id }}, 'verified')" class="text-green-600 hover:text-green-900">
                                                    <i class="fas fa-check"></i> Verify
                                                </button>
                                                <button onclick="verifyUser({{ $user->id }}, 'rejected')" class="text-red-600 hover:text-red-900">
                                                    <i class="fas fa-times"></i> Reject
                                                </button>
                                            @elseif($user->graduate && $user->graduate->verification_status === 'verified')
                                                <button onclick="verifyUser({{ $user->id }}, 'rejected')" class="text-red-600 hover:text-red-900">
                                                    <i class="fas fa-times"></i> Revoke
                                                </button>
                                            @elseif($user->graduate && $user->graduate->verification_status === 'rejected')
                                                <button onclick="verifyUser({{ $user->id }}, 'verified')" class="text-green-600 hover:text-green-900">
                                                    <i class="fas fa-check"></i> Verify
                                                </button>
                                            @endif
                                            <button onclick="viewUser({{ $user->id }})" class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                            @if($user->id !== auth()->id())
                                                <button onclick="deleteUser({{ $user->id }}, '{{ $user->name }}')" class="text-red-600 hover:text-red-900">
                                                    <i class="fas fa-trash"></i> Delete
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
                <div class="mt-6">
                    {{ $users->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-gray-400 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No Users Found</h3>
                    <p class="text-gray-600">No users match your current search criteria.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- User Details Modal -->
<div id="user-details-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">User Details</h3>
                    <div class="flex space-x-2">
                        <button onclick="refreshUserDetails()" class="text-blue-600 hover:text-blue-800" title="Refresh">
                            <i class="fas fa-sync-alt text-lg"></i>
                        </button>
                        <button onclick="closeUserDetailsModal()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                </div>
                <div id="user-details-content">
                    <!-- User details will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Verification Modal -->
<div id="verification-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Verify User</h3>
                <form id="verification-form">
                    <input type="hidden" id="user-id" name="user_id">
                    <input type="hidden" id="verification-status" name="verification_status">
                    
                    <div class="mb-4">
                        <label for="verification_notes" class="block text-sm font-medium text-gray-700 mb-2">
                            Verification Notes (Optional):
                        </label>
                        <textarea id="verification_notes" name="verification_notes" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Add any notes about the verification decision..."></textarea>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeVerificationModal()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Confirm
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete User Confirmation Modal -->
<div id="delete-user-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50">
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
                    <h3 class="text-xl font-display font-bold text-gray-900 mb-3">Delete User</h3>
                    <p class="text-gray-600 font-body leading-relaxed">
                        Are you sure you want to delete this user? This action cannot be undone and will permanently remove:
                    </p>
                    <ul class="text-sm text-gray-500 mt-3 space-y-1">
                        <li>• User account</li>
                        <li>• Associated graduate record (if any)</li>
                        <li>• All related data</li>
                    </ul>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex space-x-3">
                    <button onclick="closeDeleteUserModal()" 
                            class="flex-1 bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition-colors font-display font-semibold">
                        Cancel
                    </button>
                    <button onclick="confirmDeleteUser()" 
                            class="flex-1 bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition-colors font-display font-semibold">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let currentUserId = null;

function viewUser(userId) {
    currentUserId = userId;
    loadUserDetails(userId);
}

function loadUserDetails(userId) {
    // Show loading state
    document.getElementById('user-details-content').innerHTML = `
        <div class="flex items-center justify-center py-8">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
            <span class="ml-2 text-gray-600">Loading user details...</span>
        </div>
    `;
    
    // Show modal
    document.getElementById('user-details-modal').classList.remove('hidden');
    
    // Fetch user details
    fetch(`/admin/users/${userId}/details`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('user-details-content').innerHTML = data.html;
        } else {
            document.getElementById('user-details-content').innerHTML = `
                <div class="text-center py-8">
                    <i class="fas fa-exclamation-triangle text-red-500 text-3xl mb-4"></i>
                    <p class="text-red-600">Error loading user details: ${data.message || 'Unknown error'}</p>
                </div>
            `;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('user-details-content').innerHTML = `
            <div class="text-center py-8">
                <i class="fas fa-exclamation-triangle text-red-500 text-3xl mb-4"></i>
                <p class="text-red-600">Error loading user details. Please try again.</p>
            </div>
        `;
    });
}

function refreshUserDetails() {
    if (currentUserId) {
        loadUserDetails(currentUserId);
    }
}

function closeUserDetailsModal() {
    document.getElementById('user-details-modal').classList.add('hidden');
}

function verifyUser(userId, status) {
    document.getElementById('user-id').value = userId;
    document.getElementById('verification-status').value = status;
    document.getElementById('verification-modal').classList.remove('hidden');
}

function closeVerificationModal() {
    document.getElementById('verification-modal').classList.add('hidden');
    document.getElementById('verification-form').reset();
}

let userToDelete = null;

function deleteUser(userId, userName) {
    userToDelete = { id: userId, name: userName };
    document.getElementById('delete-user-modal').classList.remove('hidden');
}

function closeDeleteUserModal() {
    userToDelete = null;
    document.getElementById('delete-user-modal').classList.add('hidden');
}

function confirmDeleteUser() {
    if (userToDelete) {
        // Create a form to submit DELETE request
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/users/${userToDelete.id}`;
        
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

document.getElementById('verification-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const userId = document.getElementById('user-id').value;
    const formData = new FormData(this);
    const submitButton = this.querySelector('button[type="submit"]');
    const originalText = submitButton.textContent;
    
    submitButton.textContent = 'Processing...';
    submitButton.disabled = true;
    
    fetch(`/admin/users/${userId}/verify`, {
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
            alert('User verification status updated successfully!');
            closeVerificationModal();
            window.location.reload();
        } else {
            alert('Error: ' + (data.message || 'Failed to update verification status'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error updating verification status. Please try again.');
    })
    .finally(() => {
        submitButton.textContent = originalText;
        submitButton.disabled = false;
    });
});
</script>
@endsection
