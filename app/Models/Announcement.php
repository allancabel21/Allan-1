<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'content',
        'type',
        'status',
        'priority',
        'target_audience',
        'target_batches',
        'target_programs',
        'published_at',
        'expires_at',
        'created_by',
    ];

    protected $casts = [
        'target_batches' => 'array',
        'target_programs' => 'array',
        'published_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Accessors
    public function getTypeLabelAttribute()
    {
        return match($this->type) {
            'general' => 'General',
            'important' => 'Important',
            'urgent' => 'Urgent',
            'event' => 'Event',
            default => ucfirst($this->type)
        };
    }

    public function getPriorityLabelAttribute()
    {
        return match($this->priority) {
            'low' => 'Low',
            'medium' => 'Medium',
            'high' => 'High',
            default => ucfirst($this->priority)
        };
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'draft' => 'Draft',
            'published' => 'Published',
            'archived' => 'Archived',
            default => ucfirst($this->status)
        };
    }

    public function getPriorityColorAttribute()
    {
        return match($this->priority) {
            'low' => 'bg-gray-100 text-gray-800',
            'medium' => 'bg-blue-100 text-blue-800',
            'high' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    public function getTypeColorAttribute()
    {
        return match($this->type) {
            'general' => 'bg-gray-100 text-gray-800',
            'important' => 'bg-yellow-100 text-yellow-800',
            'urgent' => 'bg-red-100 text-red-800',
            'event' => 'bg-green-100 text-green-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'draft' => 'bg-gray-100 text-gray-800',
            'published' => 'bg-green-100 text-green-800',
            'archived' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now())
                    ->where(function($q) {
                        $q->whereNull('expires_at')
                          ->orWhere('expires_at', '>', now());
                    });
    }

    public function scopeForGraduates($query)
    {
        return $query->where(function($q) {
            $q->where('target_audience', 'all')
              ->orWhere('target_audience', 'graduates');
        });
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    // Helper methods
    public function isExpired()
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    public function isPublished()
    {
        return $this->status === 'published' && 
               $this->published_at && 
               $this->published_at->isPast() && 
               !$this->isExpired();
    }

    public function canBeViewedBy($user)
    {
        // Check if announcement is published and not expired
        if (!$this->isPublished()) {
            return false;
        }

        // Check target audience
        if ($this->target_audience === 'all') {
            return true;
        }

        if ($user->isGraduate() && in_array($this->target_audience, ['all', 'graduates'])) {
            return true;
        }

        if ($user->isStaff() && in_array($this->target_audience, ['all', 'staff'])) {
            return true;
        }

        if ($user->isAdmin() && in_array($this->target_audience, ['all', 'admin'])) {
            return true;
        }

        return false;
    }
}