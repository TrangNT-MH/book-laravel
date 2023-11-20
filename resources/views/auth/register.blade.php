<!DOCTYPE html>
<html lang="">
<head>
    @include('admin.elements.head')
</head>
<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left p-5">
                        <div class="brand-logo">
                            <img src="{{ asset('images/logo.svg') }}">
                        </div>
                        <h4>New here?</h4>
                        <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                        <form class="pt-3" method="post" action="{{ route('store') }}">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="username" class="form-control form-control-lg" id="username"
                                       placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control form-control-lg" id="email"
                                       placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-lg" id="password"
                                       placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password_confirmation" class="form-control form-control-lg" id="password_confirmation"
                                       placeholder="Confirm Password">
                            </div>
                            <div class="mb-4">
                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input"> I agree to all Terms &
                                        Conditions </label>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
                            </div>
                            <div class="text-center mt-4 font-weight-light"> Already have an account? <a
                                    href="{{ route('login') }}" class="text-primary">Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
</div>
@include('admin.elements.script')
@stack('script')
</body>
</html>
