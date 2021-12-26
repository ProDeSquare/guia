@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 mx-auto mb-5">
                <img src="{{ asset('assets/images/logo.png') }}" alt="RIUF" class="img-fluid" />
            </div>
        </div>

        <h2 class="text-center mb-6">Welcome to guía</h2>

        <div class="row">
            <div class="col-md px-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Moderator Login</h4>

                        <p>Continue with Mod login if your department have provided you Mod account.</p>

                        <button class="btn btn-primary btn-block">I'm Moderator</button>
                    </div>
                </div>
            </div>
            <div class="col-md px-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Teacher Login</h4>

                        <p>Login with account provided you by your moderator as a teacher.</p>

                        <button class="btn btn-primary btn-block">I'm Teacher</button>
                    </div>
                </div>
            </div>
            <div class="col-md px-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Student Login</h4>

                        <p>Login with account provided you by your moderator as a student.</p>

                        <button class="btn btn-primary btn-block">I'm Student</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            I'm an <a href="{{ url('/admin/login') }}">admin.</a>
        </div>
    </div>
@endsection