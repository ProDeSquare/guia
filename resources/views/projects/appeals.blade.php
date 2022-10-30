@extends('layouts.app')

@section('title')
    | {{ $project->title }} (Rejection)
@endsection

@section('content')
    <div class="container">
        <div class="page-header">
            <h3 class="page-title">
                <span>Rejection: </span>
                <a href="{{ route('project.view', $project->id) }}">{{ $project->title }}</a>
            </h3>
        </div>

        <div class="page-body">
            <div class="row">
                <div class="col-lg-4">
                    @include('partials.projects-group-details')
                </div>

                <div class="col-lg-8">
                    <div class="card mb-5">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-1 mb-4">
                                    <div
                                        class="avatar d-block"
                                        style="background-image: url({{ $rejection->teacher()->first()->avatar() }})"
                                    ></div>
                                </div>
                
                                <div class="col-lg">
                                    <p class="my-1">
                                        <a href="{{ route('teacher.profile', $rejection->teacher()->first()->id) }}">
                                            {{ $rejection->teacher()->first()->name }}
                                        </a>
                                    </p>
                
                                    <div class="mt-4">
                                        {{ Markdown::parse($rejection->comment) }}
                                    </div>
                
                                    <div class="small text-muted">
                                        {{ $rejection->created_at->format('d M Y') }},
                                        {{ $rejection->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        @if (
                            Auth::guard()->user()->getGuardType() === 'student' &&
                            Auth::guard()->user()->isGrouped() &&
                            $project->status !== 1 &&
                            Auth::guard()->user()->getGroupId() === $project->group_id
                        )
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Write an appeal</h3>
                                </div>
    
                                <div class="card-body">
                                    <form action="#" method="post">
                                        @csrf
    
                                        <div class="form-group">
                                            <label class="form-label" for="appeal-text">Appeal <span class="text-danger">*</span></label>
    
                                            <textarea
                                                name="text"
                                                id="appeal-text"
                                                rows="5"
                                                class="form-control @error('text') is-invalid @enderror"
                                                placeholder="This project would turn out very well..."
                                                required
                                            >{{ old('text') }}</textarea>

                                            <small class="form-hint">This field accepts markdown</small>
    
                                            @error('text')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
    
                                        <div class="form-group mb-0">
                                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @elseif (
                            Auth::guard()->user()->getGuardType() === 'teacher' &&
                            $project->status !== 1 &&
                            $rejection->teacher_id === Auth::guard()->id()
                        )
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Add a reply</h3>
                                </div>
    
                                <div class="card-body">
                                    <form action="#" method="post">
                                        @csrf
    
                                        <div class="form-group">
                                            <label class="form-label" for="appeal-text">Text <span class="text-danger">*</span></label>
    
                                            <textarea
                                                name="text"
                                                id="appeal-text"
                                                rows="5"
                                                class="form-control @error('text') is-invalid @enderror"
                                                placeholder="This project is not feasible..."
                                                required
                                            >{{ old('text') }}</textarea>

                                            <small class="form-hint">This field accepts markdown</small>
    
                                            @error('text')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
    
                                        <div class="form-group mb-0">
                                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection