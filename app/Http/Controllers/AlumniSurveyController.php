<?php

namespace App\Http\Controllers;

use App\Models\AlumniSurvey;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AlumniSurveyController extends Controller
{
    use AuthorizesRequests;
    public function create()
    {
        return view('graduate.survey.form');
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $graduateId = optional($user->graduate)->id;

        $responses = $request->input('responses');
        if (!is_array($responses)) {
            $responses = $request->all();
        }

        AlumniSurvey::create([
            'user_id' => $user->id,
            'graduate_id' => $graduateId,
            'responses' => $responses,
            'submitted_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('graduate.survey.thankyou')->with('success', 'Survey submitted successfully!');
    }

    public function thankyou()
    {
        return view('graduate.survey.thankyou');
    }

    public function index()
    {
        // $this->authorize('viewAny', AlumniSurvey::class); // Removed for now
        $surveys = AlumniSurvey::latest()->paginate(20);
        return view('graduate.survey.create', compact('surveys'));
    }

    public function show(AlumniSurvey $survey)
    {
        // $this->authorize('view', $survey); // Removed for now
        return view('admin.surveys.show', compact('survey'));
    }

    public function indexStaff()
    {
        $surveys = AlumniSurvey::with('user')->latest()->paginate(20);
        return view('graduate.survey.create', compact('surveys'));
    }

    public function showStaff(AlumniSurvey $alumniSurvey)
    {
        $alumniSurvey->load('user');
        return view('staff.surveys.show', compact('alumniSurvey'));
    }

    public function indexAdmin()
    {
        $surveys = AlumniSurvey::with('user')->latest()->paginate(20);
        return view('graduate.survey.create', compact('surveys'));
    }

    public function showAdmin($id)
    {
        try {
            // Find the survey by ID
            $alumniSurvey = AlumniSurvey::with('user')->findOrFail($id);
            
            \Log::info('Admin viewing survey', [
                'survey_id' => $alumniSurvey->id, 
                'user_id' => $alumniSurvey->user_id,
                'user_name' => $alumniSurvey->user ? $alumniSurvey->user->name : 'No User',
                'responses_count' => is_array($alumniSurvey->responses) ? count($alumniSurvey->responses) : 0,
                'responses_type' => gettype($alumniSurvey->responses)
            ]);
            
            // Debug: Log some response data
            if ($alumniSurvey->responses && is_array($alumniSurvey->responses)) {
                $nonEmptyResponses = array_filter($alumniSurvey->responses, function($value) {
                    return !empty($value);
                });
                \Log::info('Survey responses', [
                    'total_fields' => count($alumniSurvey->responses),
                    'filled_fields' => count($nonEmptyResponses),
                    'sample_data' => array_slice($nonEmptyResponses, 0, 5, true)
                ]);
            } else {
                \Log::warning('Survey responses is not an array', [
                    'survey_id' => $alumniSurvey->id,
                    'responses_value' => $alumniSurvey->responses,
                    'responses_type' => gettype($alumniSurvey->responses)
                ]);
            }
            
            return view('admin.surveys.show', compact('alumniSurvey'));
            
        } catch (\Exception $e) {
            \Log::error('Error loading survey for admin view', [
                'survey_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()->with('error', 'Failed to load survey details: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        \Log::info('Delete method called', ['survey_id' => $id]);
        
        try {
            // Find the survey by ID
            $alumniSurvey = AlumniSurvey::findOrFail($id);
            \Log::info('Survey found', ['survey_id' => $alumniSurvey->id, 'user_id' => $alumniSurvey->user_id]);
            
            // Get user info before deletion for logging
            $user = $alumniSurvey->user;
            $userName = $user ? $user->name : 'Unknown';
            
            \Log::info('About to delete survey', ['survey_id' => $alumniSurvey->id, 'user_name' => $userName]);
            
            // Delete only the survey response (keep the user account)
            $alumniSurvey->delete();
            \Log::info('Survey deleted successfully', ['survey_id' => $alumniSurvey->id]);
            
            \Log::info('Delete operation completed successfully');
            return redirect()->back()->with('success', "Survey response for '{$userName}' deleted successfully. User account preserved.");
            
        } catch (\Exception $e) {
            \Log::error('Delete operation failed', [
                'survey_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()->with('error', 'Failed to delete survey: ' . $e->getMessage());
        }
    }
}


