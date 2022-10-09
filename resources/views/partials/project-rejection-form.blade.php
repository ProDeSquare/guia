@if (
    Auth::guard('teacher')->check() &&
    $project->group()->first()->requested(Auth::guard()->id())
)
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                Reject this project
            </h4>

            <form action="{{ route('reject.project', $project->id) }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="comment">Comment <span class="text-red">*</span></label>

                    <textarea rows="3" class="form-control @error('comment') is-invalid @enderror" id="comment" placeholder="This project is too simple" name="comment" required>{{ old('comment') }}</textarea>
                
                    <small class="form-hint">This field accepts markdown</small>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Post Rejection</button>
                </div>
            </form>
        </div>
    </div>
@endif