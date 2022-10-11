@extends('backend.layouts.master')

@section('title', 'Product Create')

@push('admin_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
@endpush

@section('admin_content')
    <div class="row">
        <div class="col-12 d-flex justify-content-between mb-4">
            <h1>Create Product</h1>

            <a href="{{ route('product.index') }}" class="btn btn-primary"><i class="fa-sharp fa-solid fa-arrow-left"></i>
                Back to Product List</a>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category Name</label>
                            <select name="category_id" id="category_id" class="form-select">
                                <option selected>Select Category Name</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Enter Product Name" id="name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row col-12">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="product_price" class="form-label">Product Price</label>
                                    <input type="number" name="product_price"
                                        class="form-control @error('price') is-invalid @enderror"
                                        placeholder="Enter Product Price" id="product_price" min="0">
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="product_code" class="form-label">Product Code</label>
                                    <input type="text" name="product_code"
                                        class="form-control @error('code') is-invalid @enderror"
                                        placeholder="Enter Product Code" id="product_code">
                                    @error('code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row col-12">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="product_stock" class="form-label">Initial Stock</label>
                                    <input type="number" name="product_stock"
                                        class="form-control @error('stock') is-invalid @enderror"
                                        placeholder="Enter Product Stock" id="product_stock" min="1">
                                    @error('stock')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="alert_quantity" class="form-label">Alert Quantity</label>
                                    <input type="number" name="alert_quantity"
                                        class="form-control @error('alert_quantity') is-invalid @enderror"
                                        placeholder="Enter Product Alert Quantity" id="alert_quantity" min="1">
                                    @error('alert_quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="short_description" class="form-label">Short Description</label>
                            <textarea class="form-control @error('short_description') is-invalid @enderror" name="short_description"
                                id="short_description" cols="30" rows="3" placeholder="Enter Product Short Description"></textarea>
                            @error('short_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="long_description" class="form-label">Long Description</label>
                            <textarea class="form-control @error('long_description') is-invalid @enderror" name="long_description"
                                id="long_description" cols="30" rows="5" placeholder="Enter Product Long Description"></textarea>
                            @error('long_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="additional_info" class="form-label">Additional Info</label>
                            <textarea class="form-control @error('additional_info') is-invalid @enderror" name="additional_info"
                                id="additional_info" cols="30" rows="2" placeholder="Enter Product Additional Information"></textarea>
                            @error('additional_info')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="product_image" class="form-label">Product Image</label>
                            <input type="file" class="form-control dropify" name="product_image"
                                data-max-file-size="1M" data-errors-position="outside"
                                data-allowed-file-extensions="jpg png jpeg">
                        </div>
                        <div class="mb-3">
                            <label for="product_multiple_image" class="form-label">Product Multiple Image</label>
                            <input type="file" class="form-control" multiple name="product_multiple_image[]">
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
