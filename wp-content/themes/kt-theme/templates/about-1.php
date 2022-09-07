<?php
/**
 * Template Name: KT Nosotros 1
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package KT Solutions
 * @subpackage Ktech Theme
 * @version 1.0.0
 */

$image = path_upload(get_the_post_thumbnail_url(get_the_ID(), 'full'));
$alcance = get_field('alcance');
$mision = get_field('mision');
?>

<?php get_header(); ?>
    <?php get_template_part('template-parts/banners/_banner2', null, []); ?>
    
    <main class="main-about layout-1">
        <section class="section-intro">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="info">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-alcance">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="info">
                            <?php echo $alcance; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="image">
                <img src="<?php echo $image; ?>" alt="" class="img-fluid">
            </div>
        </section>

        <section class="section-mision">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="info">
                            <?php echo $mision; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php get_footer(); ?>
