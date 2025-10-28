<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Carbon\Carbon;

class AlumniActivity extends Model
{
    protected $fillable = [
        'title',
        'description',
        'type',
        'batch_year',
        'event_date',
        'start_time',
        'end_time',
        'location',
        'venue',
        'registration_fee',
        'max_participants',
        'current_participants',
        'requirements',
        'benefits',
        'contact_person',
        'contact_email',
        'contact_phone',
        'image',
        'status',
        'is_featured',
        'registration_deadline',
    ];

    protected $casts = [
        'event_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'registration_fee' => 'decimal:2',
        'registration_deadline' => 'datetime',
        'is_featured' => 'boolean',
    ];

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>=', now()->toDateString());
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByBatch($query, $batchYear)
    {
        return $query->where('batch_year', $batchYear);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Accessors
    public function getFormattedEventDateAttribute()
    {
        return $this->event_date->format('M d, Y');
    }

    public function getFormattedStartTimeAttribute()
    {
        return $this->start_time ? $this->start_time->format('g:i A') : null;
    }

    public function getFormattedEndTimeAttribute()
    {
        return $this->end_time ? $this->end_time->format('g:i A') : null;
    }

    public function getFormattedRegistrationFeeAttribute()
    {
        return $this->registration_fee > 0 ? '₱' . number_format($this->registration_fee, 2) : 'Free';
    }

    public function getIsRegistrationOpenAttribute()
    {
        if (!$this->registration_deadline) {
            return true;
        }
        
        return now()->lte($this->registration_deadline) && $this->status === 'published';
    }

    public function getIsFullAttribute()
    {
        if (!$this->max_participants) {
            return false;
        }
        
        return $this->current_participants >= $this->max_participants;
    }

    public function getTypeLabelAttribute()
    {
        return match($this->type) {
            'homecoming' => 'Annual Homecoming',
            'reunion' => 'Batch Reunion',
            'mentorship' => 'Mentorship Session',
            'networking' => 'Networking Event',
            'workshop' => 'Workshop',
            'other' => 'Other Activity',
            default => ucfirst($this->type)
        };
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'draft' => 'Draft',
            'published' => 'Published',
            'cancelled' => 'Cancelled',
            'completed' => 'Completed',
            default => ucfirst($this->status)
        };
    }

    // Methods
    public function isUpcoming()
    {
        return $this->event_date >= now()->toDateString();
    }

    public function isPast()
    {
        return $this->event_date < now()->toDateString();
    }

    public function canRegister()
    {
        return $this->is_registration_open && !$this->is_full && $this->is_upcoming;
    }
}