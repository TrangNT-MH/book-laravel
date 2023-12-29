@extends('layouts.user_type.auth')
@section('content')
    <div class="user-profile-wrapper">
        <div class="row">
            <div class="user-profile-avatar col-xs-2">
                <div class="avatar position-relative">
                    <img class="img-fluid rounded-circle" src="{{ asset($userInfo['avatar']) }}">
                    <div class="upload d-flex justify-content-center align-items-center">
                        <button class="btn btn-icon"><i class="icon-cloud-upload"></i></button>
                    </div>
                </div>
            </div>
            <div class="user-profile-detail col-xs-10">
                <div class="form-control">

                </div>
            </div>
        </div>
    </div>
@endsection()
