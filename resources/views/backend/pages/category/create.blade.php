@extends('backend.layouts.master')

@section('title', 'Category Create')

@push('admin_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
@endpush

@section('admin_content')
    <div class="row">
        <div class="col-12 d-flex justify-content-between mb-4">
            <h1>Create Category</h1>

            <a href="{{ route('category.index') }}" class="btn btn-primary"><i class="fa-sharp fa-solid fa-arrow-left"></i>
                Back to Category List</a>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="category_title" class="form-label">Category Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                placeholder="Enter Category Title" id="category_title">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="category_image" class="form-label">Category Image</label>
                            <input type="file" class="form-control dropify" name="category_image" data-max-file-size="1M"
                                data-errors-position="outside" data-allowed-file-extensions="jpg png jpeg">
                        </div>
                        <div class="mb-3 form-switch">
                            <input type="checkbox" class="form-check-input @error('active') is-invalid @enderror"
                                name="is_active" role="switch" id="activeStatus" checked>

                            <label for="activeStatus" class="form-check-label">Active or Inactive</label>

                            @error('active')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mt-5">
                            <button class="btn btn-success" type="submit">Store</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('admin_script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click'
            }
        });
    </script>
@endpush
