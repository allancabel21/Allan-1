<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Graduate;
use App\Models\JobPosting;
use App\Models\AlumniActivity;
use App\Models\CareerReport;
use App\Models\EmploymentRecord;

class StaffController extends Controller
{
    public function dashboard()
    {
        // Get statistics for staff dashboard
        $stats = [
            'total_graduates' => Graduate::count(),
            'verified_graduates' => Graduate::where('verification_status', 'verified')->count(),
            'pending_verifications' => Graduate::where('verification_status', 'pending')->count(),
            'employed_graduates' => Graduate::where('is_employed', true)->count(),
            'total_job_postings' => JobPosting::count(),
            'active_job_postings' => JobPosting::where('is_active', true)->count(),
            'employment_rate' => Graduate::count() > 0 ? round((Graduate::where('is_employed', true)->count() / Graduate::count()) * 100, 1) : 0,
        ];

        // Get recent graduates
        $recent_graduates = Graduate::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Get recent job postings
        $recent_job_postings = JobPosting::with('postedBy')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('staff.dashboard', compact('stats', 'recent_graduates', 'recent_job_postings'));
    }

    public function graduates()
    {
        $graduates = Graduate::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('staff.graduates', compact('graduates'));
    }

    public function showGraduate(Graduate $graduate)
    {
        $graduate->load(['user', 'employmentRecords', 'resumes']);
        return view('staff.graduate-details', compact('graduate'));
    }

    public function careerSupport()
    {
        // Get graduates who need career support
        $graduates_needing_support = Graduate::with('user')
            ->where('is_employed', false)
            ->orWhere('verification_status', 'pending')
            ->orderBy('updated_at', 'desc')
            ->paginate(15);

        return view('staff.career-support', compact('graduates_needing_support'));
    }

    public function graduateDetails(Graduate $graduate)
    {
        $graduate->load('user');
        
        $html = view('staff.partials.graduate-details', compact('graduate'))->render();
        
        return response()->json([
            'success' => true,
            'html' => $html
        ]);
    }

    public function verifyGraduate(Graduate $graduate)
    {
        try {
            $graduate->update(['verification_status' => 'verified']);
            
            return response()->json([
                'success' => true,
                'message' => 'Graduate verified successfully!'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error verifying graduate:', [
                'error' => $e->getMessage(),
                'graduate_id' => $graduate->id
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error verifying graduate. Please try again.'
            ], 500);
        }
    }

    public function jobPostings()
    {
        $jobPostings = JobPosting::with(['postedBy.graduate'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('staff.job-postings', compact('jobPostings'));
    }

    public function storeJobPosting(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'company' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'employment_type' => 'required|string|in:Full-time,Part-time,Contract,Internship',
                'salary_min' => 'nullable|numeric|min:0',
                'salary_max' => 'nullable|numeric|min:0|gte:salary_min',
                'requirements' => 'nullable|string',
                'benefits' => 'nullable|string',
                'application_deadline' => 'nullable|date|after:today',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        }

        try {
            $jobPosting = JobPosting::create([
                'posted_by' => auth()->id(),
                'title' => $request->title,
                'description' => $request->description,
                'company' => $request->company,
                'location' => $request->location,
                'employment_type' => $request->employment_type,
                'salary_min' => $request->salary_min,
                'salary_max' => $request->salary_max,
                'requirements' => $request->requirements,
                'benefits' => $request->benefits,
                'application_deadline' => $request->application_deadline,
                'status' => 'published',
                'is_active' => true,
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Job posting created successfully!',
                    'job_id' => $jobPosting->id
                ]);
            }

            return redirect()->route('staff.job-postings')->with('success', 'Job posting created successfully!');
            
        } catch (\Exception $e) {
            \Log::error('Error creating job posting: ' . $e->getMessage());
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error creating job posting: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Error creating job posting: ' . $e->getMessage());
        }
    }

    public function jobDetails(JobPosting $jobPosting)
    {
        $jobPosting->load('postedBy.graduate');
        
        $html = view('staff.partials.job-details', compact('jobPosting'))->render();
        
        return response()->json([
            'success' => true,
            'html' => $html
        ]);
    }

