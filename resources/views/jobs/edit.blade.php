@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Job</h1>

    <form method="POST" action="{{ route('jobs.update', $job->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Job Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $job->title }}" required>
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" id="location" name="location" value="{{ $job->location }}" required>
        </div>

        <div class="form-group">
            <label for="job_type">Job Type</label>
            <select class="form-control" id="job_type" name="job_type" required>
                <option value="full-time" {{ $job->job_type == 'full-time' ? 'selected' : '' }}>Full-Time</option>
                <option value="part-time" {{ $job->job_type == 'part-time' ? 'selected' : '' }}>Part-Time</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Job</button>
    </form>
</div>
@endsection