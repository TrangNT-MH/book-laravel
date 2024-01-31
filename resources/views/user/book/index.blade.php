@extends('layouts.user_type.auth')
@push('style')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endpush
@section('content')
    <div class="head-title d-flex justify-content-between">
        <h1>Our books</h1>
        <div class="book-pagination">
            <select name="limit" id="limit" class="form-control">
                <option class="limit_10" value="10" {{ request()->get('limit') == 10 ? "selected" : "" }}>10</option>
                <option class="limit_20" value="20" {{ request()->get('limit') == 20 ? "selected" : "" }}>20</option>
                <option class="limit_50" value="50" {{ request()->get('limit') == 50 ? "selected" : "" }}>50</option>
            </select>
        </div>
    </div>
    <div class="book-list d-flex flex-wrap">
        @foreach($books as $book)
            <div class="book-box">
                <div class="book-image">
                    <img src="{{ asset('storage/' . $book->image) }} ">
                </div>
                <div class="book-short-detail">
                    <a class="book-title" href="{{ route('user.book.detail', [$book->id]) }}">
                        {{ $book->title }}
                    </a>
                    <div class="book-authors">
                        {{ $book->authors }}
                    </div>
                    <div class="book-rating d-flex align-items-center">
                        <div class="stars" style="--rating: {{ $book->avg_rating }}"></div>
                        <div class="n-reviews">{{ $book->number_of_review }}</div>
                    </div>
                    <div class="book-price d-flex justify-content-between align-items-center my-2">
                        <span>{{ $book->price }} $</span>
                        <div class="button-add-to-cart">
                            <button type="button" class="btn btn-add-to-cart" data-book-id="{{ $book->id }}"><i
                                        class="icon-basket-loaded"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-12">
        {{ $books->withQueryString()->onEachSide(1)->links('user.custom-pagination') }}
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function () {
            $('#limit').on('change', function () {
                let limit = $('#limit').find(":selected").val();
                window.location.href = `/book?limit=${limit}`
            });
        })
    </script>
    <script src="{{ asset('js/add-to-cart.js') }}"></script>
@endpush
