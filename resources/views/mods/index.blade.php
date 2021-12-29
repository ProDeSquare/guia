@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <div class="page-title">
                Moderator Actions
            </div>
        </div>

        <div class="page-body">
            <p>Following is the list of available moderator actions.</p>

            <ul>
                <li><a href="{{ route('student.add') }}">Add a Student</a></li>
                <li><a href="{{ route('teacher.add') }}">Add a Teacher</a></li>
            </ul>
        </div>
    </div>
@endsection