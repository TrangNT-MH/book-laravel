@extends('layouts.user_type.auth')
@section('content')
    <div class="user-profile-wrapper">
        <div class="mx-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <div class="user-profile-avatar col-xs-2">
                                <div class="avatar position-relative">
                                    <img class="img-fluid rounded-circle" src="{{ asset($userInfo['avatar']) }}">
                                    <div class="upload d-flex justify-content-center align-items-center">
                                        <button class="btn btn-icon"><i class="icon-cloud-upload"></i></button>
                                    </div>
                                </div>
                            </div>
                            <p class="text-muted mb-4">
                                @foreach($addresses as $address)
                                    @if($address['is_default'] == 1)
                                        {{ $address['address_detail'] . ', ' . $address['ward'] . ', ' . $address['district'] . ', ' . $address['province'] }}
                                    @endif
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card mb-4">
                        <div class="card-body">
                                <form method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputFullName">Full Name</label>
                                        <input class="form-control" id="inputFullName" type="text"
                                               placeholder="Enter your full name" value="{{ $user['name'] }}">
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputPhone">Phone number</label>
                                            <input class="form-control" id="inputPhone" type="tel"
                                                   placeholder="Enter your phone number"
                                                   value="{{ $userInfo['phoneNumber'] }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputBirthday">Birthday</label>
                                            <input class="form-control" id="inputBirthday" type="date" name="birthday"
                                                   placeholder="Enter your birthday" value="{{ $userInfo['dob'] }}">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputPhone">Gender</label>
                                        <div class="row form-group justify-content-around">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="gender"
                                                           id="optionsRadios1" value="male" {{ $userInfo['gender'] == "male" ? "checked" : "" }}> Male
                                                    <i class="input-helper"></i>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="gender"
                                                           id="optionsRadios2" value="female" {{ $userInfo['gender'] == "female" ? "checked" : "" }}> Female
                                                    <i class="input-helper"></i>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="gender"
                                                           id="optionsRadios3" value="other" {{ $userInfo['gender'] == "other" ? "checked" : "" }}> Other
                                                    <i class="input-helper"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="button">Save changes</button>
                                </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4 mb-md-4">
                                <div class="card-body">
                                    <p class="mb-4">Addresses</p>
                                    @if(!empty($addresses))
                                        @foreach($addresses as $address)
                                            <div class="address mb-4">
                                                        <span class="small font-weight-bold text-danger">{{ $address['is_default']  === 1 ? 'Default' : 'Other' }}</span>
                                                        <div class="bg-white addresses-item shadow-sm border">
                                                            <div class="gold-members p-4 d-flex justify-content-between align-items-center">
                                                                <p class="m-0">{{ $address['address_detail'] . ', ' . $address['ward'] . ', ' . $address['district'] . ', ' . $address['province'] }}</p>
                                                                <div class="edit-delete">
                                                                    <button type="button" class="btn btn-delete-address btn-icon" data-address-id="{{ $address['id'] }}"
                                                                        {{ $address['is_default'] === 1 ? 'disabled' : '' }}>
                                                                        <i class="icon icon-trash"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    <button type="button" class="btn btn-outline-primary btn-modal w-100" data-toggle="modal" data-target="#addressModal">Add New Address</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="list-item">
                                <div class="info">
                                    <i class="icon icon-envelope-letter"></i>
                                    <div class="detail">
                                        <span class="title">Email</span>
                                        <span class="content">{{ $user['email'] }}</span>
                                    </div>
                                </div>
                                <div class="status">
                                    <button class="btn btn-outline-primary p-2">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="list-item">
                                <div class="info align-items-center">
                                    <i class="icon icon-lock"></i>
                                        <span class="title">Change Password</span>
                                </div>
                                <div class="status">
                                    <button class="btn btn-outline-primary p-2" onclick="window.location='{{ route('user.changePassword') }}'">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal show fade " id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="address-form modal-body">
                    <form id="form" method="post" action="{{ route('user.cart.checkout.storeAddress') }}"
                          autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label for="province">Province</label>
                            <input type="text" class="form-control" id="province" name="province"
                                   placeholder="Province">
                            @if ($errors->has('province'))
                                <span class="text-danger">{{ $errors->first('province') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="district">District</label>
                            <input type="text" class="form-control" id="district" name="district"
                                   placeholder="District">
                            @if ($errors->has('district'))
                                <span class="text-danger">{{ $errors->first('district') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="ward">Ward</label>
                            <input type="text" class="form-control" id="ward" name="ward" placeholder="Ward">
                            @if ($errors->has('ward'))
                                <span class="text-danger">{{ $errors->first('ward') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="address-detail">Address Detail</label>
                            <input type="text" class="form-control" id="address-detail" name="address_detail"
                                   placeholder="Apt/Build/Street..." autocomplete="off">
                            @if ($errors->has('address-detail'))
                                <span class="text-danger">{{ $errors->first('address-detail') }}</span>
                            @endif
                        </div>
                        <div class="form-check">
                            @if(count($addresses) === 0)
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="is_default" value="1" checked
                                           onclick="return false"> Default
                                </label>
                            @else
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="is_default"> Default
                                </label>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-cancel" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary btn-save-address" name="save-address">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection()
@push('script')
    <script>
        $('.btn-delete-address').on('click', function () {
            let id = $(this).data('address-id');
            console.log(id)
            $.ajax({
                type: 'DELETE',
                url: `/cart/checkout/${id}`,
                data: {
                    '_method': 'DELETE',
                    _token: '{{csrf_token()}}',
                    id: id
                },
                success: function () {
                    window.location.reload()
                }
            })
        })
    </script>
@endpush