    public function editJobPosting(JobPosting $jobPosting)
    {
        return response()->json([
            'success' => true,
            'job' => $jobPosting
        ]);
    }

    public function updateJobPosting(Request $request, JobPosting $jobPosting)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'employment_type' => 'required|string|in:Full-time,Part-time,Contract,Internship',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'application_deadline' => 'nullable|date|after:today',
        ]);

        try {
            $jobPosting->update([
                'title' => $request->title,
                'description' => $request->description,
                'company_name' => $request->company_name,
                'location' => $request->location,
                'employment_type' => $request->employment_type,
                'requirements' => $request->requirements,
                'benefits' => $request->benefits,
                'application_deadline' => $request->application_deadline,
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Job posting updated successfully!'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error updating job posting:', [
                'error' => $e->getMessage(),
                'job_id' => $jobPosting->id
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error updating job posting. Please try again.'
            ], 500);
        }
    }

    public function updateJobStatus(Request $request, JobPosting $jobPosting)
    {
        $request->validate([
            'status' => 'required|in:active,inactive',
        ]);

        try {
            $jobPosting->update(['status' => $request->status]);
            
            return response()->json([
                'success' => true,
                'message' => 'Job status updated successfully!'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error updating job status:', [
                'error' => $e->getMessage(),
                'job_id' => $jobPosting->id
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error updating job status. Please try again.'
            ], 500);
        }
    }

    public function reports()
    {
        $reports = CareerReport::with('generatedBy')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('staff.reports', compact('reports'));
    }

    public function generateReport(Request $request)
    {
        $request->validate([
            'report_type' => 'required|in:employment_summary,program_analysis,career_trends',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        $data = $this->generateReportData($request->report_type);

        CareerReport::create([
            'title' => $request->title,
            'report_type' => $request->report_type,
            'description' => $request->description,
            'data' => $data,
            'generated_by' => auth()->id(),
            'generated_at' => now(),
        ]);

        return redirect()->route('staff.reports')->with('success', 'Report generated successfully!');
    }

    public function alumni()
    {
        $alumni = Graduate::with('user')
            ->where('verification_status', 'verified')
            ->orderBy('graduation_date', 'desc')
            ->paginate(15);

        return view('staff.alumni', compact('alumni'));
    }

    private function generateReportData($reportType)
    {
        switch ($reportType) {
            case 'employment_summary':
                return [
                    'total_graduates' => Graduate::count(),
                    'employed_graduates' => Graduate::where('is_employed', true)->count(),
                    'unemployed_graduates' => Graduate::where('is_employed', false)->count(),
                    'employment_rate' => Graduate::count() > 0 ? round((Graduate::where('is_employed', true)->count() / Graduate::count()) * 100, 1) : 0,
                    'verified_graduates' => Graduate::where('verification_status', 'verified')->count(),
                    'pending_verifications' => Graduate::where('verification_status', 'pending')->count(),
                ];

            case 'program_analysis':
                return Graduate::selectRaw('program, COUNT(*) as total, SUM(CASE WHEN is_employed = 1 THEN 1 ELSE 0 END) as employed')
                    ->groupBy('program')
                    ->get()
                    ->map(function ($item) {
                        $item->employment_rate = $item->total > 0 ? round(($item->employed / $item->total) * 100, 1) : 0;
                        return $item;
                    })
                    ->toArray();

            case 'career_trends':
                return [
                    'employment_by_batch' => Graduate::selectRaw('batch_year, COUNT(*) as total, SUM(CASE WHEN is_employed = 1 THEN 1 ELSE 0 END) as employed')
                        ->groupBy('batch_year')
                        ->orderBy('batch_year', 'desc')
                        ->get()
                        ->map(function ($item) {
                            $item->employment_rate = $item->total > 0 ? round(($item->employed / $item->total) * 100, 1) : 0;
                            return $item;
                        })
                        ->toArray(),
                    'recent_employment_updates' => Graduate::where('is_employed', true)
                        ->orderBy('updated_at', 'desc')
                        ->limit(20)
                        ->get(['current_position', 'current_company', 'updated_at'])
                        ->toArray(),
                ];

            default:
                return [];
        }
    }

    public function alumniActivities()
    {
        $activities = AlumniActivity::orderBy('event_date', 'desc')->paginate(10);
        
        $stats = [
            'total' => AlumniActivity::count(),
            'published' => AlumniActivity::where('status', 'published')->count(),
            'upcoming' => AlumniActivity::published()->upcoming()->count(),
            'featured' => AlumniActivity::featured()->count(),
        ];

        return view('staff.alumni-activities', compact('activities', 'stats'));
    }

    public function createAlumniActivity()
    {
        return view('staff.alumni-activities.create');
    }

    public function storeAlumniActivity(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:homecoming,reunion,mentorship,networking,workshop,other',
            'batch_year' => 'nullable|string|max:4',
            'event_date' => 'required|date|after:today',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'location' => 'required|string|max:255',
            'venue' => 'nullable|string|max:255',
            'registration_fee' => 'nullable|numeric|min:0',
            'max_participants' => 'nullable|integer|min:1',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'contact_person' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'status' => 'required|in:draft,published,cancelled,completed',
            'is_featured' => 'boolean',
            'registration_deadline' => 'nullable|date|after:today|before:event_date',
        ]);

        AlumniActivity::create($validated);

        return redirect()->route('staff.alumni-activities')
            ->with('success', 'Alumni activity created successfully.');
    }

    public function editAlumniActivity(AlumniActivity $alumniActivity)
    {
        return view('staff.alumni-activities.edit', compact('alumniActivity'));
    }

    public function updateAlumniActivity(Request $request, AlumniActivity $alumniActivity)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:homecoming,reunion,mentorship,networking,workshop,other',
            'batch_year' => 'nullable|string|max:4',
            'event_date' => 'required|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'location' => 'required|string|max:255',
            'venue' => 'nullable|string|max:255',
            'registration_fee' => 'nullable|numeric|min:0',
            'max_participants' => 'nullable|integer|min:1',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'contact_person' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'status' => 'required|in:draft,published,cancelled,completed',
            'is_featured' => 'boolean',
            'registration_deadline' => 'nullable|date|before:event_date',
        ]);

        $alumniActivity->update($validated);

        return redirect()->route('staff.alumni-activities')
            ->with('success', 'Alumni activity updated successfully.');
    }

    public function deleteAlumniActivity(AlumniActivity $alumniActivity)
    {
        $alumniActivity->delete();

        return redirect()->route('staff.alumni-activities')
            ->with('success', 'Alumni activity deleted successfully.');
    }

    public function graduationApplications()
    {
        $applications = \App\Models\GraduationApplication::with(['graduate.user'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $stats = [
            'total' => \App\Models\GraduationApplication::count(),
            'pending' => \App\Models\GraduationApplication::where('status', 'pending')->count(),
            'approved' => \App\Models\GraduationApplication::where('status', 'approved')->count(),
            'rejected' => \App\Models\GraduationApplication::where('status', 'rejected')->count(),
        ];

        return view('staff.graduation-applications', compact('applications', 'stats'));
    }

    public function showGraduationApplication(\App\Models\GraduationApplication $application)
    {
        $application->load(['graduate.user', 'approver']);
        return view('staff.graduation-application-details', compact('application'));
    }

    public function approveGraduationApplication(Request $request, \App\Models\GraduationApplication $application)
    {
        $request->validate([
            'notes' => 'nullable|string|max:1000',
        ]);

        $application->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'notes' => $request->notes,
        ]);

        return redirect()->route('staff.graduation-applications')
            ->with('success', 'Graduation application approved successfully.');
    }

    public function rejectGraduationApplication(Request $request, \App\Models\GraduationApplication $application)
    {
        $request->validate([
            'notes' => 'required|string|max:1000',
        ]);

        $application->update([
            'status' => 'rejected',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'notes' => $request->notes,
        ]);

        return redirect()->route('staff.graduation-applications')
            ->with('success', 'Graduation application rejected.');
    }
}
