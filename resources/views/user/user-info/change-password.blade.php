@extends('layouts.user_type.auth')
@section('content')
    <div class="change-password-wrapper">
        <div class="mx-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('user.profile', [Auth::user()->id]) }}">User Profile</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="card mb-4">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="card-body d-flex justify-content-center">
                            <form method="POST" action="{{ route('user.changePassword.request') }}" class="col-lg-6 p-5">
                                @csrf
                                <div class="mb-3">
                                    <label class="mb-1" for="inputOldPw">Old Password</label>
                                    <input class="form-control" id="inputOldPw" type="password" name="password"
                                           placeholder="Enter your old password" value="">
                                    @if (session('password'))
                                        <span class="text-danger">{{ session('password') }}</span>
                                    @endif
                                    @if($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1" for="inputNewPw">New Password</label>
                                    <input class="form-control" id="inputNewPw" type="password" name="newPassword"
                                           placeholder="Enter your new password" value="">
                                    @if($errors->has('newPassword'))
                                        <span class="text-danger">{{ $errors->first('newPassword') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1" for="inputCfPw">Confirm New Password</label>
                                    <input class="form-control" id="inputCfPw" type="password" name="newPasswordConfirmation"
                                           placeholder="Confirm your new password" value="">
                                    @if($errors->has('newPasswordConfirmation'))
                                        <span class="text-danger">{{ $errors->first('newPasswordConfirmation') }}</span>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Save Change</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
