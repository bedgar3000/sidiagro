(function($) {
    "use strict";

    // Init AOS
    function aos_init() {
        AOS.init({
            duration: 1000,
            once: true
        });
    }
    $(window).on('load', function() {
        aos_init();
    });

    // Activate smooth scroll on page load with hash links in the url
    var scrolltoOffset = $('#header').outerHeight() + 75;
    $(document).ready(function() {
        $(document).on('click', '.navbar-nav a, .main-nav a, .mobile-nav a, .scrollto, .scrollto a', function(e) {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                if (target.length) {
                    e.preventDefault();

                    var scrollto = target.offset().top - scrolltoOffset;

                    if ($(this).attr("href") == '#header') {
                        scrollto = 0;
                    }

                    if ($(this).parents('.single-header.scrolled').length) {
                        scrollto = scrollto - 100;
                    }
                    else if ($(this).parents('.single-header').length) {
                        scrollto = scrollto - 375;
                    }

                    $('html, body').animate({
                        scrollTop: scrollto
                    }, 1500, 'easeInOutExpo');

                    if ($(this).parents('.main-nav, .mobile-nav').length) {
                        $('.main-nav .active, .mobile-nav .active').removeClass('active');
                        $(this).closest('li').addClass('active');
                    }

                    if ($('body').hasClass('mobile-nav-active')) {
                        $('body').removeClass('mobile-nav-active');
                        $('.mobile-nav-toggle i').toggleClass('fa-times fa-bars');
                        $('.mobile-nav-overly').fadeOut();
                    }
                    return false;
                }
            }
        });
        
        if (window.location.hash) {
            var initial_nav = window.location.hash;
            if ($(initial_nav).length) {
                if ($('a[href="'+initial_nav+'"]').length) {
                    setTimeout(() => {
                        $('a[href="'+initial_nav+'"]').click();
                        console.log('click');
                    }, 1000);
                }
                else {
                    setTimeout(() => {
                        var scrollto = $(initial_nav).offset().top - 400;
                        $('html, body').animate({
                            scrollTop: scrollto
                        }, 1500, 'easeInOutExpo');
                    }, 1000);
                }
            }
        }
    });

    $(document).ready(function() {
        $('.timepicker input').timepicker({
            timeFormat: 'hh:mm p',
            interval: 30,
            minTime: '10:00 AM',
            maxTime: '05:00 PM',
            defaultTime: '10:00 AM',
            startTime: '10:00 AM',
            dynamic: true,
            dropdown: true,
            scrollbar: true
        });
        
        $('.dropdown-form').on('hide.bs.dropdown', function (e) {
            if (e.clickEvent) {
                e.preventDefault();
            }
        });
    });

    $(document).ready(function(){
        $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }
        }); 
    
        $('.scrollup').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });
	});

    $(document).ready(function(){
        var nav_sections_hotel = $('section');
        var main_nav_hotel = $('.hotel-nav');
        
        if (main_nav_hotel.length) {
            $(".hotel-nav ul:first li:first").addClass('active');
            $('.single-header').removeClass('scrolled');
        }
       
        $(window).on('scroll', function() {
            if (main_nav_hotel.length) {
                var cur_pos = $(this).scrollTop() + 200;
                
                nav_sections_hotel.each(function() {
                    var top = $(this).offset().top,
                        bottom = top + $(this).outerHeight();
                        
                    if (cur_pos >= top && cur_pos <= bottom) {
                        if (cur_pos <= bottom) {
                            main_nav_hotel.find('li').removeClass('active');
                        }
                        main_nav_hotel.find('a[href="#' + $(this).attr('id') + '"]').parent('li').addClass('active');
                    }
    
                    if (cur_pos < 300) {
                        $(".hotel-nav ul:first li:first").addClass('active');
                        $('.single-header').removeClass('scrolled');
                    } else {
                        $('.single-header').addClass('scrolled');
                    }
                });
            }
        });
	});

    $(document).ready(function() {
        $('.more-info').on('click', function(e) {
            e.preventDefault();
            
            if ($(this).find('.more').hasClass('d-none')) {
                $(this).find('.more').removeClass('d-none');
                $(this).find('.less').addClass('d-none');
            } else {
                $(this).find('.more').addClass('d-none');
                $(this).find('.less').removeClass('d-none');
            }
        });
    });

    $(document).ready(function() {
        $('.counter').counterUp({
            delay: 10,
            time: 1000
        });
    });
})(jQuery);