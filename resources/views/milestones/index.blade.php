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
                    @include('partials.milestone-details')
                </div>
            </div>
        </div>
    </div>
@endsection