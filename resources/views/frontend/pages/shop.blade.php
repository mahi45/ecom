@extends('frontend.layouts.master')

@section('frontend_title', 'Shop Page')

@section('frontend_content')
    @include('frontend.layouts.inc.breadcumb', ['pagename' => 'Shop Page'])
    <!-- product-area start -->
    <div class="product-area pt-100">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="product-menu">
                        <ul class="nav justify-content-center">
                            <li>
                                <a class="active" data-toggle="tab" href="#all">All product</a>
                            </li>
                            @foreach ($categories as $category)
                                <li>
                                    <a data-toggle="tab" href="#{{ $category->slug }}">{{ $category->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="all">
                    <ul class="row">
                        @foreach ($all_products as $product)
                            <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                <div class="product-wrap">
                                    <div class="product-img">
                                        <span>Sale</span>
                                        <img src="{{ asset('uploads/products') }}/{{ $product->product_image }}"
                                            alt="">
                                        <div class="product-icon flex-style">
                                            <ul>
                                                <li><a data-toggle="modal" data-target="#exampleModalCenter"
                                                        href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                                <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                <li><a
                                                        href="{{ route('productdetails.page', ['product_slug' => $product->slug]) }}"><i
                                                            class="fa fa-shopping-bag"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3><a
                                                href="{{ route('productdetails.page', $product->slug) }}">{{ $product->name }}</a>
                                        </h3>
                                        <p class="pull-left">${{ $product->product_price }}

                                        </p>
                                        <ul class="pull-right d-flex">
                                            @for ($i = 0; $i < $product->product_rating; $i++)
                                                <li><i class="fa fa-star"></i></li>
                                            @endfor
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                @foreach ($categories as $category)
                    <div class="tab-pane" id="{{ $category->slug }}">
                        <ul class="row">
                            @foreach ($category->products as $cproduct)
                                <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                    <div class="product-wrap">
                                        <div class="product-img">
                                            <span>Sale</span>
                                            <img src="{{ asset('uploads/products') }}/{{ $cproduct->product_image }}"
                                                alt="">
                                            <div class="product-icon flex-style">
                                                <ul>
                                                    <li><a data-toggle="modal" data-target="#exampleModalCenter"
                                                            href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                                    <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                    <li><a
                                                            href="{{ route('productdetails.page', ['product_slug' => $cproduct->slug]) }}"><i
                                                                class="fa fa-shopping-bag"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h3><a
                                                    href="{{ route('productdetails.page', $cproduct->slug) }}">{{ $cproduct->name }}</a>
                                            </h3>
                                            <p class="pull-left">${{ $cproduct->product_price }}

                                            </p>
                                            <ul class="pull-right d-flex">
                                                @for ($i = 0; $i < $cproduct->product_rating; $i++)
                                                    <li><i class="fa fa-star"></i></li>
                                                @endfor
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach

                <div class="col-12 d-flex justify-content-center">
                    <div class="py-3">
                        {{ $all_products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product-area end -->

    <!-- Modal area start -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body d-flex">
                    <div class="product-single-img w-50">
                        <img src="{{ asset('uploads/products') }}/{{ $cproduct->product_image }}" alt="">
                    </div>
                    <div class="product-single-content w-50">
                        <h3>{{ $cproduct->name }}</h3>
                        <div class="rating-wrap fix">
                            <span class="pull-left">${{ $cproduct->product_price }}</span>
                            <ul class="rating pull-right">
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li>(05 Customar Review)</li>
                            </ul>
                        </div>
                        <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and
                            demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot
                            foresee the pain and trouble that are bound to ensue; and equal blame belongs</p>
                        <ul class="input-style">
                            <li class="quantity cart-plus-minus">
                                <input type="text" value="1" />
                            </li>
                            <li><a href="{{ route('productdetails.page', ['product_slug' => $product->slug]) }}">Add to
                                    Cart</a></li>
                        </ul>
                        <ul class="cetagory">
                            <li>Categories:</li>
                            <li><a href="#">Honey,</a></li>
                            <li><a href="#">Olive</a></li>
                        </ul>
                        <ul class="socil-icon">
                            <li>Share :</li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal area start -->

@endsection
