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
                            View parent <a href="{{ route('milestone.view', [$project->id, $milestone->id]) }}">milestone</a>.
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            Assigned to
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
                            </h3>
                        </div>

                        <div class="card-body">
                            <p>{{ $assignment->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection