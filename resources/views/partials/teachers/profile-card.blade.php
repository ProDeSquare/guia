<div class="card card-profile">
    <div class="card-header"></div>

    <div class="card-body text-center">
        <div class="profile-image-container">
            <img
                src="{{ $teacher->avatar() }}"
                alt="{{ $teacher->name }}'s avatar"
                onerror="this.onerror=null;this.src='https://www.gravatar.com/avatar/{{ md5($teacher->email) }}?d=mm'"
            />
        </div>

        <h3 class="mb-3">{{ $teacher->name }}</h3>
        <p class="mb-4">
            {{ $teacher->bio }}
        </p>

        <div class="mb-3">
            <span class="badge badge-teacher-student">Lecturer</span>
        </div>

        @if (
            (Auth::guard('teacher')->check() && Auth::guard()->user()->owner($teacher->id)) ||
            (Auth::guard('student')->check() && Auth::user()->isGrouped() && Auth::guard()->user()->mainGroup()->isSupervisedBy($teacher->id))
        )
            @if ($teacher->whatsapp)
                <a
                    href="//{{ ltrim($teacher->whatsapp, 'https://') }}"
                    class="btn btn-outline-success btn-sm"
                    target="_blank"
                >
                    <span class="fa fa-whatsapp"></span> WhatsApp
                </a>
            @endif
        @endif
    </div>
</div>