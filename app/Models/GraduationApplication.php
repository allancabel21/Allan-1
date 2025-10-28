<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GraduationApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'graduate_id',
        'application_type',
        'major_in',
        'campus',
        'city_province',
        'college_unit_department',
        'last_semester',
        'school_year',
        'subject_load',
        'diploma_name',
        'diploma_address',
        'diploma_contact',
        'status',
        'notes',
        'approved_by',
        'approved_at',
    ];

    protected $casts = [
        'subject_load' => 'array',
        'approved_at' => 'datetime',
    ];

    public function graduate()
    {
        return $this->belongsTo(Graduate::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'pending' => 'Pending',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
            default => 'Unknown'
        };
    }

    public function getApplicationTypeLabelAttribute()
    {
        return match($this->application_type) {
            'degree' => 'Degree of',
            'diploma' => 'Diploma in',
            default => 'Unknown'
        };
    }

    public function getLastSemesterLabelAttribute()
    {
        return match($this->last_semester) {
            'semester' => 'Semester',
            'summer' => 'Summer',
            default => 'Unknown'
        };
    }
}