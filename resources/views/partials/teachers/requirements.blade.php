@if ($teacher->requirements)
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Requirements</h4>

            <ul>
                @foreach (explode(',', $teacher->requirements) as $requirement)
                    <li>{{ $requirement }}</li>
                @endforeach
            </ul>

            @if (
                Auth::guard('student')->check() &&
                Auth::guard()->user()->isGrouped() &&
                Auth::guard()->user()->mainGroup()->projects()->count()
            )
                @if (Auth::guard()->user()->mainGroup()->isSupervisedBy($teacher->id))
                    <button class="btn btn-primary btn-disabled btn-block" disabled>Supervisor</button>
                @elseif (Auth::guard()->user()->mainGroup()->supervisor()->count() === 0)

                    @if (Auth::guard()->user()->mainGroup()->requested($teacher->id))
                        <form action="{{ route('supervise.request.cancel', $teacher->id) }}" method="post">
                            @csrf

                            <input type="hidden" name="_method" value="delete" />

                            <button class="btn btn-outline-danger btn-block" type="submit">Cancel Request</button>
                        </form>
                    @else
                        <form action="{{ route('supervise.request', $teacher->id) }}" method="post">
                            @csrf

                            <button class="btn btn-primary btn-block" type="submit">Supervision Request</button>
                        </form>
                    @endif
                @endif
            @endif
        </div>
    </div>
@endif