@extends('layouts.app')

@section('title')
    | {{ $mod->name }}
@endsection

@section('content')
<div class="my-3 my-md-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                @include('partials.mods.profile-card')
            </div>

            <div class="col-lg-8">
                {{-- teachers list --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Teachers ({{ $mod->teachers()->count() }})</h3>
                    </div>
                    <div class="card-body o-auto" style="max-height: 15rem">
                        <ul class="list-unstyled list-separated">
                            @if ($mod->teachers()->count())
                                @foreach ($mod->teachers()->latest()->take(5)->get() as $teacher)
                                    <li class="list-separated-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span
                                                    class="avatar avatar-md d-block"
                                                    style="background-image: url({{ $teacher->avatar() }}), url(https://www.gravatar.com/avatar/{{ md5($teacher->email) }}?d=mm)"
                                                ></span>
                                            </div>
                                            <div class="col">
                                                <div>
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Students ({{ $mod->students()->count() }})</h3>
                    </div>
                    <div class="card-body o-auto" style="max-height: 15rem">
                        <ul class="list-unstyled list-separated">
                            @if ($mod->students()->count())
                                @foreach ($mod->students()->latest()->take(5)->get() as $student)
                                    <li class="list-separated-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span
                                                    class="avatar avatar-md d-block"
                                                    style="background-image: url({{ $student->avatar() }}), url(https://www.gravatar.com/avatar/{{ md5($student->email) }}?d=mm)"
                                                ></span>
                                            </div>
                                            <div class="col">
                                                <div>
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