@extends('layouts.dashboard')

@section('title', 'System Maintenance')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-6">
        <div>
            <h1 class="text-3xl font-display font-bold text-gray-900 mb-2">🔧 System Maintenance</h1>
            <p class="text-gray-600 font-body">Manage system maintenance, backups, and monitoring</p>
        </div>
    </div>

    <!-- System Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
        <div class="card-enhanced p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 text-white mr-4">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Users</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $system_stats['total_users'] }}</p>
                </div>
            </div>
        </div>

        <div class="card-enhanced p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-gradient-to-r from-green-500 to-green-600 text-white mr-4">
                    <i class="fas fa-graduation-cap text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Graduates</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $system_stats['total_graduates'] }}</p>
                </div>
            </div>
        </div>

        <div class="card-enhanced p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-gradient-to-r from-purple-500 to-purple-600 text-white mr-4">
                    <i class="fas fa-briefcase text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Job Postings</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $system_stats['total_job_postings'] }}</p>
                </div>
            </div>
        </div>

        <div class="card-enhanced p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-gradient-to-r from-orange-500 to-orange-600 text-white mr-4">
                    <i class="fas fa-chart-line text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Employment Records</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $system_stats['total_employment_records'] }}</p>
                </div>
            </div>
        </div>

        <div class="card-enhanced p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-gradient-to-r from-red-500 to-red-600 text-white mr-4">
                    <i class="fas fa-file-alt text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Reports</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $system_stats['total_reports'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Maintenance Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Backup Management -->
        <div class="card-enhanced">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-display font-semibold text-gray-900">💾 Backup Management</h3>
                <p class="text-sm text-gray-600 mt-1">Create and manage system backups</p>
            </div>
            
            <div class="p-6">
                <div class="space-y-4">
                    <div>
                        <h4 class="font-medium text-gray-900 mb-2">Create Backup</h4>
                        <form action="{{ route('admin.maintenance.backup') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Backup Type</label>
                                <select name="backup_type" required class="input-enhanced w-full">
                                    <option value="">Select backup type...</option>
                                    <option value="full">🔄 Full System Backup</option>
                                    <option value="database">🗄️ Database Only</option>
                                    <option value="files">📁 Files Only</option>
                                </select>
                            </div>
                            
                            <button type="submit" class="btn-primary w-full">
                                <i class="fas fa-download mr-2"></i>Create Backup
                            </button>
                        </form>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-4">
                        <h4 class="font-medium text-gray-900 mb-2">Recent Backups</h4>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <i class="fas fa-file-archive text-blue-600 mr-3"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Full Backup</p>
                                        <p class="text-xs text-gray-500">Created 2 days ago</p>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="text-blue-600 hover:text-blue-900 text-sm">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-900 text-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <i class="fas fa-database text-green-600 mr-3"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Database Backup</p>
                                        <p class="text-xs text-gray-500">Created 1 week ago</p>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="text-blue-600 hover:text-blue-900 text-sm">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-900 text-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Monitoring -->
        <div class="card-enhanced">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-display font-semibold text-gray-900">📊 System Monitoring</h3>
                <p class="text-sm text-gray-600 mt-1">Monitor system health and performance</p>
            </div>
            
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg border border-green-200">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                            <div>
                                <p class="text-sm font-medium text-green-900">System Status</p>
                                <p class="text-xs text-green-700">All systems operational</p>
                            </div>
                        </div>
                        <span class="badge-enhanced bg-green-100 text-green-800">Online</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4 bg-blue-50 rounded-lg border border-blue-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-blue-900">CPU Usage</p>
                                    <p class="text-xs text-blue-700">Current load</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-blue-900">23%</p>
                                </div>
                            </div>
                            <div class="mt-2 w-full bg-blue-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: 23%"></div>
                            </div>
                        </div>
                        
                        <div class="p-4 bg-purple-50 rounded-lg border border-purple-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-purple-900">Memory Usage</p>
                                    <p class="text-xs text-purple-700">RAM utilization</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-purple-900">67%</p>
                                </div>
                            </div>
                            <div class="mt-2 w-full bg-purple-200 rounded-full h-2">
                                <div class="bg-purple-600 h-2 rounded-full" style="width: 67%"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h4 class="font-medium text-gray-900 mb-2">Disk Space</h4>
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Used: 45.2 GB</span>
                                <span class="text-gray-600">Free: 54.8 GB</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gray-600 h-2 rounded-full" style="width: 45%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Maintenance Tasks -->
    <div class="card-enhanced">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-display font-semibold text-gray-900">⚙️ Maintenance Tasks</h3>
            <p class="text-sm text-gray-600 mt-1">Perform routine maintenance operations</p>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="p-4 border border-gray-200 rounded-lg hover:border-blue-300 transition-colors duration-200">
                    <div class="flex items-center mb-3">
                        <div class="p-2 bg-blue-100 rounded-lg mr-3">
                            <i class="fas fa-broom text-blue-600"></i>
                        </div>
                        <h4 class="font-medium text-gray-900">Clear Cache</h4>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">Clear application cache and temporary files</p>
                    <button class="btn-primary w-full text-sm">
                        <i class="fas fa-play mr-2"></i>Run Task
                    </button>
                </div>
                
                <div class="p-4 border border-gray-200 rounded-lg hover:border-green-300 transition-colors duration-200">
                    <div class="flex items-center mb-3">
                        <div class="p-2 bg-green-100 rounded-lg mr-3">
                            <i class="fas fa-sync text-green-600"></i>
                        </div>
                        <h4 class="font-medium text-gray-900">Optimize Database</h4>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">Optimize database tables and indexes</p>
                    <button class="btn-primary w-full text-sm">
                        <i class="fas fa-play mr-2"></i>Run Task
                    </button>
                </div>
                
                <div class="p-4 border border-gray-200 rounded-lg hover:border-purple-300 transition-colors duration-200">
                    <div class="flex items-center mb-3">
                        <div class="p-2 bg-purple-100 rounded-lg mr-3">
                            <i class="fas fa-trash-alt text-purple-600"></i>
                        </div>
                        <h4 class="font-medium text-gray-900">Clean Logs</h4>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">Remove old log files and temporary data</p>
                    <button class="btn-primary w-full text-sm">
                        <i class="fas fa-play mr-2"></i>Run Task
                    </button>
                </div>
                
                <div class="p-4 border border-gray-200 rounded-lg hover:border-orange-300 transition-colors duration-200">
                    <div class="flex items-center mb-3">
                        <div class="p-2 bg-orange-100 rounded-lg mr-3">
                            <i class="fas fa-shield-alt text-orange-600"></i>
                        </div>
                        <h4 class="font-medium text-gray-900">Security Scan</h4>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">Perform security vulnerability scan</p>
                    <button class="btn-primary w-full text-sm">
                        <i class="fas fa-play mr-2"></i>Run Task
                    </button>
                </div>
                
                <div class="p-4 border border-gray-200 rounded-lg hover:border-red-300 transition-colors duration-200">
                    <div class="flex items-center mb-3">
                        <div class="p-2 bg-red-100 rounded-lg mr-3">
                            <i class="fas fa-compress text-red-600"></i>
                        </div>
                        <h4 class="font-medium text-gray-900">Compress Files</h4>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">Compress and optimize file storage</p>
                    <button class="btn-primary w-full text-sm">
                        <i class="fas fa-play mr-2"></i>Run Task
                    </button>
                </div>
                
                <div class="p-4 border border-gray-200 rounded-lg hover:border-indigo-300 transition-colors duration-200">
                    <div class="flex items-center mb-3">
                        <div class="p-2 bg-indigo-100 rounded-lg mr-3">
                            <i class="fas fa-check-circle text-indigo-600"></i>
                        </div>
                        <h4 class="font-medium text-gray-900">System Check</h4>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">Run comprehensive system health check</p>
                    <button class="btn-primary w-full text-sm">
                        <i class="fas fa-play mr-2"></i>Run Task
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- System Logs -->
    <div class="card-enhanced mt-8">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-display font-semibold text-gray-900">📋 System Logs</h3>
            <p class="text-sm text-gray-600 mt-1">View recent system logs and events</p>
        </div>
        
        <div class="p-6">
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">System backup completed successfully</p>
                            <p class="text-xs text-gray-500">2 minutes ago</p>
                        </div>
                    </div>
                    <span class="badge-enhanced bg-green-100 text-green-800">Success</span>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mr-3"></div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Cache cleared successfully</p>
                            <p class="text-xs text-gray-500">15 minutes ago</p>
                        </div>
                    </div>
                    <span class="badge-enhanced bg-blue-100 text-blue-800">Info</span>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-yellow-500 rounded-full mr-3"></div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">High memory usage detected</p>
                            <p class="text-xs text-gray-500">1 hour ago</p>
                        </div>
                    </div>
                    <span class="badge-enhanced bg-yellow-100 text-yellow-800">Warning</span>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Database optimization completed</p>
                            <p class="text-xs text-gray-500">3 hours ago</p>
                        </div>
                    </div>
                    <span class="badge-enhanced bg-green-100 text-green-800">Success</span>
                </div>
            </div>
            
            <div class="mt-4 text-center">
                <button class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                    <i class="fas fa-eye mr-2"></i>View All Logs
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Add any JavaScript functionality for maintenance tasks
document.addEventListener('DOMContentLoaded', function() {
    // Auto-refresh system stats every 30 seconds
    setInterval(function() {
        // In a real application, you would fetch updated stats via AJAX
        console.log('Refreshing system stats...');
    }, 30000);
});
</script>
@endsection
