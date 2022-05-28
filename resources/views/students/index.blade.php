@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h3 class="page-title">Student Dashboard</h3>
        </div>

        <div class="page-body">
            @if (Auth::guard()->user()->isGrouped())
                @if (Auth::guard()->user()->assignments()->count())
                    <ul>
                        @foreach (Auth::guard()->user()->assignments()->latest()->get() as $assignment)
                            <li>
                                <a href="{{ route('assignment.view', [$assignment->project()->first()->id, $assignment->milestone()->first()->id, $assignment->id]) }}">
                                    {!! $assignment->is_completed ? '<del>' . $assignment->title . '</del>' : $assignment->title !!}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @elseif (Auth::guard()->user()->mainGroup()->projects()->count())
                    @if (Auth::guard()->user()->mainGroup()->acceptedProject())
                        <p>Nothing was yet assigned to you by your supervisor.</p>
                    @else
                        <p>Your project haven't been approved yet.</p>
                    @endif
                @endif
            @else
                <p>You're not in any group.</p>
            @endif
        </div>
    </div>
@endsection