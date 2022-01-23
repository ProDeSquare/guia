<div class="card card-profile">
    <div class="card-header"></div>

    <div class="card-body text-center">
        <img class="card-profile-img" src="{{ $teacher->avatar() }}">

        <h3 class="mb-3">{{ $teacher->name }}</h3>
        <p class="mb-4">
            {{ $teacher->bio }}
        </p>

        <div class="mb-3">
            <span class="badge badge-teacher-student">Lecturer</span>
        </div>

        @if (Auth::guard('teacher')->check() && Auth::guard()->user()->owner($teacher->id))
            @if ($teacher->whatsapp)
                <a href="{{ $teacher->whatsapp }}" class="btn btn-outline-success btn-sm">
                    <span class="fa fa-whatsapp"></span> WhatsApp
                </a>
            @endif
        @endif
    </div>
</div>