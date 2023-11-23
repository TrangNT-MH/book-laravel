@extends('layout.master')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Adding book form</h4>
                <form action="" method="post" class="forms-add-book" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="book-title">Title</label>
                        <input type="text" class="form-control" id="book-title" name="title"
                               placeholder="Title" autocomplete="on">
                        @if ($errors->has('title'))
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="book-isbn10">ISBN 10</label>
                        <input type="text" class="form-control" id="book-isbn10" name="isbn10"
                               placeholder="ISBN 10">
                        @if ($errors->has('isbn10'))
                            <span class="text-danger">{{ $errors->first('isbn10') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="book-author">Author</label>
                        <input type="text" class="form-control" id="book-author" name="author"
                               placeholder="Author">
                        @if ($errors->has('author'))
                            <span class="text-danger">{{ $errors->first('author') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="book-publication-date">Publication Date</label>
                        <input type="date" class="form-control" id="book-publication-date" name="publication_date"
                               placeholder="Publication Date">
                        @if ($errors->has('publication_date'))
                            <span class="text-danger">{{ $errors->first('publication_date') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">$</span>
                            </div>
                            <input type="text" class="form-control" name="price" aria-label="Amount (to the nearest dollar)">
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
                        <img id="image-preview" src="#" alt="Image Preview" style=" display:none; max-width: 100%; max-height: 200px;">
                    </div>
                    <div>

                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light" onclick="window.history.go(-1); return false;">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        selectImg.onchange = evt => {
            preview = document.getElementById('image-preview');
            fileName = document.getElementById('file-upload-name')
            preview.style.display = 'block';
            const [file] = selectImg.files

            if (file) {
                preview.src = URL.createObjectURL(file)
                fileName.placeholder=file['name']
            }
        }
    </script>
@endpush
