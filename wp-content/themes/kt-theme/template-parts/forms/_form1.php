<?php
$class = (!empty($args['class']) ? $args['class'] : 'contact-form form-1');
$form = get_option('setting_form');
?>

<div class="<?php echo $class; ?>">
    <?php echo do_shortcode($form); ?>
</div>