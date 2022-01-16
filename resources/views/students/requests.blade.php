@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <div class="page-title">Pending Group Requests</div>
        </div>

        <div class="page-body">
            <p>You've {{ $requests->count() }} requests pending.</p>

            @if ($requests->count())
                <ul>
                    @foreach ($requests as $request)
                        @foreach ($request->group()->first()->members()->get() as $member)
                            @if ($member->accepted)
                                <li>
                                    <a href="{{ route('student.profile', $member->student()->first()->id) }}">
                                        {{ $member->student()->first()->name }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection