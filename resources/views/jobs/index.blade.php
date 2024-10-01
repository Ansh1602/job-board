@extends('layouts.app')

@section('title', 'Jobs')

@section('content')
    <h1>Search Jobs</h1>
    <form action="{{ route('jobs.index') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search for jobs..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <h2>Available Jobs</h2>
    @foreach($jobs as $job)
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $job->title }}</h5>
                <p>{{ $job->location }} | {{ ucfirst($job->job_type) }}</p>
                <p>Posted by: {{ $job->employer_id ? $job->employer->name : 'Mock Job' }}</p>
            </div>
        </div>
    @endforeach

    {{ $jobs->links() }}
@endsection
