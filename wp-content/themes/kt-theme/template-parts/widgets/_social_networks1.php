<?php
$class  = (!empty($args['class']) ? $args['class'] : '');
$redes = [
    'instagram'   => get_option('setting_instagram'),
    'twitter'     => get_option('setting_twitter'),
    'facebook'    => get_option('setting_facebook'),
    'youtube'     => get_option('setting_youtube'),
    'linkedin'    => get_option('setting_linkedin'),
    'pinterest'   => get_option('setting_pinterest'),
    'tripadvisor' => get_option('setting_tripadvisor'),
];
?>

<?php if (!empty($redes['instagram']) || !empty($redes['twitter']) || !empty($redes['facebook']) || !empty($redes['linkedin']) || !empty($redes['pinterest']) || !empty($redes['tripadvisor'])): ?>
    <div class="widget-social layout-1 <?php echo $class; ?>">
        <?php if (!empty($redes['facebook'])): ?>
            <a href="<?php echo $redes['facebook']; ?>" target="_blank" class="icon-social">
                <i class="fab fa-facebook-f"></i>
            </a>
        <?php endif; ?>
        <?php if (!empty($redes['instagram'])): ?>
            <a href="<?php echo $redes['instagram']; ?>" target="_blank" class="icon-social">
                <i class="fab fa-instagram"></i>
            </a>
        <?php endif; ?>
        <?php if (!empty($redes['youtube'])): ?>
            <a href="<?php echo $redes['youtube']; ?>" target="_blank" class="icon-social">
                <i class="fab fa-youtube"></i>
            </a>
        <?php endif; ?>
        <?php if (!empty($redes['linkedin'])): ?>
            <a href="<?php echo $redes['linkedin']; ?>" target="_blank" class="icon-social">
                <i class="fab fa-linkedin-in"></i>
            </a>
        <?php endif; ?>
        <?php if (!empty($redes['twitter'])): ?>
            <a href="<?php echo $redes['twitter']; ?>" target="_blank" class="icon-social">
                <i class="fab fa-twitter"></i>
            </a>
        <?php endif; ?>
        <?php if (!empty($redes['tripadvisor'])): ?>
            <a href="<?php echo $redes['pinterest']; ?>" target="_blank" class="icon-social">
                <i class="icon icon-social-tripadvisor"></i>
            </a>
        <?php endif; ?>
    </div>
<?php endif; ?>