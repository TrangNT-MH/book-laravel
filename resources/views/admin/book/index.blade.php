@extends('layout.master')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/liveSearch.css') }}">
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
                        <form class="search-form w-50">
                            <input type="text" name="key" class="form-control search-book" placeholder="Search Title, Author or ISBN10" title="search" autocomplete="off">
                            <span id="bookList"></span>
                        </form>
                        <div class="bool-filter">
                            <select name="limit" id="limit">
                                <option>10</option>
                                <option>20</option>
                                <option>50</option>
                            </select>
                        </div>
                    </div>

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Title/Author</th>
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
                                    <div class="book-title my-2" style="white-space: break-spaces !important; min-width: 160px;">{{ $value['title'] }}</div>
                                    <div class="book-author text-gray">{{ $value['author'] }}</div>
                                </td>
                                <td>{{ $value['price'] }}</td>
                                <td>{{ $value['publication_date'] }}</td>
                                <td>
                                    @if($value['status'] === 1)
                                        <label class="badge badge-success">Active</label>
                                    @else
                                        <label class="badge badge-danger">Inactive</label>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function () {
            $('.search-book').on("keyup", function (e) {
                let key = $(this).val();
                console.log(key);

                if(key === '') {
                    $('#bookList').html('');
                } else {
                    $.ajax({
                        type: 'get',
                        url: '{{ route('admin.book.search') }}',
                        data: {
                            'key': key
                        },
                        success:function(data){
                            $('#bookList').html(data);
                        }
                    });
                }

                if(e.keyCode === 13) {
                    window.location.assign('/admin/book/search?key=' + key);
                }

                $('body').on('click', function (event) {
                        $('#bookList').html('');
                });

                $('#bookList').on('click', 'li', function(){
                    var value = $(this).data('book-id');


                });
                $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
            })
        })
    </script>
@endpush
