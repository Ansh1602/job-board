@extends('layouts.app')

@section('title', $job->title)

@section('content')
<div class="container">
    <h1>{{ $job->title }}</h1>
    <p><strong>Location:</strong> {{ $job->location }}</p>
    <p><strong>Job Type:</strong> {{ ucfirst($job->job_type) }}</p>
    <p><strong>Employer:</strong> {{ $job->employer->name }}</p> <!-- Assuming you have an employer relationship -->
    <a href="{{ route('home') }}" class="btn btn-primary">Back to Job Listings</a>
</div>
@endsection
