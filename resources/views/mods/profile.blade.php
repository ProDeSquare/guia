@extends('layouts.app')

@section('content')
<div class="my-3 my-md-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card card-profile">
                    <div class="card-header"></div>

                    <div class="card-body text-center">
                        <img class="card-profile-img" src="{{ $mod->avatar() }}">

                        <h3 class="mb-3">{{ $mod->name }}</h3>
                        <p class="mb-4">
                            Lorem ipsum dolor sit amet.
                        </p>

                        <div class="mb-3">
                            <span class="badge badge-admin-mod">Moderator</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">
                            Teachers ({{ $mod->teachers()->count() }})
                        </h3>

                        @if ($mod->teachers()->count())
                            <ul>
                                @foreach ($mod->teachers()->latest()->take(5)->get() as $teacher)
                                    <li>
                                        <a href="{{ route('teacher.profile', ['teacher' => $teacher->id]) }}">
                                            {{ $teacher->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>{{ $mod->name }} hasn't added any teachers yet.</p>
                        @endif
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">
                            Students ({{ $mod->students()->count() }})
                        </h3>

                        @if ($mod->students()->count())
                            <ul>
                                @foreach ($mod->students()->latest()->take(5)->get() as $student)
                                    <li>
                                        <a href="{{ route('student.profile', ['student' => $student->id]) }}">
                                            {{ $student->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>{{ $mod->name }} hasn't added any students yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection