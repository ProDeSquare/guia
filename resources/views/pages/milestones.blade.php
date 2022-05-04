@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <div class="page-title">
                Milestones for "<a href="{{ route('project.view', $project->id) }}">{{ $project->title }}</a>"
            </div>
        </div>

        <div class="page-body">
            @if (
                Auth::guard('student')->check() &&
                Auth::guard('student')->user()->mainGroup()->acceptedProject()->id === $project->id
            )
                <div>
                    <p>
                        <a href="{{ route('create.milestone', $project->id) }}">Add a new milestone</a>
                    </p>
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
                                        Assignments {{ $milestone->assignments->count() ? '('.$milestone->assignments->count().')' : ''  }}
                                    </div>

                                    <div class="card-body">
                                        @if ($milestone->assignments->count())
                                            <ul>
                                                @foreach ($milestone->assignments()->limit(3)->get() as $assignment)
                                                    <li>{{ $assignment->title }}</li>
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