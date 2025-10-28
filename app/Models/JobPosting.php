<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobPosting extends Model
{
    protected $fillable = [
        'posted_by',
        'title',
        'description',
        'company',
        'location',
        'employment_type',
        'salary_min',
        'salary_max',
        'requirements',
        'benefits',
        'application_deadline',
        'status',
        'rejection_reason',
        'reviewed_by',
        'reviewed_at',
        'is_active',
        'views_count',
    ];

    protected $casts = [
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2',
        'application_deadline' => 'date',
        'reviewed_at' => 'datetime',
        'is_active' => 'boolean',
        'views_count' => 'integer',
    ];

    public function postedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
