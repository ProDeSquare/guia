@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <div class="page-title">
                You're logged in as a moderator
            </div>
        </div>

        <div class="page-body">
            <div>Actions: </div>

            <ul>
                <li><a href="#">Add a Student</a></li>
                <li><a href="#">Add a teacher</a></li>
            </ul>
        </div>
    </div>
@endsection