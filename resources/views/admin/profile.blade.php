@extends('layouts.app')

@section('content')
<div class="my-3 my-md-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                @include('partials.admin.profile-card')
            </div>

            <div class="col-lg-8">
                {{-- update password form --}}

            </div>
        </div>
    </div>
</div>
@endsection