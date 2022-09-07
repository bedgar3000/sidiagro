<?php
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$query = new WP_Query([
    'post_status'    => 'publish',
    'post_type'      => 'video',
    'posts_per_page' => 12,
    'paged'          => $paged,
]);
?>

<?php get_header(); ?>

    <?php get_template_part('template-parts/banners/_banner1'); ?>

    <main class="main-video">
        <?php if ( $query->have_posts() ) : ?>
            <section class="section-content">
                <div class="container">
                    <div class="row grid-videos justify-content-start">
                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                            <div class="col-lg-4 col-md-6 col-video">
                                <?php get_template_part('template-parts/loops/_video1', null, []); ?>
                            </div>
                        <?php endwhile; ?>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="pagination">
                                <?php 
                                echo paginate_links( array(
                                    'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                                    'total'        => $query->max_num_pages,
                                    'current'      => max( 1, get_query_var( 'paged' ) ),
                                    'format'       => '?paged=%#%',
                                    'show_all'     => false,
                                    'type'         => 'plain',
                                    'end_size'     => 2,
                                    'mid_size'     => 1,
                                    'prev_next'    => true,
                                    'prev_text' => '&laquo;',
                                    'next_text' => '&raquo;',
                                    'add_args'     => false,
                                    'add_fragment' => '',
                                ) );
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php else: ?>
            <div class="container py-5">
                <div class="row">
                    <div class="col">
                        <div class="jumbotron">
                            <h1 class="display-4"><?php echo __('No se encontraron videos', 'ktech'); ?></h1>
                            <hr class="my-4">
                            <a class="btn btn-link" href="<?php get_option('siteurl'); ?>" role="button"><?php echo __('Regresar al inicio', 'ktech'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; wp_reset_postdata(); ?>
    </main>
    
<?php get_footer(); ?>
