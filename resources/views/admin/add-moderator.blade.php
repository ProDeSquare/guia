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

                            <form action="">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Moderator's Name</label>

                                    <input type="text" class="form-control" placeholder="John Doe" name="name" />
                                </div>

                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Email Address</label>

                                    <input type="email" class="form-control" placeholder="username@riphahfsd.edu.pk" name="email" />
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">Generate Password</label>

                                    <div>
                                        <input type="password" class="form-control" value="{{ config('mod.default_password') }}" name="password" />
                                        <small class="form-hint">
                                            The default password for mod is "{{ config('mod.default_password') }}", see <code>config/mod.php</code> for more details
                                        </small>
                                    </div>
                                </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-block btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection