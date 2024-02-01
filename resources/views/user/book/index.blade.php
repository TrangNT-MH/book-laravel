@extends('layouts.user_type.auth')
@push('style')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://kit.fontawesome.com/4d54c01209.js" crossorigin="anonymous"></script>
@endpush
@section('content')
    {{--    @dd(request()->query())--}}
    <div class="all-book">
        <div class="mx-5">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-2">
                        <div class="card-body filters px-0 py-3">
                            <button class="btn btn-icon-text">
                                <i class="fa-solid fa-filter btn-icon-prepend"></i>
                                Filters
                            </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-rounded dropdown-toggle p-3"
                                        data-toggle="dropdown">Price
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item"
                                       href="{{ request()->fullUrlWithQuery(['price' => '0-20']) }}">Under 20$</a>
                                    <a class="dropdown-item"
                                       href="{{ request()->fullUrlWithQuery(['price' => '20-50']) }}">From 20$ to
                                        50$</a>
                                    <a class="dropdown-item"
                                       href="{{ request()->fullUrlWithQuery(['price' => '50-100']) }}">From 50$ to
                                        100$</a>
                                    <a class="dropdown-item"
                                       href="{{ request()->fullUrlWithQuery(['price' => '100']) }}">Above 100$</a>
                                </div>
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-rounded dropdown-toggle p-3"
                                        data-toggle="dropdown">Category
                                </button>
                                <div class="dropdown-menu">
                                    @foreach($allGenres as $category => $genres)
                                        <a class="dropdown-item"
                                           href="{{ request()->fullUrlWithQuery(['category' => $category]) }}">{{ $category }}</a>
                                    @endforeach
                                </div>
                            </div>
                            <a class="btn btn-outline-dark btn-rounded btn-icon-text {{request()->get('sort') == 'asc' ? 'active' : ''}}"
                               href="{{ request()->fullUrlWithQuery(['sort' => 'asc']) }}">
                                <i class="fa-solid fa-arrow-up-wide-short btn-icon-prepend"></i>
                                Price Low-High
                            </a>
                            <a class="btn btn-outline-dark btn-rounded btn-icon-text {{request()->get('sort') == 'desc' ? 'active' : ''}}"
                               href="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}">
                                <i class="fa-solid fa-arrow-down-wide-short btn-icon-prepend"></i>
                                Price High-Low
                            </a>
                            <div class="btn-group">
                                <div class="book-filter">
                                    <span class="font-weight-normal filter-text">Pagination</span>
                                    <select name="limit" id="limit">
                                        <option class="limit_10"
                                                value="10" {{ request()->get('limit') == 10 ? "selected" : "" }}>10
                                        </option>
                                        <option class="limit_20"
                                                value="20" {{ request()->get('limit') == 20 ? "selected" : "" }}>20
                                        </option>
                                        <option class="limit_50"
                                                value="50" {{ request()->get('limit') == 50 ? "selected" : "" }}>50
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @if(count(request()->except('page', 'limit')) > 0)
                        <hr class="mt-0">
                        <div class="filtering mb-3 px-5">
                            @if(array_key_exists('price', request()->query()))
                                <a class="btn btn-danger btn-rounded btn-icon-text"
                                   href="{{ request()->fullUrlWithoutQuery('price') }}">
                                    <i class="icon-close btn-icon-prepend"></i>
                                    Price: From {{ request()->query()['price'] }}$
                                </a>
                            @endif
                            @if(array_key_exists('sort', request()->query()))
                                <a class="btn btn-danger btn-rounded btn-icon-text"
                                   href="{{ request()->fullUrlWithoutQuery('sort') }}">
                                    <i class="icon-close btn-icon-prepend"></i>
                                    @if(request()->query()['sort'] == 'asc')
                                        Sorting: From low to high price
                                    @else
                                        Sorting: From high to low price
                                    @endif
                                </a>
                            @endif
                            @if(array_key_exists('category', request()->query()))
                                <a class="btn btn-danger btn-rounded btn-icon-text"
                                   href="{{ request()->fullUrlWithoutQuery('category') }}">
                                    <i class="icon-close btn-icon-prepend"></i>
                                    Category: {{ request()->query()['category'] }}
                                </a>
                            @endif
                                <a class="btn btn-danger btn-rounded btn-icon-text"
                                   href="{{ request()->fullUrlWithoutQuery(request()->query()) }}">
                                    <i class="icon-close btn-icon-prepend"></i>
                                    Remove all
                                </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
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
                                            <div
                                                class="book-price d-flex justify-content-between align-items-center my-2">
                                                <span>{{ $book->price }} $</span>
                                                <div class="button-add-to-cart">
                                                    <button type="button" class="btn btn-add-to-cart"
                                                            data-book-id="{{ $book->id }}"><i
                                                            class="icon-basket-loaded"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                let url = new URL(document.location.href);
                let params = url.searchParams;
                params.set('limit', limit);
                window.location.href = url.toString();
            });
        })
    </script>
    <script src="{{ asset('js/add-to-cart.js') }}"></script>
@endpush
