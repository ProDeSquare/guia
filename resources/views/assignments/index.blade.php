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

                    @if ($assignment->submission)
                        <div class="card card-body mb-5">
                            <div class="row">
                                <div class="col-lg-1 mb-4">
                                    <div
                                        class="avatar d-block"
                                        style="background-image: url({{ $assignment->student()->first()->avatar() }})"
                                    ></div>
                                </div>

                                <div class="col-lg">
                                    <p class="my-1">
                                        <a href="{{ route('student.profile', $assignment->student()->first()->id) }}">
                                            {{ $assignment->student()->first()->name }}
                                        </a>

                                        <span class="text-muted">• Submission</span>
                                    </p>

                                    <div class="mt-4">
                                        {{ Markdown::parse($assignment->submission) }}
                                    </div>

                                    <div class="small text-muted">
                                        <strong>Submitted: </strong>
                                        {{ $assignment->created_at->format('d M Y') }},
                                        {{ $assignment->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (
                        Auth::guard('student')->check() &&
                        Auth::guard()->user()->isAssigned($assignment) &&
                        !$assignment->is_completed
                    )
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add Submission</h3>
                            </div>
                            
                            <div class="card-body">
                                <form action="#{{-- {{ route('mark.assignment.done', [$project, $milestone, $assignment]) }} --}}" method="post">
                                    @csrf

                                    <div class="form-group">
                                        <label for="submission" class="form-label">Text Message/Submission <span class="text-red">*</span></label>

                                        <textarea name="submission" id="submission" class="form-control" rows="7" placeholder="Describe your assignment or submit as text"></textarea>

                                        <small class="form-hint">
                                            This is field accepts markdown
                                        </small>
                                    </div>

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