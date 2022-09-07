<?php
$logo_main = null;
$setting_logo = get_option('setting_logo');
if (!empty($setting_logo['logo_main'])) {
    $logo_main = path_upload($setting_logo["logo_main"]);
}
?>

<section id="header" class="header-1">
    <div class="navigation-wrap start-header start-style">
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="header-top-wrapper">
                            <a class="navbar-brand logo-main" href="<?php echo get_option('home'); ?>"><img src="<?php echo $logo_main; ?>" alt=""></a>

                            <div class="header-top-right">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-sidiagro.png" alt="" class="img-fluid img-logo-sidiagro">

                                <div class="header-search">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/escudo-rd.png" alt="" class="img-fluid img-escudo-rd">

                                    <?php get_search_form(); ?>

                                    <div class="header-menu-top">
                                        <ul class="menu-top">
                                            <?php
                                            wp_nav_menu([
                                                'theme_location'  => 'header-menu-top',
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
                    </div>
                </div>
            </div>
        </div>
        
        <div class="menu-main">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <nav class="navbar navbar-expand-xl navbar-light">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav">
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

                                <div class="menu-btn desktop">
                                    <a href="https://sidiagro.do/index.php/home/login" target="_blank" class="btn btn-orange">
                                        <i class="icon icon-login-white"></i>
                                        <span>Acceso al Sistema</span>
                                    </a>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="navigation-wrap-mobile">
        <div class="mobile-top">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/escudo-rd.png" alt="" class="img-fluid img-escudo-rd">
        </div>
        
        <div class="brand-mobile">
            <a class="navbar-brand logo-main" href="<?php echo get_option('home'); ?>"><img src="<?php echo $logo_main; ?>" alt="Logo" class="img-fluid"></a>

            <span>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-sidiagro.png" alt="Logo Sidiagro" class="img-fluid img-logo-sidiagro">
            </span>
        </div>

        <div class="nav-mobile">
            <nav class="navbar navbar-expand-xl navbar-light">
                <div class="search-mobile">
                    <?php get_search_form(); ?>
                </div>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
                
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
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

                <div class="menu-btn mobile">
                    <a href="https://sidiagro.do/index.php/home/login" target="_blank" class="btn btn-orange">
                        <i class="icon icon-login-white"></i>
                        <span>Acceso al Sistema</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
