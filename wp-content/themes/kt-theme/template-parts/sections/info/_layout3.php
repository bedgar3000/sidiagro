<?php
$class = (!empty($args['class']) ? $args['class'] : 'section-info layout-3');
$content = $args['content'];
?>

<?php if (!empty($content['info'])): ?>
    <section class="<?php echo $class; ?>">
        <div class="container">
            <div class="row row-content">
                <div class="col">
                    <div class="fav">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/custom/fav.png" alt="" class="img-fluid">
                    </div>

                    <div class="info">
                        <?php echo $content['info']; ?>

                        <?php if (!empty($content['link'])): ?>
                            <div class="link">
                                <a href="<?php echo $content['link']['url']; ?>" class="btn btn-outline-light btn-pill"><?php echo $content['link']['label']; ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
