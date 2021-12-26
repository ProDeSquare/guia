@extends('layouts.app')

@section('content')
<div class="col col-login mx-auto">
    <div class="text-center mb-6">
        <img src="{{ asset('assets/images/logo.png') }}" class="h-6" alt="">
    </div>
    <form class="card" action="" method="post">
        <div class="card-body p-6">
            <div class="card-title">Mod Login</div>
            <div class="form-group">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label class="form-label">
                    Password
                    <a href="./forgot-password.html" class="float-right small">I forgot password</a>
                </label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
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