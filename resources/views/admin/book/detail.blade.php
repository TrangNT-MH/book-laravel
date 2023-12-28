@extends('layouts.user_type.auth')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/bookDetail.css') }}">
@endpush
@section('content')
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
                   href="{{ route('admin.book.index') }}">Cancel</a>
            </div>
        </div>
        <div class="card-body justify-content-around">
            <form action="{{ route('admin.book.edit', $selectBook->id) }}" method="post" class="forms-update-book"
                  enctype="multipart/form-data" autocomplete="off">
                @method('PUT')
                @csrf
                <div class="admin-book-detail d-flex    ">
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
                    <div class="col-9">
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
                                        <input type="text" class="form-control" id="book-author" name="authors"
                                               placeholder="Author" value="{{ old('authors', $selectBook->authors) }}"
                                               readonly>
                                        @if ($errors->has('author'))
                                            <span class="text-danger">{{ $errors->first('authors') }}</span>
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
                                               placeholder="Language"
                                               value="{{ old('language', $selectBook->language) }}"
                                               readonly>
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
                                    <label for="book-category" class="col-sm-3 col-form-label">Category</label>
                                    <div class="col-sm-9">
                                        {{--                                    @if($selectBook->category === 'none')--}}
                                        {{--                                        <input readonly type="text" class="form-control" value="none" placeholder="No category">--}}
                                        {{--                                    @else--}}
                                        {{--                                        <input readonly type="text" class="form-control" id="book-category"--}}
                                        {{--                                               value="{{$selectBook->category}}" name="category">--}}
                                        {{--                                    @endif--}}
                                        <input type="text" class="form-control book-category" id="book-pages"
                                               name="category"
                                               placeholder="Category"
                                               value="{{ old('category', $selectBook->category) }}"
                                               readonly>
                                        @if($errors->has('category'))
                                            <span class="text-danger">{{ $errors->first('category') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="book-pages" class="col-sm-3 col-form-label">Pages</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control book-pages" id="book-pages"
                                               name="page_count"
                                               placeholder="Pages"
                                               value="{{ old('page_count', $selectBook->page_count) }}"
                                               readonly>
                                        @if($errors->has('language'))
                                            <span class="text-danger">{{ $errors->first('language') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Publisher</label>
                                    <div class="col-sm-9">
                                        <input readonly type="text" class="form-control" name="publisher"
                                               value="{{ $selectBook->publisher }}">
                                    </div>
                                    @if($errors->has('publisher'))
                                        <span class="text-danger">{{ $errors->first('publisher') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="publish_date" class="col-sm-3 col-form-label">Publication Date</label>
                                    <div class="col-sm-9">
                                        <input readonly id="publish_date" type="date" class="form-control"
                                               name="publish_date"
                                               value="{{ $selectBook->publish_date }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">ISBN</label>
                                    <div class="col-sm-9">
                                        <input readonly type="text" class="form-control" name="isbn"
                                               value="{{ $selectBook->isbn }}">
                                    </div>
                                    @if($errors->has('publisher'))
                                        <span class="text-danger">{{ $errors->first('publisher') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="book-description" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                            <textarea readonly class="tinymce-editor" id="book-description" name="description"
                                      placeholder="Description" rows="10" cols="100%"
                                      readonly>{{ old('description', $selectBook->description) }}</textarea>
                                        @if($errors->has('description'))
                                            <span class="text-danger">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group float-right">
                    <button type="submit" class="btn btn-update-book btn-primary btn-icon-text invisible">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
@push('script')
    <script src="{{ asset('js/preview-img.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/vtnpapyjs714lk82gotpdtdz9wwz9maf1g6vbdl0g3yerqbt/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>

    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea.tinymce-editor',
            height: 300,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount', 'image'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_css: '//www.tiny.cloud/css/codepen.min.css'
        });
    </script>
    <script>
        $(document).ready(function () {
            tinymce.activeEditor.mode.set("readonly");
            $('.btn-edit').on('click', function () {
                $(':input').prop('readonly', false);
                $('#selectImg').prop('disabled', false);
                $('.btn-update-book').removeClass('invisible')
                tinymce.activeEditor.mode.set("design");
                $(this).addClass('invisible')
            });
            @if ($errors->any())
            $('.btn-edit').trigger('click');
            @endif
        })
    </script>
@endpush
