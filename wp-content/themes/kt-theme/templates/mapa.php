<?php
/**
 * Template Name: KT Mapa
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package KT Solutions
 * @subpackage Ktech Theme
 * @version 1.0.0
 */
?>

<?php get_header(); ?>
    <?php get_template_part('template-parts/banners/_banner2', null, []); ?>
    
    <main class="main-mapa py-5">
        <section class="section-mapa-info">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="menu-mapa">
                            <ul class="menu-top">
                                <?php
                                wp_nav_menu([
                                    'theme_location'  => 'header-menu',
                                    'menu'            => '',
                                    'container'       => false,
                                    'container_class' => '',
                                    'container_id'    => '',
                                    'menu_class'      => '',
                                    'menu_id'         => '',
                                    'echo'            => true,
                                    'fallback_cb'     => 'wp_page_menu',
                                    'before'          => '',
                                    'after'           => '',
                                    'link_before'     => '',
                                    'link_after'      => '',
                                    'items_wrap'      => '%3$s',
                                    'depth'           => 0,
                                    'walker'          => ''
                                ]);
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php get_footer(); ?>
