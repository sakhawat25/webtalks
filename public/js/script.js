(function ($) {
    "use strict";

    // overlay search

    $(".search_toggle").on("click", function (e) {
        e.preventDefault();
        $(".search_toggle").toggleClass("active");
        $(".overlay").toggleClass("open");
        setTimeout(function () {
            $(".search-form .form-control").focus();
        }, 400);
    });

    /* ----------------------------------------------------------- */
    /*  Slick Carousel
    /* ----------------------------------------------------------- */

    $(".slider-wrap").slick({
        slidesToShow: 3,
        slidesToScroll: 2,
        autoplaySpeed: 4000,
        items: 3,
        loop: true,
        autoplay: true,
        dots: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true,
                },
            },
            {
                breakpoint: 900,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
        ],
    });

    $(".post-slide").slick({
        fade: true,
        autplay: true,
    });

    /* ----------------------------------------------------------- */
    /*  Scroll To Top
	/* ----------------------------------------------------------- */
    $(window).scroll(function () {
        if ($(this).scrollTop() > 500) {
            $(".scroll-to-top").fadeIn();
        } else {
            $(".scroll-to-top").fadeOut();
        }
    });
})(jQuery);
