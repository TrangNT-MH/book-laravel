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
                <div class="mb-3 show-address">
                    <div class="address" data-address="">
                    </div>
                    <div>
                        <button type="button" class="change-address">Change Address</button>
                    </div>
                </div>
                <hr class="my-4">
            </div>
        </div>
    </div>
@endsection
