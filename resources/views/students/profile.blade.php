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
                            Lorem ipsum dolor sit amet.
                        </p>

                        <div class="mb-3">
                            <span class="badge badge-teacher-student">Student</span>
                        </div>

                        @if ($student->github)
                            <a class="btn btn-outline-dark btn-sm" href="{{ $student->github }}" target="_blank">
                                <span class="fa fa-github"></span> GitHub
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                {{-- update password form --}}
                @if (Auth::guard('student')->check() && Auth::guard()->user()->owner($student->id))
                    @include('partials.update-password')
                @endif
            </div>
        </div>
    </div>
</div>
@endsection