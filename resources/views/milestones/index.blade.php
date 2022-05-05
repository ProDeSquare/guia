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

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            Assignments
                        </div>

                        <div class="card-body">
                            @if ($assignments->count())
                                <ul>
                                    @foreach ($assignments as $assignment)
                                        <li>
                                            <a
                                                href="{{ route('assignment.view', [$project->id, $milestone->id, $assignment->id]) }}"
                                            >{{ $assignment->title }}</a>

                                            <span class="text-muted">({{ $assignment->student()->first()->name }})</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p>There were no assignments for this milestone.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection