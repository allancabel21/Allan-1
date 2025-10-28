<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    // Graduate view - show announcements
    public function index()
    {
        $announcements = Announcement::published()
            ->forGraduates()
            ->orderBy('priority', 'desc')
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('graduate.announcements.index', compact('announcements'));
    }

    public function show(Announcement $announcement)
    {
        // Check if user can view this announcement
        if (!$announcement->canBeViewedBy(auth()->user())) {
            abort(403, 'You are not authorized to view this announcement.');
        }

        return view('graduate.announcements.show', compact('announcement'));
    }

    // Admin/Staff management
    public function indexAdmin()
    {
        $announcements = Announcement::with('creator')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.announcements.index', compact('announcements'));
    }

    public function indexStaff()
    {
        $announcements = Announcement::with('creator')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('staff.announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('admin.announcements.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:general,important,urgent,event',
            'priority' => 'required|in:low,medium,high',
            'target_audience' => 'required|in:all,graduates,staff,admin',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after:published_at',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['created_by'] = Auth::id();

        // If status is published, always set published_at to now for immediate visibility
        if ($request->status === 'published') {
            $data['published_at'] = now();
        }

        $announcement = Announcement::create($data);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Announcement created successfully!',
                'announcement' => $announcement
            ]);
        }

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement created successfully!');
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:general,important,urgent,event',
            'priority' => 'required|in:low,medium,high',
            'target_audience' => 'required|in:all,graduates,staff,admin',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after:published_at',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        // If status is published, always set published_at to now for immediate visibility
        if ($request->status === 'published') {
            $data['published_at'] = now();
        }

        $announcement->update($data);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Announcement updated successfully!',
                'announcement' => $announcement
            ]);
        }

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement updated successfully!');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Announcement deleted successfully!'
            ]);
        }

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement deleted successfully!');
    }

    public function publish(Announcement $announcement)
    {
        $announcement->update([
            'status' => 'published',
            'published_at' => now() // Always set to current time for immediate visibility
        ]);

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Announcement published successfully!'
            ]);
        }

        return back()->with('success', 'Announcement published successfully!');
    }

    public function archive(Announcement $announcement)
    {
        $announcement->update(['status' => 'archived']);

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Announcement archived successfully!'
            ]);
        }

        return back()->with('success', 'Announcement archived successfully!');
    }
}