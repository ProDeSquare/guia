@extends('layouts.app')

@section('content')
<div class="my-3 my-md-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card card-profile">
                    <div class="card-header"></div>

                    <div class="card-body text-center">
                        <img class="card-profile-img" src="{{ $teacher->avatar() }}">

                        <h3 class="mb-3">{{ $teacher->name }}</h3>
                        <p class="mb-4">
                            Lorem ipsum dolor sit amet.
                        </p>

                        <div class="mb-3">
                            <span class="badge badge-teacher-student">Lecturer</span>
                        </div>

                        <button class="btn btn-outline-success btn-sm">
                            <span class="fa fa-whatsapp"></span> WhatsApp
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection