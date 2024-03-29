<div class="card">
    <div class="card-body">
        <h3 class="card-title">
            Update Profile
        </h3>

        <form action="{{ route('teacher.profile.update') }}" method="post">
            <div class="form-group">
                @csrf

                <label for="bio" class="form-label">Bio</label>

                <textarea rows="3" class="form-control @error('bio') is-invalid @enderror" id="bio" placeholder="Something about yourself" name="bio">{{ old('bio') ?? $teacher->bio }}</textarea>

                @error('bio')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="requirements" class="form-label">Requirements</label>

                <input type="text" class="form-control @error('requirements') is-invalid @enderror" id="requirements" placeholder="AI, ML, Docker (Comma Seperated)" name="requirements" value="{{ old('requirements') ?? $teacher->requirements }}" required />

                @error('requirements')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="whatsapp" class="form-label">WhatsApp link</label>

                <input type="text" class="form-control @error('whatsapp') is-invalid @enderror" id="whatsapp" placeholder="wa.me/phone-number" name="whatsapp" value="{{ old('whatsapp') ?? $teacher->whatsapp }}" required />

                @error('whatsapp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Update Information</button>
            </div>
        </form>
    </div>
</div>