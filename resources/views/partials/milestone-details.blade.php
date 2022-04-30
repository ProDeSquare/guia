<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <a href="{{ route('milestone.view', [$project->id, $milestone->id]) }}">{{ $milestone->title }}</a>
        </h3>
    </div>

    <div class="card-body">
        <p>{{ $milestone->description }}</p>

        <div>
            @if ($milestone->github_issue_link)
                <a class="btn btn-outline-dark btn-sm" href="{{ $milestone->github_issue_link }}">
                    <span class="fa fa-github"></span> GitHub
                </a>
            @endif
        </div>
    </div>
</div>