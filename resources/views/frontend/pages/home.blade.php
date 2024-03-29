@extends('frontend.layouts.master')

@section('frontend_title', 'Home Page')

@section('frontend_content')

    @include('frontend.pages.widgets.slider')

    @include('frontend.pages.widgets.featured-area')

    @include('frontend.pages.widgets.countdown')

    @include('frontend.pages.widgets.best-seller')

    @include('frontend.pages.widgets.latest-product')

    @include('frontend.pages.widgets.testimonial')

@endsection
