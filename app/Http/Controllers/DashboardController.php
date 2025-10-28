<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Graduate;
use App\Models\JobPosting;
use App\Models\EmploymentRecord;

class DashboardController extends Controller
{
    public function index()
    {
        // Get statistics for the dashboard
        $stats = [
            'total_graduates' => Graduate::count(),
            'employed_graduates' => Graduate::where('is_employed', true)->count(),
            'total_jobs' => JobPosting::where('is_active', true)->count(),
            'employment_rate' => Graduate::count() > 0 ? round((Graduate::where('is_employed', true)->count() / Graduate::count()) * 100, 1) : 0,
        ];

        return view('dashboard.index', compact('stats'));
    }
}
