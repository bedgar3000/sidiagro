<?php
$form          = get_option('setting_contact_form');
$contacto_info = get_field('contacto-info');

$copyright = get_option('setting_copyright');
$direccion = get_option('setting_direccion');
$telefono  = get_telefono('setting_telefono');
$telefono2 = get_telefono('setting_telefono2');
$email     = get_option('setting_email');
?>

<footer id="footer" class="footer-1">
    <div class="container">
        <div class="row my-2">
            <div class="col">
                <div class="footer-escudos">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/escudo.png" class="img-fluid">
                    <span class="line-vertical-white"></span>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/escudo-ministerio-white.png" class="img-fluid">
                </div>

                <h3><?php echo __('Ministerio de Agricultura','ktech'); ?></h3>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="footer-address">
                    <?php echo $direccion; ?>
                </div>
                
                <div class="footer-phone">
                    <span><?php echo __('Tel.: ','ktech'); ?> <a href="tel:+<?php echo $telefono[1]; ?>"><?php echo $telefono[0]; ?></a></span>
                    <span class="sep">|</span>
                    <span><?php echo __('Fax.: ','ktech'); ?> <a href="tel:+<?php echo $telefono2[1]; ?>"><?php echo $telefono2[0]; ?></a></span>
                    <span class="sep">|</span>
                    <span><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></span>
                </div>
            </div>
        </div>

        <div class="row my-4">
            <div class="col">
                <div class="footer-menu-wrapper">
                    <ul id="footer-menu" class="footer-menu">
                        <?php
                        wp_nav_menu([
                            'theme_location'  => 'footer-menu',
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

        <div class="row">
            <div class="col">
                <div class="footer-copyright">
                    <?php echo nl2br($copyright); ?>
                </div>
            </div>
        </div>
        
        <div class="logos-footer">
            <span><img src="<?php echo get_template_directory_uri(); ?>/assets/img/custom/logo-E1.png" alt="" class="img-fluid"></span>
            <span><img src="<?php echo get_template_directory_uri(); ?>/assets/img/custom/logo-A4.png" alt="" class="img-fluid"></span>
            <span><img src="<?php echo get_template_directory_uri(); ?>/assets/img/custom/logo-A3.png" alt="" class="img-fluid"></span>
            <span><img src="<?php echo get_template_directory_uri(); ?>/assets/img/custom/logo-A2.png" alt="" class="img-fluid"></span>
        </div>
    </div>
</footer>
