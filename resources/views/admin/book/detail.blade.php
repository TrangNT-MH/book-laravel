@extends('layout.master')
@push('style')

@endpush
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body d-flex flex-row">
                <div class="col-4 book-image">
                    <img src="{{ asset('storage/' . $selectBook->image) }}" alt="" style="max-width: 200px;">
                </div>
                <div class="col-3 title">
                    <div>Title: </div>
                    <div>Author: </div>
                    <div>ISBN10: </div>
                    <div>Publication Date: </div>
                    <div>Price: </div>
                    <div>Status: </div>
                </div>
                <div class="col-8 book-detail">
                    <div class="book-detail-title text-capitalize">{{ $selectBook->title }}</div>
                    <div class="book-detail-author text-capitalize">{{ $selectBook->author }}</div>
                    <div class="book-detail-isbn10">{{ $selectBook->isbn10 }}</div>
                    <div class="book-detail-publication-date">Publication Date: {{ $selectBook->publication_date }}</div>
                    <div class="book-detail-price">{{ $selectBook->price }}</div>
                    <div class="book-detail-status">
                        @if($selectBook->status == 1)
                            <label class="badge badge-success">Active</label>
                        @else
                            <label class="badge badge-warning">Inactive</label>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
