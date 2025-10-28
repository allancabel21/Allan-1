@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Data Monitoring</h1>
        <p class="text-gray-600">Monitor system data, user statistics, and platform analytics</p>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <i class="fas fa-users text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $stats['total_users'] ?? 0 }}</h3>
                    <p class="text-sm text-gray-600">Total Users</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 rounded-lg">
                    <i class="fas fa-graduation-cap text-green-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $stats['total_graduates'] ?? 0 }}</h3>
                    <p class="text-sm text-gray-600">Graduates</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-2 bg-purple-100 rounded-lg">
                    <i class="fas fa-briefcase text-purple-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $stats['total_jobs'] ?? 0 }}</h3>
                    <p class="text-sm text-gray-600">Job Postings</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-2 bg-orange-100 rounded-lg">
                    <i class="fas fa-id-card text-orange-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $stats['total_memberships'] ?? 0 }}</h3>
                    <p class="text-sm text-gray-600">Memberships</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- User Registration Trends -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">User Registration Trends</h3>
            <div class="h-64 flex items-center justify-center bg-gray-50 rounded-lg">
                <div class="text-center">
                    <i class="fas fa-chart-line text-4xl text-gray-400 mb-2"></i>
                    <p class="text-gray-500">Registration trends chart</p>
                    <p class="text-sm text-gray-400">Last 30 days</p>
                </div>
            </div>
        </div>

        <!-- Employment Statistics -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Employment Statistics</h3>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Employed Graduates</span>
                    <span class="text-sm font-semibold text-green-600">{{ $stats['employed_graduates'] ?? 0 }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Unemployed Graduates</span>
                    <span class="text-sm font-semibold text-red-600">{{ $stats['unemployed_graduates'] ?? 0 }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Employment Rate</span>
                    <span class="text-sm font-semibold text-blue-600">{{ $stats['employment_rate'] ?? 0 }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-green-600 h-2 rounded-full" style="width: {{ $stats['employment_rate'] ?? 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Recent Users -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent User Registrations</h3>
            <div class="space-y-3">
                @if(isset($recent_users) && $recent_users->count() > 0)
                    @foreach($recent_users as $user)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user text-blue-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $user->email }}</p>
                            </div>
                        </div>
                        <span class="text-xs text-gray-500">{{ $user->created_at->diffForHumans() }}</span>
                    </div>
                    @endforeach
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-users text-4xl text-gray-300 mb-2"></i>
                        <p class="text-gray-500">No recent registrations</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Recent Job Postings -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Job Postings</h3>
            <div class="space-y-3">
                @if(isset($recent_jobs) && $recent_jobs->count() > 0)
                    @foreach($recent_jobs as $job)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-briefcase text-green-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $job->title }}</p>
                                <p class="text-xs text-gray-500">{{ $job->company }}</p>
                            </div>
                        </div>
                        <span class="text-xs text-gray-500">{{ $job->created_at->diffForHumans() }}</span>
                    </div>
                    @endforeach
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-briefcase text-4xl text-gray-300 mb-2"></i>
                        <p class="text-gray-500">No recent job postings</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- System Health -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Database Status -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Database Status</h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Connection</span>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <i class="fas fa-check-circle mr-1"></i>Connected
                    </span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Tables</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $stats['total_tables'] ?? 0 }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Storage Used</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $stats['db_size'] ?? 'N/A' }}</span>
                </div>
            </div>
        </div>

        <!-- File Storage -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">File Storage</h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Profile Pictures</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $stats['profile_pictures'] ?? 0 }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Payment Proofs</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $stats['payment_proofs'] ?? 0 }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Resumes</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $stats['resumes'] ?? 0 }}</span>
                </div>
            </div>
        </div>

        <!-- System Performance -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">System Performance</h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Response Time</span>
                    <span class="text-sm font-semibold text-green-600">{{ $stats['response_time'] ?? 'N/A' }}ms</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Memory Usage</span>
                    <span class="text-sm font-semibold text-blue-600">{{ $stats['memory_usage'] ?? 'N/A' }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Uptime</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $stats['uptime'] ?? 'N/A' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Export -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Export</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <button class="flex items-center justify-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-download text-blue-600 mr-2"></i>
                <span class="text-sm font-medium">Export Users</span>
            </button>
            <button class="flex items-center justify-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-download text-green-600 mr-2"></i>
                <span class="text-sm font-medium">Export Graduates</span>
            </button>
            <button class="flex items-center justify-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-download text-purple-600 mr-2"></i>
                <span class="text-sm font-medium">Export Jobs</span>
            </button>
        </div>
    </div>
</div>

<script>
// Auto-refresh data every 30 seconds
setInterval(() => {
    // You can add AJAX calls here to refresh specific data
    console.log('Refreshing data monitoring...');
}, 30000);

// Add any additional JavaScript for charts or real-time updates
document.addEventListener('DOMContentLoaded', function() {
    // Initialize any charts or real-time features here
    console.log('Data monitoring page loaded');
});
</script>
@endsection
