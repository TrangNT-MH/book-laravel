@extends('layouts.user_type.auth')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Adding book form</h4>
                <form action="{{ route('admin.book.store') }}" method="post" class="forms-add-book"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="book-title">Title</label>
                        <input type="text" class="form-control" id="book-title" name="title"
                               placeholder="Title" autocomplete="on" value="{{ old('title') }}">
                        @if ($errors->has('title'))
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="book-isbn">ISBN</label>
                        <input type="text" class="form-control" id="book-isbn" name="isbn"
                               placeholder="ISBN" value="{{ old('isbn') }}">
                        @if ($errors->has('isbn'))
                            <span class="text-danger">{{ $errors->first('isbn') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="book-author">Author</label>
                        <input type="text" class="form-control" id="book-author" name="authors"
                               placeholder="Author" value="{{ old('authors') }}">
                        @if ($errors->has('authors'))
                            <span class="text-danger">{{ $errors->first('authors') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="book-publisher">Publisher</label>
                        <input type="text" class="form-control" id="book-publisher" name="publisher"
                               placeholder="Publisher" value="{{ old('publisher') }}">
                        @if ($errors->has('publisher'))
                            <span class="text-danger">{{ $errors->first('publisher') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="book-publication-date">Publication Date</label>
                        <input type="date" class="form-control" id="book-publication-date" name="publish_date"
                               placeholder="Publication Date" value="{{ old('publish_date') }}">
                        @if ($errors->has('publish_date'))
                            <span class="text-danger">{{ $errors->first('publish_date') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select class="js-example-basic-multiple select2-hidden-accessible" multiple="" name="genres[]"
                                style="width:100%" data-select2-id="4" tabindex="-1" aria-hidden="true">
                            @foreach($allGenres as $values)
                                <optgroup label="{{ $values['category'] }}">
                                    @foreach($values['genres'] as $value)
                                        <option value="{{ $value }}" {{ (collect(old('genres'))->contains($value)) ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                    <option></option>
                                </optgroup>
                            @endforeach
                        </select>
                        @if ($errors->has('genres'))
                            <span class="text-danger">{{ $errors->first('genres') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="book-language">Pages number</label>
                        <input type="number" class="form-control" id="book-pages-number" name="page_count"
                               placeholder="Pages Number" value="{{ old('page_count') }}">
                        @if ($errors->has('page_count'))
                            <span class="text-danger">{{ $errors->first('page_count') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="book-language">Language</label>
                        <input type="text" class="form-control" id="book-language" name="language"
                               placeholder="Language" value="{{ old('language') }}">
                        @if ($errors->has('language'))
                            <span class="text-danger">{{ $errors->first('language') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">$</span>
                            </div>
                            <input type="text" class="form-control" name="price"
                                   aria-label="Amount (to the nearest dollar)" value="{{ old('price') }}">
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
                        <img id="image-preview" src="#" alt="Image Preview"
                             style=" display:none; max-width: 100%; max-height: 200px;">
                    </div>
                    <div class="form-group">
                        <label for="book-description">Description</label>
                        <div class="col-xs-12">
                            <textarea class="tinymce-editor" id="book-description" name="description" rows="10" cols="100%">
                                {{ old('description') }}
                            </textarea>
                            @if($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light" onclick="window.history.go(-1); return false;">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('js/preview-img.js') }}"></script>
    <script src="{{ asset('js/typeahead.js') }}"></script>
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
@endpush
