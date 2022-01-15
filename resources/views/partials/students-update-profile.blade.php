<div class="card">
    <div class="card-body">
        <h3 class="card-title">
            Update Profile
        </h3>

        <form action="{{ route('student.profile.update') }}" method="post">
            <div class="form-group">
                @csrf

                <label for="bio" class="form-label">Bio</label>

                <textarea rows="3" class="form-control @error('bio') is-invalid @enderror" id="bio" placeholder="Something about yourself" name="bio">{{ old('bio') ?? $student->bio }}</textarea>

                @error('bio')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="github" class="form-label">GitHub</label>

                <input type="text" class="form-control @error('github') is-invalid @enderror" id="github" placeholder="https://github.com/username)" name="github" value="{{ old('github') ?? $student->github }}" required />

                @error('github')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Update Information</button>
            </div>
        </form>
    </div>
</div>