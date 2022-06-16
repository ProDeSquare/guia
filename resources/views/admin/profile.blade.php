@extends('layouts.app')

@section('title')
    | {{ $admin->name }}
@endsection

@section('content')
<div class="my-3 my-md-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                @include('partials.admin.profile-card')
            </div>

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Moderators ({{ $admin->moderators()->count() }})</h3>
                    </div>

                    <div class="card-body o-auto" style="max-height: 15rem">
                        <ul class="list-unstyled list-separated">
                            @if ($admin->moderators()->count())
                                @foreach ($admin->moderators()->latest()->take(15)->get() as $moderator)
                                    <li class="list-separated-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="avatar avatar-md d-block" style="background-image: url({{ $moderator->avatar() }})"></span>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <a href="{{ route('mod.profile', $moderator->id) }}" class="text-inherit">{{ $moderator->name }}</a>
                                                </div>
                                                <small class="d-block item-except text-sm text-muted h-1x">
                                                    {{ $moderator->email }}
                                                </small>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <small class="d-block item-except text-sm text-muted h-1x">
                                    {{ $admin->name }} hasn't added any moderators yet.
                                </small>
                            @endif
                        </ul>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection