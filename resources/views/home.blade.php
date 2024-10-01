@extends('layouts.app')

@section('title', 'Job Listings')

@section('content')
<div class="container">
    <h1>Job Listings</h1>

    @if ($jobs->isEmpty())
        <p>No jobs available at the moment.</p>
    @else
        <ul class="list-group">
            @foreach($jobs as $job)
                <li class="list-group-item">
                    <h5>{{ $job->title }}</h5>
                    <p>{{ $job->location }} | {{ ucfirst($job->job_type) }}</p>
                    <p><strong>Employer:</strong> {{ $job->employer->name }}</p>
                    <!-- Assuming you have an employer relationship -->
                    <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-info">View Details</a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection