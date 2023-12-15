@extends('layout.main')
@section('content')
    <div class="cart-checkout-wrapper d-flex col-12">
        <div class="box-cart-checkout p-5 col-6">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="fw-bold mb-0 text-black">Checkout</h1>
            </div>
            <table class="table">
                @foreach($cart as $item)
                    <tr class=" view-cart-checkout">
                        <td class="cart-checkout-img">
                            <img src="{{ asset('storage/' . $item->options['image']) }}" alt="">
                        </td>
                        <td class="cart-checkout-title-author d-flex flex-column">
                            <div class="cart-checkout-title my-2" href="{{ route('user.book.detail', [$item->id]) }}">
                                {{ $item->name }}
                            </div>
                            <div class="cart-checkout-authors my-2">
                                {{ $item->options['author'] }}
                            </div>
                            <div class="cart-checkout-price my-2">
                                <h5 class="mb-0">{{ $item->price }}$ x {{ $item->qty }} = {{ $item->qty * $item->price }}$</h5>
                            </div>
                        </td>

                    </tr>
                @endforeach
            </table>
            <div class="cart-footer col-12 my-3 d-flex flex-column">
                <div class="book-total-price d-flex align-items-center justify-content-end mb-5">
                    <span class="display-5 font-weight-medium text-capitalize"> The total price: {{ Cart::instance('cart')->initial() }}$ </span>
                </div>
                <div class="d-flex justify-content-between">
                    <h6 class="mb-0">
                        <a href="{{ route('user.cart') }}" class="text-body align-items-center">
                            <i class="icon-arrow-left"></i>
                            <span class="font-weight-bold">Back to cart</span>
                        </a>
                    </h6>
                    <h6 class="mb-0">
                        <a href="" class="text-body">
                            <button class="btn btn-inverse-danger">Place Order</button>
                        </a>
                    </h6>
                </div>
            </div>
        </div>
        <div class="checkout-address col-6">
            <div class="p-5">
                <div class="d-flex justify-content-between mb-4">
                    <h5 class="text-uppercase">Destination Address</h5>
                </div>
                <hr class="my-4">

                <div class="mb-3 show-address d-flex justify-content-between">
                    <div class="address">
                        @foreach($addresses as $address)
                            @if($address['is_default'] === 1)
                                {{ $address['street_number'] . ', ' . $address['street_address'] . ', ' . $address['district'] . ', ' . $address['city'] }}
                            @endif
                        @endforeach
                    </div>
                    <div>
                        <button type="button" class="change-address btn btn-inverse-danger btn-icon-text">Change Address</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Button to trigger the modal -->
    <button type="button" class="btn btn-primary btn-modal" data-toggle="modal" data-target="#addressModal" style="visibility: hidden">
    </button>

    <!-- Modal -->
    <div class="modal show fade " id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title" id="addressModalLabel">Addresses</h4>
                    <button type="button" class="btn btn-icon" data-dismiss="modal" aria-label="Close">
                        <i class="icon-close"></i>
                    </button>
                </div>
                <div class="address-list modal-body">
                    @foreach ($addresses as $address)
                    <div class="choose-address d-flex">
                        <label class="box-address box-address-{{ $address['id'] }}"
                               data-address-id={{ $address['id'] }}>
                            <input type="radio" class="radio-choose-address"
                                   value="{{ $address['id'] }}"
                                   name="address" {{ $address['is_default']  === 1 ? 'checked' : '' }}>
                            <div class="mb-2">
                                <div class="bg-white addresses-item shadow-sm border">
                                    <div class="gold-members p-4">
                                        <h6 class="mb-1">{{ $address['is_default']  === 1    ? 'Default' : 'Other' }}</h6>
                                        <p>{{ $address['street_number'] . ', ' . $address['street_address'] . ', ' . $address['district'] . ', ' . $address['city'] }}</p>
                                        <div class="edit-delete">
                                            <button type="button" class="btn-edit-address"
                                                    data-address-id="">EDIT
                                            </button>
                                            <button type="button" class="btn-delete-address btn-delete-address-"
                                                    data-address-id="">
                                                DELETE
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                    @endforeach
                    <button type="button" class="btn btn-add-address btn-icon-text p-0">
                            <i class="icon-plus"></i>
                            Add Address
                    </button>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-close-modal" data-dismiss="modal">Close
                        </button>
                        <button type="submit" class="btn btn-primary btn-choose-address" name="save-address">
                            Save Address
                        </button>
                    </div>
                </div>
                <div class="address-form modal-body" style="display: none;">
                    <form id="form" method="post" action="" class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="address_1" class="form-label">Address 1</label>
                            <input type="text" class="form-control address_1" id="address_1" name="address_1">
                        </div>
                        <div class="mb-3">
                            <label for="district" class="form-label">District</label>
                            <input type="text" class="form-control" id="district" name="district">
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control" id="country" name="country" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="make-default" class="form-check-label">Make Default</label>
                            <input type="checkbox" class="form-check-input" id="make-default">
                            <input type="hidden" name="make-default" id="make-default-hidden" value="0">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-back">Back</button>
                            <button type="submit" class="btn btn-primary btn-save-address" name="save-address">
                                Save Address
                            </button>
                            <button type="submit" class="btn btn-primary btn-update-address" name="save-address" style="display: none">
                                Update Address
                            </button>
                        </div>
                        <div class="form-group">
                            <label for="address-street">Title</label>
                            <input type="text" class="form-control" id="book-title" name="title"
                                   placeholder="Title" autocomplete="off"
                                   value="{{ old('title', $selectBook->title) }}" readonly>
                            @if ($errors->has('title'))
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="book-isbn10">ISBN 10</label>
                            <input type="text" class="form-control" id="book-isbn10" name="isbn10"
                                   placeholder="ISBN 10" value="{{ old('isbn10', $selectBook->isbn10) }}" readonly>
                            @if ($errors->has('isbn10'))
                                <span class="text-danger">{{ $errors->first('isbn10') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="book-author">Author</label>
                            <input type="text" class="form-control" id="book-author" name="author"
                                   placeholder="Author" value="{{ old('author', $selectBook->author) }}" readonly>
                            @if ($errors->has('author'))
                                <span class="text-danger">{{ $errors->first('author') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="book-publication-date">Publication Date</label>
                            <input type="date" class="form-control" id="book-publication-date"
                                   name="publication_date"
                                   placeholder="Publication Date"
                                   value="{{ old('publication_date', $selectBook->publication_date) }}"
                                   readonly>
                            @if ($errors->has('publication_date'))
                                <span class="text-danger">{{ $errors->first('publication_date') }}</span>
                            @endif
                        </div>
                    </form>
                    <form action="{{ route('admin.book.edit', $selectBook->id) }}" method="post" class="forms-update-book"
                          enctype="multipart/form-data" autocomplete="off">
                        @method('PUT')
                        @csrf
                        <div class="book-detail d-flex flex-row">
                            <div class="col-4">
                                <div class="form-group">
                                    <img id="image-preview" src="{{ asset('storage/' . $selectBook->image) }}"
                                         alt="Image Preview"
                                         class="img-fluid p-0 mx-auto d-block mb-3 px-2">
                                </div>
                            </div>
                            <div class="col-8">
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
                                    <input type="text" class="form-control" id="book-isbn10" name="isbn10"
                                           placeholder="ISBN 10" value="{{ old('isbn10', $selectBook->isbn10) }}" readonly>
                                    @if ($errors->has('isbn10'))
                                        <span class="text-danger">{{ $errors->first('isbn10') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="book-author">Author</label>
                                    <input type="text" class="form-control" id="book-author" name="author"
                                           placeholder="Author" value="{{ old('author', $selectBook->author) }}" readonly>
                                    @if ($errors->has('author'))
                                        <span class="text-danger">{{ $errors->first('author') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="book-publication-date">Publication Date</label>
                                    <input type="date" class="form-control" id="book-publication-date"
                                           name="publication_date"
                                           placeholder="Publication Date"
                                           value="{{ old('publication_date', $selectBook->publication_date) }}"
                                           readonly>
                                    @if ($errors->has('publication_date'))
                                        <span class="text-danger">{{ $errors->first('publication_date') }}</span>
                                    @endif
                                </div>
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
                                               value="{{ old('image', @end(@explode('/', $selectBook->image))) }}" disabled>
                                        <span class="input-group-append">
                                        <label id="btn-upload" class="file-upload-browse btn btn-primary"
                                               for="selectImg" type="button">Upload</label>
                                    </span>
                                    </div>
                                    @if ($errors->has('image'))
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                    @endif
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
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function () {
            $('.change-address').on('click', function () {
                $('.btn-modal').click();
            })
            $('.btn-add-address').on('click', function () {
                $('.address-form').show();
                $('.address-list').hide();
            })
        })
    </script>
@endpush
