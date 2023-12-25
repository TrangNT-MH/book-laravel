@extends('layout.master')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/bookDetail.css') }}">
@endpush
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.book.edit', $selectBook->id) }}" method="post" class="forms-update-book"
                      enctype="multipart/form-data" autocomplete="off">
                    @method('PUT')
                    @csrf
                    <div class="book-detail d-flex flex-row">

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
                    <form action="{{ route('admin.book.status', ['id' => $selectBook->id, 'status' => $selectBook->status]) }}"
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
            <div class="card-body d-flex">
                    <div class="col-3">
                        <img id="image-preview" src="{{ asset('storage/' . $selectBook->image) }}"
                             alt="Image Preview"
                             class="w-100 mb-2">
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

                <form class="form-sample col-9">
                    <h4 class="card-title">Book information</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label book-title">Title</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="book-title" name="title"
                                           placeholder="Title" autocomplete="off"
                                           value="{{ old('title', $selectBook->title) }}" readonly>
                                    @if ($errors->has('title'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Author</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="book-author" name="author"
                                           placeholder="Author" value="{{ old('author', $selectBook->author) }}"
                                           readonly>
                                    @if ($errors->has('author'))
                                        <span class="text-danger">{{ $errors->first('author') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Language</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="book-language" name="language"
                                           placeholder="Language" value="{{ old('language', $selectBook->language) }}" readonly>
                                    @if($errors->has('language'))
                                        <span class="text-danger">{{ $errors->first('language') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Price</label>
                                <div class="col-sm-9">
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
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Category</label>
                                <div class="col-sm-9">
                                    <select class="form-control">
                                        <option>Category1</option>
                                        <option>Category2</option>
                                        <option>Category3</option>
                                        <option>Category4</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Membership</label>
                                <div class="col-sm-4">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios1" value="" checked=""> Free <i class="input-helper"></i></label>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios2" value="option2"> Professional <i class="input-helper"></i></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="form-group d-flex">
                                <label for="book-description" class="col-3 col-form-label">Description</label>
                                <div class="col-9">
                                    <textarea class="form-control" id="book-description" name="description" placeholder="Description" rows="10" cols="100%" readonly>
                                        {{ old('description', $selectBook->description) }}
                                    </textarea>
{{--                                    <input type="text" class="form-control" id="book-description" name="description"--}}
{{--                                           placeholder="Description" value="{{ old('description', $selectBook->description) }}" readonly>--}}
                                    @if($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Address 2</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Postcode</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">City</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Country</label>
                                <div class="col-sm-9">
                                    <select class="form-control">
                                        <option>America</option>
                                        <option>Italy</option>
                                        <option>Russia</option>
                                        <option>Britain</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
