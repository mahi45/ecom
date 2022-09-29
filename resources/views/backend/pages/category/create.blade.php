@extends('backend.layouts.master')

@section('title', 'Category Create')

@section('admin_content')
    <div class="row">
        <div class="col-12 d-flex justify-content-between mb-4">
            <h1>Create Category</h1>

            <a href="{{ route('category.index') }}" class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i>
                Back to Category List</a>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('category.store') }}" method="POST">
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
    <script>
        toastr.options = {
            "closeButton": false,
            "progressBar": true
        }
    </script>
@endpush
