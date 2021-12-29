@extends('layouts.app')

@section('content')
<div class="col col-login mx-auto">
    <div class="text-center mb-6">
        <img src="{{ asset('assets/images/logo.png') }}" class="h-6" alt="">
    </div>
    <form class="card" action="{{ route('admin.login') }}" method="post">
        @csrf

        <div class="card-body p-6">
            <div class="card-title">Admin Login</div>
            <div class="form-group">
                <label class="form-label" for="email">Email address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" placeholder="Enter email" value="{{ old('email') }}" name="email" required />

                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="password">
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
                    <input type="checkbox" class="custom-control-input" name="remember" {{ old('remember') ? 'checked' : '' }} />
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