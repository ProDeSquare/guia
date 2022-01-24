@extends('layouts.app')

@section('content')
<div class="my-3 my-md-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                @include('partials.teachers.profile-card')

                @include('partials.teachers.requirements')
            </div>

            <div class="col-lg-8">
                @if ($teacher->underSupervision()->count())
                    @include('partials.teachers.supervision-list')
                @else
                    <p class="text-center">
                        <strong>{{ $teacher->name }}</strong> has no activity for time being.
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection