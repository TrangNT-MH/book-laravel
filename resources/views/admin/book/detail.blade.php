@extends('layout.master')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/bookDetail.css') }}">
@endpush
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.book.update', $selectBook->id) }}" method="post" class="forms-update-book"
                      enctype="multipart/form-data" autocomplete="off">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="book-title">Title</label>
                        <input type="text" class="form-control" id="book-title" name="title"
                               placeholder="Title" autocomplete="off" value="{{ $selectBook->title }}">
                        @if ($errors->has('title'))
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="book-isbn10">ISBN 10</label>
                        <input type="text" class="form-control" id="book-isbn10" name="isbn10"
                               placeholder="ISBN 10" value="{{ $selectBook->isbn10 }}">
                        @if ($errors->has('isbn10'))
                            <span class="text-danger">{{ $errors->first('isbn10') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="book-author">Author</label>
                        <input type="text" class="form-control" id="book-author" name="author"
                               placeholder="Author" value="{{ $selectBook->author }}">
                        @if ($errors->has('author'))
                            <span class="text-danger">{{ $errors->first('author') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="book-publication-date">Publication Date</label>
                        <input type="date" class="form-control" id="book-publication-date" name="publication_date"
                               placeholder="Publication Date" value="{{ $selectBook->publication_date }}">
                        @if ($errors->has('publication_date'))
                            <span class="text-danger">{{ $errors->first('publication_date') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">$</span>
                            </div>
                            <input type="text" class="form-control" name="price"
                                   aria-label="Amount (to the nearest dollar)" value="{{ $selectBook->price }}">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                        @if ($errors->has('price'))
                            <span class="text-danger">{{ $errors->first('price') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>File upload</label>
                        <input id="selectImg" type="file" name="image" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input id="file-upload-name" type="text" class="form-control file-upload-info" disabled
                                   placeholder="Upload Image">
                            <span class="input-group-append">
                            <label id="btn-upload" class="file-upload-browse btn btn-primary"
                                   for="selectImg" type="button">Upload</label>
                          </span>
                        </div>
                        @if ($errors->has('image'))
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                        @endif
                        <img id="image-preview" src="{{ asset('storage/' . $selectBook->image) }}" alt="Image Preview"
                             style="max-width: 100%; max-height: 200px;">
                    </div>
                    <div class="btn-edit-deactivate">
                        <button type="submit" class="btn btn-edit btn-primary btn-icon-text mr-3"
                                data-toggle="modal" data-target="#editBookModal">Edit
                            <i class="icon-doc btn-icon-append"></i>
                        </button>
                        <button class="btn btn-light" onclick="window.history.go(-1); return false;">Cancel</button>
                    </div>
                </form>

                {{--                    <form--}}
                {{--                        action="{{ route('admin.book.status', ['id' => $selectBook->id, 'status' => $selectBook->status]) }}"--}}
                {{--                        method="POST">--}}
                {{--                        @csrf--}}
                {{--                        @method('PUT')--}}
                {{--                        @if($selectBook->status == 1)--}}
                {{--                            <button--}}
                {{--                                class="btn btn-activate-deactivate btn-outline-danger btn-icon-text">--}}
                {{--                                Deactivate--}}
                {{--                                <i class="icon-action-redo"></i>--}}
                {{--                            </button>--}}

                {{--                        @else--}}
                {{--                            <button--}}
                {{--                                class="btn btn-activate-deactivate btn-outline-primary btn-icon-text">--}}
                {{--                                Activate--}}
                {{--                                <i class="icon-action-undo"></i>--}}
                {{--                            </button>--}}
                {{--                        @endif--}}
                {{--                    </form>--}}
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
    </script>
@endpush
