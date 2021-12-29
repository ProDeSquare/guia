@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Add Moderator
                    </h2>

                    <p>
                        A Mod can add multiple teachers and students.
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

                            <form action="{{ route('mod.add') }}" method="post">
                                @csrf

                                {{-- name --}}
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Moderator's Name</label>

                                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="John Doe" name="name" value="{{ old('name') }}" required />

                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- email --}}
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Email Address</label>

                                    <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="username@riphahfsd.edu.pk" name="email" value="{{ old('email') }}" required />

                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- password --}}
                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">Generate Password</label>

                                    <div>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" value="{{ config('mod.default_password') }}" name="password" required />

                                        <small class="form-hint">
                                            The default password for mod is "{{ config('mod.default_password') }}", see <code>config/mod.php</code> for more details. <strong>Error would reset your input.</strong>
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
                                    Recent Moderators
                                </div>
                            </div>

                            <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                                @if ($mods->count())
                                    <div class="divide-y">
                                        @foreach ($mods as $mod)
                                            <div class="users-list-div">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <span class="avatar" style="background-image: url({{ $mod->avatar() }})"></span>
                                                    </div>
                                                    <div class="col">
                                                        <div class="text-truncate">
                                                            <strong>{{ $mod->name }}</strong>
                                                        </div>

                                                        <div class="text-muted">
                                                            <strong>Created:</strong>
                                                            {{ $mod->created_at->diffForHumans() }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div>You haven't added any moderator.</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection