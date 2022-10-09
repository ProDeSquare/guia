@if ($rejections->count())
    <h4 class="page-title mb-3">Rejections</h4>

    @foreach ($rejections as $rejection)
        <div class="card card-body mb-5">
            <div class="row">
                <div class="col-lg-1 mb-4">
                    <div
                        class="avatar d-block"
                        style="background-image: url({{ $rejection->teacher()->first()->avatar() }})"
                    ></div>
                </div>

                <div class="col-lg">
                    <p class="my-1">
                        <a href="{{ route('teacher.profile', $rejection->teacher()->first()->id) }}">
                            {{ $rejection->teacher()->first()->name }}
                        </a>
                    </p>

                    <div>
                        {{ Markdown::parse($rejection->comment) }}
                    </div>

                    <div class="small text-muted">
                        {{ $rejection->created_at->format('d M Y') }},
                        {{ $rejection->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif