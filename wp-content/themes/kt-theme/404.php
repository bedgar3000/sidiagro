<?php
/**
 * 404 Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package KT Solutions
 * @subpackage Ktech Theme
 * @version 1.0.0
 */

global $post;
?>

<?php get_header(); ?>
    <?php get_template_part('template-parts/banners/banner-1'); ?>

    <main class="main-404 layout-1">
        <section class="section-404 mb-5">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="content py-5">
                            <div class="jumbotron">
                                <h1 class="display-4"><?php echo __('Opps! An error has occurred', 'ktech'); ?></h1>
                                <p><?php echo __('The page you are looking for does not exist.','ktech'); ?></p>
                                <hr class="my-4">
                                <a class="btn btn-link" href="<?php get_option('siteurl'); ?>" role="button"><?php echo __('Back to home', 'ktech'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <?php get_template_part('template-parts/sections/cta-1'); ?>
    </main>
<?php get_footer(); ?>
