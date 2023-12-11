@extends('layout.main')
@push('style')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-center">
        <div class="col-lg-12 box-cart">
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
                                <a class="book-cart-title" href="{{ route('user.book.detail', [$item->rowId]) }}">
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
                                       style="text-align: center"/>
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
                            <span class="display-5 font-weight-medium text-capitalize"> The total price: {{ Cart::instance('cart')->subtotal() }}$ </span>
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
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function () {
            $('.quantity-input').each(function () {
                let id = $(this).parents().data('id');
                if (parseInt($(this).val()) === 1) {
                    $(`.btn-decrease-${id}`).prop("disabled", true).addClass('btn-blur')
                }
            });

            $('.btn-increase').on('click', function () {
                let id = $(this).parents().data('id');
                let qty = parseInt($(`#quantity-${id}`).val()) + 1;
                $(`.btn-decrease-${id}`).prop("disabled", false).removeClass('btn-blur')
                console.log(qty)
                $(`#quantity-${id}`).val(qty);
                $.ajax({
                    type: 'PUT',
                    url: `/cart/update/${id}`,
                    data: {
                        '_method': 'PUT',
                        '_token': '{{ csrf_token()}}',
                        id: id,
                        qty: qty
                    },
                    success: function () {
                        window.location.reload()
                    }
                });
            });

            $('.btn-decrease').on('click', function () {
                let id = $(this).parents().data('id');
                let qty = parseInt($(`#quantity-${id}`).val());
                qty--;
                $(`#quantity-${id}`).val(qty);
                if (qty === 1) {
                    $(this).prop('disabled', true).addClass('btn-blur')
                }
                $.ajax({
                    type: 'PUT',
                    url: `/cart/update/${id}`,
                    data: {
                        '_method': 'PUT',
                        '_token': '{{ csrf_token()}}',
                        id: id,
                        qty: qty
                    },
                    success: function () {
                        window.location.reload()
                    }
                });
            });
        })

        function onSubmitForm(form) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
            return false;
        }
    </script>
@endpush
