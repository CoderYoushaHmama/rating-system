$(document).ready(function () {
    $('#sections').slick({
        autoplay: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        adaptiveHeight: true,
        prevArrow: "#prev-btn",
        nextArrow: "#next-btn",
    });
    $('#services').slick({
        autoplay: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        adaptiveHeight: true,
        prevArrow: "#prev-btn2",
        nextArrow: "#next-btn2",
    });
});

