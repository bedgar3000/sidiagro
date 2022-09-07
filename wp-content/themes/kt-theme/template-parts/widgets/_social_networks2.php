<?php
$redes = [
    'instagram' => get_option('setting_instagram'),
    'twitter'   => get_option('setting_twitter'),
    'facebook'  => get_option('setting_facebook'),
    'youtube'   => get_option('setting_youtube'),
    'linkedin'  => get_option('setting_linkedin'),
    'pinterest' => get_option('setting_pinterest'),
];
?>

<?php if (!empty($redes['instagram']) || !empty($redes['twitter']) || !empty($redes['facebook']) || !empty($redes['linkedin']) || !empty($redes['pinterest'])): ?>
    <div class="social-network layout-2">
        <?php if (!empty($redes['facebook'])): ?>
            <a href="<?php echo $redes['facebook']; ?>" target="_blank" class="icon-social">
                <i class="icon icon-network-facebook"></i>
            </a>
        <?php endif; ?>
        <?php if (!empty($redes['instagram'])): ?>
            <a href="<?php echo $redes['instagram']; ?>" target="_blank" class="icon-social">
            <i class="icon icon-network-instagram"></i>
            </a>
        <?php endif; ?>
        <?php if (!empty($redes['youtube'])): ?>
            <a href="<?php echo $redes['youtube']; ?>" target="_blank" class="icon-social">
            <i class="icon icon-network-youtube"></i>
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
        <?php if (!empty($redes['pinterest'])): ?>
            <a href="<?php echo $redes['pinterest']; ?>" target="_blank" class="icon-social">
                <i class="fab fa-pinterest-p"></i>
            </a>
        <?php endif; ?>
    </div>
<?php endif; ?>