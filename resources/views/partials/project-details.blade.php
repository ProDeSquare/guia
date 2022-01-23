<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <a href="{{ route('project.view', $project->id) }}">{{ $project->title }}</a>

            @if ($project->status === 1)
                <button class="btn btn-link btn-disabled" disabled>
                    <i class="fe fe-check"></i>

                    Accepted
                </button>
            @endif
        </h3>
    </div>

    <div class="card-body">
        <p>{{ $project->description }}</p>

        <div>
            <h4>Technologies</h4>

            <ul>
                @foreach (explode(',', $project->technologies) as $technology)
                    <li>{{ trim($technology) }}</li>
                @endforeach
            </ul>
        </div>

        <div>
            @if ($project->github_repo)
                <a class="btn btn-outline-dark btn-sm" href="{{ $project->github_repo }}">
                    <span class="fa fa-github"></span> GitHub
                </a>
            @endif

            @if ($project->link)
                <a class="btn btn-outline-primary btn-sm" href="{{ $project->link }}">
                    <span class="fa fa-link"></span> Link
                </a>
            @endif
        </div>
    </div>

    @if (
        Auth::guard('student')->check() &&
        Auth::guard()->user()->getGroupId() === $project->group_id &&
        Auth::guard()->user()->mainGroup()->supervisor()->count() === 0
    )
        <div class="card-footer">
            <a href="{{ route('update.project', $project->id) }}" class="btn btn-primary float-right">Update</a>
        </div>
    @endif

    @if (
        Auth::guard('teacher')->check() &&
        $project->group()->first()->requested(Auth::guard()->id())
    )
        <div class="card-footer">
            <div class="row">
                <div class="col-lg">
                    <form action="#" method="post">
                        @csrf

                        <button class="btn btn-outline-danger">
                            Reject
                        </button>
                    </form>
                </div>

                <div class="col-lg">
                    <form action="{{ route('accept.supervision.request', [$project->group_id, $project->id]) }}" method="post">
                        @csrf

                        <button class="btn btn-primary float-right">
                            <i class="fe fe-check"></i>

                            Accept
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>