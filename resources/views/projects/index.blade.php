@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <div class="page-title">
                {{ $project->title }}
            </div>
        </div>

        <div class="page-body">
            <div class="row">
                <div class="col-lg-4">
                    @include('partials.projects-group-details')
                </div>

                <div class="col-lg">
                    @include('partials.project-details')

                    @include('partials.project-rejection-form')
                </div>
            </div>

            <div>
                @include('partials.project-rejections-list')
            </div>
        </div>
    </div>
@endsection