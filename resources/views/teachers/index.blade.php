@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h3 class="page-title">
                {{ Auth::guard()->user()->name }}'s Dashboard
            </h3>
        </div>

        <div class="page-body">
            
        </div>
    </div>
@endsection