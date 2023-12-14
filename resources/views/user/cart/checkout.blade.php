@extends('layout.main')
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
                                <h5 class="mb-0">{{ $item->price }}$ x {{ $item->qty }} = {{ $item->qty * $item->price }}$</h5>
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
                            @if($address['is_default'] === 1)
                                {{ $address['street_number'] . ', ' . $address['street_address'] . ', ' . $address['district'] . ', ' . $address['city'] }}
                            @endif
                        @endforeach
                    </div>
                    <div>
                        <button type="button" class="change-address btn btn-inverse-danger btn-icon-text">Change Address</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Button to trigger the modal -->
    <button type="button" class="btn btn-primary btn-modal" data-toggle="modal" data-target="#addressModal" style="visibility: hidden">
    </button>

    <!-- Modal -->
    <div class="modal show fade " id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title" id="addressModalLabel">Addresses</h4>
                    <button type="button" class="btn btn-icon" data-dismiss="modal" aria-label="Close">
                        <i class="icon-close"></i>
                    </button>
                </div>
                <div class="address-list modal-body">
                    @foreach ($addresses as $address)
                    <div class="choose-address d-flex">
                        <label class="box-address box-address-{{ $address['id'] }}"
                               data-address-id={{ $address['id'] }}>
                            <input type="radio" class="radio-choose-address"
                                   value="{{ $address['id'] }}"
                                   name="address" {{ $address['is_default']  === 1 ? 'checked' : '' }}>
                            <div class="mb-2">
                                <div class="bg-white addresses-item shadow-sm border">
                                    <div class="gold-members p-4">
                                        <h6 class="mb-1">{{ $address['is_default']  === 1    ? 'Default' : 'Other' }}</h6>
                                        <p>{{ $address['street_number'] . ', ' . $address['street_address'] . ', ' . $address['district'] . ', ' . $address['city'] }}</p>
                                        <div class="edit-delete">
                                            <button type="button" class="btn-edit-address"
                                                    data-address-id="">EDIT
                                            </button>
                                            <button type="button" class="btn-delete-address btn-delete-address-"
                                                    data-address-id="">
                                                DELETE
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                    @endforeach
                    <button type="button" class="btn btn-add-address btn-icon-text p-0">
                            <i class="icon-plus"></i>
                            Add Address
                    </button>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-close-modal" data-dismiss="modal">Close
                        </button>
                        <button type="submit" class="btn btn-primary btn-choose-address" name="save-address">
                            Save Address
                        </button>
                    </div>
                </div>
                <div class="address-form modal-body" style="display: none;">
                    <form id="form" method="post" action="" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="address_1" class="form-label">Address 1</label>
                            <input type="text" class="form-control address_1" id="address_1" name="address_1" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="district" class="form-label">District</label>
                            <input type="text" class="form-control" id="district" name="district" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control" id="country" name="country" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="make-default" class="form-check-label">Make Default</label>
                            <input type="checkbox" class="form-check-input" id="make-default">
                            <input type="hidden" name="make-default" id="make-default-hidden" value="0">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-back">Back</button>
                            <button type="submit" class="btn btn-primary btn-save-address" name="save-address">
                                Save Address
                            </button>
                            <button type="submit" class="btn btn-primary btn-update-address" name="save-address" style="display: none">
                                Update Address
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
            $('.change-address').on('click', function () {
                $('.btn-modal').click();
            })
        })
    </script>
@endpush
