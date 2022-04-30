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
                        @include('partials.milestone-details')
                    @endforeach
                @else
                    <p>There were no milestones for this project.</p>
                @endif
            </div>
        </div>
    </div>
@endsection