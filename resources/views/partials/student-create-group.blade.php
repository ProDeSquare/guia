<div class="card">
    <div class="card-header">
        <div class="card-title">
            Create a group
        </div>
    </div>

    <div class="card-body">
        You're not in a group! If you're the <strong>project leader</strong> you can create a group and request your
        project partners or continue with the project alone. Creating a group on your own would delete all the pending requests.
    </div>

    <div class="card-footer">
        <form action="{{ route('group.create') }}" method="post">
            @csrf

            <div class="row">
                <div class="col-lg">
                    <div class="mt-2">
                        <label class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" required />
                            <span class="custom-control-label">I've read the conditions</span>
                        </label>
                    </div>
                </div>

                <div class="col-lg-4">
                    <button class="btn btn-primary btn-block" type="submit">
                        <i class="fe fe-plus"></i>
        
                        Create
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>