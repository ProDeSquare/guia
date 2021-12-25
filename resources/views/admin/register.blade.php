@extends('layouts.app')

@section('content')
<div class="col col-login mx-auto">
    <div class="text-center mb-6">
        <img src="{{ asset('assets/images/logo.png') }}" class="h-6" alt="">
    </div>
    <form class="card" action="" method="post">
        <div class="card-body p-6">
            <div class="card-title">Create new account</div>
            <div class="form-group">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" placeholder="Enter name">
            </div>
            <div class="form-group">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-primary btn-block">Create new account</button>
            </div>
        </div>
    </form>
</div>
@endsection