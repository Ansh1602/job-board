<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    // Display job creation form
    public function create()
    {
        return view('jobs.create');
    }

    // Store a newly created job in the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'location' => 'required',
            'job_type' => 'required',
        ]);

        Job::create([
            'title' => $request->title,
            'location' => $request->location,
            'job_type' => $request->job_type,
            'employer_id' => Auth::id(), // Associate job with the logged-in employer
        ]);

        return redirect()->route('dashboard')->with('success', 'Job posted successfully.');
    }

    // Display a list of jobs
    public function index(Request $request)
    {
        $search = $request->input('search'); // Get search input

        // Modify the query to include search functionality
        $jobs = Job::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%")
                ->orWhere('job_type', 'like', "%{$search}%");
        })
            ->orderByRaw('employer_id IS NULL') // employer-posted first
            ->orderBy('created_at', 'desc')     // order by newest jobs
            ->paginate(10);

        return view('jobs.index', compact('jobs'));
    }


    // Display a specific job
    public function show($id)
    {
        $job = Job::findOrFail($id);
        return view('jobs.show', compact('job'));
    }


    public function dashboard()
    {
        // Retrieve jobs posted by the authenticated employer
        $jobs = Job::where('employer_id', auth()->id())->get();

        // Return the correct view
        return view('dashboard', compact('jobs'));
    }

    // Show the form to edit a job
    public function edit($id)
    {
        $job = Job::findOrFail($id);

        // Ensure the employer owns the job
        if ($job->employer_id != Auth::id()) {
            abort(403);
        }

        return view('jobs.edit', compact('job'));
    }

    // Delete a job
    public function destroy($id)
    {
        $job = Job::findOrFail($id);

        // Ensure the employer owns the job
        if ($job->employer_id != Auth::id()) {
            abort(403);
        }

        $job->delete();

        return redirect()->route('dashboard')->with('success', 'Job deleted successfully.');
    }

    // Update the job in the database
    public function update(Request $request, $id)
    {
        $job = Job::findOrFail($id);

        // Ensure the employer owns the job
        if ($job->employer_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required',
            'location' => 'required',
            'job_type' => 'required',
        ]);

        $job->update([
            'title' => $request->title,
            'location' => $request->location,
            'job_type' => $request->job_type,
        ]);

        return redirect()->route('dashboard')->with('success', 'Job updated successfully.');
    }


}
