@extends('layouts.user_type.auth')
@section('content')
    <div class="change-password-wrapper">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.profile', [Auth::user()->id]) }}">User
                                Profile</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Change Email</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.verifyChangeEmail') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="mb-1" for="inputEmail">New email</label>
                                @if($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                                <input class="form-control" id="inputEmail" type="email" name="email"
                                       placeholder="Enter your new email" value="">
                                <span
                                    class="small mt-1 text-gray">We will send link verification through your new email</span>
                                <input type="submit" hidden/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
