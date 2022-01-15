@php
    $guard = auth()->guard()->user()->getGuardType();

    $guard_labels = [
        'admin' => 'Administrator',
        'mod' => 'Moderator',
        'teacher' => 'Lecturer',
        'student' => 'Student',
    ];
@endphp

<div class="header py-4">
    <div class="container">
        <div class="d-flex">
            <a class="header-brand" href="{{ route('home') }}">
            <img src="{{ asset("assets/images/logo.png") }}" class="header-brand-img" alt="riphah logo">
            </a>
            <div class="d-flex order-lg-2 ml-auto">
                <div class="dropdown">
                    <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                    <span class="avatar" style="background-image: url({{ auth()->guard($guard)->user()->avatar() }})"></span>
                    <span class="ml-2 d-none d-lg-block">
                    <span class="text-default">
                        {{ auth()->guard($guard)->user()->name }}
                    </span>
                    <small class="text-muted d-block mt-1">
                        {{ $guard_labels[$guard] }}
                    </small>
                    </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        @if (auth()->guard()->user()->getGuardType() === 'admin')
                            <a class="dropdown-item" href="{{ route('admin.profile', ['admin' => auth()->guard()->id()]) }}">
                                <i class="dropdown-icon fe fe-user"></i> Profile
                            </a>
                        @elseif (auth()->guard()->user()->getGuardType() === 'mod')
                            <a class="dropdown-item" href="{{ route('mod.profile', ['mod' => auth()->guard()->id()]) }}">
                                <i class="dropdown-icon fe fe-user"></i> Profile
                            </a>
                        @elseif (auth()->guard()->user()->getGuardType() === 'teacher')
                            <a class="dropdown-item" href="{{ route('teacher.profile', ['teacher' => auth()->guard()->id()]) }}">
                                <i class="dropdown-icon fe fe-user"></i> Profile
                            </a>
                        @elseif (auth()->guard()->user()->getGuardType() === 'student')
                            <a class="dropdown-item" href="{{ route('student.profile', ['student' => auth()->guard()->id()]) }}">
                                <i class="dropdown-icon fe fe-user"></i> Profile
                            </a>
                        @endif
                        <a class="dropdown-item" href="#">
                        <i class="dropdown-icon fe fe-settings"></i> Settings
                        </a>
                        <a class="dropdown-item" href="#">
                        <span class="float-right"><span class="badge badge-primary">6</span></span>
                        <i class="dropdown-icon fe fe-mail"></i> Inbox
                        </a>
                        <a class="dropdown-item" href="#">
                        <i class="dropdown-icon fe fe-send"></i> Message
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                        <i class="dropdown-icon fe fe-help-circle"></i> Need help?
                        </a>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="dropdown-item">
                                <i class="dropdown-icon fe fe-log-out"></i> Sign out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
            <span class="header-toggler-icon"></span>
            </a>
        </div>
    </div>
</div>
<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 ml-auto">
                <form class="input-icon my-3 my-lg-0" method="get" action="{{ route('search') }}">
                    <input type="search" class="form-control header-search" placeholder="Search&hellip;" tabindex="1" name="q" value="{{ app('request')->input('q') }}" />
                    <div class="input-icon-addon">
                        <i class="fe fe-search"></i>
                    </div>
                </form>
            </div>
            <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link active"><i class="fe fe-home"></i> Dashboard</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-file"></i> Pages</a>
                        <div class="dropdown-menu dropdown-menu-arrow">
                            <a href="#" class="dropdown-item">Profile</a>
                            <a href="#" class="dropdown-item">Login</a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="fe fe-file-text"></i> Documentation</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>