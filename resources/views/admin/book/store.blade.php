@extends('layout.master')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Adding book form</h4>
                <form action="" method="post" class="forms-add-book">
                    @csrf
                    <div class="form-group">
                        <label for="book-title">Title</label>
                        <input type="text" class="form-control" id="book-title"
                               placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label for="book-author">Author</label>
                        <input type="text" class="form-control" id="book-author"
                               placeholder="Author">
                    </div>
                    <div class="form-group">
                        <label for="book-publication-date">Publication Date</label>
                        <input type="date" class="form-control" id="book-publication-date"
                               placeholder="Publication Date">
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">$</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>File upload</label>
                        <input id="upload-image-add-book" type="file" name="image" class="file-upload-default"
                               accept="image/png, image/jpeg">
                        <div class="input-group col-xs-12 d-flex justify-content-between align-items-center">
                            {{--                        <input type="text" class="form-control file-upload-info" disabled--}}
                            {{--                               placeholder="Upload Image">--}}
                            <div class="preview-image flex-grow-1 h-100">
                                <input type="text" class="form-control" placeholder="Upload Image">
                            </div>
                            <label class="file-upload-browse btn btn-primary mb-0" for="upload-image-add-book">Upload</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
@endsection
