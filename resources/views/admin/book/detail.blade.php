@extends('layout.master')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/bookDetail.css') }}">
@endpush
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header d-flex flex-row justify-content-between align-items-center">
                <div class="book-detail-header">
                    <span class="display-2 font-weight-medium">Information</span>
                </div>
                <div class="btn-edit-deactivate d-flex">
                    <button type="button" class="btn btn-edit btn-primary btn-icon-text mr-3"
                            data-toggle="modal" data-target="#editBookModal">Edit
                        <i class="icon-doc btn-icon-append"></i>
                    </button>
                    <form
                        action="{{ route('admin.book.status', ['id' => $selectBook->id, 'status' => $selectBook->status]) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        @if($selectBook->status == 1)
                            <button
                                class="btn btn-activate-deactivate btn-outline-danger btn-icon-text">
                                Deactivate
                                <i class="icon-action-redo"></i>
                            </button>
                        @else
                            <button
                                class="btn btn-activate-deactivate btn-outline-primary btn-icon-text">
                                Activate
                                <i class="icon-action-undo"></i>
                            </button>
                        @endif
                    </form>
                    <a type="button" class="btn btn-cancel btn-dark ml-3"
                       href="{{ route('admin.book.detail', [$selectBook->id]) }}">Cancel</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.book.edit', $selectBook->id) }}" method="post" class="forms-update-book"
                      enctype="multipart/form-data" autocomplete="off">
                    @method('PUT')
                    @csrf
                    <div class="book-detail d-flex flex-row">
                        <div class="">
                            <div class="form-group">
                                <img id="image-preview" src="{{ asset('storage/' . $selectBook->image) }}"
                                     alt="Image Preview"
                                     class="img-fluid p-0 mx-auto d-block mb-3 px-2">
                            </div>
                        </div>
                        <div class="">
                            <div class="d-flex justify-content-between">
                                <div class="form-group">
                                    <label for="book-title">Title</label>
                                    <input type="text" class="form-control" id="book-title" name="title"
                                           placeholder="Title" autocomplete="off"
                                           value="{{ old('title', $selectBook->title) }}" readonly>
                                    @if ($errors->has('title'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="book-isbn10">ISBN 10</label>
                                    <input type="text" class="form-control" id="book-isbn10" name="isbn"
                                           placeholder="ISBN" value="{{ old('isbn', $selectBook->isbn) }}" readonly>
                                    @if ($errors->has('isbn'))
                                        <span class="text-danger">{{ $errors->first('isbn') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <div class="form-group">
                                    <label for="book-author">Author</label>
                                    <input type="text" class="form-control" id="book-author" name="author"
                                           placeholder="Author" value="{{ old('author', $selectBook->author) }}"
                                           readonly>
                                    @if ($errors->has('author'))
                                        <span class="text-danger">{{ $errors->first('author') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="book-publication-date">Publication Date</label>
                                    <input type="date" class="form-control" id="book-publication-date"
                                           name="publish_date"
                                           placeholder="Publication Date"
                                           value="{{ old('publication_date', $selectBook->publish_date) }}"
                                           readonly>
                                    @if ($errors->has('publish_date'))
                                        <span class="text-danger">{{ $errors->first('publish_date') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <div class="form-group">
                                    <label for="book-language">Language</label>
                                    <input type="text" class="form-control" id="book-language" name="language"
                                           placeholder="Language" value="{{ old('language', $selectBook->language) }}" readonly>
                                    @if($errors->has('language'))
                                        <span class="text-danger">{{ $errors->first('language') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white">$</span>
                                        </div>
                                        <input type="text" class="form-control" id="price" name="price"
                                               aria-label="Amount (to the nearest dollar)"
                                               value="{{ old('price', $selectBook->price) }}"
                                               readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                    @if ($errors->has('price'))
                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input id="selectImg" type="file" name="image" class="file-upload-default" disabled>
                                    <div class="input-group col-xs-12">
                                        <input id="file-upload-name" type="text" class="form-control file-upload-info"
                                               placeholder="Upload Image"
                                               value="{{ old('image', @end(@explode('/', $selectBook->image))) }}"
                                               disabled>
                                        <span class="input-group-append">
                                        <label id="btn-upload" class="file-upload-browse btn btn-primary"
                                               for="selectImg" type="button">Upload</label>
                                    </span>
                                    </div>
                                    @if ($errors->has('image'))
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group float-right">
                                <button type="submit" class="btn btn-update-book btn-primary btn-icon-text invisible">
                                    Submit
                                    <i class="icon-cloud-upload btn-icon-prepend"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function () {
            let originalFormHtml = $('.forms-update-book').html();

            $('.btn-edit').on('click', function () {
                $(':input').prop('readonly', false);
                $('#selectImg').prop('disabled', false);
                $('.btn-update-book').removeClass('invisible')
                $(this).addClass('invisible')
            });
            @if ($errors->any())
            $('.btn-edit').trigger('click');
            @endif
        })
    </script>
    <script src="{{ asset('js/preview-img.js') }}"></script>
@endpush
