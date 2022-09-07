<?php
if (defined('ICL_LANGUAGE_CODE')) {
    $slider = (ICL_LANGUAGE_CODE == 'es' ? get_option('setting_slider') : get_option('setting_slider_' . ICL_LANGUAGE_CODE));
} else {
    $slider = get_option('setting_slider');
}
?>

<?php if (!empty($slider)): ?>
    <section class="slider-hero" id="inicio">
        <?php putRevSlider( $slider ); ?>
    </section>
<?php endif; ?>
