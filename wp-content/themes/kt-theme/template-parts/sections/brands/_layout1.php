<?php
$class = (!empty($args['class']) ? $args['class'] : 'section-brands layout-1');
$content = $args['brands'];

$query = new WP_Query([
    'post_status'    => 'publish',
    'post_type'      => 'brand',
    'posts_per_page' => -1,
]);
?>

<?php if ( $query->have_posts() ) : ?>
    <section class="<?php echo $class; ?>">
        <div class="container">
            <?php if (!empty($content)): ?>
                <div class="row">
                    <div class="col">
                        <div class="intro">
                            <?php echo $content; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row justify-content-center">
                <div class="col-xl-11">
                    <div class="owl-carousel owl-theme owl-brands">
                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                            <?php $imagen = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); ?>
                            <div class="item">
                                <img src="<?php echo path_upload($imagen); ?>" alt="">
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; wp_reset_postdata(); ?>
