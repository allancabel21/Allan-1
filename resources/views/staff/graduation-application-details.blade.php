<div class="space-y-8">
    <!-- Application Header -->
    <div class="card-enhanced p-8 shadow-lg">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg">
                    <span class="text-white text-xl font-bold" style="display: inline-block; width: 24px; height: 24px; line-height: 24px; text-align: center;">
                        📋
                    </span>
                </div>
                <h4 class="text-2xl font-display font-bold text-gray-900">Application Information</h4>
            </div>
            <span class="badge-enhanced px-4 py-2 text-lg font-display font-semibold
                @if($application->status === 'approved') bg-green-100 text-green-800
                @elseif($application->status === 'rejected') bg-red-100 text-red-800
                @else bg-yellow-100 text-yellow-800 @endif">
                {{ $application->status_label }}
            </span>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-gray-50 rounded-xl p-4">
                <label class="text-sm font-display font-semibold text-gray-600 uppercase tracking-wide">Application Type</label>
                <p class="text-lg text-gray-900 font-display font-bold mt-1">{{ $application->application_type_label }}</p>
            </div>
            <div class="bg-gray-50 rounded-xl p-4">
                <label class="text-sm font-display font-semibold text-gray-600 uppercase tracking-wide">Major/Field</label>
                <p class="text-lg text-gray-900 font-body mt-1">{{ $application->major_in ?? 'N/A' }}</p>
            </div>
            <div class="bg-gray-50 rounded-xl p-4">
                <label class="text-sm font-display font-semibold text-gray-600 uppercase tracking-wide">Campus</label>
                <p class="text-lg text-gray-900 font-body mt-1">{{ $application->campus }}</p>
            </div>
            <div class="bg-gray-50 rounded-xl p-4">
                <label class="text-sm font-display font-semibold text-gray-600 uppercase tracking-wide">City/Province</label>
                <p class="text-lg text-gray-900 font-body mt-1">{{ $application->city_province }}</p>
            </div>
            <div class="bg-gray-50 rounded-xl p-4">
                <label class="text-sm font-display font-semibold text-gray-600 uppercase tracking-wide">College/Unit/Department</label>
                <p class="text-lg text-gray-900 font-body mt-1">{{ $application->college_unit_department }}</p>
            </div>
            <div class="bg-gray-50 rounded-xl p-4">
                <label class="text-sm font-display font-semibold text-gray-600 uppercase tracking-wide">Last Semester</label>
                <p class="text-lg text-gray-900 font-body mt-1">{{ $application->last_semester_label }}</p>
            </div>
            <div class="bg-gray-50 rounded-xl p-4">
                <label class="text-sm font-display font-semibold text-gray-600 uppercase tracking-wide">School Year</label>
                <p class="text-lg text-gray-900 font-body mt-1">{{ $application->school_year }}</p>
            </div>
            <div class="bg-gray-50 rounded-xl p-4">
                <label class="text-sm font-display font-semibold text-gray-600 uppercase tracking-wide">Submitted Date</label>
                <p class="text-lg text-gray-900 font-body mt-1">{{ $application->created_at->format('M d, Y h:i A') }}</p>
            </div>
        </div>
    </div>

    <!-- Student Information -->
    <div class="card-enhanced p-8 shadow-lg">
        <h4 class="text-2xl font-display font-bold text-gray-900 mb-8 flex items-center">
            <div class="p-3 bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg mr-4">
                <span class="text-white text-xl font-bold" style="display: inline-block; width: 24px; height: 24px; line-height: 24px; text-align: center;">
                    👨‍🎓
                </span>
            </div>
            Student Information
        </h4>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-gray-50 rounded-xl p-4">
                <label class="text-sm font-display font-semibold text-gray-600 uppercase tracking-wide">Full Name</label>
                <p class="text-lg text-gray-900 font-display font-bold mt-1">{{ $application->graduate->first_name }} {{ $application->graduate->last_name }}</p>
            </div>
            <div class="bg-gray-50 rounded-xl p-4">
                <label class="text-sm font-display font-semibold text-gray-600 uppercase tracking-wide">Student ID</label>
                <p class="text-lg text-gray-900 font-body mt-1">{{ $application->graduate->student_id ?? 'N/A' }}</p>
            </div>
            <div class="bg-gray-50 rounded-xl p-4">
                <label class="text-sm font-display font-semibold text-gray-600 uppercase tracking-wide">Email</label>
                <p class="text-lg text-gray-900 font-body mt-1">{{ $application->graduate->user->email ?? 'N/A' }}</p>
            </div>
            <div class="bg-gray-50 rounded-xl p-4">
                <label class="text-sm font-display font-semibold text-gray-600 uppercase tracking-wide">Contact Number</label>
                <p class="text-lg text-gray-900 font-body mt-1">{{ $application->graduate->contact_number ?? 'N/A' }}</p>
            </div>
            <div class="md:col-span-2 bg-gray-50 rounded-xl p-4">
                <label class="text-sm font-display font-semibold text-gray-600 uppercase tracking-wide">Address</label>
                <p class="text-lg text-gray-900 font-body mt-1">{{ $application->graduate->present_address ?? 'N/A' }}</p>
            </div>
        </div>
    </div>

    <!-- Subject Load -->
    <div class="card-enhanced p-8 shadow-lg">
        <h4 class="text-2xl font-display font-bold text-gray-900 mb-8 flex items-center">
            <div class="p-3 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg mr-4">
                <span class="text-white text-xl font-bold" style="display: inline-block; width: 24px; height: 24px; line-height: 24px; text-align: center;">
                    📚
                </span>
            </div>
            Subject Load
        </h4>
        
        <div class="table-enhanced">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="text-left py-2 px-3 border-b">Subject Code</th>
                        <th class="text-left py-2 px-3 border-b">Descriptive Title</th>
                        <th class="text-left py-2 px-3 border-b">Units</th>
                        <th class="text-left py-2 px-3 border-b">Instructor</th>
                        <th class="text-left py-2 px-3 border-b">Signature</th>
                    </tr>
                </thead>
                <tbody>
                    @if($application->subject_load && is_array($application->subject_load))
                        @foreach($application->subject_load as $subject)
                            @if(!empty($subject['code']) || !empty($subject['title']))
                            <tr>
                                <td class="py-2 px-3 border-b">{{ $subject['code'] ?? 'N/A' }}</td>
                                <td class="py-2 px-3 border-b">{{ $subject['title'] ?? 'N/A' }}</td>
                                <td class="py-2 px-3 border-b">{{ $subject['units'] ?? 'N/A' }}</td>
                                <td class="py-2 px-3 border-b">{{ $subject['instructor'] ?? 'N/A' }}</td>
                                <td class="py-2 px-3 border-b">{{ $subject['signature'] ?? 'N/A' }}</td>
                            </tr>
                            @endif
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">No subject load information available</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Diploma Information -->
    <div class="card-enhanced p-8 shadow-lg">
        <h4 class="text-2xl font-display font-bold text-gray-900 mb-8 flex items-center">
            <div class="p-3 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg mr-4">
                <span class="text-white text-xl font-bold" style="display: inline-block; width: 24px; height: 24px; line-height: 24px; text-align: center;">
                    🏆
                </span>
            </div>
            Diploma Information
        </h4>
        
        <div class="space-y-4">
            <div>
                <label class="text-sm font-medium text-gray-500">Name to be printed on diploma</label>
                <p class="text-gray-900 font-semibold">{{ $application->diploma_name }}</p>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-500">Mailing Address</label>
                <p class="text-gray-900">{{ $application->diploma_address }}</p>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-500">Contact Number</label>
                <p class="text-gray-900">{{ $application->diploma_contact }}</p>
            </div>
        </div>
    </div>

    <!-- Approval Information -->
    @if($application->status !== 'pending')
    <div class="card-enhanced p-8 shadow-lg">
        <h4 class="text-2xl font-display font-bold text-gray-900 mb-8 flex items-center">
            <div class="p-3 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl shadow-lg mr-4">
                <span class="text-white text-xl font-bold" style="display: inline-block; width: 24px; height: 24px; line-height: 24px; text-align: center;">
                    ✅
                </span>
            </div>
            Approval Information
        </h4>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="text-sm font-medium text-gray-500">Status</label>
                <p class="text-gray-900 font-semibold">{{ $application->status_label }}</p>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-500">Approved/Rejected By</label>
                <p class="text-gray-900">{{ $application->approver->name ?? 'N/A' }}</p>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-500">Date</label>
                <p class="text-gray-900">{{ $application->approved_at ? $application->approved_at->format('M d, Y h:i A') : 'N/A' }}</p>
            </div>
            @if($application->notes)
            <div class="md:col-span-2">
                <label class="text-sm font-medium text-gray-500">Notes</label>
                <p class="text-gray-900">{{ $application->notes }}</p>
            </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Actions -->
    @if($application->status === 'pending')
    <div class="card-enhanced p-8 shadow-lg">
        <h4 class="text-2xl font-display font-bold text-gray-900 mb-8 flex items-center">
            <div class="p-3 bg-gradient-to-br from-teal-500 to-teal-600 rounded-xl shadow-lg mr-4">
                <span class="text-white text-xl font-bold" style="display: inline-block; width: 24px; height: 24px; line-height: 24px; text-align: center;">
                    ⚙️
                </span>
            </div>
            Actions
        </h4>
        <div class="flex space-x-4">
            <button onclick="approveApplication({{ $application->id }})" 
                    class="btn-primary px-6 py-3">
                <i class="fas fa-check mr-2"></i>Approve Application
            </button>
            <button onclick="rejectApplication({{ $application->id }})" 
                    class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition-colors font-display font-semibold">
                <i class="fas fa-times mr-2"></i>Reject Application
            </button>
        </div>
    </div>
    @endif
</div>
