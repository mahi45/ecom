@extends('frontend.layouts.master')

@section('frontend_title', 'Checkout Page')

@section('frontend_content')
    @include('frontend.layouts.inc.breadcumb', ['pagename' => 'Checkout']);
    <!-- checkout-area start -->
    <div class="checkout-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-form form-style">
                        <h3>Billing Details</h3>
                        <form action="http://themepresss.com/tf/html/tohoney/checkout">
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <p>Full Name *</p>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Email Address *</p>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Phone No. *</p>
                                    <input type="tel" name="phone"
                                        class="form-control @error('phone') is-invalid @enderror">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>District*</p>
                                    <select name="district" id="district" class="form-select">
                                        <option value="1">Please select district</option>
                                        <option value="2">Dhaka</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Upazila *</p>
                                    <select name="upazila" id="upazila" class="form-select">
                                        <option value="1">Please select upazila</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Your Address *</p>
                                    <input type="text" name="address" placeholder="Enter your address">
                                </div>
                                <div class="col-12">
                                    <p>Order Notes</p>
                                    <textarea name="order_notes" id="order_notes" placeholder="notes about your order"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="order-area">
                        <h3>Your Order</h3>
                        <ul class="total-cost">
                            @foreach ($carts as $item)
                                <li>{{ $item->name }} X {{ $item->qty }} <span class="pull-right">৳
                                        {{ $item->price * $item->qty }}</span></li>
                            @endforeach
                            @if (Session::has('coupon'))
                                <li>Discount <span class="pull-right"><strong>(-)৳
                                            {{ Session::get('coupon')['discount_amount'] }}</strong></span></li>
                                <li>Balance <span class="pull-right"><strong>৳
                                            {{ Session::get('coupon')['balance'] }} <del class="text-danger">৳
                                                {{ Session::get('coupon')['cart_total'] }}</del></strong></span></li>
                            @else
                                <li>Subtotal <span class="pull-right"><strong>৳ {{ $total_price }}</strong></span></li>
                                <li>Total<span class="pull-right">৳ {{ $total_price }}</span></li>
                            @endif
                        </ul>
                        <ul class="payment-method">
                            <li>
                                <input id="delivery" type="checkbox">
                                <label for="delivery">Cash on Delivery</label>
                            </li>
                        </ul>
                        <button>Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- checkout-area end -->
@endsection
