@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h3 class="page-title">Update Profile</h3>
        </div>

        <div class="page-body">
            <div class="row">
                <div class="col-lg-4">
                    @include('partials.mods.profile-card')
                </div>

                <div class="col-lg">
                    @include('partials.update-password')
                </div>
            </div>
        </div>
    </div>
@endsection