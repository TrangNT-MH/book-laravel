@extends('layout.main')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/user/style.css') }}"
@endpush
@section('content')
    <div class="head-title">
        <h1>Our books</h1>
    </div>
    <div class="book-list d-flex flex-wrap">
        @foreach($books as $book)
        <div class="book-box">
            <div class="book-image">
                <img src="{{ asset('storage/' . $book->image) }} ">
            </div>
            <div class="book-short-detail">
                <div class="book-title">
                    {{ $book->title }}
                </div>
                <div class="book-authors">
                    {{ $book->authors }}
                </div>
                <div class="book-rating d-flex align-items-center">
                    <div class="stars" style="--rating: {{ $book->avg_rating }}"></div>
                    <div class="n-reviews">{{ $book->n_review }}</div>
                </div>
                <div class="book-price d-flex justify-content-between">
                    {{ $book->price }} $
                    <div class="add-to-cart">
                        <button type="button" class="btn btn-add-to-cart"><i class="icon-basket-loaded"></i></button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
