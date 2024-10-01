@extends('layouts.app')

@section('title', 'Employer Dashboard')

@section('content')
<div class="container">
    <h1>Employer Dashboard</h1>
    <a href="{{ route('jobs.create') }}" class="btn btn-primary mb-3">Post a New Job</a>

    <h2>Your Posted Jobs</h2>
    @if ($jobs->isEmpty())
        <p>You haven't posted any jobs yet.</p>
    @else
        <ul class="list-group">
            @foreach($jobs as $job)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h5>{{ $job->title }}</h5>
                        <p>{{ $job->location }} | {{ ucfirst($job->job_type) }}</p>
                    </div>
                    <div>
                        <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection