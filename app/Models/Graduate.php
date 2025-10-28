<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Graduate extends Model
{
    protected $fillable = [
        'user_id',
        'student_id',
        'program',
        'batch_year',
        'graduation_date',
        'graduation_year',
        'phone',
        'address',
        'linkedin_profile',
        'bio',
        'profile_picture',
        'is_employed',
        'current_position',
        'current_company',
        'employment_start_date',
        'salary',
        'verification_status',
        'verification_notes',
        // Status and career fields
        'current_status',
        'employment_type',
        'employment_sector',
        'job_level',
        'job_description',
        'work_location',
        'is_remote_work',
        'education_level',
        'pursuing_degree',
        'institution_name',
        'expected_graduation',
        'career_goals',
        'skills',
        'interests',
        // Personal Information
        'first_name',
        'last_name',
        'middle_name',
        'middle_initial',
        'extension',
        'gender',
        'birth_date',
        'place_of_birth',
        'civil_status',
        'nationality',
        'religion',
        'blood_type',
        // Family Information
        'father_name',
        'mother_name',
        // Address Information
        'present_address',
        'municipality_city',
        'province_region',
        'barangay',
        'zip_code',
        'permanent_address',
        'permanent_city',
        'permanent_province',
        'permanent_barangay',
        'permanent_zip_code',
    ];

    protected $casts = [
        'graduation_date' => 'date',
        'employment_start_date' => 'date',
        'is_employed' => 'boolean',
        'salary' => 'decimal:2',
        'birth_date' => 'date',
        'age' => 'decimal:2',
        'expected_graduation' => 'date',
        'is_remote_work' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function employmentRecords(): HasMany
    {
        return $this->hasMany(EmploymentRecord::class);
    }

    public function resumes(): HasMany
    {
        return $this->hasMany(Resume::class);
    }

    public function alumniMemberships(): HasMany
    {
        return $this->hasMany(AlumniMembership::class);
    }

    public function graduationApplications(): HasMany
    {
        return $this->hasMany(GraduationApplication::class);
    }

    public function activeMembership()
    {
        return $this->hasOne(AlumniMembership::class)->where('status', 'verified')
                    ->where('membership_end_date', '>=', now()->toDateString());
    }

    // Accessors for status labels
    public function getCurrentStatusLabelAttribute()
    {
        return match($this->current_status) {
            'undergraduate' => 'Undergraduate Student',
            'graduate' => 'Graduate',
            'employed' => 'Employed',
            'unemployed' => 'Unemployed',
            'pursuing_higher_education' => 'Pursuing Higher Education',
            'self_employed' => 'Self-Employed',
            default => ucfirst($this->current_status ?? 'Graduate')
        };
    }

    public function getEmploymentTypeLabelAttribute()
    {
        return match($this->employment_type) {
            'full_time' => 'Full-time',
            'part_time' => 'Part-time',
            'contract' => 'Contract',
            'freelance' => 'Freelance',
            'internship' => 'Internship',
            'self_employed' => 'Self-employed',
            default => ucfirst($this->employment_type ?? '')
        };
    }

    public function getJobLevelLabelAttribute()
    {
        return match($this->job_level) {
            'entry' => 'Entry Level',
            'mid' => 'Mid Level',
            'senior' => 'Senior Level',
            'executive' => 'Executive',
            'manager' => 'Manager',
            'director' => 'Director',
            default => ucfirst($this->job_level ?? '')
        };
    }

    public function getEducationLevelLabelAttribute()
    {
        return match($this->education_level) {
            'bachelor' => 'Bachelor\'s Degree',
            'master' => 'Master\'s Degree',
            'doctorate' => 'Doctorate',
            'certificate' => 'Certificate',
            'diploma' => 'Diploma',
            default => ucfirst($this->education_level ?? '')
        };
    }
}
