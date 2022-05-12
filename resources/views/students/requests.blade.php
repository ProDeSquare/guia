@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h3 class="page-title">Pending Group Requests</div>
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
                                                                {{ $member->student()->first()->email }}
                                                            </small>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm">
                                            <form action="{{ route('request.decline', $request->id) }}" method="post">
                                                @csrf

                                                <input type="hidden" name="_method" value="delete" />

                                                <button class="btn btn-link btn-block">
                                                    Decline
                                                </button>
                                            </form>
                                        </div>

                                        <div class="col-sm">
                                            <form action="{{ route('request.accept', $request->id) }}" method="post">
                                                @csrf

                                                <input type="hidden" name="_method" value="patch" />

                                                <button class="btn btn-primary btn-block" type="submit">
                                                    <i class="mr-1 fe fe-check"></i>
                                                    Accept
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection