@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h3 class="page-title">
                Add Milestone for <a href="{{ route('project.view', $project->id) }}">"{{$project->title}}"</a>
            </h3>
        </div>

        <div class="page-body">
            <div class="row">
                <div class="col-lg-4">
                    @include('partials.projects-group-details')
                </div>

                <div class="col-lg">
                    <div class="card card-body">
                        <h3 class="card-title">Create a milestone</h3>

                        <form action="{{ route('create.milestone', $project->id) }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="title" class="form-label">Milestone Title <span class="text-red">*</span></label>

                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Give your milestone a title" name="title" value="{{ old('title') }}" required />

                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description" class="form-label">Milestone Description <span class="text-red">*</span></label>

                                <textarea rows="7" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Describe your milestone in detail" name="description" required>{{ old('description') }}</textarea>
                            
                                <small class="form-hint">This field accepts markdown</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="github_issue_link" class="form-label">GitHub Issue Link</label>

                                <input type="text" class="form-control @error('github_issue_link') is-invalid @enderror" id="github_issue_link" placeholder="Github issue link for this milestone" name="github_issue_link" value="{{ old('github_issue_link') }}" />

                                @error('github_issue_link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection