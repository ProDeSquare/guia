<div class="card">
    <div class="card-body">
        <h3 class="card-title">Update Avatar</h3>

        <form action="#" method="post">
            @csrf

            @method('put')

            <div class="form-group">
                <label for="avatar-field" class="form-label">Image URL</label>

                <input
                    type="url"
                    class="form-control @error('avatar') is-invalid @enderror"
                    placeholder="https://prodesquare.com/image.jpg"
                    value="{{ old('avatar') ?? Auth::guard()->user()->avatar }}"
                    name="avatar"
                />

                <small class="form-hint">Empty the field to switch to default avatar</small>

                @error('avatar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
    </div>
</div>