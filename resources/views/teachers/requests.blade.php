@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h3 class="page-title">
                Supervision Requests
            </h3>
        </div>

        <div class="page-body">
            <p>You've {{ $requests->count() }} requests pending.</p>

            @if ($requests->count())
                <div class="row">
                    @foreach ($requests as $request)
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Group #{{ $request->group_id }}</h3>
                                </div>

                                <div class="card-body o-auto" style="max-height: 15rem">
                                    <ul class="list-unstyled list-separated">
                                        @foreach ($request->group()->first()->members()->get() as $member)
                                            @if ($member->accepted)
                                                <li class="list-separated-item">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <span class="avatar avatar-md d-block" style="background-image: url({{ $member->student()->first()->avatar() }})"></span>
                                                        </div>
                                                        <div class="col">
                                                            <div>
                                                                <a href="{{ route('student.profile', $member->student()->first()->id) }}" class="text-inherit">
                                                                    {{ $member->student()->first()->name }}
                                                                </a>
                                                            </div>
                                                            <small class="d-block item-except text-sm text-muted h-1x">
                                                                {{ $member->student()->first()->roll_no }}
                                                            </small>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="card-footer">
                                    <a class="btn btn-block" href="{{ route('view.group.projects', $request->group_id) }}">View Group Projects</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection