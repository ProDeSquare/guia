@php
    $members = $student->group()->first()->group()->first()->members()->get();
    $group = $student->group()->first()->group()->first();
@endphp

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <a href="{{ route('view.group.projects', $group->id) }}">
                Group #{{ $group->id }}
            </a>
        </h3>
    </div>

    <div class="card-body o-auto" style="max-height: 15rem">
        <ul class="list-unstyled list-separated">
            @foreach ($members as $member)
                <li class="list-separated-item">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="avatar avatar-md d-block" style="background-image: url({{ $member->student()->first()->avatar() }})"></span>
                        </div>
                        <div class="col">
                            <div>
                                <a href="{{ route('student.profile', $member->student()->first()->id) }}" class="text-inherit">{{ $member->student()->first()->name }}</a>
                            </div>
                            <small class="d-block item-except text-sm text-muted h-1x">
                                {{ $member->student()->first()->roll_no }}
                            </small>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    @if (Auth::guard('student')->check() && Auth::guard()->id() === $student->id)
        @if (Auth::guard()->user()->group()->first()->group()->first()->members()->count() <= 1)
            <div class="card-footer">
                <form action="{{ route('group.delete') }}" method="post">
                    @csrf

                    <input type="hidden" name="_method" value="delete" />

                    <button class="btn btn-block btn-primary">
                        Leave Group
                    </button>
                </form>
            </div>
        @endif
    @endif
</div>