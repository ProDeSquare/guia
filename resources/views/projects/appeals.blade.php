@extends('layouts.app')

@section('title')
    | {{ $project->title }} (Rejection)
@endsection

@section('content')
    <div class="container">
        <div class="page-header">
            <h3 class="page-title">
                <span>Rejection: </span>
                <a href="{{ route('project.view', $project->id) }}">{{ $project->title }}</a>
            </h3>
        </div>

        <div class="page-body">
            <div class="row">
                <div class="col-lg-4">
                    @include('partials.projects-group-details')
                </div>

                <div class="col-lg-8">
                    <div class="card mb-5">
                        <div class="card-body">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection