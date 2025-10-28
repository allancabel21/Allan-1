@extends('layouts.dashboard')

@section('title', 'Alumni Memberships Management')

@section('content')
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-display font-bold text-gradient mb-3">Alumni Memberships Management</h1>
        <p class="text-lg text-gray-600 font-body">Manage alumni membership applications and payments with real-time updates</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
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
                    <p class="text-sm text-gray-600 font-medium">Pending</p>
                </div>
            </div>
        </div>

        <div class="card-enhanced p-6">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-xl shadow-lg">
                    <div class="text-white text-2xl font-bold">💳</div>
                </div>
                <div class="ml-4">
                    <h3 class="text-2xl font-display font-bold text-gray-900">{{ $stats['paid'] }}</h3>
                    <p class="text-sm text-gray-600 font-medium">Paid</p>
                </div>
            </div>
        </div>

        <div class="card-enhanced p-6">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl shadow-lg">
                    <div class="text-white text-2xl font-bold">✅</div>
                </div>
                <div class="ml-4">
                    <h3 class="text-2xl font-display font-bold text-gray-900">{{ $stats['verified'] }}</h3>
                    <p class="text-sm text-gray-600 font-medium">Verified</p>
                </div>
            </div>
        </div>

        <div class="card-enhanced p-6">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-br from-gray-500 to-gray-600 rounded-xl shadow-lg">
                    <div class="text-white text-2xl font-bold">❌</div>
                </div>
                <div class="ml-4">
                    <h3 class="text-2xl font-display font-bold text-gray-900">{{ $stats['expired'] }}</h3>
                    <p class="text-sm text-gray-600 font-medium">Expired</p>
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
                    <option value="paid">Paid</option>
                    <option value="verified">Verified</option>
                    <option value="expired">Expired</option>
                    <option value="cancelled">Cancelled</option>
                </select>
                
                <select id="typeFilter" class="input-enhanced text-sm">
                    <option value="">All Types</option>
                    <option value="basic">Basic</option>
                    <option value="premium">Premium</option>
                    <option value="lifetime">Lifetime</option>
                </select>
                
                <select id="paymentFilter" class="input-enhanced text-sm">
                    <option value="">All Payment Methods</option>
                    <option value="gcash">GCash</option>
                    <option value="bank_transfer">Bank Transfer</option>
                    <option value="cash_on_delivery">Cash on Delivery</option>
                    <option value="cash">Cash</option>
                    <option value="other">Other</option>
                </select>

                <input type="text" id="searchInput" placeholder="Search by name..." 
                       class="input-enhanced text-sm min-w-[200px]">
            </div>
        </div>
    </div>

    <!-- Memberships Table -->
    <div class="table-enhanced">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="text-left">Member</th>
                        <th class="text-left">Type</th>
                        <th class="text-left">Amount</th>
                        <th class="text-left">Payment</th>
                        <th class="text-left">Status</th>
                        <th class="text-left">Period</th>
                        <th class="text-left">Actions</th>
                    </tr>
                </thead>
                <tbody id="membershipsTableBody">
                    @forelse($memberships as $membership)
                    <tr class="membership-row transition-colors duration-200" data-status="{{ $membership->status }}" data-type="{{ $membership->membership_type }}" data-payment-method="{{ $membership->payment_method }}">
                        <td class="whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12">
                                    <div class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg">
                                        <i class="fas fa-user text-white text-lg"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-display font-semibold text-gray-900">
                                        {{ $membership->graduate->first_name }} {{ $membership->graduate->last_name }}
                                    </div>
                                    <div class="text-sm text-gray-500 font-body">{{ $membership->graduate->user->email ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="whitespace-nowrap">
                            <span class="badge-enhanced
                                @if($membership->membership_type === 'basic') bg-gray-100 text-gray-800
                                @elseif($membership->membership_type === 'premium') bg-blue-100 text-blue-800
                                @else bg-purple-100 text-purple-800 @endif">
                                {{ $membership->membership_type_label }}
                            </span>
                        </td>
                        <td class="whitespace-nowrap">
                            <span class="text-lg font-display font-bold text-gray-900">{{ $membership->formatted_amount }}</span>
                        </td>
                        <td class="whitespace-nowrap">
                            <div class="flex items-center">
                                @if($membership->payment_method === 'gcash')
                                    <i class="fas fa-mobile-alt text-green-600 mr-2"></i>
                                @elseif($membership->payment_method === 'bank_transfer')
                                    <i class="fas fa-university text-blue-600 mr-2"></i>
                                @elseif($membership->payment_method === 'cash_on_delivery')
                                    <i class="fas fa-truck text-orange-600 mr-2"></i>
                                @else
                                    <i class="fas fa-money-bill text-gray-600 mr-2"></i>
                                @endif
                                <span>{{ $membership->payment_method_label }}</span>
                            </div>
                            @if($membership->payment_reference)
                            <div class="text-xs text-gray-400 mt-1">
                                @if($membership->payment_method === 'gcash')
                                    <strong>Ref:</strong> {{ $membership->payment_reference }}
                                @elseif($membership->payment_method === 'bank_transfer')
                                    <strong>Txn ID:</strong> {{ $membership->payment_reference }}
                                @elseif($membership->payment_method === 'cash_on_delivery')
                                    <strong>Delivery:</strong> {{ $membership->payment_reference ?: 'Standard Address' }}
                                @else
                                    {{ $membership->payment_reference }}
                                @endif
                            </div>
                            @endif
                            @if($membership->payment_date)
                            <div class="text-xs text-gray-400">
                                <i class="fas fa-clock mr-1"></i>{{ $membership->payment_date->format('M d, Y g:i A') }}
                            </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($membership->status === 'verified') bg-green-100 text-green-800
                                @elseif($membership->status === 'paid') bg-blue-100 text-blue-800
                                @elseif($membership->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($membership->status === 'expired') bg-gray-100 text-gray-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ $membership->status_label }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div>{{ $membership->formatted_membership_period }}</div>
                            @if($membership->is_active)
                            <div class="text-xs text-green-600">{{ $membership->days_remaining }} days left</div>
                            @elseif($membership->is_expired)
                            <div class="text-xs text-red-600">Expired</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <button onclick="viewMembershipDetails({{ $membership->id }})" class="text-blue-600 hover:text-blue-900" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                
                                @if($membership->payment_proof)
                                <button onclick="viewPaymentProof('{{ $membership->payment_proof }}')" class="text-green-600 hover:text-green-900" title="View Payment Proof">
                                    <i class="fas fa-image"></i>
                                </button>
                                @endif
                                
                                @if($membership->status === 'pending' && $membership->payment_proof)
                                    <button onclick="confirmPayment({{ $membership->id }})" class="text-blue-600 hover:text-blue-900" title="Confirm Payment">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                    <button onclick="rejectMembership({{ $membership->id }})" class="text-red-600 hover:text-red-900" title="Reject">
                                        <i class="fas fa-times"></i>
                                    </button>
                                @endif
                                
                                @if($membership->status === 'paid')
                                    @if($membership->payment_method === 'cash_on_delivery')
                                        <button onclick="markAsDelivered({{ $membership->id }})" class="text-orange-600 hover:text-orange-900" title="Mark as Delivered">
                                            <i class="fas fa-truck"></i>
                                        </button>
                                    @else
                                        <button onclick="verifyMembership({{ $membership->id }})" class="text-green-600 hover:text-green-900" title="Verify">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    @endif
                                    <button onclick="rejectMembership({{ $membership->id }})" class="text-red-600 hover:text-red-900" title="Reject">
                                        <i class="fas fa-times"></i>
                                    </button>
                                @endif
                                
                                <button onclick="deleteMembership({{ $membership->id }})" class="text-red-600 hover:text-red-900" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="text-gray-500">
                                <i class="fas fa-id-card text-4xl mb-4"></i>
                                <h3 class="text-lg font-medium mb-2">No membership applications found</h3>
                                <p>No alumni have applied for membership yet.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($memberships->hasPages())
        <div class="px-6 py-3 border-t border-gray-200">
            {{ $memberships->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Payment Proof Modal -->
<div id="paymentProofModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Payment Proof</h3>
                    <button onclick="closePaymentProofModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="text-center">
                    <img id="paymentProofImage" src="" alt="Payment Proof" class="max-w-full h-auto rounded-lg">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Verify Membership Modal -->
<div id="verifyModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                        <i class="fas fa-check text-green-600"></i>
                    </div>
                </div>
                <div class="text-center">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Verify Membership</h3>
                    <p class="text-sm text-gray-500 mb-6">Are you sure you want to verify this membership application?</p>
                    <form id="verifyForm">
                        <div class="mb-4">
                            <label for="verifyNotes" class="block text-sm font-medium text-gray-700 mb-2">Notes (Optional)</label>
                            <textarea id="verifyNotes" name="notes" rows="3" 
                                      class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                      placeholder="Add any notes about this verification..."></textarea>
                        </div>
                        <div class="flex space-x-3">
                            <button type="button" onclick="closeVerifyModal()" 
                                    class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition-colors">
                                Cancel
                            </button>
                            <button type="submit" 
                                    class="flex-1 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                                Verify
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reject Membership Modal -->
<div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                        <i class="fas fa-times text-red-600"></i>
                    </div>
                </div>
                <div class="text-center">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Reject Membership</h3>
                    <p class="text-sm text-gray-500 mb-6">Please provide a reason for rejecting this membership application.</p>
                    <form id="rejectForm">
                        <div class="mb-4">
                            <label for="rejectNotes" class="block text-sm font-medium text-gray-700 mb-2">Reason for Rejection *</label>
                            <textarea id="rejectNotes" name="notes" rows="3" required
                                      class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                      placeholder="Please explain why this membership is being rejected..."></textarea>
                        </div>
                        <div class="flex space-x-3">
                            <button type="button" onclick="closeRejectModal()" 
                                    class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition-colors">
                                Cancel
                            </button>
                            <button type="submit" 
                                    class="flex-1 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">
                                Reject
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                </div>
                <div class="text-center">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Delete Membership</h3>
                    <p class="text-sm text-gray-500 mb-6">Are you sure you want to delete this membership application? This action cannot be undone.</p>
                    <div class="flex space-x-3">
                        <button onclick="closeDeleteModal()" class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition-colors">
                            Cancel
                        </button>
                        <button onclick="confirmDelete()" class="flex-1 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let membershipToDelete = null;
let membershipToVerify = null;
let membershipToReject = null;

// Real-time filtering
document.getElementById('statusFilter').addEventListener('change', filterMemberships);
document.getElementById('typeFilter').addEventListener('change', filterMemberships);
document.getElementById('paymentFilter').addEventListener('change', filterMemberships);
document.getElementById('searchInput').addEventListener('input', filterMemberships);

function filterMemberships() {
    const statusFilter = document.getElementById('statusFilter').value;
    const typeFilter = document.getElementById('typeFilter').value;
    const paymentFilter = document.getElementById('paymentFilter').value;
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    
    const rows = document.querySelectorAll('.membership-row');
    
    rows.forEach(row => {
        const status = row.getAttribute('data-status');
        const type = row.getAttribute('data-type');
        const paymentMethod = row.getAttribute('data-payment-method');
        const name = row.querySelector('.text-sm.font-medium').textContent.toLowerCase();
        const email = row.querySelector('.text-sm.text-gray-500').textContent.toLowerCase();
        
        const statusMatch = !statusFilter || status === statusFilter;
        const typeMatch = !typeFilter || type === typeFilter;
        const paymentMatch = !paymentFilter || paymentMethod === paymentFilter;
        const searchMatch = !searchInput || name.includes(searchInput) || email.includes(searchInput);
        
        if (statusMatch && typeMatch && paymentMatch && searchMatch) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function viewPaymentProof(imagePath) {
    document.getElementById('paymentProofImage').src = '/storage/' + imagePath;
    document.getElementById('paymentProofModal').classList.remove('hidden');
}

function closePaymentProofModal() {
    document.getElementById('paymentProofModal').classList.add('hidden');
}

function confirmPayment(membershipId) {
    if (confirm('Confirm that payment has been received and mark as paid?')) {
        fetch(`/admin/alumni-memberships/${membershipId}/confirm-payment`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload();
            } else {
                alert(data.message || 'Error confirming payment');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error confirming payment');
        });
    }
}

function verifyMembership(membershipId) {
    membershipToVerify = membershipId;
    document.getElementById('verifyModal').classList.remove('hidden');
}

function closeVerifyModal() {
    membershipToVerify = null;
    document.getElementById('verifyModal').classList.add('hidden');
}

function rejectMembership(membershipId) {
    membershipToReject = membershipId;
    document.getElementById('rejectModal').classList.remove('hidden');
}

function closeRejectModal() {
    membershipToReject = null;
    document.getElementById('rejectModal').classList.add('hidden');
}

function markAsDelivered(membershipId) {
    if (confirm('Mark this Cash on Delivery membership as delivered and verified?')) {
        fetch(`/admin/alumni-memberships/${membershipId}/deliver`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification(data.message, 'success');
                location.reload();
            } else {
                showNotification('Failed to mark as delivered', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Failed to mark as delivered', 'error');
        });
    }
}

function deleteMembership(membershipId) {
    membershipToDelete = membershipId;
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    membershipToDelete = null;
    document.getElementById('deleteModal').classList.add('hidden');
}

// Form submissions
document.getElementById('verifyForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch(`/admin/alumni-memberships/${membershipToVerify}/verify`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification(data.message, 'success');
            location.reload();
        } else {
            showNotification('Failed to verify membership', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Failed to verify membership', 'error');
    });
});

document.getElementById('rejectForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch(`/admin/alumni-memberships/${membershipToReject}/reject`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification(data.message, 'success');
            location.reload();
        } else {
            showNotification('Failed to reject membership', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Failed to reject membership', 'error');
    });
});

function confirmDelete() {
    if (membershipToDelete) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/alumni-memberships/${membershipToDelete}`;
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        
        const tokenField = document.createElement('input');
        tokenField.type = 'hidden';
        tokenField.name = '_token';
        tokenField.value = '{{ csrf_token() }}';
        
        form.appendChild(methodField);
        form.appendChild(tokenField);
        document.body.appendChild(form);
        form.submit();
    }
}

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${
        type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
    }`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Auto-refresh every 30 seconds for real-time updates
setInterval(() => {
    const statusFilter = document.getElementById('statusFilter').value;
    const typeFilter = document.getElementById('typeFilter').value;
    const paymentFilter = document.getElementById('paymentFilter').value;
    const searchInput = document.getElementById('searchInput').value;
    
    if (!statusFilter && !typeFilter && !paymentFilter && !searchInput) {
        location.reload();
    }
}, 30000);

// View comprehensive membership details
function viewMembershipDetails(membershipId) {
    // Fetch membership details via AJAX
    fetch(`/admin/alumni-memberships/${membershipId}/details`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showMembershipDetailsModal(data.membership);
            } else {
                alert('Error loading membership details');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error loading membership details');
        });
}

function showMembershipDetailsModal(membership) {
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 bg-black/50 backdrop-blur-sm z-50';
    modal.innerHTML = `
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="card-enhanced max-w-4xl w-full max-h-[90vh] overflow-y-auto">
                <div class="p-8">
                    <div class="flex justify-between items-center mb-8">
                        <h3 class="text-2xl font-display font-bold text-gray-900">Membership Details</h3>
                        <button onclick="this.closest('.fixed').remove()" class="text-gray-400 hover:text-gray-600 transition-colors p-2 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Personal Information -->
                        <div class="card-enhanced p-6">
                            <h4 class="text-xl font-display font-bold text-gray-900 mb-6 flex items-center">
                                <div class="p-2 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg mr-3">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                Personal Information
                            </h4>
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Full Name</label>
                                    <p class="text-gray-900 font-semibold">${membership.full_name || 'N/A'}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Student/Alumni ID</label>
                                    <p class="text-gray-900">${membership.student_id || 'N/A'}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Course/Degree</label>
                                    <p class="text-gray-900">${membership.course_degree || 'N/A'}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Batch/Year Graduated</label>
                                    <p class="text-gray-900">${membership.batch_year || 'N/A'}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Date of Birth</label>
                                    <p class="text-gray-900">${membership.date_of_birth || 'N/A'}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Gender</label>
                                    <p class="text-gray-900">${membership.gender ? membership.gender.charAt(0).toUpperCase() + membership.gender.slice(1) : 'N/A'}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Contact Number</label>
                                    <p class="text-gray-900">${membership.contact_number || 'N/A'}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Email Address</label>
                                    <p class="text-gray-900">${membership.email_address || 'N/A'}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Address</label>
                                    <p class="text-gray-900">${membership.address || 'N/A'}</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Professional Information -->
                        <div class="card-enhanced p-6">
                            <h4 class="text-xl font-display font-bold text-gray-900 mb-6 flex items-center">
                                <div class="p-2 bg-gradient-to-br from-green-500 to-green-600 rounded-lg mr-3">
                                    <i class="fas fa-briefcase text-white"></i>
                                </div>
                                Professional Information
                            </h4>
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Current Occupation</label>
                                    <p class="text-gray-900 font-semibold">${membership.current_occupation || 'N/A'}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Company/Organization</label>
                                    <p class="text-gray-900">${membership.company_organization || 'N/A'}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Position/Job Title</label>
                                    <p class="text-gray-900">${membership.position_job_title || 'N/A'}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Industry</label>
                                    <p class="text-gray-900">${membership.industry || 'N/A'}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Work Address</label>
                                    <p class="text-gray-900">${membership.work_address || 'N/A'}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Years of Experience</label>
                                    <p class="text-gray-900">${membership.years_experience || 'N/A'}</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Additional Details -->
                        <div class="card-enhanced p-6 lg:col-span-2">
                            <h4 class="text-xl font-display font-bold text-gray-900 mb-6 flex items-center">
                                <div class="p-2 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg mr-3">
                                    <i class="fas fa-star text-white"></i>
                                </div>
                                Additional Details
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Skills and Expertise</label>
                                    <p class="text-gray-900 mt-1">${membership.skills_expertise || 'N/A'}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Achievements or Awards</label>
                                    <p class="text-gray-900 mt-1">${membership.achievements_awards || 'N/A'}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Willingness to Volunteer/Mentor</label>
                                    <p class="text-gray-900 mt-1">${membership.volunteer_mentor ? membership.volunteer_mentor.charAt(0).toUpperCase() + membership.volunteer_mentor.slice(1) : 'N/A'}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Preferred Activities</label>
                                    <p class="text-gray-900 mt-1">${membership.preferred_activities && membership.preferred_activities.length > 0 ? membership.preferred_activities.join(', ') : 'N/A'}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="text-sm font-medium text-gray-500">Why Join Alumni Association</label>
                                    <p class="text-gray-900 mt-1">${membership.membership_reason || 'N/A'}</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Membership Information -->
                        <div class="card-enhanced p-6 lg:col-span-2">
                            <h4 class="text-xl font-display font-bold text-gray-900 mb-6 flex items-center">
                                <div class="p-2 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg mr-3">
                                    <i class="fas fa-id-card text-white"></i>
                                </div>
                                Membership Information
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Membership Type</label>
                                    <p class="text-gray-900 font-semibold">${membership.membership_type_label}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Amount</label>
                                    <p class="text-gray-900 font-semibold">${membership.formatted_amount}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Payment Method</label>
                                    <p class="text-gray-900">${membership.payment_method_label}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Status</label>
                                    <span class="badge-enhanced ${getStatusBadgeClass(membership.status)}">${membership.status_label}</span>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Membership Period</label>
                                    <p class="text-gray-900">${membership.formatted_membership_period}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Payment Reference</label>
                                    <p class="text-gray-900">${membership.payment_reference || 'N/A'}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
}

function getStatusBadgeClass(status) {
    switch(status) {
        case 'verified': return 'bg-green-100 text-green-800';
        case 'paid': return 'bg-blue-100 text-blue-800';
        case 'pending': return 'bg-yellow-100 text-yellow-800';
        case 'expired': return 'bg-gray-100 text-gray-800';
        default: return 'bg-red-100 text-red-800';
    }
}
</script>
@endsection
