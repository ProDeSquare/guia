@extends('layouts.app')

@section('content')
<div class="col col-login mx-auto">
    <div class="text-center mb-6">
        <img src="{{ asset('assets/images/logo.png') }}" class="h-6" alt="">
    </div>
    <form class="card" action="" method="post">
        @csrf

        <div class="card-body p-6">
            <div class="card-title">Register as an admin</div>

            {{-- name --}}
            <div class="form-group">
                <label class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name" name="name" value="{{ old('name') }}" />

                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- email --}}
            <div class="form-group">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email" name="email" value="{{ old('email') }}" />

                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- password --}}
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" />

                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- submit --}}
            <div class="form-footer">
                <button type="submit" class="btn btn-primary btn-block">Create new account</button>
            </div>
        </div>
    </form>

    <div class="card mt-4">
        <p class="card-body">This is one time setup! Once the admin account is created you would never need to setup this app again.</p>
    </div>
</div>
@endsection