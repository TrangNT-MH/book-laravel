$(document).ready(function () {
    $.ajaxSetup({headers: {'csrftoken': '{{ csrf_token() }}'}});
    $('.btn-add-to-cart').on('click', function () {
        let id = $(this).data('book-id')
        console.log(id)
        $.ajax({
            type: 'GET',
            url: `/book/${id}`,
            success: function (response) {
                toastr.options = {
                    "closeButton": true,
                    "positionClass": "toast-bottom-right"
                }
                toastr.success(response.message);
            }
        }).done(function (response) {
            var cart = response.cart
            let count = Object.keys(cart).length;
            $('#cart-badge').text(count);
        })
    })

    let qty = parseInt($('#quantity').val());
    if (qty === 1) {
        $(`.btn-decrease`).prop("disabled", true).addClass('btn-blur')
    }
    $('.btn-increase').on('click', function () {
        $(`.btn-decrease`).prop("disabled", false).removeClass('btn-blur')
        qty++;
        $('#quantity').val(qty)

    })

    $('.btn-decrease').on('click', function () {
        qty--;
        $('#quantity').val(qty)
        $(this).prop("disabled", false).removeClass('btn-blur')

        console.log(qty)
        if (qty === 1) {
            $(`.btn-decrease`).prop("disabled", true).addClass('btn-blur')
        }
    })

    $('.btn-detail-add-to-cart').on('click', function () {
        let id = $(this).data('book-id')
        let qty = parseInt($('#quantity').val());
        console.log(qty)
        $.ajax({
            type: 'GET',
            url: `/book/${id}`,
            data: {
                qty: qty
            },
            success: function (response) {
                toastr.options = {
                    "closeButton": true,
                    "positionClass": "toast-bottom-right"
                }
                toastr.success(response.message);
            }
        }).done(function (response) {
            var cart = response.cart
            let count = Object.keys(cart).length;
            $('#cart-badge').text(count);
        })
    })
})
