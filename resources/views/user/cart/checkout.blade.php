@extends('layouts.user_type.auth')
@section('content')
    <div class="cart-checkout-wrapper d-flex col-12">
        <div class="box-cart-checkout p-5 col-6">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="fw-bold mb-0 text-black">Checkout</h1>
            </div>
            <table class="table">
                @foreach($cart as $item)
                    <tr class=" view-cart-checkout">
                        <td class="cart-checkout-img">
                            <img src="{{ asset('storage/' . $item->options['image']) }}" alt="">
                        </td>
                        <td class="cart-checkout-title-author d-flex flex-column">
                            <div class="cart-checkout-title my-2" href="{{ route('user.book.detail', [$item->id]) }}">
                                {{ $item->name }}
                            </div>
                            <div class="cart-checkout-authors my-2">
                                {{ $item->options['author'] }}
                            </div>
                            <div class="cart-checkout-price my-2">
                                <h5 class="mb-0">{{ $item->price }}$ x {{ $item->qty }}
                                    = {{ $item->qty * $item->price }}$</h5>
                            </div>
                        </td>

                    </tr>
                @endforeach
            </table>
            <div class="cart-footer col-12 my-3 d-flex flex-column">
                <div class="book-total-price d-flex align-items-center justify-content-end mb-5">
                    <span class="display-5 font-weight-medium text-capitalize"> The total price: {{ Cart::instance('cart')->initial() }}$ </span>
                </div>
                <div class="d-flex justify-content-between">
                    <h6 class="mb-0">
                        <a href="{{ route('user.cart') }}" class="text-body align-items-center">
                            <i class="icon-arrow-left"></i>
                            <span class="font-weight-bold">Back to cart</span>
                        </a>
                    </h6>
                    <h6 class="mb-0">
                        <a href="" class="text-body">
                            <button class="btn btn-inverse-danger">Place Order</button>
                        </a>
                    </h6>
                </div>
            </div>
        </div>
        <div class="checkout-address col-6">
            <div class="p-5">
                <div class="d-flex justify-content-between mb-4">
                    <h5 class="text-uppercase">Destination Address</h5>
                </div>
                <hr class="my-4">

                <div class="mb-3 show-address d-flex justify-content-between">
                    <div class="address">
                        @foreach($addresses as $address)
                            @if($address['is_default'] == 1)
                                {{ $address['address_detail'] . ', ' . $address['ward'] . ', ' . $address['district'] . ', ' . $address['province'] }}
                            @endif
                        @endforeach
                    </div>
                    <div>
                        <button type="button" class="change-address btn btn-inverse-danger btn-icon-text">Change
                            Address
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Button to trigger the modal -->
    <button type="button" class="btn btn-primary btn-modal" data-toggle="modal" data-target="#addressModal"
            style="visibility: hidden">
    </button>

    <!-- Modal -->
    <div class="modal show fade " id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title" id="addressModalLabel">Addresses</h4>
                </div>
                <div class="address-list modal-body">
                    @foreach ($addresses as $address)
                        <div class="choose-address d-flex">
                            <label class="box-address box-address-{{ $address['id'] }}"
                                   data-address-id={{ $address['id'] }}>
                                <input type="radio" class="radio-choose-address"
                                       value="{{ $address['id'] }}"
                                       name="address" {{ $address['is_default']  == 1 ? 'checked' : '' }}>
                                <div class="mb-2">
                                    <div class="bg-white addresses-item shadow-sm border">
                                        <div class="gold-members p-4">
                                            <h6 class="mb-1">{{ $address['is_default']  == 1 ? 'Default' : 'Other' }}</h6>
                                            <p>{{ $address['address_detail'] . ', ' . $address['ward'] . ', ' . $address['district'] . ', ' . $address['province'] }}</p>
                                            <div class="edit-delete">
                                                <button type="button" class="btn-edit-address"
                                                        data-address-id="{{ $address['id'] }}">EDIT
                                                </button>
                                                <button type="button" class="btn-delete-address"
                                                        data-address-id="{{ $address['id'] }}" {{ $address['is_default'] == 1 ? 'disabled' : '' }}>
                                                    DELETE
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    @endforeach
                    <button type="button" class="btn btn-add-address btn-outline-danger btn-icon-text">
                        <i class="icon-plus mr-2"></i> Add
                    </button>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-close-modal" data-dismiss="modal">Close
                        </button>
                        <button type="submit" class="btn btn-primary btn-choose-address" name="save-address">
                            Save
                        </button>
                    </div>
                </div>
                <div class="address-form modal-body" style="display: none;">
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
                            @if(count($addresses) === 0)
                                <button type="button" class="btn btn-secondary btn-back">Back</button>
                            @else
                                <button type="button" class="btn btn-secondary btn-cancel">Cancel</button>
                            @endif
                            <button type="submit" class="btn btn-primary btn-save-address" name="save-address">
                                Save
                            </button>
                            <button type="submit" class="btn btn-primary btn-update-address" name="save-address"
                                    style="display: none">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

    <script>

        $(document).ready(function () {
            let errors = @json($errors->any());
            if (errors) {
                $('#form').submit(function (event) {
                    event.preventDefault;
                })
            }
            let addresses = @json($addresses);

            function showAddressFrom() {
                $('.address-form').show();
                $('.address-list').hide();
            }

            function showAddressList() {
                $('.address-form').hide();
                $('.address-list').show();
            }

            if (addresses.length === 0) {
                showAddressFrom();
                $('.btn-modal').click();

            }

            $('.btn-back').on('click', function () {
                if (addresses.length === 0) {
                    window.location.href = "{{ route('user.cart') }}";
                }
            })

            $('.change-address').on('click', function () {
                $('.btn-modal').click();
            })

            $('.btn-add-address').on('click', function () {
                $('#address-detail').val('');
                $('#ward').val('');
                $('#district').val('');
                $('#province').val('');
                showAddressFrom()
            })

            $('.btn-cancel').on('click', function () {
                showAddressList()
            })

            function showEditForm(address) {
                $('#address-detail').val(address.address_detail);
                $('#ward').val(address.ward);
                $('#district').val(address.district);
                $('#province').val(address.province);
            }

            $('.btn-edit-address').on('click', function () {
                let addressId = $(this).data('address-id');
                let addressToEdit = addresses.find(address => address.id === addressId);
                if (addressToEdit) {
                    showAddressFrom();
                    showEditForm(addressToEdit);
                }
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.btn-delete-address').on('click', function () {
                let id = $(this).data('address-id');
                console.log(id)
                $.ajax({
                    type: 'DELETE',
                    url: `/cart/checkout/${id}`,
                    data: {
                        '_method': 'DELETE',
                        _token: '{{  csrf_token() }}',
                        id: id
                    },
                    success: function () {
                        window.location.reload()
                    }
                })
            })
        })
    </script>
@endpush
