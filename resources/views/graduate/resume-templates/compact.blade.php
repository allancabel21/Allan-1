<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $graduate->first_name ?? 'Graduate' }} {{ $graduate->last_name ?? 'Resume' }} - Resume</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            font-size: 11px;
            line-height: 1.2;
        }
        
        .profile-picture {
            width: 80px;
            height: 100px;
            object-fit: cover;
            border: 1px solid #374151;
            border-radius: 2px;
        }
        
        .section-header {
            font-weight: 700;
            font-size: 12px;
            text-decoration: underline;
            margin-bottom: 6px;
            color: #111827;
            text-transform: uppercase;
        }
        
        .personal-data {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4px 12px;
        }
        
        .data-label {
            font-weight: 500;
            color: #374151;
            font-size: 10px;
        }
        
        .data-value {
            color: #111827;
            font-size: 10px;
        }
        
        .education-item, .employment-item {
            margin-bottom: 8px;
            padding-bottom: 6px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .education-item:last-child, .employment-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        
        .institution, .company {
            font-weight: 600;
            color: #111827;
            margin-bottom: 2px;
            font-size: 10px;
        }
        
        .degree, .position {
            color: #374151;
            margin-bottom: 2px;
            font-size: 10px;
        }
        
        .period {
            color: #6b7280;
            font-size: 9px;
        }
        
        .skills-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4px;
        }
        
        .skill-item {
            font-size: 10px;
            color: #374151;
        }
        
        @media print {
            body { 
                margin: 0; 
                font-size: 10px;
                line-height: 1.1;
            }
            .no-print { display: none !important; }
            .container { 
                max-width: 100%;
                padding: 0.3in;
                margin: 0;
            }
            .section-header {
                font-size: 11px;
                margin-bottom: 4px;
            }
            .personal-data {
                gap: 2px 8px;
            }
            .education-item, .employment-item {
                margin-bottom: 6px;
                padding-bottom: 4px;
            }
            h1 {
                font-size: 18px;
                margin-bottom: 8px;
            }
            .profile-picture {
                width: 70px;
                height: 85px;
            }
        }
        
        .editable-field {
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
        }
        
        .editable-field:hover {
            background-color: #f8fafc;
            border-radius: 2px;
            padding: 1px 2px;
        }
        
        .editable-field.editing {
            background-color: #eff6ff;
            border: 1px solid #3b82f6;
            border-radius: 2px;
            padding: 2px;
        }
        
        .edit-input {
            width: 100%;
            border: none;
            background: transparent;
            font-family: inherit;
            font-size: inherit;
            color: inherit;
            outline: none;
            resize: none;
        }
        
        .edit-hint {
            position: absolute;
            top: -20px;
            left: 0;
            background: #1e3a8a;
            color: white;
            padding: 1px 6px;
            border-radius: 2px;
            font-size: 9px;
            opacity: 0;
            transition: opacity 0.2s ease;
            pointer-events: none;
            z-index: 10;
        }
        
        .editable-field:hover .edit-hint {
            opacity: 1;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Action Buttons -->
    <div class="no-print fixed top-4 right-4 z-50 flex gap-2">
        <button id="editBtn" onclick="toggleEditMode()" class="bg-purple-600 text-white px-3 py-1 rounded text-sm shadow-lg hover:bg-purple-700 transition-colors">
            <i class="fas fa-edit mr-1"></i>Edit
        </button>
        <button id="saveBtn" onclick="saveResume()" class="bg-green-600 text-white px-3 py-1 rounded text-sm shadow-lg hover:bg-green-700 transition-colors hidden">
            <i class="fas fa-save mr-1"></i>Save
        </button>
        <button onclick="printResume()" class="bg-blue-600 text-white px-3 py-1 rounded text-sm shadow-lg hover:bg-blue-700 transition-colors">
            <i class="fas fa-print mr-1"></i>Print
        </button>
        <button onclick="window.close()" class="bg-gray-600 text-white px-3 py-1 rounded text-sm shadow-lg hover:bg-gray-700 transition-colors">
            <i class="fas fa-times mr-1"></i>Close
        </button>
    </div>

    @php
        $resumeContent = json_decode($resume->content ?? '{}', true);
        
        // Ensure all content fields are strings to prevent explode() errors
        $stringFields = ['address', 'contact_number', 'email', 'first_name', 'last_name', 'birth_date', 'place_of_birth', 'civil_status', 'citizenship', 'religion', 'height', 'weight', 'father_name', 'mother_name', 'sss_number', 'tin_number', 'program', 'student_id', 'batch_year', 'graduation_date', 'current_company', 'current_position', 'employment_start_date', 'skills', 'software', 'languages', 'work_experience', 'education', 'references'];
        foreach ($stringFields as $field) {
            if (isset($resumeContent[$field]) && !is_string($resumeContent[$field])) {
                $resumeContent[$field] = is_array($resumeContent[$field]) ? implode("\n", $resumeContent[$field]) : (string) $resumeContent[$field];
            }
        }
    @endphp

    <div class="container max-w-4xl mx-auto bg-white shadow-2xl p-6">
        <!-- Header Section with Profile Picture -->
        <div class="flex justify-between items-start mb-4">
            <!-- Contact Information -->
            <div class="flex-1">
                <!-- Name -->
                <h1 class="text-xl font-bold text-gray-900 underline mb-2">
                    <div class="editable-field" data-field="first_name" data-type="text">
                        <span class="field-display">{{ strtoupper($resumeContent['first_name'] ?? $graduate->first_name ?? 'First') }}</span>
                        <input type="text" class="edit-input hidden" value="{{ $resumeContent['first_name'] ?? $graduate->first_name ?? 'First' }}">
                        <div class="edit-hint">Click to edit first name</div>
                    </div> 
                    <div class="editable-field" data-field="last_name" data-type="text">
                        <span class="field-display">{{ strtoupper($resumeContent['last_name'] ?? $graduate->last_name ?? 'Last') }}</span>
                        <input type="text" class="edit-input hidden" value="{{ $resumeContent['last_name'] ?? $graduate->last_name ?? 'Last' }}">
                        <div class="edit-hint">Click to edit last name</div>
                    </div>
                </h1>
                
                <div class="text-xs text-gray-700 space-y-1">
                    <div class="editable-field" data-field="address" data-type="text">
                        <span class="field-display">{{ $resumeContent['address'] ?? $graduate->present_address ?? 'Address not provided' }}</span>
                        <input type="text" class="edit-input hidden" value="{{ $resumeContent['address'] ?? $graduate->present_address ?? 'Address not provided' }}">
                        <div class="edit-hint">Click to edit address</div>
                    </div>
                    <div class="editable-field" data-field="contact_number" data-type="text">
                        <span class="field-display">{{ $resumeContent['contact_number'] ?? $graduate->contact_number ?? '+63 912 345 6789' }}</span>
                        <input type="text" class="edit-input hidden" value="{{ $resumeContent['contact_number'] ?? $graduate->contact_number ?? '+63 912 345 6789' }}">
                        <div class="edit-hint">Click to edit phone</div>
                    </div>
                    <div class="editable-field" data-field="email" data-type="text">
                        <span class="field-display">{{ $resumeContent['email'] ?? $graduate->user->email ?? 'email@example.com' }}</span>
                        <input type="text" class="edit-input hidden" value="{{ $resumeContent['email'] ?? $graduate->user->email ?? 'email@example.com' }}">
                        <div class="edit-hint">Click to edit email</div>
                    </div>
                </div>
            </div>
            
            <!-- Profile Picture -->
            <div class="flex-shrink-0 ml-4">
                <div class="relative">
                    <img src="{{ $graduate->profile_picture ? asset('storage/' . $graduate->profile_picture) : asset('images/default-avatar.svg') }}" 
                         alt="Profile Picture" 
                         class="profile-picture"
                         id="profile-image">
                    
                    <!-- Change Photo Button -->
                    <button onclick="document.getElementById('profile-upload').click()" 
                            class="absolute bottom-0 right-0 bg-blue-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-blue-700 transition-colors no-print">
                        <i class="fas fa-camera"></i>
                    </button>
                    
                    <!-- Hidden File Input -->
                    <input type="file" id="profile-upload" accept="image/*" class="hidden" onchange="uploadProfilePicture(this)">
                </div>
            </div>
        </div>

        <!-- Two Column Layout -->
        <div class="grid grid-cols-2 gap-4">
            <!-- Left Column -->
            <div class="space-y-3">
                <!-- Personal Data Section -->
                <div>
                    <h2 class="section-header">Personal Data</h2>
                    <div class="personal-data">
                        <div class="flex">
                            <span class="data-label w-20">Birth Date:</span>
                            <div class="editable-field" data-field="birth_date" data-type="text">
                                <span class="data-value field-display">{{ $resumeContent['birth_date'] ?? ($graduate->birth_date ? \Carbon\Carbon::parse($graduate->birth_date)->format('M d, Y') : 'Not provided') }}</span>
                                <input type="text" class="edit-input hidden" value="{{ $resumeContent['birth_date'] ?? ($graduate->birth_date ? \Carbon\Carbon::parse($graduate->birth_date)->format('M d, Y') : 'Not provided') }}">
                                <div class="edit-hint">Click to edit birth date</div>
                            </div>
                        </div>
                        <div class="flex">
                            <span class="data-label w-20">Place:</span>
                            <div class="editable-field" data-field="place_of_birth" data-type="text">
                                <span class="data-value field-display">{{ $resumeContent['place_of_birth'] ?? $graduate->place_of_birth ?? 'Not provided' }}</span>
                                <input type="text" class="edit-input hidden" value="{{ $resumeContent['place_of_birth'] ?? $graduate->place_of_birth ?? 'Not provided' }}">
                                <div class="edit-hint">Click to edit place of birth</div>
                            </div>
                        </div>
                        <div class="flex">
                            <span class="data-label w-20">Status:</span>
                            <div class="editable-field" data-field="civil_status" data-type="text">
                                <span class="data-value field-display">{{ $resumeContent['civil_status'] ?? $graduate->civil_status ?? 'Not provided' }}</span>
                                <input type="text" class="edit-input hidden" value="{{ $resumeContent['civil_status'] ?? $graduate->civil_status ?? 'Not provided' }}">
                                <div class="edit-hint">Click to edit civil status</div>
                            </div>
                        </div>
                        <div class="flex">
                            <span class="data-label w-20">Citizenship:</span>
                            <div class="editable-field" data-field="citizenship" data-type="text">
                                <span class="data-value field-display">{{ $resumeContent['citizenship'] ?? $graduate->citizenship ?? 'Filipino' }}</span>
                                <input type="text" class="edit-input hidden" value="{{ $resumeContent['citizenship'] ?? $graduate->citizenship ?? 'Filipino' }}">
                                <div class="edit-hint">Click to edit citizenship</div>
                            </div>
                        </div>
                        <div class="flex">
                            <span class="data-label w-20">Religion:</span>
                            <div class="editable-field" data-field="religion" data-type="text">
                                <span class="data-value field-display">{{ $resumeContent['religion'] ?? $graduate->religion ?? 'Not provided' }}</span>
                                <input type="text" class="edit-input hidden" value="{{ $resumeContent['religion'] ?? $graduate->religion ?? 'Not provided' }}">
                                <div class="edit-hint">Click to edit religion</div>
                            </div>
                        </div>
                        <div class="flex">
                            <span class="data-label w-20">Height:</span>
                            <div class="editable-field" data-field="height" data-type="text">
                                <span class="data-value field-display">{{ $resumeContent['height'] ?? $graduate->height ?? 'Not provided' }}</span>
                                <input type="text" class="edit-input hidden" value="{{ $resumeContent['height'] ?? $graduate->height ?? 'Not provided' }}">
                                <div class="edit-hint">Click to edit height</div>
                            </div>
                        </div>
                        <div class="flex">
                            <span class="data-label w-20">Weight:</span>
                            <div class="editable-field" data-field="weight" data-type="text">
                                <span class="data-value field-display">{{ $resumeContent['weight'] ?? $graduate->weight ?? 'Not provided' }}</span>
                                <input type="text" class="edit-input hidden" value="{{ $resumeContent['weight'] ?? $graduate->weight ?? 'Not provided' }}">
                                <div class="edit-hint">Click to edit weight</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Skills Section -->
                <div>
                    <h2 class="section-header">Skills</h2>
                    <div class="editable-field" data-field="skills" data-type="textarea">
                        <div class="field-display text-xs text-gray-700">
                            {{ $resumeContent['skills'] ?? '• Programming Languages: PHP, JavaScript, Python\n• Web Development: HTML, CSS, Laravel\n• Database: MySQL, PostgreSQL\n• Tools: Git, VS Code, Docker' }}
                        </div>
                        <textarea class="edit-input hidden" rows="6">{{ $resumeContent['skills'] ?? '• Programming Languages: PHP, JavaScript, Python\n• Web Development: HTML, CSS, Laravel\n• Database: MySQL, PostgreSQL\n• Tools: Git, VS Code, Docker' }}</textarea>
                        <div class="edit-hint">Click to edit skills</div>
                    </div>
                </div>

                <!-- Software Skills -->
                <div>
                    <h2 class="section-header">Software</h2>
                    <div class="editable-field" data-field="software" data-type="textarea">
                        <div class="field-display text-xs text-gray-700">
                            {{ $resumeContent['software'] ?? '• Microsoft Office Suite\n• Adobe Creative Suite\n• Visual Studio Code\n• Git Version Control' }}
                        </div>
                        <textarea class="edit-input hidden" rows="4">{{ $resumeContent['software'] ?? '• Microsoft Office Suite\n• Adobe Creative Suite\n• Visual Studio Code\n• Git Version Control' }}</textarea>
                        <div class="edit-hint">Click to edit software</div>
                    </div>
                </div>

                <!-- Languages -->
                <div>
                    <h2 class="section-header">Languages</h2>
                    <div class="editable-field" data-field="languages" data-type="textarea">
                        <div class="field-display text-xs text-gray-700">
                            {{ $resumeContent['languages'] ?? '• English (Fluent)\n• Filipino (Native)\n• Cebuano (Native)' }}
                        </div>
                        <textarea class="edit-input hidden" rows="3">{{ $resumeContent['languages'] ?? '• English (Fluent)\n• Filipino (Native)\n• Cebuano (Native)' }}</textarea>
                        <div class="edit-hint">Click to edit languages</div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-3">
                <!-- Educational Background Section -->
                <div>
                    <h2 class="section-header">Education</h2>
                    
                    <!-- Tertiary Education -->
                    <div class="education-item">
                        <div class="editable-field" data-field="institution" data-type="text">
                            <div class="institution field-display">{{ $resumeContent['institution'] ?? 'University of Science and Technology of Southern Philippines' }}</div>
                            <input type="text" class="edit-input hidden" value="{{ $resumeContent['institution'] ?? 'University of Science and Technology of Southern Philippines' }}">
                            <div class="edit-hint">Click to edit institution</div>
                        </div>
                        <div class="editable-field" data-field="program" data-type="text">
                            <div class="degree field-display">{{ $resumeContent['program'] ?? $graduate->program ?? 'Bachelor of Science in Information Technology' }}</div>
                            <input type="text" class="edit-input hidden" value="{{ $resumeContent['program'] ?? $graduate->program ?? 'Bachelor of Science in Information Technology' }}">
                            <div class="edit-hint">Click to edit degree</div>
                        </div>
                        <div class="editable-field" data-field="graduation_year" data-type="text">
                            <div class="period field-display">
                                {{ $resumeContent['graduation_year'] ?? ($graduate->graduation_date ? \Carbon\Carbon::parse($graduate->graduation_date)->format('Y') : ($graduate->batch_year ?? date('Y'))) }}
                                @if($resumeContent['student_id'] ?? $graduate->student_id)
                                    | ID: {{ $resumeContent['student_id'] ?? $graduate->student_id }}
                                @endif
                            </div>
                            <input type="text" class="edit-input hidden" value="{{ $resumeContent['graduation_year'] ?? ($graduate->graduation_date ? \Carbon\Carbon::parse($graduate->graduation_date)->format('Y') : ($graduate->batch_year ?? date('Y'))) }}">
                            <div class="edit-hint">Click to edit graduation year</div>
                        </div>
                    </div>
                    
                    <!-- Secondary Education -->
                    <div class="education-item">
                        <div class="institution">USTP High School</div>
                        <div class="degree">Secondary Education</div>
                        <div class="period">2015 - 2019</div>
                    </div>
                </div>

                <!-- Employment History Section -->
                <div>
                    <h2 class="section-header">Experience</h2>
                    
                    @if($graduate->is_employed && $graduate->current_position)
                    <div class="employment-item">
                        <div class="editable-field" data-field="current_company" data-type="text">
                            <div class="company field-display">{{ $resumeContent['current_company'] ?? $graduate->current_company ?? 'Company Name' }}</div>
                            <input type="text" class="edit-input hidden" value="{{ $resumeContent['current_company'] ?? $graduate->current_company ?? 'Company Name' }}">
                            <div class="edit-hint">Click to edit company</div>
                        </div>
                        <div class="editable-field" data-field="current_position" data-type="text">
                            <div class="position field-display">{{ $resumeContent['current_position'] ?? $graduate->current_position }}</div>
                            <input type="text" class="edit-input hidden" value="{{ $resumeContent['current_position'] ?? $graduate->current_position }}">
                            <div class="edit-hint">Click to edit position</div>
                        </div>
                        <div class="editable-field" data-field="employment_period" data-type="text">
                            <div class="period field-display">
                                {{ $resumeContent['employment_period'] ?? ($graduate->employment_start_date ? \Carbon\Carbon::parse($graduate->employment_start_date)->format('M Y') . ' - Present' : 'Current') }}
                            </div>
                            <input type="text" class="edit-input hidden" value="{{ $resumeContent['employment_period'] ?? ($graduate->employment_start_date ? \Carbon\Carbon::parse($graduate->employment_start_date)->format('M Y') . ' - Present' : 'Current') }}">
                            <div class="edit-hint">Click to edit employment period</div>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Sample Employment Entry -->
                    <div class="employment-item">
                        <div class="company">Tech Solutions Inc.</div>
                        <div class="position">Project Coordinator</div>
                        <div class="period">Jun 2020 - Aug 2022</div>
                    </div>
                </div>

                <!-- References Section -->
                <div>
                    <h2 class="section-header">References</h2>
                    <div class="editable-field" data-field="references" data-type="textarea">
                        <div class="field-display text-xs text-gray-700">
                            {{ $resumeContent['references'] ?? 'Available upon request' }}
                        </div>
                        <textarea class="edit-input hidden" rows="3">{{ $resumeContent['references'] ?? 'Available upon request' }}</textarea>
                        <div class="edit-hint">Click to edit references</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let isEditMode = false;
        let originalValues = {};

        function toggleEditMode() {
            isEditMode = !isEditMode;
            const editBtn = document.getElementById('editBtn');
            const saveBtn = document.getElementById('saveBtn');
            const editableFields = document.querySelectorAll('.editable-field');

            if (isEditMode) {
                editBtn.innerHTML = '<i class="fas fa-times mr-1"></i>Cancel';
                editBtn.className = 'bg-red-600 text-white px-3 py-1 rounded text-sm shadow-lg hover:bg-red-700 transition-colors';
                saveBtn.classList.remove('hidden');
                
                // Store original values
                editableFields.forEach(field => {
                    const fieldName = field.dataset.field;
                    const displayElement = field.querySelector('.field-display');
                    originalValues[fieldName] = displayElement.textContent.trim();
                });
            } else {
                editBtn.innerHTML = '<i class="fas fa-edit mr-1"></i>Edit';
                editBtn.className = 'bg-purple-600 text-white px-3 py-1 rounded text-sm shadow-lg hover:bg-purple-700 transition-colors';
                saveBtn.classList.add('hidden');
                
                // Hide all edit inputs
                document.querySelectorAll('.edit-input').forEach(input => {
                    input.classList.add('hidden');
                });
                document.querySelectorAll('.field-display').forEach(display => {
                    display.classList.remove('hidden');
                });
                document.querySelectorAll('.editable-field').forEach(field => {
                    field.classList.remove('editing');
                });
            }
        }

        function saveResume() {
            const formData = new FormData();
            const editableFields = document.querySelectorAll('.editable-field');

            editableFields.forEach(field => {
                const fieldName = field.dataset.field;
                const input = field.querySelector('.edit-input');
                if (input && input.value.trim()) {
                    formData.append(fieldName, input.value.trim());
                }
            });

            // Add CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formData.append('_token', csrfToken);

            fetch(`/graduate/resume/{{ $resume->id }}/update`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Resume updated successfully!', 'success');
                    updateDisplayValues(formData);
                    toggleEditMode();
                } else {
                    showNotification(data.message || 'Error updating resume', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error updating resume. Please try again.', 'error');
            });
        }

        function updateDisplayValues(formData) {
            const editableFields = document.querySelectorAll('.editable-field');
            
            editableFields.forEach(field => {
                const fieldName = field.dataset.field;
                const value = formData.get(fieldName);
                
                if (value) {
                    const displayElement = field.querySelector('.field-display');
                    const inputElement = field.querySelector('.edit-input');
                    
                    displayElement.textContent = value;
                    
                    if (inputElement) {
                        inputElement.value = value;
                    }
                }
            });
        }

        function uploadProfilePicture(input) {
            if (input.files && input.files[0]) {
                const formData = new FormData();
                formData.append('profile_picture', input.files[0]);
                
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                formData.append('_token', csrfToken);

                fetch('/graduate/profile/picture', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('profile-image').src = data.profile_picture_url;
                        showNotification('Profile picture updated successfully!', 'success');
                    } else {
                        showNotification(data.message || 'Error uploading profile picture', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error uploading profile picture. Please try again.', 'error');
                });
            }
        }

        function printResume() {
            window.print();
        }

        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 left-1/2 transform -translate-x-1/2 z-50 px-4 py-2 rounded text-sm shadow-lg ${
                type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
            }`;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Add event listeners for editable fields
        document.addEventListener('DOMContentLoaded', function() {
            const editableFields = document.querySelectorAll('.editable-field');
            
            editableFields.forEach(field => {
                field.addEventListener('click', function() {
                    if (isEditMode) {
                        const displayElement = this.querySelector('.field-display');
                        const inputElement = this.querySelector('.edit-input');
                        
                        if (displayElement && inputElement) {
                            displayElement.classList.add('hidden');
                            inputElement.classList.remove('hidden');
                            this.classList.add('editing');
                            inputElement.focus();
                        }
                    }
                });
                
                const inputElement = field.querySelector('.edit-input');
                if (inputElement) {
                    inputElement.addEventListener('blur', function() {
                        const field = this.closest('.editable-field');
                        const displayElement = field.querySelector('.field-display');
                        
                        displayElement.classList.remove('hidden');
                        this.classList.add('hidden');
                        field.classList.remove('editing');
                    });
                    
                    inputElement.addEventListener('keydown', function(e) {
                        if (e.key === 'Enter' && this.tagName !== 'TEXTAREA') {
                            this.blur();
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
