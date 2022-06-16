@extends('layouts.app')

@section('title', '| Dashboard')

@section('content')
    <div class="container">
        <div class="page-header">
            <h3 class="page-title">
                {{ Auth::guard()->user()->name }}'s Dashboard
            </h3>
        </div>

        <div class="page-body">
            @if (Auth::guard()->user()->underSupervision()->count())
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                                <thead>
                                    <tr>
                                        <th>Supervising</th>
                                        <th>Project</th>
                                    </tr>
                                </thead>
    
                                <tbody>
                                    @foreach (Auth::guard()->user()->underSupervision()->latest()->get() as $underSupervision)
                                        @php
                                            $group = $underSupervision->group()->first();
                                        @endphp

                                        <tr>
                                            <td>
                                                <div>
                                                    Group
                                                    <a href="{{ route('view.group.projects', $group->id) }}">
                                                        #{{ $group->id }}
                                                    </a>
                                                </div>
                                                <div class="small text-muted">
                                                    {{ $underSupervision->created_at->diffForHumans() }}
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <a href="{{ route('project.view', $group->acceptedProject()->id) }}">
                                                        {{ $group->acceptedProject()->title }}
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <p>You aren't supervising any groups yet.</p>
            @endif
        </div>
    </div>
@endsection