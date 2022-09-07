<?php
$class = (!empty($args['class']) ? $args['class'] : 'section-owl layout-1');
$post_type = (!empty($args['post_type']) ? $args['post_type'] : 'post');
$intro = (!empty($args['intro']) ? $args['intro'] : null);
$link = (!empty($args['link']) ? $args['link'] : null);
$loop = (!empty($args['loop']) ? $args['loop'] : '_card1');

$posts = [];
$query = new WP_Query([
    'post_status'    => 'publish',
    'post_type'      => $post_type,
    'posts_per_page' => 6,
]);
?>

<?php if ($query->have_posts()): ?>
    <section class="<?php echo $class; ?>" data-aos="fade-up">
        <div class="container">
            <?php if (!empty($intro)): ?>
                <div class="row">
                    <div class="col">
                        <div class="intro"><?php echo $intro; ?></div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col">
                    <div class="owl-carousel owl-theme owl-<?php echo $post_type; ?>">
                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                            <?php get_template_part('template-parts/loops/' . $loop, null, []); ?>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
            
            <?php if (!empty($link)): ?>
                <div class="row">
                    <div class="col">
                        <div class="link">
                            <a href="<?php echo $link['url']; ?>" class="btn btn-outline-secondary btn-pill">
                                <?php echo $link['label']; ?>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; wp_reset_postdata(); ?>
