@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <div class="page-title">
                Milestones for "<a href="{{ route('project.view', $project->id) }}">{{ $project->title }}</a>"
            </div>
        </div>

        <div class="page-body">
            <div>
                <ul>
                    @foreach ($milestones as $milestone)
                        <li>
                            {{ $milestone->title }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection