@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h3 class="page-title">
                <a href="{{ route('project.view', $project->id) }}">{{ $project->title }}</a>
            </h3>
        </div>

        <div class="page-body">
            <div class="row">
                <div class="col-lg-4">
                    @include('partials.projects-group-details')
                </div>

                <div class="col-lg-8">
                    @include('partials.project-details')

                    @include('partials.project-rejection-form')

                    @include('partials.project-rejections-list')
                </div>
            </div>
        </div>
    </div>
@endsection