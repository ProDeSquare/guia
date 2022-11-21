@extends('layouts.app')

@section('title', '| Account Settings')

@section('content')
    <div class="container">
        <div class="page-header">
            <h3 class="page-title">Update Profile</h3>
        </div>

        <div class="page-body">
            <div class="row">
                <div class="col-lg-4">
                    @include('partials.admin.profile-card')
                </div>

                <div class="col-lg">
                    @include('partials.update-password')
                    @include('partials.update-avatar')
                </div>
            </div>
        </div>
    </div>
@endsection