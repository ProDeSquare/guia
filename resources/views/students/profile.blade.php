@extends('layouts.app')

@section('content')
<div class="my-3 my-md-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                @include('partials.students.profile-card')
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
            </div>
        </div>
    </div>
</div>
@endsection