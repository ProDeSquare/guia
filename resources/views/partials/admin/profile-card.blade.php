<div class="card card-profile">
    <div class="card-header"></div>

    <div class="card-body text-center">
        <div class="profile-image-container" style="background-image: url({{ $admin->avatar() }})"></div>

        <h3 class="mb-3">{{ $admin->name }}</h3>
        <p class="mb-4">
            {{ $admin->email }}
        </p>

        <div class="mb-3">
            <span class="badge badge-admin-mod">Admin</span>
        </div>
    </div>
</div>