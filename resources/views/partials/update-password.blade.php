<div class="card">
    <div class="card-body">
        <h3 class="card-title">Update Password</h3>

        <form action="{{ route('update.password') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="current_password" class="form-label">
                    Current Password
                </label>

                <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required />

                @error('current_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-lg">
                    <div class="form-group">
                        <label for="password" class="form-label">
                            New Password
                        </label>
        
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required />
        
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg">
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">
                            Confirm Password
                        </label>
        
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required />
        
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div>
                <button type="submit" class="btn btn-primary btn-block">Update Password</button>
            </div>
        </form>
    </div>
</div>