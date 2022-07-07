@extends('layouts.app')

@section('title')
    | (Assignment) {{ $assignment->title }}
@endsection

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
                            View parent <a href="{{ route('milestone.view', [$project->id, $milestone->id]) }}">milestone</a>.
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Assigned to</h3>
                        </div>

                        <div class="card-body">
                            <ul class="list-unstyled list-separated">
                                <li class="list-separated-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="avatar avatar-md d-block" style="background-image: url({{ $assignment->student()->first()->avatar() }})"></span>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <a href="{{ route('student.profile', $assignment->student()->first()->id) }}" class="text-inherit">{{ $assignment->student()->first()->name }}</a>
                                            </div>
                                            <small class="d-block item-except text-sm text-muted h-1x">
                                                {{ $assignment->student()->first()->roll_no }}
                                            </small>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <a
                                    href="{{ route('assignment.view', [$project->id, $milestone->id, $assignment->id]) }}"
                                >{{ $assignment->title }}</a>

                                @if ($assignment->is_completed === 1)
                                    <button class="btn btn-link btn-disabled" disabled>
                                        <i class="fe fe-check"></i>

                                        Completed
                                    </button>
                                @endif
                            </h3>
                        </div>

                        <div class="card-body">
                            <div>{{ Markdown::parse($assignment->description) }}</div>

                            @if ($assignment->github_commit_link)
                                <a class="btn btn-outline-dark btn-sm" href="{{ $assignment->github_commit_link }}" target="_blank">
                                    <span class="fa fa-github"></span> View Commit on GitHub
                                </a>
                            @endif
                        </div>
                    </div>

                    @if (
                        Auth::guard('student')->check() &&
                        Auth::guard()->user()->isAssigned($assignment) &&
                        !$assignment->is_completed
                    )
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Mark as done</h3>
                            </div>
                            
                            <div class="card-body">
                                <form action="{{ route('mark.assignment.done', [$project, $milestone, $assignment]) }}" method="post">
                                    @csrf

                                    @method('put')

                                    <div class="form-group">
                                        <label for="github_commit_link" class="form-label">GitHub Commit Link</label>
        
                                        <input type="text" class="form-control @error('github_commit_link') is-invalid @enderror" id="github_commit_link" placeholder="Commit link from git repository" name="github_commit_link" value="{{ old('github_commit_link') }}" />

                                        <small class="form-hint">
                                            This is field is optional but if you've pushed your changes to git then paste the commit link in the field and submit.
                                        </small>

                                        @error('github_commit_link')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection