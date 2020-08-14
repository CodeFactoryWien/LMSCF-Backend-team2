
$(window).on('scroll', function () {
    if ($(window).scrollTop() >= $(window).height())
        $('.nav').addClass('sticky');
    else
        $('.nav').removeClass('sticky');
});