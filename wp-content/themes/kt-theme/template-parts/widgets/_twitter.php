<?php
$widget = get_option('setting_twitter_widget');
$user = get_option('setting_twitter_user');
?>

<?php if (!empty($widget) && !empty($user)): ?>
    <div class="card card-widget">
        <div class="card-header">
            <i class="icon icon-widget-twitter"></i>
            <span class="card-title"><?php echo $user; ?></span>
        </div>
        <div class="card-body">
            <?php echo $widget; ?>
        </div>
    </div>
<?php endif; ?>