@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Add Student
                    </h2>

                    <p>
                        Students can request or make request to join groups. Make requests to teachers to supervise or co-supervise them.
                    </p>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Fill out this form</div>

                            <form action="{{ route('student.add') }}" method="post">
                                @csrf

                                {{-- name --}}
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Students's Name</label>

                                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="John Doe" name="name" id="name" value="{{ old('name') }}" required />

                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Roll No. --}}
                                <div class="form-group mb-3">
                                    <label for="roll_no" class="form-label">Roll Number</label>

                                    <input type="number" class="form-control @error('roll_no') is-invalid @enderror" placeholder="10706" name="roll_no" id="roll_no" value="{{ old('roll_no') }}" required />

                                    @error('roll_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- username --}}
                                <div class="form-group mb-3">
                                    <label for="username" class="form-label">Username</label>

                                    <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="{{ config('student.default_username') }}" name="username" value="{{ old('username') ?? config('student.default_username') }}" id="username" required />

                                    <small class="form-hint">
                                        Students would use username instead of email to login.
                                    </small>

                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- password --}}
                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">Generate Password</label>

                                    <div>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" value="{{ config('student.default_password') }}" name="password" id="password" required />

                                        <small class="form-hint">
                                            The default password for student is "{{ config('student.default_password') }}", see <code>config/student.php</code> for more details. <strong>Error would reset your input.</strong>
                                        </small>

                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- submit --}}
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-block btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                        <div class="card" style="max-height: calc(24rem + 10px)">
                            <div class="card-header">
                                <div class="card-title">
                                    Recent Students
                                </div>
                            </div>

                            <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                                @if ($students->count())
                                    <div class="divide-y">
                                        @foreach ($students as $student)
                                            <div class="users-list-div">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span class="avatar" style="background-image: url({{ $student->avatar() }})"></span>
                                                    </div>
                                                    <div class="col">
                                                        <div class="text-truncate">
                                                            <strong>{{ $student->name }}</strong>
                                                        </div>

                                                        <div class="text-muted">
                                                            <strong>Created:</strong>
                                                            {{ $student->created_at->diffForHumans() }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div>You haven't added any student.</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection