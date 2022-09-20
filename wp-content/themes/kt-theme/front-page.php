<?php
/**
 * The front page template file
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KT Solutions
 * @subpackage Ktech Theme
 * @version 1.0.0
 */

global $post;
$post_id = $post->ID;
?>

<?php get_header(); ?>

    <main class="main-home">
        
        <!-- SLIDER HERO -->
        <?php get_template_part('template-parts/sliders/rev/_hero'); ?>

        <!-- ESTUDIOS ANALISIS  -->
        <?php
        $estudios = get_field('estudios');
        $query_estudios = new WP_Query([
            'post_status'    => 'publish',
            'post_type'      => 'servicio',
            'posts_per_page' => 6,
            'tax_query' => [
                [
                    'taxonomy' => 'categoria-servicios',
                    'field'    => 'slug',
                    'terms'    => 'estudios-y-analisis',
                ],
            ],
        ]);
        ?>
        <?php if ($query_estudios->have_posts()): ?>
            <section class="section-estudios" data-aos="fade-up">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="intro"><?php echo $estudios; ?></div>
                        </div>
                    </div>
        
                    <div class="row">
                        <?php while ($query_estudios->have_posts()) : $query_estudios->the_post(); ?>
                            <div class="col-lg-4 col-md-6">
                                <a href="#" class="card layout-1">
                                    <div class="card-figure">
                                        <img src="<?php echo path_upload(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" class="img-fluid" alt="">
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <?php echo get_the_title(); ?>
                                        </h4>
                                        <div class="card-text">
                                            <?php echo the_field('extract'); ?>
                                        </div>
                                    </div>
                                    <!-- <div class="card-action">
                                        <div class="btn btn-link">
                                            <span class="mr-1"><?php //echo __('Conoce más','ktech'); ?></span>
                                            <i class="icon icon-btn-go-primary-sm"></i>
                                        </div>
                                    </div> -->
                                </a>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </section>
        <?php endif; wp_reset_postdata(); ?>

        <!-- CULTIVOS  -->
        <?php
        $cultivos = get_field('cultivos');
        $query_cultivos = new WP_Query([
            'post_status'    => 'publish',
            'post_type'      => 'cultivo',
            'posts_per_page' => -1,
        ]);
        ?>
        <?php if ($query_cultivos->have_posts()): ?>
            <section class="section-cultivos" id="cultivos" data-aos="fade-up">
                <div class="cultivo-banner" style="background-image: url(<?php echo path_upload($cultivos['banner']); ?>);">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="text">
                                    <h2><?php echo $cultivos['text']; ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row justify-content-center">
                        <?php while ($query_cultivos->have_posts()) : $query_cultivos->the_post(); ?>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                                <a href="#" class="card layout-2">
                                    <div class="card-figure">
                                        <img src="<?php echo path_upload(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" class="img-fluid" alt="">
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <?php echo get_the_title(); ?>
                                        </h4>
                                    </div>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
                
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="cultivo-info">
                                <?php echo $cultivos['info']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; wp_reset_postdata(); ?>

        <!-- ACADEMIA  -->
        <?php
        $academia = get_field('academia');
        ?>
        <?php if ($academia): ?>
            <section class="section-academia" id="academia" data-aos="fade-up">
                <div class="academia-banner" style="background-image: url(<?php echo path_upload($academia['banner']); ?>);">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="text">
                                    <?php echo $academia['text']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row justify-content-center">
                        <?php foreach ($academia['pages'] as $key => $value): ?>
                            <div class="col-xl-3 col-md-6">
                                <a href="#" class="card layout-3">
                                    <div class="card-figure">
                                        <img src="<?php echo path_upload($value['image']); ?>" class="img-fluid" alt="">
                                    </div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            <?php echo $value['name']; ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php endif; wp_reset_postdata(); ?>

        <!-- INSTITUCIONES -->
        <?php
        $query_instituciones = new WP_Query([
            'post_status'    => 'publish',
            'post_type'      => 'institucion',
            'posts_per_page' => -1,
        ]);
        ?>
        <?php if ($query_instituciones->have_posts()): ?>
            <section class="section-instituciones" data-aos="fade-up">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="title">
                                <h2><?php echo __('Instituciones  de Cooperación','ktech'); ?></h2>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="owl-carousel owl-theme owl-institucion">
                                <?php while ($query_instituciones->have_posts()) : $query_instituciones->the_post(); ?>
                                    <div class="item">
                                        <div class="item-box">
                                            <img src="<?php echo path_upload(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" alt="">
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; wp_reset_postdata(); ?>

        <!-- NEWSLETTER -->
        <section class="section-social-newsletter">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="wrapper">
                            <div class="social">
                                <div class="info">
                                    <h4><?php echo __('Síguenos en nuestras', 'ktech'); ?></h4>
                                    <h2><?php echo __('Redes Sociales', 'ktech'); ?></h2>
                                </div>

                                <?php get_template_part('template-parts/widgets/_social_networks1'); ?>
                            </div>
                            
                            <div class="newsletter-form">
                                <h3><?php echo __('Suscríbete al Newsletter','ktech'); ?></h3>
                                <p><?php echo __('Recibe las ultimas noticias y eventos','ktech'); ?></p>
                                <?php get_template_part('template-parts/forms/_newsletter1'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ENLACES FOOTER -->
        <?php get_template_part('template-parts/enlaces'); ?>
        
    </main>
    
<?php get_footer(); ?>