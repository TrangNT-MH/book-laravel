$(document).ready(function () {
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') } });
    $('.quantity-input').each(function () {
        let id = $(this).parents().data('id');
        if (parseInt($(this).val()) === 1) {
            $(`.btn-decrease-${id}`).prop("disabled", true).addClass('btn-blur')
        }

        $(`#quantity-${id}`).on('change', function () {
            let qty = parseInt($(this).val());
            console.log(qty)
            $.ajax({
                type: 'PUT',
                url: `/cart/update/${id}`,
                data: {
                    '_method': 'PUT',
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: id,
                    qty: qty
                },
                success: function () {
                    window.location.reload()
                }
            });
        })
    });

    $('.btn-increase').on('click', function () {
        let id = $(this).parents().data('id');
        let qty = parseInt($(`#quantity-${id}`).val()) + 1;
        $(`.btn-decrease-${id}`).prop("disabled", false).removeClass('btn-blur')
        console.log(qty)
        $(`#quantity-${id}`).val(qty);
        $.ajax({
            type: 'PUT',
            url: `/cart/update/${id}`,
            data: {
                '_method': 'PUT',
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: id,
                qty: qty
            },
            success: function () {
                window.location.reload()
            }
        });
    });

    $('.btn-decrease').on('click', function () {
        let id = $(this).parents().data('id');
        let qty = parseInt($(`#quantity-${id}`).val());
        qty--;
        $(`#quantity-${id}`).val(qty);
        if (qty === 1) {
            $(this).prop('disabled', true).addClass('btn-blur')
        }
        $.ajax({
            type: 'PUT',
            url: `/cart/update/${id}`,
            data: {
                '_method': 'PUT',
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: id,
                qty: qty
            },
            success: function () {
                window.location.reload()
            }
        });
    });
})
