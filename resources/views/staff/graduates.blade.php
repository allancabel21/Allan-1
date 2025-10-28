@extends('layouts.dashboard')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-900">Graduate Management</h1>
        <p class="text-sm text-gray-600 mt-2">View and manage all graduates in the system</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Graduates</p>
                    <p class="text-xl font-semibold text-gray-900">{{ $graduates->total() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Verified</p>
                    <p class="text-xl font-semibold text-gray-900">{{ $graduates->where('verification_status', 'verified')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Pending</p>
                    <p class="text-xl font-semibold text-gray-900">{{ $graduates->where('verification_status', 'pending')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <i class="fas fa-briefcase text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Employed</p>
                    <p class="text-xl font-semibold text-gray-900">{{ $graduates->where('is_employed', true)->count() }}</p>
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
                    <option value="verified">Verified</option>
                    <option value="pending">Pending</option>
                    <option value="not_verified">Not Verified</option>
                </select>
            </div>
            
            <div class="flex items-center space-x-2">
                <label for="employment-filter" class="text-sm font-medium text-gray-700">Employment:</label>
                <select id="employment-filter" class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All</option>
                    <option value="employed">Employed</option>
                    <option value="unemployed">Unemployed</option>
                </select>
            </div>
            
            <div class="flex items-center space-x-2">
                <label for="search" class="text-sm font-medium text-gray-700">Search:</label>
                <input type="text" id="search" placeholder="Search by name, email, student ID..." 
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

    <!-- Graduates Table -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">All Graduates</h2>
        </div>

        @if($graduates->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Graduate</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employment</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Verification</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($graduates as $graduate)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    @if($graduate->profile_picture)
                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $graduate->profile_picture) }}" alt="">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                            <i class="fas fa-user text-gray-600"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $graduate->first_name }} {{ $graduate->last_name }}
                                    </div>
                                    <div class="text-sm text-gray-500">{{ $graduate->user->email ?? 'N/A' }}</div>
                                    <div class="text-xs text-gray-400">{{ $graduate->student_id ?? 'No ID' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $graduate->program ?? 'Not specified' }}</div>
                            <div class="text-sm text-gray-500">Batch: {{ $graduate->batch_year ?? 'N/A' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($graduate->is_employed)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Employed
                                </span>
                                @if($graduate->current_position)
                                    <div class="text-xs text-gray-500 mt-1">{{ $graduate->current_position }}</div>
                                @endif
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <i class="fas fa-times-circle mr-1"></i>
                                    Unemployed
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($graduate->verification_status === 'verified')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Verified
                                </span>
                            @elseif($graduate->verification_status === 'pending')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-clock mr-1"></i>
                                    Pending
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    <i class="fas fa-question-circle mr-1"></i>
                                    Not Verified
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $graduate->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <button onclick="viewGraduate({{ $graduate->id }})" 
                                        class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-md text-xs transition-colors">
                                    <i class="fas fa-eye mr-1"></i>View
                                </button>
                                
                                @if($graduate->verification_status === 'pending')
                                <button onclick="verifyGraduate({{ $graduate->id }})" 
                                        class="text-green-600 hover:text-green-900 bg-green-50 hover:bg-green-100 px-3 py-1 rounded-md text-xs transition-colors">
                                    <i class="fas fa-check mr-1"></i>Verify
                                </button>
                                @endif
                                
                                <button onclick="contactGraduate({{ $graduate->id }})" 
                                        class="text-purple-600 hover:text-purple-900 bg-purple-50 hover:bg-purple-100 px-3 py-1 rounded-md text-xs transition-colors">
                                    <i class="fas fa-envelope mr-1"></i>Contact
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $graduates->links() }}
        </div>
        @else
        <div class="px-6 py-12 text-center">
            <i class="fas fa-users text-4xl text-gray-300 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No graduates found</h3>
            <p class="text-gray-500">There are no graduates in the system yet.</p>
        </div>
        @endif
    </div>
</div>

<!-- Graduate Details Modal -->
<div id="graduateModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Graduate Details</h3>
                <button onclick="closeGraduateModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div id="graduateDetails" class="text-gray-600">
                <!-- Graduate details will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
function viewGraduate(graduateId) {
    // Show loading
    document.getElementById('graduateDetails').innerHTML = '<div class="text-center py-4"><i class="fas fa-spinner fa-spin text-2xl text-gray-400"></i></div>';
    document.getElementById('graduateModal').classList.remove('hidden');
    
    // Fetch graduate details
    fetch(`/staff/graduates/${graduateId}/details`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('graduateDetails').innerHTML = data.html;
            } else {
                document.getElementById('graduateDetails').innerHTML = '<div class="text-red-600">Error loading graduate details.</div>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('graduateDetails').innerHTML = '<div class="text-red-600">Error loading graduate details.</div>';
        });
}

function closeGraduateModal() {
    document.getElementById('graduateModal').classList.add('hidden');
}

function verifyGraduate(graduateId) {
    if (confirm('Are you sure you want to verify this graduate?')) {
        fetch(`/staff/graduates/${graduateId}/verify`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error verifying graduate: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error verifying graduate. Please try again.');
        });
    }
}

function contactGraduate(graduateId) {
    // This would open an email client or contact form
    alert('Contact functionality would be implemented here');
}

function applyFilters() {
    const status = document.getElementById('status-filter').value;
    const employment = document.getElementById('employment-filter').value;
    const search = document.getElementById('search').value;
    
    let url = new URL(window.location);
    if (status) url.searchParams.set('status', status);
    if (employment) url.searchParams.set('employment', employment);
    if (search) url.searchParams.set('search', search);
    
    window.location.href = url.toString();
}

function clearFilters() {
    document.getElementById('status-filter').value = '';
    document.getElementById('employment-filter').value = '';
    document.getElementById('search').value = '';
    window.location.href = window.location.pathname;
}
</script>
@endsection
