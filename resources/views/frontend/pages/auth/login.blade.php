@extends('frontend.layouts.master')

@section('frontend_title', 'Login Page')

@section('frontend_content')
    @include('frontend.layouts.inc.breadcumb', ['pagename' => 'Login'])
    <!-- checkout-area start -->
    <div class="account-area ptb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                    <form action="{{ route('login.store') }}" method="POST">
                        @csrf
                        <div class="account-form form-style">
                            <p>Email Address </p>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ message }}</strong>
                                </span>
                            @enderror

                            <p>Password <span class="text-danger">*</span></p>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <button type="submit" class="btn btn-danger">SIGN IN</button>
                            <div class="text-center">
                                <a href="{{ route('register.page') }}">Or Creat an Account</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- checkout-area end -->
@endsection
