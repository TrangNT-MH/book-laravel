@extends('layouts.user_type.auth')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/liveSearch.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
@endpush
@section('content')
    <div class="page-header">
        <h3 class="page-title"> Tables </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Book tables</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card overflow-scroll">
            <div class="card">
                <div class="card-header">
                    <div class="col-12 d-flex align-items-center justify-content-between">
                        <span class="card-title m-0">Filter</span>
                        <div class="col-md-4 book-status">
                            <select id="bookStatus" class="form-control text-capitalize">
                                <option value="">Status</option>
                                <option value="1" {{ request()->get('is_active') == 1 ? "selected" : "" }}>Active
                                </option>
                                <option value="2" {{ request()->get('is_active') == 2 ? "selected" : "" }}>Inactive
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="body-head d-flex align-items-center my-2">
                        <h4 class="card-title m-0 mr-2">Books</h4>
                        <a href="{{ route('admin.book.create') }}"
                           class="icon-plus btn-add-book border-0 bg-transparent m-0" style="color: indianred"></a>
                    </div>
                    <div class="search-bar d-flex justify-content-between">
                        <form action="" class="search-form w-50">
                            <input id="search-book" type="text" name="key" class="form-control search-book"
                                   placeholder="Search Title" title="search" autocomplete="off"
                                   value="{{ request()->get('key') }}">
                            <span id="bookList"></span>
                        </form>
                        <div class="book-filter">
                            <select name="limit" id="limit" class="form-control">
                                <option class="limit_5" value="5" {{ request()->get('limit') == 5 ? "selected" : "" }}>
                                    5
                                </option>
                                <option class="limit_10"
                                        value="10" {{ request()->get('limit') == 10 ? "selected" : "" }}>10
                                </option>
                                <option class="limit_20"
                                        value="20" {{ request()->get('limit') == 20 ? "selected" : "" }}>20
                                </option>
                            </select>
                        </div>
                    </div>

                    <table class="table mt-3">
                        <thead class="table-secondary">
                        <tr class="font-weight-bolder">
                            <th>No.</th>
                            <th>Title/Author</th>
                            <th>ISBN</th>
                            <th>Price</th>
                            <th>Publisher</th>
                            <th>Publication Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allBooks as $key => $value)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>
                                    <div class="book-title cursor-pointer"
                                         style="white-space: break-spaces !important; min-width: 160px;"
                                         onclick="window.location.href = '{{ route('admin.book.detail', [$value->id]) }}'">{{ $value->title }}
                                    </div>
                                    <div class="book-author text-gray">{{ $value->authors }}</div>
                                </td>
                                <td>{{ $value->isbn }}</td>
                                <td>{{ $value->price }}</td>
                                <td>{{ $value->publisher }}</td>
                                <td>{{ $value->publish_date }}</td>
                                <td>
                                    @if($value->status === 1)
                                        <label class="badge badge-success">Active</label>
                                    @else
                                        <label class="badge badge-danger">Inactive</label>
                                    @endif
                                </td>
                                <td class="text-center"><i class="icon-action icon-options-vertical"></i></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $allBooks->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function () {

            $('#limit').on('change', function () {
                let params = getParams();
                filterTable(params);
            });

            $('#bookStatus').on('change', function () {
                let params = getParams();
                filterTable(params);
            });

            $('#search-book').on('keypress', function (e) {
                if (e.which === 13) {
                    let params = getParams();
                    params['key'] = $(this).val();
                    filterTable(params);
                }
            });

            function getParams() {
                let limit = $('#limit').find(":selected").val();
                let key = '{{ request()->get('key') ?? '' }}';
                let status = $('#bookStatus').find(":selected").val();
                return {
                    'key': key,
                    'limit': limit,
                    'is_active': status
                }
            }

            function filterTable(params) {
                let url = '/admin/book/index';
                let paramsUrl = [];

                $.each(params, function (key, value) {
                    console.log(key)
                    if (value !== '') {
                        paramsUrl.push(key + '=' + value)
                    }
                })

                if (paramsUrl.length > 0) {
                    url += '?' + paramsUrl.join('&');
                }

                window.location.href = url;
            }

            $('.search-book').on("keyup", function () {
                let key = $(this).val();

                if (key === '') {
                    $('#bookList').html('');
                } else {
                    $.ajax({
                        type: 'get',
                        url: '{{ route('admin.book.index') }}',
                        data: {
                            'key': key
                        },
                        success: function (data) {
                            $('#bookList').html(data);
                        }
                    });
                }

                $('body').on('click', function (event) {
                    $('#bookList').html('');
                });

                $('#bookList').on('click', 'li', function () {
                    let id = $(this).data('book-id');
                    window.location.href = `/admin/book/detail/${id}`;
                });
            });
            $.ajaxSetup({headers: {'csrftoken': '{{ csrf_token() }}'}});

            $()
        })
    </script>
@endpush
