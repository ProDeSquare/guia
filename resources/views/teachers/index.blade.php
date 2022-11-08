@extends('layouts.app')

@section('title', '| Dashboard')

@section('content')
    <div class="container">
        <div class="page-header">
            <h3 class="page-title">
                <a href="{{ route('teacher.profile', Auth::guard()->user()) }}">{{ Auth::guard()->user()->name }}</a>'s Dashboard
            </h3>
        </div>

        <div class="page-body">
            @if (Auth::guard()->user()->underSupervision()->count())
                <h5>Under Supervision</h5>

                <div class="row">
                    @foreach (Auth::guard()->user()->underSupervision()->latest()->get() as $underSupervision)
                        @php $group = $underSupervision->group()->first(); @endphp

                        <div class="col-lg-4 mb-4">
                            <div class="card card-body">
                                <div>
                                    <a
                                        class="badge badge-teacher-student"
                                        href="{{ route('view.group.projects', $group) }}"
                                    >
                                        #{{ $group->id }}
                                    </a>
                                </div>

                                <h3 class="card-title mt-5">
                                    <a href="{{ route('project.view', $group->acceptedProject()) }}">
                                        {{ $group->acceptedProject()->title }}
                                    </a>
                                </h3>

                                <div>
                                    @if ($group->acceptedProject()->github_repo)
                                        <a class="btn btn-outline-dark btn-sm" href="{{ $group->acceptedProject()->github_repo }}" target="_blank">
                                            <span class="fa fa-github"></span> GitHub
                                        </a>
                                    @else
                                        <a
                                            class="btn btn-outline-dark btn-sm disabled"
                                            href="#"
                                            target="_blank"
                                        >
                                            <span class="fa fa-github"></span> GitHub
                                        </a>
                                    @endif

                                    @if ($group->acceptedProject()->link)
                                        <a class="btn btn-outline-primary btn-sm" href="{{ $group->acceptedProject()->link }}" target="_blank">
                                            <span class="fa fa-link"></span> Link
                                        </a>
                                    @else
                                        <a
                                            class="btn btn-outline-primary btn-sm disabled"
                                            href="#"
                                            target="_blank"
                                        >
                                            <span class="fa fa-link"></span> Link
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>You aren't supervising any groups</p>

                @if (Auth::guard()->user()->supervisionRequests()->count())
                    <a
                        href="{{ route('supervision.requests') }}"
                        class="btn btn-primary"
                    >{{ Auth::guard()->user()->supervisionRequests()->count() }} new requests</a>
                @endif
            @endif
        </div>
    </div>
@endsection