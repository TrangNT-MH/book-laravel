@extends('layout.master')
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
                <div class="card-body">
                    <div class="body-head d-flex align-items-center my-2">
                        <h4 class="card-title m-0 mr-2">Books</h4>
                        <a href="{{ route('admin.book.create') }}" class="icon-plus btn-add-book border-0 bg-transparent m-0" style="color: indianred"></a>
                    </div>
                    <div class="search-bar d-flex justify-content-between">
                        <form action="" class="search-form w-50">
                            <input id="search-book" type="text" name="key" class="form-control search-book" placeholder="Search Title, Author or ISBN10" title="search" autocomplete="off" value="{{ isset($_GET['key']) ? $_GET['key'] : null }}">
                            <span id="bookList"></span>
                        </form>
                        <div class="book-filter">
                            <select name="limit" id="limit" class="form-control">
                                <option class="limit_5" value="5" {{ request()->get('limit') == 5 ? "selected" : "" }}>5</option>
                                <option class="limit_10" value="10" {{ request()->get('limit') == 10 ? "selected" : "" }}>10</option>
                                <option class="limit_20" value="20" {{ request()->get('limit') == 20 ? "selected" : "" }}>20</option>
                            </select>
                        </div>
                    </div>

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Title/Author</th>
                            <th>ISBN10</th>
                            <th>Price</th>
                            <th>Publication Date</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allBooks as $key => $value)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>
                                    <div class="book-title my-2" style="white-space: break-spaces !important; min-width: 160px;">{{ $value->title }}</div>
                                    <div class="book-author text-gray">{{ $value->author }}</div>
                                </td>
                                <td>{{ $value->isbn10 }}</td>
                                <td>{{ $value->price }}</td>
                                <td>{{ $value->publication_date }}</td>
                                <td>
                                    @if($value->status === 1)
                                        <label class="badge badge-success">Active</label>
                                    @else
                                        <label class="badge badge-danger">Inactive</label>
                                    @endif
                                </td>
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
            $('#search-book').on('keypress',function(e) {
                if(e.which == 13) {
                    let key = $(this).val();
                    window.location.assign('/admin/book/index?key=' + key);
                }
            });
            $('.search-book').on("keyup", function () {
                let key = $(this).val();

                if(key === '') {
                    $('#bookList').html('');
                } else {
                    $.ajax({
                        type: 'get',
                        url: '{{ route('admin.book.index') }}',
                        data: {
                            'key': key
                        },
                        success:function(data){
                            $('#bookList').html(data);
                        }
                    });
                }

                $('body').on('click', function (event) {
                        $('#bookList').html('');
                });

                $('#bookList').on('click', 'li', function(){
                    let id = $(this).data('book-id');
                    window.location.href = `/admin/book/detail/${id}`;
                });
                $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
            });

            var limit = $('#limit').find(":selected").val();
            $('#limit').on('change', function () {
                console.log(limit)
                limit = parseInt($(this).val());
                window.location.href = "/admin/book/index?limit=" + limit;
            })
        })
    </script>
@endpush
