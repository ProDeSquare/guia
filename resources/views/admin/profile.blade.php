@extends('layouts.app')

@section('content')
<div class="my-3 my-md-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card card-profile">
                    <div class="card-header"></div>

                    <div class="card-body text-center">
                        <img class="card-profile-img" src="{{ $admin->avatar() }}">

                        <h3 class="mb-3">{{ $admin->name }}</h3>
                        <p class="mb-4">
                            Lorem ipsum dolor sit amet.
                        </p>

                        <div class="mb-3">
                            <span class="badge badge-admin-mod">Admin</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection