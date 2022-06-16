@extends('layouts.app')

@section('title', '| Settings')

@section('content')
    <div class="container">
        <div class="page-header">
            <h3 class="page-title">Update Profile</h3>
        </div>

        <div class="page-body">
            <div class="row">
                <div class="col-lg-4">
                    @include('partials.teachers.profile-card')
                </div>

                <div class="col-lg">
                    @include('partials.teachers-update-profile')
                    @include('partials.update-password')
                </div>
            </div>
        </div>
    </div>
@endsection