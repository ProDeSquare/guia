<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Members
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
</div>

@if ($member->group()->first()->supervisor()->count())
    <div class="card">
        <div class="card-body">
            <p>
                Supervised by
                <a href="{{ route('teacher.profile', $member->group()->first()->supervisor()->first()->supervisor()->first()->id) }}">
                    {{ $member->group()->first()->supervisor()->first()->supervisor()->first()->name }}
                </a>
            </p>
        </div>
    </div>
@endif