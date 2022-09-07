<?php
$class = (!empty($args['class']) ? $args['class'] : 'section-info layout-2');
$content = $args['content'];
?>

<?php if (!empty($content['image']) && !empty($content['info'])): ?>
    <section class="<?php echo $class; ?>">
        <div class="container">
            <div class="row row-content">
                <div class="col-xl-6">
                    <div class="image">
                        <img src="<?php echo path_upload($content['image']); ?>" alt="" class="img-fluid">
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="info">
                        <div class="wrapper">
                            <?php echo $content['info']; ?>

                            <?php if (!empty($content['link'])): ?>
                                <div class="link">
                                    <a href="<?php echo $content['link']['url']; ?>" class="underline"><?php echo $content['link']['label']; ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
