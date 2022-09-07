(function($) {
    "use strict";

    $(document).ready(function() {
        $('.nav-mobile').find('.menu-item-has-children').on('click', function(e) {
            e.preventDefault();

            // $('.nav-mobile').find('.sub-menu').removeClass('active');
            $(this).find('.sub-menu').toggleClass('active');
        });
    });
})(jQuery);