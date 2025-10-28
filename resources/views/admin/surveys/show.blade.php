<div id="survey-content" class="space-y-6">
    <!-- Survey Header -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-bold text-gray-900">Survey Response Details</h2>
            <div class="flex items-center space-x-2">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    <i class="fas fa-check mr-1"></i> Completed
                </span>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Respondent</label>
                <p class="text-sm text-gray-900">{{ $alumniSurvey->user->name ?? 'Unknown' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <p class="text-sm text-gray-900">{{ $alumniSurvey->user->email ?? 'N/A' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Submitted</label>
                <p class="text-sm text-gray-900">{{ $alumniSurvey->created_at ? $alumniSurvey->created_at->format('M d, Y g:i A') : 'N/A' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Response ID</label>
                <p class="text-sm text-gray-900">#{{ $alumniSurvey->id }}</p>
            </div>
        </div>
    </div>

    <!-- Survey Responses -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Survey Responses</h3>
        
        @if($alumniSurvey->responses && is_array($alumniSurvey->responses) && count($alumniSurvey->responses) > 0)
            <div class="space-y-6">
                @php
                    $sections = [
                        'A. General Information' => ['name', 'permanent_address', 'email', 'telephone', 'mobile', 'birthday_month', 'birthday_day', 'birthday_year', 'province'],
                        'B. Educational Background' => ['degree_1', 'college_1', 'year_graduated_1', 'honors_1', 'degree_2', 'college_2', 'year_graduated_2', 'honors_2', 'degree_3', 'college_3', 'year_graduated_3', 'honors_3'],
                        'C. Professional Examinations' => ['exam_name_1', 'exam_date_1', 'exam_rating_1', 'exam_name_2', 'exam_date_2', 'exam_rating_2', 'exam_name_3', 'exam_date_3', 'exam_rating_3'],
                        'D. Training & Development' => ['course_reasons_other', 'training_title_1', 'training_duration_1', 'training_institution_1', 'training_title_2', 'training_duration_2', 'training_institution_2', 'training_title_3', 'training_duration_3', 'training_institution_3'],
                        'E. Employment Information' => ['advance_reason_other', 'unemployed_reasons_other', 'self_employed_skills', 'present_occupation', 'stay_job_reasons_other', 'accept_job_reasons_other', 'change_job_reasons_other', 'first_job_duration_other', 'how_found_first_job_other', 'time_to_first_job_other', 'useful_competencies_other', 'curriculum_suggestions'],
                        'F. Alumni Contacts' => ['alumni_name_1', 'alumni_address_1', 'alumni_contact_1', 'alumni_name_2', 'alumni_address_2', 'alumni_contact_2', 'alumni_name_3', 'alumni_address_3', 'alumni_contact_3', 'alumni_name_4', 'alumni_address_4', 'alumni_contact_4']
                    ];
                @endphp
                
                @foreach($sections as $sectionTitle => $fields)
                    @php
                        $hasData = false;
                        foreach($fields as $field) {
                            if(isset($alumniSurvey->responses[$field]) && !empty($alumniSurvey->responses[$field])) {
                                $hasData = true;
                                break;
                            }
                        }
                    @endphp
                    
                    @if($hasData)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h4 class="text-md font-semibold text-gray-800 mb-3 border-b pb-2">{{ $sectionTitle }}</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($fields as $field)
                                    @if(isset($alumniSurvey->responses[$field]) && !empty($alumniSurvey->responses[$field]))
                                        <div class="space-y-1">
                                            <label class="block text-sm font-medium text-gray-600 capitalize">
                                                {{ str_replace('_', ' ', $field) }}
                                            </label>
                                            <div class="text-sm text-gray-900 bg-gray-50 p-2 rounded">
                                                @if(is_array($alumniSurvey->responses[$field]))
                                                    @if(count($alumniSurvey->responses[$field]) > 0)
                                                        <ul class="list-disc list-inside space-y-1">
                                                            @foreach($alumniSurvey->responses[$field] as $item)
                                                                <li>{{ $item }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <span class="text-gray-500">No responses</span>
                                                    @endif
                                                @else
                                                    {{ $alumniSurvey->responses[$field] }}
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
                
                @php
                    $hasOtherData = false;
                    foreach($alumniSurvey->responses as $key => $value) {
                        $found = false;
                        foreach($sections as $sectionFields) {
                            if(in_array($key, $sectionFields)) {
                                $found = true;
                                break;
                            }
                        }
                        if(!$found && !empty($value)) {
                            $hasOtherData = true;
                            break;
                        }
                    }
                @endphp
                
                @if($hasOtherData)
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h4 class="text-md font-semibold text-gray-800 mb-3 border-b pb-2">Other Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($alumniSurvey->responses as $key => $value)
                                @php
                                    $found = false;
                                    foreach($sections as $sectionFields) {
                                        if(in_array($key, $sectionFields)) {
                                            $found = true;
                                            break;
                                        }
                                    }
                                @endphp
                                
                                @if(!$found && !empty($value))
                                    <div class="space-y-1">
                                        <label class="block text-sm font-medium text-gray-600 capitalize">
                                            {{ str_replace('_', ' ', $key) }}
                                        </label>
                                        <div class="text-sm text-gray-900 bg-gray-50 p-2 rounded">
                                            @if(is_array($value))
                                                @if(count($value) > 0)
                                                    <ul class="list-disc list-inside space-y-1">
                                                        @foreach($value as $item)
                                                            <li>{{ $item }}</li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <span class="text-gray-500">No responses</span>
                                                @endif
                                            @else
                                                {{ $value }}
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @else
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-clipboard-list text-4xl mb-4"></i>
                <p>No survey responses available</p>
            </div>
        @endif
    </div>

    <!-- Actions -->
    <div class="flex justify-end space-x-3">
        <button onclick="closeModal()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
            Close
        </button>
        <button onclick="deleteSurvey({{ $alumniSurvey->id }})" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
            <i class="fas fa-trash mr-1"></i> Delete Response
        </button>
    </div>
</div>