<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <a href="{{ route('milestone.view', [$project->id, $milestone->id]) }}">{{ $milestone->title }}</a>
        </h3>
    </div>

    <div class="card-body">
        <div>{{ Markdown::parse($milestone->description) }}</div>

        @if ($milestone->github_issue_link)
            <div>
                <a class="btn btn-outline-dark btn-sm" target="blank" href="{{ $milestone->github_issue_link }}">
                    <span class="fa fa-github"></span> GitHub Issue
                </a>
            </div>
        @endif

        <div class="mt-2 small text-muted">
            {{ $milestone->created_at->format('d M Y h:iA') }},
            {{ $milestone->created_at->diffForHumans() }}
        </div>
    </div>

    @if (
        Auth::guard('teacher')->check() &&
        $project->group()->first()->isSupervisedBy(Auth::guard()->id())
    )
        <div class="card-footer">
            <a href="{{ route('create.assignment', [$project->id, $milestone->id]) }}" class="btn btn-primary btn-block">Add Assignment</a>
        </div>
    @endif
</div>