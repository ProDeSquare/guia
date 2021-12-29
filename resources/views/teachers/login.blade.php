@extends('layouts.app')

@section('content')
<div class="col col-login mx-auto">
    <div class="text-center mb-6">
        <img src="{{ asset('assets/images/logo.png') }}" class="h-6" alt="">
    </div>

    <form class="card" action="" method="post">
        @csrf

        <div class="card-body p-6">
            <div class="card-title">Teacher Login</div>

            <div class="form-group">
                <label for="email" class="form-label">Email address</label>

                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email" name="email" value="{{ old('email') }}" required />

                @error('email')
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
                    <input type="checkbox" class="custom-control-input" />
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