@extends('layout.master')
@section('content')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <img src="{{ asset('images/logo.svg') }}">
                            </div>
                            <h4>Find your account</h4>
                            <h6 class="font-weight-light">Enter your email.</h6>
                            <form class="pt-3" method="post" action="{{ route('password.request') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1"
                                           placeholder="Email">
                                    @if($errors->has('email'))
                                        <span class="text text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <button class="btn btn-inverse-primary w-100">Send Link To Reset Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
@endsection
