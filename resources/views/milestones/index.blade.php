@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <div class="page-title">
                {{ $project->title }}
            </div>
        </div>

        <div class="page-body">
            <p>
                <a href="{{ route('project.milestones', $project) }}">View all milestones.</a>
            </p>

            <div class="row">
                <div class="col-lg-4">
                    @include('partials.milestone-details')
                </div>
            </div>
        </div>
    </div>
@endsection