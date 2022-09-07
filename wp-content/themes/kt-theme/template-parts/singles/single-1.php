<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KT Solutions
 * @subpackage ICF
 * @version 1.0.0
 */

global $post;
?>

<?php get_header(); ?>

    <?php
    get_template_part('template-parts/banners/_banner1', null, [
        'title' => 'Noticias',
    ]);
    ?>

    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <?php
            $title = get_the_title();
            $image = path_upload(get_the_post_thumbnail_url(get_the_ID(), 'full'));
            $date  = get_the_date('j') . ' de ' . ucfirst(get_the_date('F Y'));
            ?>
            
            <main class="main-single layout-1">
                <section class="section-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-9 col-lg-8 col-content">
                                <div class="content">
                                    <figure class="figure">
                                        <img src="<?php echo $image; ?>" class="figure-img" alt="<?php echo $title; ?>">
                                        <figcaption class="figure-caption">
                                            <div class="figure-date"><?php echo $date; ?></div>
                                            <div class="figure-share">
                                                <span><?php echo __('Compartir'); ?></span>
                                                <?php add_share_buttons(); ?>
                                            </div>
                                        </figcaption>
                                    </figure>
                                
                                    <h1 class="title"><?php echo $title; ?></h1>
                                
                                    <div class="info">
                                        <?php echo the_content(); ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-3 col-lg-4 col-sidebar">
                                <div class="sidebar">
                                    <?php get_template_part('template-parts/widgets/_latest1'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

        <?php endwhile; ?>
    <?php endif; ?>

<?php get_footer(); ?>
