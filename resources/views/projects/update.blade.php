@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h3 class="page-title">
                Update "<a href="{{ route('project.view', $project->id) }}">{{ $project->title }}</a>"
            </h3>
        </div>

        <div class="page-body">
            <div class="row">
                <div class="col-lg-4">
                    @include('partials.projects-group-details')
                </div>

                <div class="col-lg">
                    <div class="card card-body">
                        <h3 class="card-title">Update project</h3>

                        <form action="{{ route('update.project', $project->id) }}" method="post">
                            @csrf

                            <input type="hidden" name="_method" value="patch" />

                            <div class="row">
                                <div class="col-lg">
                                    <div class="form-group">
                                        <label for="title" class="form-label">Project Title <span class="text-red">*</span></label>

                                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Give your project a title" name="title" value="{{ old('title') ?? $project->title }}" required />

                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description" class="form-label">Project Description <span class="text-red">*</span></label>

                                        <textarea rows="7" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Describe your project in detail" name="description" required>{{ old('description') ?? $project->description }}</textarea>
                                    
                                        <small class="form-hint">This field accepts markdown</small>
                                    </div>
                                </div>

                                <div class="col-lg">
                                    <div class="form-group">
                                        <label for="github_repo" class="form-label">GitHub Repository</label>

                                        <input type="text" class="form-control @error('github_repo') is-invalid @enderror" id="github_repo" placeholder="GitHub repo for your project" name="github_repo" value="{{ old('github_repo') ?? $project->github_repo }}" />

                                        @error('github_repo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="technologies" class="form-label">Technologies to be used <span class="text-red">*</span></label>

                                        <input type="text" class="form-control @error('technologies') is-invalid @enderror" id="technologies" placeholder="AI, ML, Python" name="technologies" value="{{ old('technologies') ?? $project->technologies }}" required />

                                        @error('technologies')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="link" class="form-label">Link</label>

                                        <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" placeholder="Where would it be active" name="link" value="{{ old('link') ?? $project->link }}" />

                                        @error('link')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection