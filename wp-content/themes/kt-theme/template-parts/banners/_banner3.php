<?php
if ( is_home() ) {
    $title = __('Blog', 'ktech');
    $info = __('In our blog, you can benefit from all the tips and advice offered by our expert team, specialized in the organization and decoration of all kinds of parties and celebrations.', 'ktech');
}
$banner = path_upload(get_option('setting_banner')["pages"]);
?>

<?php if (!empty($banner)): ?>
    <section class="section-banner banner-3">
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