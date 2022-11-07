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