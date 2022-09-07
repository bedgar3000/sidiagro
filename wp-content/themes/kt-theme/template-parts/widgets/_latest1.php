<?php
global $post_id;

$blog_query = new WP_Query([
    'post_status'    => 'publish',
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'order'          => 'DESC',
]);
?>

<?php if ( $blog_query->have_posts() ) : ?>

    <div class="widget-latest layout-1">
        <h5 class="widget-title">
            <?php echo __('Más noticias','ktech'); ?>
        </h5>
        <div class="widget-items">
            <?php while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
                
                <?php
                $day = get_the_time('d');
                $month = get_the_time('F');
                $year = get_the_time('Y');
                $date  = date_i18n('F d, Y');
                ?>

                <a href="<?php the_permalink(); ?>" class="widget-item">
                    <small><?php echo $date; ?></small>
                    <p><?php the_title(); ?></p>
                </a>

                <div class="line"></div>
            <?php endwhile; ?>
        </div>
    </div>

<?php endif; wp_reset_postdata(); ?>