@extends('layout.master')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/bookDetail.css') }}">
@endpush
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <div class="row book-grid-row style-4 m-b60">
                        <div class="col">
                            <div class="book-detail-box d-flex flex-row">
                                <div class="book-detail-media mr-5">
                                    <img src="{{ asset('storage/' . $selectBook->image) }}" alt="book"
                                         style="max-width: 400px;">
                                </div>
                                <div class="book-detail-content">
                                    <div class="book-detail-header">
                                        <h3 class="title font-weight-bolder display-2">{{ $selectBook->title }}</h3>
                                    </div>
                                    <div class="book-detail-body">
                                        <div class="book-detail">
                                            <ul class="book-info">
                                                <li>
                                                    <div class="writer-info">
                                                        <span>Writen by</span>{{ $selectBook->author }}
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="publication-date">
                                                        <span>Publication Date</span>{{ $selectBook->publication_date }}
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="book-footer">
                                            <div class="price">
                                                <h5>${{ $selectBook->price }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-8">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
