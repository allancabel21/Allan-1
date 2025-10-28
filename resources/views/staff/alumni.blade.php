@extends('layouts.dashboard')

@section('title', 'Alumni Management')

@section('content')
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-display font-bold text-gradient mb-3">Alumni Management</h1>
        <p class="text-lg text-gray-600 font-body">Manage and view verified alumni information</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="card-enhanced p-6">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-2xl font-display font-bold text-gray-900">{{ $alumni->total() }}</h3>
                    <p class="text-sm text-gray-600 font-medium">Total Alumni</p>
                </div>
            </div>
        </div>

        <div class="card-enhanced p-6">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl shadow-lg">
                    <i class="fas fa-check-circle text-white text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-2xl font-display font-bold text-gray-900">{{ $alumni->where('verification_status', 'verified')->count() }}</h3>
                    <p class="text-sm text-gray-600 font-medium">Verified</p>
                </div>
            </div>
        </div>

        <div class="card-enhanced p-6">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl shadow-lg">
                    <i class="fas fa-clock text-white text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-2xl font-display font-bold text-gray-900">{{ $alumni->where('verification_status', 'pending')->count() }}</h3>
                    <p class="text-sm text-gray-600 font-medium">Pending</p>
                </div>
            </div>
        </div>

        <div class="card-enhanced p-6">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-br from-purple-500 to-indigo-500 rounded-xl shadow-lg">
                    <i class="fas fa-graduation-cap text-white text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-2xl font-display font-bold text-gray-900">{{ $alumni->where('current_status', 'employed')->count() }}</h3>
                    <p class="text-sm text-gray-600 font-medium">Employed</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="card-enhanced p-6 mb-6">
        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4">
            <h3 class="text-lg font-display font-semibold text-gray-900">Search & Filter Alumni</h3>
            <div class="flex flex-wrap gap-3">
                <input type="text" id="searchInput" placeholder="Search by name, email, or program..." 
                       class="input-enhanced text-sm min-w-[300px]">
                
                <select id="statusFilter" class="input-enhanced text-sm">
                    <option value="">All Status</option>
                    <option value="employed">Employed</option>
                    <option value="unemployed">Unemployed</option>
                    <option value="pursuing_higher_education">Pursuing Higher Education</option>
                    <option value="self_employed">Self Employed</option>
                </select>

                <select id="verificationFilter" class="input-enhanced text-sm">
                    <option value="">All Verification</option>
                    <option value="verified">Verified</option>
                    <option value="pending">Pending</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Alumni Table -->
    <div class="table-enhanced">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="text-left">Alumni</th>
                        <th class="text-left">Program</th>
                        <th class="text-left">Graduation</th>
                        <th class="text-left">Current Status</th>
                        <th class="text-left">Verification</th>
                        <th class="text-left">Contact</th>
                        <th class="text-left">Actions</th>
                    </tr>
                </thead>
                <tbody id="alumniTableBody">
                    @forelse($alumni as $graduate)
                    <tr class="alumni-row transition-colors duration-200" 
                        data-name="{{ strtolower($graduate->first_name . ' ' . $graduate->last_name) }}"
                        data-status="{{ $graduate->current_status }}"
                        data-verification="{{ $graduate->verification_status }}">
                        <td class="whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12">
                                    <div class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg">
                                        <i class="fas fa-user text-white text-lg"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-display font-semibold text-gray-900">
                                        {{ $graduate->first_name }} {{ $graduate->last_name }}
                                    </div>
                                    <div class="text-sm text-gray-500 font-body">{{ $graduate->user->email ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="whitespace-nowrap">
                            <div class="text-sm text-gray-900 font-body">{{ $graduate->program ?? 'N/A' }}</div>
                            <div class="text-xs text-gray-500">{{ $graduate->batch_year ?? 'N/A' }}</div>
                        </td>
                        <td class="whitespace-nowrap">
                            <div class="text-sm text-gray-900 font-body">
                                {{ $graduate->graduation_date ? $graduate->graduation_date->format('M Y') : 'N/A' }}
                            </div>
                        </td>
                        <td class="whitespace-nowrap">
                            <span class="badge-enhanced
                                @if($graduate->current_status === 'employed') bg-green-100 text-green-800
                                @elseif($graduate->current_status === 'unemployed') bg-red-100 text-red-800
                                @elseif($graduate->current_status === 'pursuing_higher_education') bg-purple-100 text-purple-800
                                @elseif($graduate->current_status === 'self_employed') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ $graduate->current_status_label ?? 'Not specified' }}
                            </span>
                        </td>
                        <td class="whitespace-nowrap">
                            <span class="badge-enhanced
                                @if($graduate->verification_status === 'verified') bg-green-100 text-green-800
                                @elseif($graduate->verification_status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($graduate->verification_status === 'rejected') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($graduate->verification_status ?? 'pending') }}
                            </span>
                        </td>
                        <td class="whitespace-nowrap">
                            <div class="text-sm text-gray-900 font-body">{{ $graduate->contact_number ?? 'N/A' }}</div>
                            <div class="text-xs text-gray-500">{{ $graduate->present_address ? Str::limit($graduate->present_address, 30) : 'N/A' }}</div>
                        </td>
                        <td class="whitespace-nowrap">
                            <div class="flex space-x-2">
                                <button onclick="viewAlumniDetails({{ $graduate->id }})" 
                                        class="text-blue-600 hover:text-blue-800 transition-colors">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="editAlumni({{ $graduate->id }})" 
                                        class="text-green-600 hover:text-green-800 transition-colors">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="contactAlumni({{ $graduate->id }})" 
                                        class="text-purple-600 hover:text-purple-800 transition-colors">
                                    <i class="fas fa-envelope"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-8">
                            <div class="text-gray-500">
                                <i class="fas fa-users text-4xl mb-4"></i>
                                <p class="text-lg font-body">No alumni found</p>
                                <p class="text-sm">Try adjusting your search criteria</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($alumni->hasPages())
    <div class="mt-6">
        {{ $alumni->links() }}
    </div>
    @endif
@endsection

@push('scripts')
<script>
// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    filterAlumni();
});

document.getElementById('statusFilter').addEventListener('change', function() {
    filterAlumni();
});

document.getElementById('verificationFilter').addEventListener('change', function() {
    filterAlumni();
});

function filterAlumni() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const statusFilter = document.getElementById('statusFilter').value;
    const verificationFilter = document.getElementById('verificationFilter').value;
    const rows = document.querySelectorAll('.alumni-row');

    rows.forEach(row => {
        const name = row.dataset.name;
        const status = row.dataset.status;
        const verification = row.dataset.verification;

        const matchesSearch = name.includes(searchTerm);
        const matchesStatus = !statusFilter || status === statusFilter;
        const matchesVerification = !verificationFilter || verification === verificationFilter;

        if (matchesSearch && matchesStatus && matchesVerification) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function viewAlumniDetails(graduateId) {
    // Implement alumni details modal
    console.log('View alumni details:', graduateId);
}

function editAlumni(graduateId) {
    // Implement edit alumni functionality
    console.log('Edit alumni:', graduateId);
}

function contactAlumni(graduateId) {
    // Implement contact alumni functionality
    console.log('Contact alumni:', graduateId);
}
</script>
@endpush
