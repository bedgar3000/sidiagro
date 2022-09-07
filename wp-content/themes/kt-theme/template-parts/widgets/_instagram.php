<?php
$widget = get_option('setting_instagram_widget');
$user = get_option('setting_instagram_user');
?>

<?php if (!empty($widget) && !empty($user)): ?>
    <div class="card card-widget">
        <div class="card-header">
            <i class="icon icon-widget-instagram"></i>
            <span class="card-title"><?php echo $user; ?></span>
        </div>
        <div class="card-body">
            <?php echo $widget; ?>
        </div>
    </div>
<?php endif; ?>