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
        <div>
            {{ Markdown::parse($project->description) }}
        </div>

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
                <a class="btn btn-outline-dark btn-sm" href="{{ $project->github_repo }}" target="_blank">
                    <span class="fa fa-github"></span> GitHub
                </a>
            @endif

            @if ($project->link)
                <a class="btn btn-outline-primary btn-sm" href="{{ $project->link }}" target="_blank">
                    <span class="fa fa-link"></span> Link
                </a>
            @endif

            <div class="mt-2 small">
                <strong>Created: </strong>

                <span class="text-muted">
                    {{ $project->created_at->format('d M Y h:iA') }},
                    {{ $project->created_at->diffForHumans() }}
                </span>
            </div>

            <div class="small">
                <strong>Updated: </strong>

                <span class="text-muted">
                    {{ $project->updated_at->format('d M Y h:iA') }},
                    {{ $project->updated_at->diffForHumans() }}
                </span>
            </div>
        </div>
    </div>

    @if (
        Auth::guard('student')->check() &&
        Auth::guard()->user()->isGrouped() &&
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
                    <div class="small text-muted my-2">
                        Reject project to decline.
                    </div>
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
    @elseif ($project->status === 1)
        <div class="card-footer">
            <a href="{{ route('project.milestones', $project->id) }}">View Milestones</a>
        </div>
    @endif
</div>