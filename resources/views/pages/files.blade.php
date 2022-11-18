@extends('layouts.app')

@section('title')
    | File Upload
@endsection

@section('content')
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">File Uploads</h1>
        </div>

        <div class="page-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Upload a new file
                            </h3>
                        </div>
    
                        <div class="card-body">
                            <form action="#" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="title" class="form-label">Title <span class="text-red">*</span></label>

                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="My project thumbnail" name="title" value="{{ old('title') }}" required>

                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="custom-file mb-4">
                                    <input type="file" id="file">

                                    <label class="custom-file-label text-truncate" for="file" id="file-input-label">Choose File</label>

                                    @error('file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-link" type="reset">Cancel</button>

                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-upload mr-2"></i>
                                        Confirm Upload
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    
                <div class="col-lg-8">
                    <p class="text-center">No recent uploads</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelector("#file").addEventListener('change', e => {
            document.querySelector("#file-input-label").innerText = e.srcElement.files[0].name || "Choose File"
        })
    </script>
@endsection