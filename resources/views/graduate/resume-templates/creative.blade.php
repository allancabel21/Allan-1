<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $graduate->first_name ?? 'Graduate' }} {{ $graduate->last_name ?? 'Resume' }} - Creative Resume</title>
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
        
        .creative-header {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            position: relative;
            overflow: hidden;
        }
        
        .geometric-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }
        
        .shape-1 {
            position: absolute;
            top: -50px;
            left: -50px;
            width: 200px;
            height: 200px;
            background: linear-gradient(45deg, #06b6d4, #0891b2);
            border-radius: 50%;
            opacity: 0.3;
        }
        
        .shape-2 {
            position: absolute;
            top: 100px;
            left: 50px;
            width: 150px;
            height: 150px;
            background: linear-gradient(45deg, #0891b2, #0e7490);
            border-radius: 50%;
            opacity: 0.2;
        }
        
        .shape-3 {
            position: absolute;
            top: 50px;
            right: 100px;
            width: 100px;
            height: 100px;
            background: linear-gradient(45deg, #06b6d4, #0891b2);
            border-radius: 50%;
            opacity: 0.25;
        }
        
        .section-header {
            background: #1e3a8a;
            color: white;
            padding: 8px 12px;
            font-weight: 700;
            font-size: 11px;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .section-content {
            background: white;
            padding: 12px;
            border-left: 3px solid #1e3a8a;
        }
        
        .profile-picture {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 4px;
            font-size: 11px;
        }
        
        .contact-item i {
            width: 12px;
            text-align: center;
        }
        
        .skill-item {
            background: #f8fafc;
            padding: 4px 8px;
            border-radius: 4px;
            margin-bottom: 4px;
            font-size: 10px;
            border-left: 2px solid #1e3a8a;
        }
        
        .work-item {
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .work-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        
        .work-date {
            color: #6b7280;
            font-size: 9px;
            font-weight: 500;
            margin-bottom: 2px;
        }
        
        .work-company {
            color: #1e3a8a;
            font-weight: 600;
            font-size: 11px;
            margin-bottom: 1px;
        }
        
        .work-title {
            color: #111827;
            font-weight: 700;
            font-size: 12px;
            margin-bottom: 4px;
        }
        
        .work-description {
            color: #4b5563;
            font-size: 10px;
            line-height: 1.3;
        }
        
        .reference-item {
            margin-bottom: 8px;
        }
        
        .reference-name {
            font-weight: 600;
            color: #111827;
            font-size: 11px;
        }
        
        .reference-title {
            color: #1e3a8a;
            font-size: 10px;
            margin-bottom: 2px;
        }
        
        .reference-contact {
            color: #6b7280;
            font-size: 9px;
        }
        
        .languages {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
        }
        
        .language-tag {
            background: #1e3a8a;
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: 500;
        }
        
        @media print {
            body { 
                margin: 0; 
                font-size: 9px;
                line-height: 1.1;
            }
            .no-print { display: none !important; }
            .container { 
                max-width: 100%;
                padding: 0.2in;
                margin: 0;
            }
            .creative-header {
                padding: 0.3in 0.2in;
            }
            .section-header {
                padding: 4px 8px;
                font-size: 9px;
            }
            .section-content {
                padding: 8px;
            }
            .profile-picture {
                width: 60px;
                height: 60px;
            }
            .contact-item {
                margin-bottom: 2px;
                font-size: 9px;
            }
            .skill-item {
                padding: 2px 6px;
                margin-bottom: 2px;
                font-size: 8px;
            }
            .work-item {
                margin-bottom: 6px;
                padding-bottom: 4px;
            }
            .work-date {
                font-size: 8px;
            }
            .work-company {
                font-size: 9px;
            }
            .work-title {
                font-size: 10px;
                margin-bottom: 2px;
            }
            .work-description {
                font-size: 8px;
                line-height: 1.2;
            }
            .reference-item {
                margin-bottom: 4px;
            }
            .reference-name {
                font-size: 9px;
            }
            .reference-title {
                font-size: 8px;
            }
            .reference-contact {
                font-size: 7px;
            }
            .language-tag {
                padding: 1px 6px;
                font-size: 7px;
            }
            h1 {
                font-size: 20px;
                margin-bottom: 4px;
            }
            .geometric-shapes {
                display: none;
            }
        }
        
        .editable-field {
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
        }
        
        .editable-field:hover {
            background-color: #f8fafc;
            border-radius: 4px;
            padding: 2px 4px;
        }
        
        .editable-field.editing {
            background-color: #eff6ff;
            border: 2px solid #3b82f6;
            border-radius: 4px;
            padding: 4px;
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
            top: -25px;
            left: 0;
            background: #1e3a8a;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 11px;
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
        <button id="editBtn" onclick="toggleEditMode()" class="bg-purple-600 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-purple-700 transition-colors">
            <i class="fas fa-edit mr-2"></i>Edit Resume
        </button>
        <button id="saveBtn" onclick="saveResume()" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-green-700 transition-colors hidden">
            <i class="fas fa-save mr-2"></i>Save Changes
        </button>
        <button onclick="window.print()" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-blue-700 transition-colors">
            <i class="fas fa-print mr-2"></i>Print
        </button>
        <button onclick="downloadPDF()" class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-indigo-700 transition-colors">
            <i class="fas fa-download mr-2"></i>Download PDF
        </button>
        <button onclick="window.close()" class="bg-gray-600 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-gray-700 transition-colors">
            <i class="fas fa-times mr-2"></i>Close
        </button>
    </div>

    @php
        $resumeContent = json_decode($resume->content ?? '{}', true);
        
        // Ensure all content fields are strings to prevent explode() errors
        $stringFields = ['skills', 'software', 'languages', 'work_experience', 'education', 'references', 'bio'];
        foreach ($stringFields as $field) {
            if (isset($resumeContent[$field]) && !is_string($resumeContent[$field])) {
                $resumeContent[$field] = is_array($resumeContent[$field]) ? implode("\n", $resumeContent[$field]) : (string) $resumeContent[$field];
            }
        }
    @endphp

    <div class="max-w-4xl mx-auto bg-white shadow-2xl">
        <!-- Header Section -->
        <div class="creative-header p-4 relative">
            <div class="geometric-shapes">
                <div class="shape-1"></div>
                <div class="shape-2"></div>
                <div class="shape-3"></div>
            </div>
            
            <div class="relative z-10 flex items-center gap-4">
                <!-- Profile Picture -->
                <div class="flex-shrink-0">
                    <img src="{{ $graduate->profile_picture ? asset('storage/' . $graduate->profile_picture) : asset('images/default-avatar.svg') }}" 
                         alt="Profile Picture" 
                         class="profile-picture">
                </div>
                
                <!-- Name and Contact Info -->
                <div class="flex-1 text-white">
                    <div class="mb-2">
                        <div class="contact-item">
                            <i class="fas fa-briefcase"></i>
                            <div class="editable-field" data-field="current_position" data-type="text">
                                <span class="field-display">{{ $graduate->current_position ?? 'Graduate' }}</span>
                                <input type="text" class="edit-input hidden" value="{{ $graduate->current_position ?? 'Graduate' }}">
                                <div class="edit-hint">Click to edit position</div>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <div class="editable-field" data-field="contact_number" data-type="text">
                                <span class="field-display">{{ $graduate->contact_number ?? '+123 456 7890' }}</span>
                                <input type="text" class="edit-input hidden" value="{{ $graduate->contact_number ?? '+123 456 7890' }}">
                                <div class="edit-hint">Click to edit phone</div>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <div class="editable-field" data-field="email" data-type="text">
                                <span class="field-display">{{ $graduate->user->email ?? 'email@example.com' }}</span>
                                <input type="text" class="edit-input hidden" value="{{ $graduate->user->email ?? 'email@example.com' }}">
                                <div class="edit-hint">Click to edit email</div>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fab fa-linkedin"></i>
                            <div class="editable-field" data-field="linkedin_profile" data-type="text">
                                <span class="field-display">{{ $graduate->linkedin_profile ?? 'LinkedIn Profile' }}</span>
                                <input type="text" class="edit-input hidden" value="{{ $graduate->linkedin_profile ?? 'LinkedIn Profile' }}">
                                <div class="edit-hint">Click to edit LinkedIn</div>
                            </div>
                        </div>
                    </div>
                    
                    <h1 class="text-2xl font-black uppercase tracking-wide leading-tight">
                        <div class="editable-field" data-field="first_name" data-type="text">
                            <span class="field-display">{{ strtoupper($graduate->first_name ?? 'First') }}</span>
                            <input type="text" class="edit-input hidden" value="{{ $graduate->first_name ?? 'First' }}">
                            <div class="edit-hint">Click to edit first name</div>
                        </div><br>
                        <div class="editable-field" data-field="last_name" data-type="text">
                            <span class="field-display">{{ strtoupper($graduate->last_name ?? 'Last') }}</span>
                            <input type="text" class="edit-input hidden" value="{{ $graduate->last_name ?? 'Last' }}">
                            <div class="edit-hint">Click to edit last name</div>
                        </div>
                    </h1>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex">
            <!-- Left Column -->
            <div class="w-1/3 bg-gray-50">
                <!-- Profile Section -->
                <div class="mb-3">
                    <div class="section-header">
                        <i class="fas fa-user"></i>
                        <span>PROFILE</span>
                    </div>
                    <div class="section-content">
                        <div class="editable-field" data-field="bio" data-type="textarea">
                            <p class="text-xs text-gray-700 leading-relaxed field-display">
                                {{ $resumeContent['bio'] ?? $graduate->bio ?? 'Experienced professional with a strong background in technology and project management. Passionate about delivering high-quality solutions and driving innovation in dynamic environments.' }}
                            </p>
                            <textarea class="edit-input hidden" rows="3">{{ $resumeContent['bio'] ?? $graduate->bio ?? 'Experienced professional with a strong background in technology and project management. Passionate about delivering high-quality solutions and driving innovation in dynamic environments.' }}</textarea>
                            <div class="edit-hint">Click to edit profile</div>
                        </div>
                    </div>
                </div>

                <!-- Skills Section -->
                <div class="mb-3">
                    <div class="section-header">
                        <i class="fas fa-cogs"></i>
                        <span>SKILLS</span>
                    </div>
                    <div class="section-content">
                        <div class="editable-field" data-field="skills" data-type="textarea">
                            <div class="field-display">
                                @if(isset($resumeContent['skills']) && $resumeContent['skills'] && is_string($resumeContent['skills']))
                                    @foreach(explode("\n", $resumeContent['skills']) as $skill)
                                        @if(trim($skill))
                                            <div class="skill-item">{{ trim($skill) }}</div>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="skill-item">Project Management</div>
                                    <div class="skill-item">Resource Coordination</div>
                                    <div class="skill-item">Team Leadership</div>
                                    <div class="skill-item">Strategic Planning</div>
                                    <div class="skill-item">Problem Solving</div>
                                    <div class="skill-item">Communication</div>
                                @endif
                            </div>
                            <textarea class="edit-input hidden" rows="4" placeholder="💼 SKILLS FORMAT: One skill per line

EXAMPLE:
Project Management
Resource Coordination
Team Leadership
Strategic Planning
Problem Solving
Communication
Time Management
Critical Thinking

INSTRUCTIONS:
• Write one skill per line
• Be specific and relevant
• Use action words when possible">{{ $resumeContent['skills'] ?? 'Project Management
Resource Coordination
Team Leadership
Strategic Planning
Problem Solving
Communication' }}</textarea>
                            <div class="edit-hint">Click to edit skills</div>
                        </div>
                    </div>
                </div>

                <!-- Software Section -->
                <div class="mb-3">
                    <div class="section-header">
                        <i class="fas fa-desktop"></i>
                        <span>SOFTWARE</span>
                    </div>
                    <div class="section-content">
                        <div class="editable-field" data-field="software" data-type="textarea">
                            <div class="field-display">
                                @if(isset($resumeContent['software']) && $resumeContent['software'] && is_string($resumeContent['software']))
                                    @foreach(explode("\n", $resumeContent['software']) as $software)
                                        @if(trim($software))
                                            <div class="skill-item">{{ trim($software) }}</div>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="skill-item">MS Office Suite</div>
                                    <div class="skill-item">Microsoft OneNote</div>
                                    <div class="skill-item">Kronos Workforce</div>
                                    <div class="skill-item">Project Management Tools</div>
                                    <div class="skill-item">Data Analysis Software</div>
                                @endif
                            </div>
                            <textarea class="edit-input hidden" rows="3" placeholder="💻 SOFTWARE FORMAT: One software per line

EXAMPLE:
MS Office Suite
Microsoft OneNote
Kronos Workforce
Project Management Tools
Data Analysis Software
Adobe Creative Suite
Google Workspace

INSTRUCTIONS:
• Write one software/tool per line
• Include proficiency level if relevant
• Be specific about versions when important">{{ $resumeContent['software'] ?? 'MS Office Suite
Microsoft OneNote
Kronos Workforce
Project Management Tools
Data Analysis Software' }}</textarea>
                            <div class="edit-hint">Click to edit software</div>
                        </div>
                    </div>
                </div>

                <!-- Languages Section -->
                <div class="mb-3">
                    <div class="section-header">
                        <i class="fas fa-comments"></i>
                        <span>LANGUAGES</span>
                    </div>
                    <div class="section-content">
                        <div class="editable-field" data-field="languages" data-type="textarea">
                            <div class="field-display">
                                <div class="languages">
                                @if(isset($resumeContent['languages']) && $resumeContent['languages'] && is_string($resumeContent['languages']))
                                    @foreach(explode("\n", $resumeContent['languages']) as $language)
                                        @if(trim($language))
                                            <span class="language-tag">{{ trim($language) }}</span>
                                        @endif
                                    @endforeach
                                    @else
                                        <span class="language-tag">English</span>
                                        <span class="language-tag">Filipino</span>
                                        <span class="language-tag">Cebuano</span>
                                    @endif
                                </div>
                            </div>
                            <textarea class="edit-input hidden" rows="2" placeholder="🗣️ LANGUAGES FORMAT: One language per line

EXAMPLE:
English
Filipino
Cebuano
Spanish
Japanese

INSTRUCTIONS:
• Write one language per line
• Include proficiency level if relevant (e.g., English - Fluent)
• List all languages you can speak">{{ $resumeContent['languages'] ?? 'English
Filipino
Cebuano' }}</textarea>
                            <div class="edit-hint">Click to edit languages</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="w-2/3">
                <!-- Work Experience Section -->
                <div class="mb-3">
                    <div class="section-header">
                        <i class="fas fa-briefcase"></i>
                        <span>WORK EXPERIENCE</span>
                    </div>
                    <div class="section-content">
                        <div class="editable-field" data-field="work_experience" data-type="textarea">
                            <div class="field-display">
                                @if(isset($resumeContent['work_experience']) && $resumeContent['work_experience'] && is_string($resumeContent['work_experience']))
                                    @php
                                        $entries = explode("\n\n", $resumeContent['work_experience']);
                                    @endphp
                                    @foreach($entries as $entry)
                                        @php
                                            $lines = array_filter(array_map('trim', explode("\n", $entry)));
                                        @endphp
                                        @if(count($lines) >= 3)
                                            <div class="work-item">
                                                <div class="work-date">{{ $lines[0] ?? '' }}</div>
                                                <div class="work-company">{{ $lines[1] ?? '' }}</div>
                                                <div class="work-title">{{ $lines[2] ?? '' }}</div>
                                                <div class="work-description">{{ implode(' ', array_slice($lines, 3)) }}</div>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    @if($graduate->is_employed && $graduate->current_position)
                                    <div class="work-item">
                                        <div class="work-date">
                                            @if($graduate->employment_start_date)
                                                {{ \Carbon\Carbon::parse($graduate->employment_start_date)->format('m/Y') }} - Present
                                            @else
                                                Current
                                            @endif
                                        </div>
                                        <div class="work-company">{{ $graduate->current_company ?? 'Company Name' }}</div>
                                        <div class="work-title">{{ $graduate->current_position }}</div>
                                        <div class="work-description">
                                            {{ $graduate->bio ?? 'Leading projects and managing teams to deliver exceptional results. Responsible for strategic planning, resource allocation, and ensuring project success.' }}
                                        </div>
                                    </div>
                                    @endif

                                    <!-- Sample work experience entries -->
                                    <div class="work-item">
                                        <div class="work-date">06/2020 - 08/2022</div>
                                        <div class="work-company">Tech Solutions Inc., Cagayan de Oro</div>
                                        <div class="work-title">Project Coordinator</div>
                                        <div class="work-description">
                                            Coordinated multiple projects simultaneously, ensuring timely delivery and quality standards. Managed cross-functional teams and maintained effective communication with stakeholders.
                                        </div>
                                    </div>

                                    <div class="work-item">
                                        <div class="work-date">01/2019 - 05/2020</div>
                                        <div class="work-company">Digital Agency, Manila</div>
                                        <div class="work-title">Junior Developer</div>
                                        <div class="work-description">
                                            Developed and maintained web applications using modern technologies. Collaborated with senior developers to implement new features and improve system performance.
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <textarea class="edit-input hidden" rows="8" placeholder="📝 FORMAT: Each job on separate lines, separated by blank line

EXAMPLE:
06/2020 - 08/2022
Tech Solutions Inc., Cagayan de Oro
Project Coordinator
Coordinated multiple projects simultaneously, ensuring timely delivery and quality standards. Managed cross-functional teams and maintained effective communication with stakeholders.

01/2019 - 05/2020
Digital Agency, Manila
Junior Developer
Developed and maintained web applications using modern technologies. Collaborated with senior developers to implement new features and improve system performance.

INSTRUCTIONS:
• Line 1: Date (e.g., 06/2020 - 08/2022 or Current)
• Line 2: Company Name, Location
• Line 3: Job Title
• Line 4+: Description of responsibilities and achievements
• Leave blank line between different jobs">{{ $resumeContent['work_experience'] ?? '06/2020 - 08/2022
Tech Solutions Inc., Cagayan de Oro
Project Coordinator
Coordinated multiple projects simultaneously, ensuring timely delivery and quality standards. Managed cross-functional teams and maintained effective communication with stakeholders.

01/2019 - 05/2020
Digital Agency, Manila
Junior Developer
Developed and maintained web applications using modern technologies. Collaborated with senior developers to implement new features and improve system performance.' }}</textarea>
                            <div class="edit-hint">Click to edit work experience</div>
                        </div>
                    </div>
                </div>

                <!-- Education Section -->
                <div class="mb-3">
                    <div class="section-header">
                        <i class="fas fa-graduation-cap"></i>
                        <span>EDUCATION</span>
                    </div>
                    <div class="section-content">
                        <div class="editable-field" data-field="education" data-type="textarea">
                            <div class="field-display">
                                @if(isset($resumeContent['education']) && $resumeContent['education'] && is_string($resumeContent['education']))
                                    @php
                                        $entries = explode("\n\n", $resumeContent['education']);
                                    @endphp
                                    @foreach($entries as $entry)
                                        @php
                                            $lines = array_filter(array_map('trim', explode("\n", $entry)));
                                        @endphp
                                        @if(count($lines) >= 3)
                                            <div class="work-item">
                                                <div class="work-date">{{ $lines[0] ?? '' }}</div>
                                                <div class="work-company">{{ $lines[1] ?? '' }}</div>
                                                <div class="work-title">{{ $lines[2] ?? '' }}</div>
                                                <div class="work-description">{{ implode(' ', array_slice($lines, 3)) }}</div>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="work-item">
                                        <div class="work-date">
                                            @if($graduate->graduation_date)
                                                {{ \Carbon\Carbon::parse($graduate->graduation_date)->format('Y') }}
                                            @else
                                                {{ $graduate->batch_year ?? date('Y') }}
                                            @endif
                                        </div>
                                        <div class="work-company">University of Science and Technology of Southern Philippines</div>
                                        <div class="work-title">{{ $graduate->program ?? 'Bachelor of Science in Information Technology' }}</div>
                                        <div class="work-description">
                                            Student ID: {{ $graduate->student_id ?? 'N/A' }}<br>
                                            Batch: {{ $graduate->batch_year ?? date('Y') }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <textarea class="edit-input hidden" rows="5" placeholder="📚 FORMAT: Each education entry on separate lines, separated by blank line

EXAMPLE:
2023
University of Science and Technology of Southern Philippines
Bachelor of Science in Information Technology
Student ID: 2020-12345
Batch: 2023

2019
USTP High School
Secondary Education
Graduated with honors

INSTRUCTIONS:
• Line 1: Year (e.g., 2023)
• Line 2: Institution Name
• Line 3: Degree/Program
• Line 4+: Additional details (Student ID, Batch, etc.)
• Leave blank line between different education entries">{{ $resumeContent['education'] ?? '2023
University of Science and Technology of Southern Philippines
Bachelor of Science in Information Technology
Student ID: ' . ($graduate->student_id ?? 'N/A') . '
Batch: ' . ($graduate->batch_year ?? date('Y')) }}</textarea>
                            <div class="edit-hint">Click to edit education</div>
                        </div>
                    </div>
                </div>

                <!-- References Section -->
                <div class="mb-3">
                    <div class="section-header">
                        <i class="fas fa-phone"></i>
                        <span>REFERENCES</span>
                    </div>
                    <div class="section-content">
                        <div class="editable-field" data-field="references" data-type="textarea">
                            <div class="field-display">
                                @if(isset($resumeContent['references']) && $resumeContent['references'] && is_string($resumeContent['references']))
                                    @php
                                        $entries = explode("\n\n", $resumeContent['references']);
                                    @endphp
                                    @foreach($entries as $entry)
                                        @php
                                            $lines = array_filter(array_map('trim', explode("\n", $entry)));
                                        @endphp
                                        @if(count($lines) >= 3)
                                            <div class="reference-item">
                                                <div class="reference-name">{{ $lines[0] ?? '' }}</div>
                                                <div class="reference-title">{{ $lines[1] ?? '' }}</div>
                                                <div class="reference-contact">{{ $lines[2] ?? '' }}</div>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="reference-item">
                                        <div class="reference-name">Dr. Maria Santos</div>
                                        <div class="reference-title">Professor, USTP</div>
                                        <div class="reference-contact">+63 912 345 6789 • maria.santos@ustp.edu.ph</div>
                                    </div>
                                    <div class="reference-item">
                                        <div class="reference-name">John Michael Reyes</div>
                                        <div class="reference-title">Senior Developer, Tech Corp</div>
                                        <div class="reference-contact">+63 917 123 4567 • john.reyes@techcorp.com</div>
                                    </div>
                                @endif
                            </div>
                            <textarea class="edit-input hidden" rows="6" placeholder="👥 FORMAT: Each reference on separate lines, separated by blank line

EXAMPLE:
Dr. Maria Santos
Professor, USTP
+63 912 345 6789 • maria.santos@ustp.edu.ph

John Michael Reyes
Senior Developer, Tech Corp
+63 917 123 4567 • john.reyes@techcorp.com

INSTRUCTIONS:
• Line 1: Full Name
• Line 2: Title, Company/Organization
• Line 3: Contact Information (Phone, Email)
• Leave blank line between different references">{{ $resumeContent['references'] ?? 'Dr. Maria Santos
Professor, USTP
+63 912 345 6789 • maria.santos@ustp.edu.ph

John Michael Reyes
Senior Developer, Tech Corp
+63 917 123 4567 • john.reyes@techcorp.com' }}</textarea>
                            <div class="edit-hint">Click to edit references</div>
                        </div>
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
                editBtn.innerHTML = '<i class="fas fa-times mr-2"></i>Cancel Edit';
                editBtn.className = 'bg-red-600 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-red-700 transition-colors';
                saveBtn.classList.remove('hidden');
                
                // Store original values
                editableFields.forEach(field => {
                    const fieldName = field.dataset.field;
                    const displayElement = field.querySelector('.field-display');
                    originalValues[fieldName] = displayElement.textContent.trim();
                });
            } else {
                editBtn.innerHTML = '<i class="fas fa-edit mr-2"></i>Edit Resume';
                editBtn.className = 'bg-purple-600 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-purple-700 transition-colors';
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
                    // Update display values
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
                    
                    if (fieldName === 'skills' || fieldName === 'software' || fieldName === 'languages') {
                        // Parse line-by-line for skills, software, languages
                        const lines = value.split('\n').filter(line => line.trim());
                        if (fieldName === 'languages') {
                            displayElement.innerHTML = `<div class="languages">${lines.map(line => `<span class="language-tag">${line.trim()}</span>`).join('')}</div>`;
                        } else {
                            displayElement.innerHTML = lines.map(line => `<div class="skill-item">${line.trim()}</div>`).join('');
                        }
                    } else if (fieldName === 'work_experience' || fieldName === 'education' || fieldName === 'references') {
                        // Parse structured content
                        const entries = value.split('\n\n');
                        let html = '';
                        
                        entries.forEach(entry => {
                            const lines = entry.split('\n').filter(line => line.trim());
                            if (lines.length >= 3) {
                                if (fieldName === 'references') {
                                    html += `<div class="reference-item">
                                        <div class="reference-name">${lines[0] || ''}</div>
                                        <div class="reference-title">${lines[1] || ''}</div>
                                        <div class="reference-contact">${lines[2] || ''}</div>
                                    </div>`;
                                } else {
                                    html += `<div class="work-item">
                                        <div class="work-date">${lines[0] || ''}</div>
                                        <div class="work-company">${lines[1] || ''}</div>
                                        <div class="work-title">${lines[2] || ''}</div>
                                        <div class="work-description">${lines.slice(3).join(' ')}</div>
                                    </div>`;
                                }
                            }
                        });
                        
                        displayElement.innerHTML = html;
                    } else {
                        // Simple text fields
                        displayElement.textContent = value;
                    }
                    
                    if (inputElement) {
                        inputElement.value = value;
                    }
                }
            });
        }

        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 left-1/2 transform -translate-x-1/2 z-50 px-6 py-3 rounded-lg shadow-lg ${
                type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
            }`;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        function downloadPDF() {
            // Create a new window for PDF generation
            const printWindow = window.open('', '_blank');
            const currentContent = document.documentElement.outerHTML;
            
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Resume - PDF</title>
                    <style>
                        @media print {
                            @page { margin: 0; size: A4; }
                            body { margin: 0; }
                            .no-print { display: none !important; }
                        }
                    </style>
                </head>
                <body>
                    ${currentContent}
                </body>
                </html>
            `);
            
            printWindow.document.close();
            printWindow.focus();
            
            // Wait for content to load then print
            setTimeout(() => {
                printWindow.print();
            }, 500);
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