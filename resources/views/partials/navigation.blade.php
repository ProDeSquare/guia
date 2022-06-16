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
                    <span class="avatar" style="background-image: url({{ auth()->guard()->user()->avatar() }})"></span>
                    <span class="ml-2 d-none d-lg-block">
                    <span class="text-default">
                        {{ auth()->guard()->user()->name }}
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

                            <a class="dropdown-item" href="{{ route('admin.settings') }}">
                                <i class="dropdown-icon fe fe-settings"></i> Settings
                            </a>
                        @elseif (auth()->guard()->user()->getGuardType() === 'mod')
                            <a class="dropdown-item" href="{{ route('mod.profile', ['mod' => auth()->guard()->id()]) }}">
                                <i class="dropdown-icon fe fe-user"></i> Profile
                            </a>

                            <a class="dropdown-item" href="{{ route('mod.settings') }}">
                                <i class="dropdown-icon fe fe-settings"></i> Settings
                            </a>
                        @elseif (auth()->guard()->user()->getGuardType() === 'teacher')
                            <a class="dropdown-item" href="{{ route('teacher.profile', ['teacher' => auth()->guard()->id()]) }}">
                                <i class="dropdown-icon fe fe-user"></i> Profile
                            </a>

                            <a class="dropdown-item" href="{{ route('teacher.settings') }}">
                                <i class="dropdown-icon fe fe-settings"></i> Settings
                            </a>
                        @elseif (auth()->guard()->user()->getGuardType() === 'student')
                            <a class="dropdown-item" href="{{ route('student.profile', ['student' => auth()->guard()->id()]) }}">
                                <i class="dropdown-icon fe fe-user"></i> Profile
                            </a>

                            <a class="dropdown-item" href="{{ route('student.settings') }}">
                                <i class="dropdown-icon fe fe-settings"></i> Settings
                            </a>
                        @endif

                        @if (
                            Auth::guard('student')->check() &&
                            !Auth::guard()->user()->isGrouped()
                        )
                            <a class="dropdown-item" href="{{ route('requests.view') }}">
                                <span class="float-right">
                                    <span class="badge badge-primary">
                                        {{ Auth::guard()->user()->groupRequests()->count() }}
                                    </span>
                                </span>
                                <i class="dropdown-icon fe fe-send"></i> Requests
                            </a>
                        @endif

                        @if (Auth::guard('teacher')->check())
                            <a class="dropdown-item" href="{{ route('supervision.requests') }}">
                                <span class="float-right">
                                    <span class="badge badge-primary">
                                        {{ Auth::guard()->user()->supervisionRequests()->count() }}
                                    </span>
                                </span>
                                <i class="dropdown-icon fe fe-send"></i> Requests
                            </a>
                        @endif

                        <div class="dropdown-divider"></div>

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
                        <a href="{{ route('home') }}" class="nav-link {{ Route::currentRouteName() === 'dashboard' ? 'active' : '' }}"><i class="fe fe-home"></i> Dashboard</a>
                    </li>

                    @if (Auth::guard('admin')->check())
                        <li class="nav-item">
                            <a href="{{ route('mod.add') }}" class="nav-link {{ Route::currentRouteName() === 'mod.add' ? 'active' : '' }}"><i class="fe fe-plus"></i> Add Moderator</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('faq.create') }}" class="nav-link {{ Route::currentRouteName() === 'faq.create' ? 'active' : '' }}"><i class="fe fe-plus"></i> Create FAQ</a>
                        </li>
                    @endif

                    @if (Auth::guard('mod')->check())
                        <li class="nav-item">
                            <a href="{{ route('teacher.add') }}" class="nav-link {{ Route::currentRouteName() === 'teacher.add' ? 'active' : '' }}"><i class="fe fe-plus"></i> Add Teacher</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('student.add') }}" class="nav-link {{ Route::currentRouteName() === 'student.add' ? 'active' : '' }}"><i class="fe fe-plus"></i> Add Student</a>
                        </li>
                    @endif

                    @if (
                        Auth::guard('student')->check() &&
                        Auth::guard()->user()->isGrouped()
                    )
                        <li class="nav-item">
                            <a href="{{ route('view.group.projects', Auth::guard()->user()->getGroupId()) }}" class="nav-link {{ Route::currentRouteName() === 'view.group.projects' ? 'active' : '' }}"><i class="fe fe-file-text"></i> Group Projects</a>
                        </li>
    
                        @if (Auth::guard()->user()->mainGroup()->supervisor()->count() === 0)
                            <li class="nav-item">
                                <a href="{{ route('create.project') }}" class="nav-link {{ Route::currentRouteName() === 'create.project' ? 'active' : '' }}"><i class="fe fe-plus"></i> Create Project</a>
                            </li>
                        @endif
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>