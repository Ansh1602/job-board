@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Job</h1>

    <form method="POST" action="{{ route('jobs.store') }}">
        @csrf
        <div class="form-group">
            <label for="title">Job Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>

        <div class="form-group">
            <label for="job_type">Job Type</label>
            <select class="form-control" id="job_type" name="job_type" required>
                <option value="full-time">Full-Time</option>
                <option value="part-time">Part-Time</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Post Job</button>
    </form>
</div>
@endsection