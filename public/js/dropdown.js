$(document).ready(function () {
    $('.nav li a').each(function () {
        let show = 0;
        $(this).on('click', function () {
            if (show % 2 === 0) {
                $(this).next().addClass('show')
            } else {
                $(this).next().removeClass('show')
            }
            show++
        })
    })
})
