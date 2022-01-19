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

                            {{-- @if(Auth::guard('student')->check() && !Auth::guard()->user()->owner($student->id))
                                @if (! $student->isGrouped())
                                    @if (
                                        Auth::guard()->user()->isGrouped() &&
                                        Auth::guard()->user()->group()->first()->group()->first()->members()->count() < 3
                                    )
                                        @if ($student->hasAlreadyRequestedForCurrentGroup(Auth::guard()->user()->group()->first()->group_id))
                                            <form action="{{ route('remove.from.group', $student->id) }}" method="post">
                                                @csrf

                                                <button class="btn btn-outline-danger btn-sm mt-3" type="submit">
                                                    Cancel Request
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('add.to.group', $student->id) }}" method="post">
                                                @csrf

                                                <button class="btn btn-outline-primary btn-sm mt-3" type="submit">
                                                    Add to group
                                                </button>
                                            </form>
                                        @endif
                                    @elseif (! Auth::guard()->user()->isGrouped())
                                        <form action="{{ route('add.to.group', $student->id) }}" method="post">
                                            @csrf

                                            <button class="btn btn-outline-primary btn-sm mt-3" type="submit">
                                                Add to group
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            @endif --}}
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