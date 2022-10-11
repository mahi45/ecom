@extends('backend.layouts.master')

@section('title', 'Testimonial Create')

@push('admin_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
@endpush

@section('admin_content')
    <div class="row">
        <div class="col-12 d-flex justify-content-between mb-4">
            <h1>Create Testimonial</h1>

            <a href="{{ route('testimonial.index') }}" class="btn btn-primary"><i class="fa-sharp fa-solid fa-arrow-left"></i>
                Back to Testimonial List</a>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('testimonial.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="client_name" class="form-label">Client Name</label>
                            <input type="text" name="client_name"
                                class="form-control @error('client_name') is-invalid @enderror"
                                placeholder="Enter Client Name" id="client_name">
                            @error('client_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="client_designation" class="form-label">Client Designation</label>
                            <input type="text" name="client_designation"
                                class="form-control @error('client_designation') is-invalid @enderror"
                                placeholder="Enter Client Designation" id="client_designation">
                            @error('client_designation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="client_message" class="form-label">Client Message</label>
                            <textarea class="form-control @error('client_message') is-invalid @enderror" name="client_message" id="client_message"
                                cols="30" rows="10" placeholder="Enter Client Message"></textarea>
                            @error('client_message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="client_image" class="form-label">Client Image</label>
                            <input type="file" name="client_image"
                                class="form-control dropify @error('client_image') is-invalid @enderror" id=""
                                data-max-file-size="1M" data-errors-position="outside">
                            @error('client_image')
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop your file here',
                'replace': 'Drag and drop your file here',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });
    </script>
@endpush
