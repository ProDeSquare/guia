@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h3 class="page-title">
                Group Projects
            </h3>
        </div>

        <div class="page-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Members
                            </h3>
                        </div>
                    
                        <div class="card-body o-auto" style="max-height: 15rem">
                            <ul class="list-unstyled list-separated">
                                @foreach ($members as $member)
                                    <li class="list-separated-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="avatar avatar-md d-block" style="background-image: url({{ $member->student()->first()->avatar() }})"></span>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <a href="{{ route('student.profile', $member->student()->first()->id) }}" class="text-inherit">{{ $member->student()->first()->name }}</a>
                                                </div>
                                                <small class="d-block item-except text-sm text-muted h-1x">
                                                    {{ $member->student()->first()->email }}
                                                </small>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg">
                    @if ($projects->count())
                        @foreach ($projects as $project)
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $project->title }}</h3>
                                </div>

                                <div class="card-body">
                                    <p>{{ $project->description }}</p>

                                    <div>
                                        <h4>Technologies</h4>

                                        <ul>
                                            @foreach (explode(',', $project->technologies) as $technology)
                                                <li>{{ trim($technology) }}</li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div>
                                        @if ($project->github_repo)
                                            <a class="btn btn-outline-dark btn-sm" href="{{ $project->github_repo }}">
                                                <span class="fa fa-github"></span> GitHub
                                            </a>
                                        @endif

                                        @if ($project->link)
                                            <a class="btn btn-outline-primary btn-sm" href="{{ $project->link }}">
                                                <span class="fa fa-link"></span> Link
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center">No projects found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection