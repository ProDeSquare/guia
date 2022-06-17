@extends('layouts.app')

@section('title', '| Group Projects')

@section('content')
    <div class="container">
        <div class="page-header">
            <h3 class="page-title">
                Group Projects
            </h3>
        </div>

        <div class="page-body">
            <div class="row">
                <div class="col-lg-4">
                    @include('partials.projects-group-details')
                </div>

                <div class="col-lg">
                    @if ($projects->count())
                        @foreach ($projects as $project)
                            @include('partials.project-details')
                        @endforeach

                        {{ $projects->links() }}
                    @else
                        <p class="text-center">No projects found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection