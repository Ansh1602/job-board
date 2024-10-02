@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Welcome to the Job Board</h1>
    <p>Find your next job or post one!</p>

    <!-- Job Search Form -->
    <form method="GET" action="{{ route('jobs.search') }}" class="mb-4">
        <div class="form-row">
            <div class="col-md-4">
                <input type="text" name="title" class="form-control" placeholder="Job title"
                    value="{{ request()->get('title') }}">
            </div>
            <div class="col-md-4">
                <input type="text" name="location" class="form-control" placeholder="Location"
                    value="{{ request()->get('location') }}">
            </div>
            <div class="col-md-4">
                <select name="job_type" class="form-control">
                    <option value="">Select Job Type</option>
                    <option value="full-time" {{ request()->get('job_type') == 'full-time' ? 'selected' : '' }}>Full-Time
                    </option>
                    <option value="part-time" {{ request()->get('job_type') == 'part-time' ? 'selected' : '' }}>Part-Time
                    </option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Search</button>
    </form>


    <!-- Job Listings -->
    <h2>Available Jobs</h2>
    @if ($jobs->isEmpty())
        <p>No jobs found. Try searching with different keywords.</p>
    @else
        <ul class="list-group">
            @foreach($jobs as $job)
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $job->title }}</h5>
                <p>{{ $job->location }} | {{ ucfirst($job->job_type) }}</p>
                <!-- <p>Posted by: {{ $job->employer_id && $job->employer ? $job->employer->name : 'Mock Job' }}</p> -->
            </div>
        </div>
    @endforeach
        </ul>
    @endif

</div>
@endsection
