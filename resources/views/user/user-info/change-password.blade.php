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
                <div class="mb-3">
                    <label class="small mb-1" for="inputFullName">Full Name</label>
                    <input class="form-control" id="inputFullName" type="text" name="name"
                           placeholder="Enter your full name" value="{{ $user['name'] }}">
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
