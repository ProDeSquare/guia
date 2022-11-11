@extends('layouts.app')

@section('title')
    | {{ $project->title }} (Edit History)
@endsection

@section('content')
    <div class="container">
        <div class="page-header">
            <h3 class="page-title">
                <a href="{{ route('project.view', $project->id) }}">{{ $project->title }}</a> (Edit History)
            </h3>
        </div>

        <div class="page-body">
            <div class="row">
                <div class="col-lg-4">
                    @include('partials.projects-group-details')
                </div>

                <div class="col-lg-8">
                    @forelse ($edits as $edit)
                        <div class="card mb-5">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <a href="{{ route('project.view', $project->id) }}">{{ $edit->title }}</a>
                                </h3>
                            </div>

                            <div class="card-body">
                                <div>
                                    {{ Markdown::parse($edit->description) }}
                                </div>

                                <div>
                                    <h4>Technologies</h4>
                        
                                    <ul>
                                        @foreach (explode(',', $edit->technologies) as $technology)
                                            <li>{{ trim($technology) }}</li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div>
                                    @if ($edit->github_repo)
                                        <a class="btn btn-outline-dark btn-sm" href="{{ $edit->github_repo }}" target="_blank">
                                            <span class="fa fa-github"></span> GitHub
                                        </a>
                                    @endif

                                    @if ($edit->link)
                                        <a class="btn btn-outline-primary btn-sm" href="{{ $edit->link }}" target="_blank">
                                            <span class="fa fa-link"></span> Link
                                        </a>
                                    @endif
                                </div>

                                <div class="mt-2 small">
                                    <strong>Till: </strong>

                                    <span class="text-muted">
                                        {{ $edit->created_at->format('d M Y h:iA') }},
                                        {{ $edit->created_at->diffForHumans(null, true, true) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">{{ $edits->links() }}</div>
                    @empty
                        <p class="text-center">No edit history available for this project.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection