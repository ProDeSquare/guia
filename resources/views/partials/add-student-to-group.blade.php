{{-- Auth user is already in a group & group is not full --}}
@if (
    Auth::guard()->user()->isGrouped() &&
    Auth::guard()->user()->group()->first()->group()->first()->members()->count() < 3
)
    {{-- if the student has already got request to join auth user's group --}}
    <div class="card">
        @if ($student->hasAlreadyRequestedForCurrentGroup(Auth::guard()->user()->group()->first()->group_id))
            <div class="card-header">
                <h3 class="card-title">
                    Requested
                </h3>
            </div>

            <div class="card-body">
                <p>
                    You've already requested <strong>{{ $student->name }}</strong> to join your group. You can cancel
                    this request if they don't accept.
                </p>
            </div>

            <div class="card-footer">
                <form action="{{ route('remove.from.group', $student->id) }}" method="post">
                    @csrf
    
                    <button class="btn btn-danger btn-block" type="submit">
                        Cancel Request
                    </button>
                </form>
            </div>
        @else
            <div class="card-header">
                <h3 class="card-title">
                    Send Request
                </h3>
            </div>

            <div class="card-body">
                <p>
                    <strong>{{ $student->name }}</strong> is not in any group, to add <strong>{{ $student->name }}</strong>
                    to your group send them a group request.
                </p>
            </div>

            <div class="card-footer">
                <form action="{{ route('add.to.group', $student->id) }}" method="post">
                    @csrf

                    <button class="btn btn-primary btn-block" type="submit">
                        Add to group
                    </button>
                </form>
            </div>
        @endif
    </div>

{{-- if auth user isn't in a group --}}
@elseif (! Auth::guard()->user()->isGrouped())
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Create Group & Request
            </h3>
        </div>

        <div class="card-body">
            <p>
                <strong>{{ $student->name }}</strong> is not in any group, click add to group to make a new group and invite
                <strong>{{ $student->name }}</strong> your group.
            </p>
        </div>

        <div class="card-footer">
            <form action="{{ route('add.to.group', $student->id) }}" method="post">
                @csrf

                <button class="btn btn-primary btn-block" type="submit">
                    Add to group
                </button>
            </form>
        </div>
    </div>
@endif