@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-4">
                <div class="page-body py-6">
                    <div class="card card-body">
                        <h4 class="card-title">
                            Fill out necessary info
                        </h4>

                        <form action="{{ route('student.add.email') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="email" class="form-label">Email address</label>
                
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email" name="email" value="{{ old('email') }}" required />
                
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <small class="form-hint">You must add email address to continue using this site.</small>
                            </div>

                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary btn-block">Continue</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection