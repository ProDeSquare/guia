<div class="card card-profile">
    <div class="card-header"></div>

    <div class="card-body text-center">
        <div class="profile-image-container">
            <img
                src="{{ $mod->avatar() }}"
                alt="{{ $mod->name }}'s avatar"
                onerror="this.onerror=null;this.src='https://www.gravatar.com/avatar/{{ md5($mod->email) }}?d=mm'"
            />
        </div>

        <h3 class="mb-3">{{ $mod->name }}</h3>

        <div class="mb-3">
            <span class="badge badge-admin-mod">Moderator</span>
        </div>
    </div>
</div>