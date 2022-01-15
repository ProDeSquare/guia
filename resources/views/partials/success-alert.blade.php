@if (Session::has('success'))
    <div class="container mt-4">
        <div class="alert alert-icon alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"></button>
            <i class="fe fe-check mr-2" aria-hidden="true"></i> {{ Session::get('success') }}
        </div>
    </div>
@endif