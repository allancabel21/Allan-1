@extends('layouts.dashboard')

@section('title', $announcement->title)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Back Button -->
            <div class="mb-4">
                <a href="{{ route('graduate.announcements') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Announcements
                </a>
            </div>

            <!-- Announcement Card -->
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-bullhorn me-2"></i>
                            {{ $announcement->title }}
                        </h3>
                        <div class="d-flex gap-2">
                            @php
                                $typeColors = [
                                    'general' => 'badge-secondary',
                                    'important' => 'badge-warning',
                                    'urgent' => 'badge-danger',
                                    'event' => 'badge-info'
                                ];
                                $priorityColors = [
                                    'low' => 'badge-light',
                                    'medium' => 'badge-primary',
                                    'high' => 'badge-danger'
                                ];
                            @endphp
                            <span class="badge {{ $typeColors[$announcement->type] ?? 'badge-secondary' }} fs-6">
                                {{ ucfirst($announcement->type) }}
                            </span>
                            <span class="badge {{ $priorityColors[$announcement->priority] ?? 'badge-light' }} fs-6">
                                {{ ucfirst($announcement->priority) }} Priority
                            </span>
                            @if($announcement->expires_at && $announcement->expires_at->isPast())
                                <span class="badge badge-danger fs-6">
                                    <i class="fas fa-exclamation-triangle"></i> Expired
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <!-- Content -->
                    <div class="announcement-content mb-4">
                        <div class="content-text" style="
                            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                            font-size: 16px;
                            line-height: 1.8;
                            color: #2c3e50;
                            white-space: pre-wrap;
                            word-wrap: break-word;
                        ">
                            {{ $announcement->content }}
                        </div>
                    </div>

                    <!-- Divider -->
                    <hr class="my-4" style="border-color: #e9ecef;">

                    <!-- Footer Information -->
                    <div class="announcement-footer">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="d-flex flex-wrap gap-4 text-muted">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-user-circle me-2 text-primary"></i>
                                        <span class="fw-medium">Posted by: {{ $announcement->creator->name }}</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-alt me-2 text-success"></i>
                                        <span class="fw-medium">Published: {{ $announcement->published_at->format('F d, Y \a\t g:i A') }}</span>
                                    </div>
                                    @if($announcement->expires_at)
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-clock me-2 text-warning"></i>
                                            <span class="fw-medium">Expires: {{ $announcement->expires_at->format('F d, Y \a\t g:i A') }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4 text-end">
                                <small class="text-muted">
                                    <i class="fas fa-eye me-1"></i>
                                    Last updated: {{ $announcement->updated_at->format('M d, Y') }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .announcement-content {
        background: #f8f9fa;
        border-left: 4px solid #007bff;
        padding: 20px;
        border-radius: 8px;
        margin: 20px 0;
    }
    
    .content-text {
        font-size: 16px !important;
        line-height: 1.8 !important;
        color: #2c3e50 !important;
    }
    
    .card {
        border-radius: 12px;
        overflow: hidden;
    }
    
    .card-header {
        border-bottom: none;
        padding: 20px 25px;
    }
    
    .card-body {
        padding: 30px;
    }
    
    .badge {
        font-size: 0.75rem;
        padding: 0.5rem 0.75rem;
        border-radius: 20px;
    }
    
    .btn {
        border-radius: 8px;
        font-weight: 500;
        padding: 8px 16px;
    }
    
    .btn-outline-secondary {
        border-color: #6c757d;
        color: #6c757d;
    }
    
    .btn-outline-secondary:hover {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
    }
    
    @media (max-width: 768px) {
        .card-body {
            padding: 20px;
        }
        
        .announcement-content {
            padding: 15px;
        }
        
        .content-text {
            font-size: 15px !important;
        }
        
        .d-flex.gap-4 {
            flex-direction: column;
            gap: 10px !important;
        }
    }
</style>
@endsection
