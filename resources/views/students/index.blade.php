@extends('layouts.app')

@section('title', '| Dashboard')

@section('content')
    <div class="container">
        <div class="page-header">
            <h3 class="page-title">
                <a href="{{ route('student.profile', Auth::guard()->user()) }}">{{ Auth::guard()->user()->name }}</a>'s Dashboard
            </h3>
        </div>

        <div class="page-body">
            @if (Auth::guard()->user()->isGrouped())
                <div class="row">
                    @if (Auth::guard()->user()->mainGroup()->acceptedProject())
                        @php $project = Auth::guard()->user()->mainGroup()->acceptedProject(); @endphp

                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <a href="{{ route('project.view', $project) }}">{{ $project->title }}</a>

                                        <span class="badge badge-teacher-student ml-1">Active</span>
                                    </h3>
                                </div>

                                <div class="card-body">
                                    <div>
                                        {{ Markdown::parse($project->description) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Project Supervisor</h3>
                                </div>

                                <div class="card-body o-auto" style="max-height: 15rem">
                                    @php $supervisor = Auth::guard()->user()->mainGroup()->supervisor()->first()->supervisor()->first() @endphp

                                    <ul class="list-unstyled list-separated">
                                        <li class="list-separated-item">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="avatar avatar-md d-block" style="background-image: url({{ $supervisor->avatar() }})"></span>
                                                </div>
                                                <div class="col">
                                                    <div>
                                                        <a href="{{ route('teacher.profile', $supervisor->id) }}" class="text-inherit">{{ $supervisor->name }}</a>
                                                    </div>
                                                    <small class="d-block item-except text-sm text-muted h-1x">
                                                        {{ $supervisor->email }}
                                                    </small>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @elseif (Auth::guard()->user()->mainGroup()->projects()->count())
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Group Projects</h3>
                                </div>
    
                                <div class="card-body">
                                    <ul>
                                        @foreach (Auth::guard()->user()->mainGroup()->projects()->get() as $project)
                                            <li>
                                                <a href="{{ route('project.view', $project) }}">{{ $project->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (Auth::guard()->user()->assignments()->count())
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Recent Assignments
                                    </h3>
                                </div>
        
                                <div class="card-body">
                                    <ul>
                                        @foreach (Auth::guard()->user()->assignments()->latest()->get() as $assignment)
                                            <li>
                                                <a href="{{ route('assignment.view', [$assignment->project()->first()->id, $assignment->milestone()->first()->id, $assignment->id]) }}">
                                                    {!! $assignment->is_completed ? '<del>' . $assignment->title . '</del>' : $assignment->title !!}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <p>You're not in any group.</p>
            @endif
        </div>
    </div>
@endsection