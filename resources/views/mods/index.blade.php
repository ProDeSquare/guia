@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <div class="page-title">
                Moderator Dashboard
            </div>
        </div>

        <div class="page-body">
            <div class="row row-cards">
                <div class="col-6 col-sm-4 col-lg-2">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            <div class="h1 mt-4 mb-0">
                                {{ \App\Models\Admin::count() }}
                            </div>

                            <div class="text-muted mb-4">
                                Admins
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-sm-4 col-lg-2">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            <div class="h1 mt-4 mb-0">
                                {{ \App\Models\Mod::count() }}
                            </div>

                            <div class="text-muted mb-4">
                                <a href="{{ route('all.moderators') }}">Moderators</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-sm-4 col-lg-2">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            <div class="h1 mt-4 mb-0">
                                {{ \App\Models\Teacher::count() }}
                            </div>

                            <div class="text-muted mb-4">
                                <a href="{{ route('all.teachers') }}">Teachers</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-sm-4 col-lg-2">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            <div class="h1 mt-4 mb-0">
                                {{ \App\Models\Student::count() }}
                            </div>

                            <div class="text-muted mb-4">
                                <a href="{{ route('all.students') }}">Students</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-sm-4 col-lg-2">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            <div class="h1 mt-4 mb-0">
                                {{ \App\Models\Group::count() }}
                            </div>

                            <div class="text-muted mb-4">
                                FYP Groups
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-sm-4 col-lg-2">
                    <div class="card">
                        <div class="card-body p-3 text-center">
                            <div class="h1 mt-4 mb-0">
                                {{ \App\Models\Project::where('status', 1)->count() }}
                            </div>

                            <div class="text-muted mb-4">
                                Projects
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection