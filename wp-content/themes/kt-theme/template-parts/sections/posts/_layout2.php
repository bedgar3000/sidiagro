<?php
$class = (!empty($args['class']) ? $args['class'] : 'section-posts layout-2');
$post_type = (!empty($args['post_type']) ? $args['post_type'] : 'post');
$posts_per_page = (!empty($args['posts_per_page']) ? $args['posts_per_page'] : 6);
$intro = (!empty($args['intro']) ? $args['intro'] : null);
$link = (!empty($args['link']) ? $args['link'] : null);
$loop = (!empty($args['loop']) ? $args['loop'] : '_card1');
$id = (!empty($args['id']) ? $args['id'] : null);

$posts = [];
$query = new WP_Query([
    'post_status'    => 'publish',
    'post_type'      => $post_type,
    'posts_per_page' => $posts_per_page,
]);
$i = 0;
?>

<?php if ($query->have_posts()): ?>
    <section class="<?php echo $class; ?>" data-aos="fade-up" id="<?php echo $id; ?>">
        <div class="container">
            <?php if (!empty($intro)): ?>
                <div class="row">
                    <div class="col">
                        <div class="intro"><?php echo $intro; ?></div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row">
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div class="col-lg-4">
                        <?php get_template_part('template-parts/loops/' . $loop, null, [
                            'key' => ++$i,
                        ]); ?>
                    </div>
                <?php endwhile; ?>
            </div>
            
            <?php if (!empty($link)): ?>
                <div class="row">
                    <div class="col">
                        <div class="link">
                            <a href="<?php echo $link['url']; ?>" class="btn btn-outline-primary btn-pill"><?php echo $link['label']; ?></a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; wp_reset_postdata(); ?>
