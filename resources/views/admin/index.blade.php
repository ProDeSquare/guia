@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <div class="page-title">
                Admin Actions
            </div>
        </div>

        <div class="page-body">
            <p>Following is the list of available admin actions.</p>

            <ul>
                <li>
                    <a href="{{ route('mod.add') }}">Add a moderator</a>
                </li>
            </ul>
        </div>
    </div>
@endsection