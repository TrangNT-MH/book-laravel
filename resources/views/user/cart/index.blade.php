@extends('layout.main')
@push('style')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-center">
        <div class="col-lg-12 box-cart">
            @if($cart->count() !== 0)
                <div class="p-5">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                    </div>
                    <hr class="my-4">
                    <div class="row view-cart">
                        @foreach($cart as $item)
                            <div class="item col-12 d-flex align-items-center my-2">
                                <div class="col-2 cart-img">
                                    <img src="{{ asset('storage/' . $item->options['image']) }}" alt="">
                                </div>
                                <div class="col-4 d-flex flex-column">
                                    <a class="book-cart-title" href="{{ route('user.book.detail', [$item->id]) }}">
                                        {{ $item->name }}
                                    </a>
                                    <div class="book-authors">
                                        {{ $item->options['author'] }}
                                    </div>
                                </div>
                                <div class="col-2 text-center" id="book-price">
                                    <h6 class="mb-0">{{ $item->price }}$</h6>
                                </div>
                                <div class="col-2 up-down" data-id="{{ $item->rowId }}">
                                    <button type="button"
                                            class="btn btn-primary btn-icon btn-decrease btn-decrease-{{ $item->rowId }}">
                                        <i class="icon-minus"></i>
                                    </button>
                                    <input type="text" id="quantity-{{ $item->rowId }}"
                                           class="quantity-input" size="2" value="{{ $item->qty }}"
                                           style="text-align: center" onkeypress="return isNumberKey(event)"/>
                                    <button type="button" class="btn btn-primary btn-icon btn-increase">
                                        <i class="icon-plus"></i>
                                    </button>
                                </div>
                                <div class="col-1 text-center book-subtotal">
                                    <h6 class="subtotal mb-0">{{ $item->qty * $item->price }}$</h6>
                                </div>
                                <div class="col-1 text-right">
                                    <form action="{{ route('user.cart.delete', ['id' => $item->rowId]) }}" method="POST"
                                          onsubmit="return onSubmitForm(this);">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-inverse-danger btn-icon"><i
                                                class="icon-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                            <span class="col-12 border-bottom"></span>
                        @endforeach
                        <div class="cart-footer col-12 my-3 d-flex flex-column">
                            <div class="book-total-price d-flex align-items-center justify-content-end mb-5">
                                <span class="display-5 font-weight-medium text-capitalize"> The total price: {{ Cart::instance('cart')->initial() }}$ </span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-0">
                                    <a href="{{ route('user.book.index') }}" class="text-body align-items-center">
                                        <i class="icon-arrow-left"></i>
                                        <span class="font-weight-bold">Back to shop</span>
                                    </a>
                                </h6>
                                <h6 class="mb-0">
                                    <a href="/cart/checkout" class="text-body">
                                        <span class="font-weight-bold">Checkout</span>
                                        <i class="icon-arrow-right"></i>
                                    </a>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="cart-empty text-center p-5">
                    <img src="{{ asset('images/empty-cart.png') }}" class="w-25 mb-4">
                    <h5 class="mb-3"><strong>Your cart is empty</strong></h5>
                    <a class="btn btn-success btn-icon-text" href="{{ route('user.book.index') }}">Shopping Now</a>
                </div>
            @endif
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('js/update-cart.js') }}"></script>
    <script src="{{ asset('js/submit-verify.js') }}"></script>
    <script src="{{ asset('js/only-number.js') }}"></script>
@endpush
