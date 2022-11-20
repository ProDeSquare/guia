<div class="card card-profile">
    <div class="card-header"></div>

    <div class="card-body text-center">
        <div class="profile-image-container">
            <img
                src="{{ $student->avatar() }}"
                alt="{{ $student->name }}'s avatar"
                onerror="this.onerror=null;this.src='https://www.gravatar.com/avatar/{{ md5($student->email) }}?d=mm'"
            />
        </div>

        <h3 class="mb-3">{{ $student->name }}</h3>
        <p class="mb-4">
            {{ $student->bio }}
        </p>

        <div class="mb-3">
            <span class="badge badge-teacher-student">Student</span>
        </div>

        <div>
            @if ($student->github)
                <a class="btn btn-outline-dark btn-sm" href="{{ $student->github }}" target="_blank">
                    <span class="fa fa-github"></span> GitHub
                </a>
            @endif
        </div>
    </div>
</div>