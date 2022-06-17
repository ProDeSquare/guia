@extends('layouts.app')

@section('title', '| Student Login')

@section('content')
<div class="col col-login mx-auto">
    <div class="text-center mb-6">
        <img src="{{ asset('assets/images/logo.png') }}" class="h-6" alt="">
    </div>

    <form class="card" action="{{ route('student.login') }}" method="post">
        @csrf

        <div class="card-body p-6">
            <div class="card-title">Student Login</div>

            <div class="form-group">
                <label class="form-label" for="username">Username</label>

                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Enter Username" name="username" value="{{ old('username') }}" required />

                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">
                    Password
                    {{-- <a href="./forgot-password.html" class="float-right small">I forgot password</a> --}}
                </label>

                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password" required />

                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="remember" />
                    <span class="custom-control-label">Remember me</span>
                </label>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary btn-block">Sign in</button>
            </div>
        </div>
    </form>
</div>
@endsection