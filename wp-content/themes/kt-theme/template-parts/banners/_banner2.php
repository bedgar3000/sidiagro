<?php
$title  = (!empty($args['title']) ? $args['title'] : '');
$banner = (!empty($args['banner']) ? $args['banner'] : '');

if (empty($title)) {
    if ( is_home() ) {
        $title = __('Blog', 'ktech');
    } else {
        $title = get_the_title();
    }
}

if (empty($banner)) {
    $banner = path_upload(get_option('setting_banner')["pages"]);
}
?>

<?php if (!empty($banner)): ?>
    <section class="section-banner banner-2">
        <img src="<?php echo $banner; ?>" class="img-fluid" alt="">

        <?php if (!empty($title) || !empty($info)): ?>
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="info">
                                <?php if (!empty($title)): ?>
                                    <h1><?php echo $title; ?></h1>
                                <?php endif; ?>
                                
                                <?php if (!empty($info)): ?>
                                    <p><?php echo $info; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </section>
<?php endif; ?>