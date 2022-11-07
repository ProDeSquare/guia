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

                {{-- @elseif (Auth::guard()->user()->mainGroup()->projects()->count())
                    @if (Auth::guard()->user()->mainGroup()->acceptedProject())
                        <p>Nothing was yet assigned to you by your supervisor.</p>
                    @else
                        <p>Your project haven't been approved yet.</p>
                    @endif --}}
                </div>
            @else
                <p>You're not in any group.</p>
            @endif
        </div>
    </div>
@endsection