<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class AlumniMembership extends Model
{
    protected $fillable = [
        'graduate_id',
        'membership_type',
        'amount',
        'payment_method',
        'payment_reference',
        'payment_proof',
        'status',
        'membership_start_date',
        'membership_end_date',
        'notes',
        'payment_date',
        'verified_at',
        'verified_by',
        
        // Personal Information
        'full_name',
        'student_id',
        'course_degree',
        'batch_year',
        'date_of_birth',
        'gender',
        'contact_number',
        'email_address',
        'address',
        
        // Professional Information
        'current_occupation',
        'company_organization',
        'position_job_title',
        'industry',
        'work_address',
        'years_experience',
        
        // Additional Details
        'skills_expertise',
        'achievements_awards',
        'volunteer_mentor',
        'preferred_activities',
        'membership_reason',
    ];

    protected $casts = [
        'membership_start_date' => 'date',
        'membership_end_date' => 'date',
        'amount' => 'decimal:2',
        'payment_date' => 'datetime',
        'verified_at' => 'datetime',
        'date_of_birth' => 'date',
        'preferred_activities' => 'array',
    ];

    // Relationships
    public function graduate(): BelongsTo
    {
        return $this->belongsTo(Graduate::class);
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'verified')
                    ->where('membership_end_date', '>=', now()->toDateString());
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    public function scopeVerified($query)
    {
        return $query->where('status', 'verified');
    }

    public function scopeExpired($query)
    {
        return $query->where('membership_end_date', '<', now()->toDateString());
    }

    public function scopeByType($query, $type)
    {
        return $query->where('membership_type', $type);
    }

    // Accessors
    public function getFormattedAmountAttribute()
    {
        return '₱' . number_format($this->amount, 2);
    }

    public function getMembershipTypeLabelAttribute()
    {
        return match($this->membership_type) {
            'lifetime' => 'Lifetime Membership',
            'yearbook' => 'Yearbook Subscription',
            default => ucfirst($this->membership_type) . ' Membership'
        };
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'pending' => 'Pending Payment',
            'paid' => 'Payment Received',
            'verified' => 'Active',
            'expired' => 'Expired',
            'cancelled' => 'Cancelled',
            default => ucfirst($this->status)
        };
    }

    public function getPaymentMethodLabelAttribute()
    {
        return match($this->payment_method) {
            'gcash' => 'GCash',
            'paymaya' => 'PayMaya',
            'bank_transfer' => 'Bank Transfer',
            'cash' => 'Cash',
            'other' => 'Other',
            default => ucfirst($this->payment_method ?? 'Not specified')
        };
    }

    public function getIsActiveAttribute()
    {
        return $this->status === 'verified' && $this->membership_end_date >= now()->toDateString();
    }

    public function getIsExpiredAttribute()
    {
        return $this->membership_end_date < now()->toDateString();
    }

    public function getDaysRemainingAttribute()
    {
        if ($this->is_expired) {
            return 0;
        }
        
        return now()->diffInDays($this->membership_end_date, false);
    }

    public function getFormattedMembershipPeriodAttribute()
    {
        return $this->membership_start_date->format('M d, Y') . ' - ' . $this->membership_end_date->format('M d, Y');
    }

    // Methods
    public function isActive()
    {
        return $this->is_active;
    }

    public function isExpired()
    {
        return $this->is_expired;
    }

    public function canRenew()
    {
        return $this->is_expired || $this->days_remaining <= 30;
    }

    public function getMembershipBenefits()
    {
        return match($this->membership_type) {
            'lifetime' => [
                'All premium benefits',
                'Lifetime access to all services',
                'VIP event access',
                'Alumni board voting rights',
                'Exclusive alumni merchandise',
                'Priority support'
            ],
            'yearbook' => [
                'Latest yearbook edition',
                'Alumni directory access',
                'Professional photos',
                'Graduation memories',
                'Networking opportunities',
                'Access to exclusive content'
            ],
            default => []
        };
    }

    // Static methods
    public static function getMembershipPricing()
    {
        return [
            'lifetime' => [
                'amount' => 1000.00,
                'duration' => 36500, // 100 years
                'description' => 'Lifetime membership with all benefits'
            ],
            'yearbook' => [
                'amount' => 3000.00,
                'duration' => 0, // One-time purchase
                'description' => 'Yearbook subscription and alumni directory access'
            ]
        ];
    }
}