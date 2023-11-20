@extends('layout.master')
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
                    <form class="search-form d-md-block w-50" action="#">
                        <input type="search" class="form-control" placeholder="Search Here" title="Search here">
                    </form>
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
                                <td class="d-flex flex-column">
                                    <div class="book-title my-2">{{ $value['title'] }}</div>
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
