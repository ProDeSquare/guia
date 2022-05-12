@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h3 class="page-title">
                <a href="{{ route('project.view', $project->id) }}">{{ $project->title }}</a>
            </h3>
        </div>

        <div class="page-body">
            <div class="row">
                <div class="col-lg-4">
                    @include('partials.milestone-details')

                    <div class="card">
                        <div class="card-body">
                            View all <a href="{{ route('project.milestones', $project->id) }}">milestones</a>.
                        </div>
                    </div>
                </div>

                <div class="col-lg">
                    <div class="card card-body">
                        <h3 class="card-title">Add an assignment</h3>

                        <form action="{{ route('create.assignment', [$project->id, $milestone->id]) }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="title" class="form-label">Assignment Title <span class="text-red">*</span></label>

                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Title for the task" name="title" value="{{ old('title') }}" required />

                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description" class="form-label">Assignment Description <span class="text-red">*</span></label>

                                <textarea rows="7" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Describe the task in detail" name="description" required>{{ old('description') }}</textarea>
                            
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="assigned_to" class="form-label">Assign to <span class="text-red">*</span></label>

                                <select class="form-control" name="student_id" id="assigned_to">
                                    @foreach ($members as $member)
                                        <option
                                            value="{{ $member->student()->first()->id }}"
                                            
                                        >
                                            {{ $member->student()->first()->name }} -
                                            {{ $member->student()->first()->roll_no }}
                                        </option>
                                        @old('student_id')
                                    @endforeach
                                </select>

                                @error('assigned_to')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection