@extends('backend.layouts.master')

@section('title', 'Coupon Create')

@push('admin_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
@endpush

@section('admin_content')
    <div class="row">
        <div class="col-12 d-flex justify-content-between mb-4">
            <h1>Create Coupon</h1>

            <a href="{{ route('coupon.index') }}" class="btn btn-primary"><i class="fa-sharp fa-solid fa-arrow-left"></i>
                Back to Coupon List</a>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('coupon.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="coupon_name" class="form-label">Coupon Name</label>
                            <input type="text" name="coupon_name"
                                class="form-control @error('coupon_name') is-invalid @enderror" id="coupon_name">
                            @error('coupon_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="discount_amount" class="form-label">Discount Percentage</label>
                            <input type="number" min="0" name="discount_amount"
                                class="form-control @error('discount_amount') is-invalid @enderror" id="discount_amount">
                            @error('discount_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="minimum_purchase_amount" class="form-label">Minimum Purchase Amount</label>
                            <input type="number" min="0" name="minimum_purchase_amount"
                                class="form-control @error('minimum_purchase_amount') is-invalid @enderror"
                                id="minimum_purchase_amount">
                            @error('minimum_purchase_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="validity_till" class="form-label">Validity Till</label>
                            <input type="date" name="validity_till"
                                class="form-control @error('validity_till') is-invalid @enderror" id="validity_till">
                            @error('validity_till')
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
                'default': 'Drag and drop a file here or click'
            }
        });
    </script>
@endpush
