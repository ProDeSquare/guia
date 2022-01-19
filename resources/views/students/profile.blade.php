@extends('layouts.app')

@section('content')
<div class="my-3 my-md-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card card-profile">
                    <div class="card-header"></div>

                    <div class="card-body text-center">
                        <img class="card-profile-img" src="{{ $student->avatar() }}">

                        <h3 class="mb-3">{{ $student->name }}</h3>
                        <p class="mb-4">
                            {{ $student->bio }}
                        </p>

                        <div class="mb-3">
                            <span class="badge badge-teacher-student">Student</span>
                        </div>

                        <div>
                            @if ($student->github)
                                <a class="btn btn-outline-dark btn-sm" href="{{ $student->github }}">
                                    <span class="fa fa-github"></span> GitHub
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                {{-- if student is in a group --}}
                @if ($student->isGrouped())
                    @include('partials.group-info-student-profile')
                {{-- logged in as a student & on someones profile --}}
                @elseif (Auth::guard('student')->check() && !Auth::guard()->user()->owner($student->id))
                    @include('partials.add-student-to-group')
                @elseif (Auth::guard('student')->check() && Auth::guard()->user()->owner($student->id))
                    @if (!$student->isGrouped())
                        @include('partials.student-create-group')
                    @endif
                @else
                    <p class="text-center">
                        <strong>{{ $student->name }}</strong> has no activity for the time being.
                    </p>
                @endif

                {{-- update password form --}}
                @if (Auth::guard('student')->check() && Auth::guard()->user()->owner($student->id))
                    {{-- @include('partials.students-update-profile')
                    @include('partials.update-password') --}}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection