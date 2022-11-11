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

                        <a href="{{ route('mod.login') }}" class="btn btn-primary btn-block">I'm Moderator</a>
                    </div>
                </div>
            </div>
            <div class="col-md px-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Teacher Login</h4>

                        <p>Login with account provided you by your moderator as a teacher.</p>

                        <a href="{{ route('teacher.login') }}" class="btn btn-primary btn-block">I'm Teacher</a>
                    </div>
                </div>
            </div>
            <div class="col-md px-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Student Login</h4>

                        <p>Login with account provided you by your moderator as a student.</p>

                        <a href="{{ route('student.login') }}" class="btn btn-primary btn-block">I'm Student</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ url('/admin/login') }}">Administrator Login</a>
        </div>
    </div>
@endsection