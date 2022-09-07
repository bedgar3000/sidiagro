<?php
/**
 * Template Name: KT Contacto 1
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package KT Solutions
 * @subpackage Ktech Theme
 * @version 1.0.0
 */

$form    = get_option('setting_form');
$maps    = get_option('setting_google_maps');
$address = get_option('setting_direccion');
$email   = get_option('setting_email');
$phone   = get_option('setting_telefono');
?>

<?php get_header(); ?>
    <?php get_template_part('template-parts/banners/_banner2', null, []); ?>
    
    <main class="main-contact layout-1">
        <section class="section-contact-info">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="contact-grid">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="icon icon-contact-email-white"></i>
                                </div>
                                <div class="contact-info">
                                    <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
                                </div>
                            </div>
                            
                            <div class="line-v"></div>

                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="icon icon-contact-address-white"></i>
                                </div>
                                <div class="contact-info">
                                    <?php echo $address; ?>
                                </div>
                            </div>

                            <div class="line-v"></div>
                            
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="icon icon-contact-phone-white"></i>
                                </div>
                                <div class="contact-info">
                                    <?php echo $phone; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-contact-form">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-xl-6">
                        <div class="contact-map">
                            <?php echo $maps; ?>
                        </div>
                    </div>
                    
                    <div class="col-xl-6">
                        <div class="contact-form form-3">
                            <div class="wrapper">
                                <h3><?php echo __('Formulario de Contacto','ktech'); ?></h3>
                                <?php echo do_shortcode($form); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php get_footer(); ?>
