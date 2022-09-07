<?php
$class = (!empty($args['class']) ? $args['class'] : 'newsletter form-1');
$form = get_option('setting_newsletter');
?>

<div class="<?php echo $class; ?>">
    <?php echo do_shortcode($form); ?>
</div>