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
                {{-- teachers list --}}
                <div class="card" bis_skin_checked="1">
                    <div class="card-header" bis_skin_checked="1">
                        <h3 class="card-title">Teachers ({{ $mod->teachers()->count() }})</h3>
                    </div>
                    <div class="card-body o-auto" style="height: 15rem" bis_skin_checked="1">
                        <ul class="list-unstyled list-separated">
                            @if ($mod->teachers()->count())
                                @foreach ($mod->teachers()->latest()->take(5)->get() as $teacher)
                                    <li class="list-separated-item">
                                        <div class="row align-items-center" bis_skin_checked="1">
                                            <div class="col-auto" bis_skin_checked="1">
                                                <span class="avatar avatar-md d-block" style="background-image: url({{ $teacher->avatar() }})"></span>
                                            </div>
                                            <div class="col" bis_skin_checked="1">
                                                <div bis_skin_checked="1">
                                                    <a href="{{ route('teacher.profile', ['teacher' => $teacher->id]) }}" class="text-inherit">{{ $teacher->name }}</a>
                                                </div>
                                                <small class="d-block item-except text-sm text-muted h-1x">
                                                    {{ $teacher->email }}
                                                </small>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <small class="d-block item-except text-sm text-muted h-1x">
                                    {{ $mod->name }} hasn't added any teachers yet.
                                </small>
                            @endif
                        </ul>
                    </div>
                </div>

                {{-- students list --}}
                <div class="card" bis_skin_checked="1">
                    <div class="card-header" bis_skin_checked="1">
                        <h3 class="card-title">Students ({{ $mod->students()->count() }})</h3>
                    </div>
                    <div class="card-body o-auto" style="height: 15rem" bis_skin_checked="1">
                        <ul class="list-unstyled list-separated">
                            @if ($mod->students()->count())
                                @foreach ($mod->students()->latest()->take(5)->get() as $student)
                                    <li class="list-separated-item">
                                        <div class="row align-items-center" bis_skin_checked="1">
                                            <div class="col-auto" bis_skin_checked="1">
                                                <span class="avatar avatar-md d-block" style="background-image: url({{ $student->avatar() }})"></span>
                                            </div>
                                            <div class="col" bis_skin_checked="1">
                                                <div bis_skin_checked="1">
                                                    <a href="{{ route('student.profile', ['student' => $student->id]) }}" class="text-inherit">{{ $student->name }}</a>
                                                </div>
                                                @if ($student->email)
                                                    <small class="d-block item-except text-sm text-muted h-1x">
                                                        {{ $student->email }}
                                                    </small>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <small class="d-block item-except text-sm text-muted h-1x">
                                    {{ $mod->name }} hasn't added any students yet.
                                </small>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection