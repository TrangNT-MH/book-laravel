@extends('layout.main')
@push('style')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endpush
@section('content')
    <div class="book-detail-content d-flex">
        <div class="image-frame">
            <div class="book-image">
                <img src="{{ asset('storage/' . $book->image) }}" alt="">
            </div>
            <div class="categories d-flex flex-column align-items-start">
                <h5 class="mt-2">Categories:</h5>
                @foreach($arrCate as $cate)
                    <span class="badge badge-primary p-1 m-1">{{ $cate}}</span>
                @endforeach
            </div>
        </div>
        <div class="book-detail-wrapper">
            <div class="book-overview-box p-2">
                <div class="book-overview d-flex flex-column">
                    <span class="book-authors mb-2">Author: {{ $book->authors }}</span>
                    <span class="border-bottom"></span>
                    <div class="book-title my-2">{{ $book->title }}</div>
                    <div class="book-rating d-flex align-items-center my-2">
                        <div class="stars" style="--rating: {{ $book->avg_rating }}"></div>
                        <div class="n-reviews">{{ $book->number_of_review }}</div>
                    </div>
                    <div class="book-price my-2">{{ $book->price }}</div>
                </div>
                <div class="book-description">
                    <h6 class="">Description</h6>
                    {!! $book->description !!}
                </div>
            </div>
            <div class="card-body book-detail">
                <h4 class="card-title">Detail information</h4>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Number of pages</th>
                        <th>Publication Date</th>
                        <th>Publisher</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $book->page_count }}</td>
                        <td>{{ $book->publish_date }}</td>
                        <td>{{ $book->publisher }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="add-to-cart">
            <div class="quantity p-4">
                <div class="title">
                    <h6><strong>Quantity</strong></h6>
                </div>
                <div class="body d-flex">
                    <button type="button" class="btn btn-icon btn-decrease" data-book-id="{{ $book->id }}">
                        <i class="icon-minus text-danger"></i>
                    </button>
                    <input type="text" id="quantity"
                           class="quantity-input" size="10" value="1" onkeypress="return isNumberKey(event)"/>
                    <button type="button" class="btn btn-icon btn-increase" data-book-id="{{ $book->id }}">
                        <i class="icon-plus text-danger"    ></i>
                    </button>
                </div>
                <div class="price my-2">
                    <h6><strong>Price</strong></h6>
                    <h4>{{ $book->price }}$</h4>
                </div>
                <button type="button" class="btn btn-danger btn-detail-add-to-cart btn-icon-text w-100 my-2" data-book-id="{{ $book->id }}">Add To Cart</button>
                <a href="{{ route('user.cart.checkout') }}" class="btn btn-outline-danger btn-buy w-100">Buy Now</a>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('js/only-number.js') }}"></script>
    <script src="{{ asset('js/add-to-cart.js') }}"></script>
@endpush

