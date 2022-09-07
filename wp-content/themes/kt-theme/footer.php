<?php
/**
 * The template for displaying the footer
 *
 * Contains the footer section and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package KT Solutions
 * @subpackage Ktech Theme
 * @version 1.0.0
 */
?>
    <?php get_template_part('template-parts/footers/_layout1'); ?>

    <!-- Vendor JS Files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/vendor/php-email-form/validate.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/vendor/counterup/counterup.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/vendor/venobox/venobox.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/vendor/aos/aos.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/vendor/animated-modal/animatedModal.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/datepicker.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/datepicker.es.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/datepicker.en.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    
    <script>
        (function($) {
            "use strict";

            $('#urls-categoria').on('change', function() {
                var slug = $(this).val();
                var html = ``;
                urls_items[slug].forEach(element => {
                    html += `
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="item-enlace">
                                <span>${element.title}</span>
                                <a target="_blank" href="${element.url}">${element.url}</a>
                            </div>
                        </div>
                    `;
                });
                $('#urls-items').html(html);
            });
        })(jQuery);
    </script>
    
    <!-- Template Main JS File -->
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/main.js?v=<?php echo date('YmdHis'); ?>"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/menu2.js?v=<?php echo date('YmdHis'); ?>"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/sliders.js?v=<?php echo date('YmdHis'); ?>"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/navbar.js?v=<?php echo date('YmdHis'); ?>"></script>
    
    <?php wp_footer(); ?>

    <script src="//code.tidio.co/dlugjw3vbo0wfiyxiowym9jugeocauvq.js" async></script>
</body>
</html>
