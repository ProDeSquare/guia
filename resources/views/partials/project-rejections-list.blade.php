@if ($rejections->count())
    <h4 class="page-title mb-3">Rejections</h4>

    @foreach ($rejections as $rejection)
        <div class="card mb-5">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-1 mb-4">
                        <div
                            class="avatar d-block"
                            style="background-image: url({{ $rejection->teacher()->first()->avatar() }}), url(https://www.gravatar.com/avatar/{{ md5($rejection->teacher()->first()->email) }}?d=mm)"
                        ></div>
                    </div>
    
                    <div class="col-lg">
                        <p class="my-1">
                            <a href="{{ route('teacher.profile', $rejection->teacher()->first()->id) }}">
                                {{ $rejection->teacher()->first()->name }}
                            </a>
                        </p>
    
                        <div class="mt-4">
                            {{ Markdown::parse($rejection->comment) }}
                        </div>
    
                        <div class="small text-muted">
                            {{ $rejection->created_at->format('d M Y') }},
                            {{ $rejection->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            </div>

            @if (
                Auth::guard()->user()->getGuardType() === 'student' &&
                Auth::guard()->user()->isGrouped() &&
                $project->status !== 1 &&
                Auth::guard()->user()->getGroupId() === $project->group_id
            )
                <div class="card-footer">
                    <a href="{{ route('view.appeals', [$project, $rejection]) }}" class="btn btn-primary float-right">Appeal for project approval</a>
                </div>
            @elseif ($rejection->appeals()->count())
                <div class="card-footer">
                    <a href="{{ route('view.appeals', [$project, $rejection]) }}" class="btn btn-primary float-right">View appeals ({{ $rejection->appeals()->count() }})</a>
                </div>
            @endif
        </div>
    @endforeach
@endif