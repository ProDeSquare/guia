@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h3 class="page-title">
                Milestones for "<a href="{{ route('project.view', $project->id) }}">{{ $project->title }}</a>"
            </h3>
        </div>

        <div class="page-body">
            @if (
                Auth::guard('student')->check() &&
                Auth::guard('student')->user()->mainGroup()->acceptedProject()->id === $project->id
            )
                <div>
                    <a class="btn btn-primary mb-4" href="{{ route('create.milestone', $project->id) }}">Add a new milestone</a>
                </div>
            @endif

            <div>
                @if ($milestones->count())
                    @foreach ($milestones as $milestone)
                        <div class="row">
                            <div class="col-lg-4">
                                @include('partials.milestone-details')
                            </div>

                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Assignments {{ $milestone->assignments->count() ? '('.$milestone->assignments->count().')' : ''  }}
                                        </h3>
                                    </div>

                                    <div class="card-body">
                                        @if ($milestone->assignments->count())
                                            <ul>
                                                @foreach ($milestone->assignments()->limit(3)->get() as $assignment)
                                                    <li>
                                                        <a href="{{ route('assignment.view', [$project, $milestone, $assignment]) }}">
                                                            {{ $assignment->title }}
                                                        </a>

                                                        <span class="text-muted">({{ $assignment->student()->first()->name }})</span>

                                                        @if ($assignment->is_completed)
                                                            <span class="text-green">
                                                                <i class="fe fe-check"></i>
                                                            </span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p>There were no assignments created for this milestone.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{ $milestones->links() }}
                @else
                    <p>There were no milestones for this project.</p>
                @endif
            </div>
        </div>
    </div>
@endsection