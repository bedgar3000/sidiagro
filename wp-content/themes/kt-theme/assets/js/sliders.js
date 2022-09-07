(function($) {
    "use strict";

    $(document).ready(function() {
        $('.owl-institucion').owlCarousel({
            loop:false,
            margin:25,
            nav:false,
            dots:true,
            autoplay:true,
            autoplayTimeout:10000,
            responsive:{
                0:{
                    items:1
                },
                768:{
                    items:2
                },
                992:{
                    items:3
                },
                1200:{
                    items:4
                }
            }
        });
    });
})(jQuery);
