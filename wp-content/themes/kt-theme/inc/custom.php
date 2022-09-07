<?php
/**
 * Custom functions
 *
 * @package KT Solutions
 * @subpackage Ktech Theme
 * @version 1.0.0
 */

/**
 * Registrar menus del theme
 * 
 */
function register_menus() {
    register_nav_menus([
        'header-menu'     => __('Header Menu'),
        'header-menu-top' => __('Header Menu Top'),
        'footer-menu'     => __('Footer Menu'),
    ]);
}
add_action('init', 'register_menus');

/**
 * Sidebar
 * 
 */
function ju_widgets() {
    register_sidebar([
        'name'          => __('Theme Sidebar'),
        'id'            => 'ju_sidebar',
        'description'   => __('Sidebar for the theme'),
        'class'         => '',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ]);
}
add_action('widgets_init', 'ju_widgets');

/**
 * Quitar actualizaciones de los plugins
 */
function disable_plugin_updates( $value ) 
{
    if (!empty($value->response['advanced-custom-fields-pro/acf.php'])) unset($value->response['advanced-custom-fields-pro/acf.php']);
    return $value;
}
add_filter('site_transient_update_plugins', 'disable_plugin_updates');

/**
 * Theme Customizer API
 */
function my_customize_register( $wp_customize ) {
    //  Section (Logo)
    $wp_customize->add_section('section_logo', array(
        'title'    => __('Logo de la Empresa', 'themename'),
        'priority' => 120,
    ));
    //  Control (Logo principal)
    $wp_customize->add_setting('setting_logo[logo_main]', array(
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ));
    $wp_customize->add_control( new WP_Customize_Upload_Control($wp_customize, 'logo_main', array(
        'label'    => __('Cargar logo principal', 'themename'),
        'section'  => 'section_logo',
        'settings' => 'setting_logo[logo_main]',
    )));
    //  Control (Favicon)
    $wp_customize->add_setting('setting_logo[favicon]', array(
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ));
    $wp_customize->add_control( new WP_Customize_Upload_Control($wp_customize, 'favicon', array(
        'label'    => __('Cargar favicon', 'themename'),
        'section'  => 'section_logo',
        'settings' => 'setting_logo[favicon]',
    )));
    //  Control (Logo principal)
    $wp_customize->add_setting('setting_logo[logo_white]', array(
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ));
    $wp_customize->add_control( new WP_Customize_Upload_Control($wp_customize, 'logo_white', array(
        'label'    => __('Cargar logo blanco', 'themename'),
        'section'  => 'section_logo',
        'settings' => 'setting_logo[logo_white]',
    )));

    //  Section (Redes Sociales)
    $wp_customize->add_section('section_redes_sociales', array(
        'title' => 'Redes sociales'
    ));
    //  Control (Facebook)
    $wp_customize->add_setting('setting_facebook', array(
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ));
    $wp_customize->add_control('setting_facebook', array(
        'label'   => 'Facebook',
        'section' => 'section_redes_sociales',
        'type'    => 'text',
    ));
    //  Control (Twitter)
    $wp_customize->add_setting('setting_twitter', array(
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ));
    $wp_customize->add_control('setting_twitter', array(
        'label'   => 'Twitter',
        'section' => 'section_redes_sociales',
        'type'    => 'text',
    ));
    //  Control (Instagram)
    $wp_customize->add_setting('setting_instagram', array(
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ));
    $wp_customize->add_control('setting_instagram', array(
        'label'   => 'Instagram',
        'section' => 'section_redes_sociales',
        'type'    => 'text',
    ));
    //  Control (YouTube)
    $wp_customize->add_setting('setting_youtube', array(
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ));
    $wp_customize->add_control('setting_youtube', array(
        'label'   => 'YouTube',
        'section' => 'section_redes_sociales',
        'type'    => 'text',
    ));
    //  Control (Linkedin)
    $wp_customize->add_setting('setting_linkedin', array(
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ));
    $wp_customize->add_control('setting_linkedin', array(
        'label'   => 'Linkedin',
        'section' => 'section_redes_sociales',
        'type'    => 'text',
    ));
    //  Control (Pinterest)
    $wp_customize->add_setting('setting_pinterest', array(
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ));
    $wp_customize->add_control('setting_pinterest', array(
        'label'   => 'Pinterest',
        'section' => 'section_redes_sociales',
        'type'    => 'text',
    ));
    //  Control (Tripadvisor)
    $wp_customize->add_setting('setting_tripadvisor', array(
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ));
    $wp_customize->add_control('setting_tripadvisor', array(
        'label'   => 'Tripadvisor',
        'section' => 'section_redes_sociales',
        'type'    => 'text',
    ));
    //  Control (Instagram)
    $wp_customize->add_setting('setting_instagram_widget', array(
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ));
    $wp_customize->add_control('setting_instagram_widget', array(
        'label'   => 'Instagram (Widget)',
        'section' => 'section_redes_sociales',
        'type'    => 'textarea',
    ));
    //  Control (Instagram)
    $wp_customize->add_setting('setting_instagram_user', array(
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ));
    $wp_customize->add_control('setting_instagram_user', array(
        'label'   => 'Instagram (Usuario)',
        'section' => 'section_redes_sociales',
        'type'    => 'text',
    ));
    //  Control (Twitter)
    $wp_customize->add_setting('setting_twitter_widget', array(
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ));
    $wp_customize->add_control('setting_twitter_widget', array(
        'label'   => 'Twitter (Widget)',
        'section' => 'section_redes_sociales',
        'type'    => 'textarea',
    ));
    //  Control (Twitter)
    $wp_customize->add_setting('setting_twitter_user', array(
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ));
    $wp_customize->add_control('setting_twitter_user', array(
        'label'   => 'Twitter (Usuario)',
        'section' => 'section_redes_sociales',
        'type'    => 'text',
    ));
    
    //  Section (Footer)
    $wp_customize->add_section('section_footer', array(
        'title' => 'Footer'
    ));
    //  Control (Copyright)
    $wp_customize->add_setting('setting_copyright', array(
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ));
    $wp_customize->add_control('setting_copyright', array(
        'label'   => 'Copyright',
        'section' => 'section_footer',
        'type'    => 'textarea',
    ));

    //  Section (Contacto)
    $wp_customize->add_section('section_contact', array(
        'title' => 'Contacto'
    ));
    //  Control (Telefono)
    $wp_customize->add_setting('setting_telefono', array(
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ));
    $wp_customize->add_control('setting_telefono', array(
        'label'   => 'Telefono',
        'section' => 'section_contact',
        'type'    => 'text',
    ));
    //  Control (Telefono)
    $wp_customize->add_setting('setting_telefono2', array(
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ));
    $wp_customize->add_control('setting_telefono2', array(
        'label'   => 'Telefono 2',
        'section' => 'section_contact',
        'type'    => 'text',
    ));
    //  Control (Fax)
    $wp_customize->add_setting('setting_telefono3', array(
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ));
    $wp_customize->add_control('setting_telefono3', array(
        'label'   => 'Fax',
        'section' => 'section_contact',
        'type'    => 'text',
    ));
    //  Control (E-mail)
    $wp_customize->add_setting('setting_email', array(
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ));
    $wp_customize->add_control('setting_email', array(
        'label'   => 'e-mail',
        'section' => 'section_contact',
        'type'    => 'text',
    ));
    //  Direccion
    $wp_customize->add_setting('setting_direccion', array(
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ));
    $wp_customize->add_control('setting_direccion', array(
        'label'   => 'Direccion',
        'section' => 'section_contact',
        'type'    => 'textarea',
    ));
    //  Form (Shortcode)
    $wp_customize->add_setting('setting_form', array(
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ));
    $wp_customize->add_control('setting_form', array(
        'label'   => 'Formulario de contacto (Shortcode)',
        'section' => 'section_contact',
        'type'    => 'text',
    ));
    //  Newsletter (Shortcode)
    $wp_customize->add_setting('setting_newsletter', array(
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ));
    $wp_customize->add_control('setting_newsletter', array(
        'label'   => 'Newsletter (Shortcode)',
        'section' => 'section_contact',
        'type'    => 'text',
    ));
    //  Google Maps (Code)
    $wp_customize->add_setting('setting_google_maps', array(
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ));
    $wp_customize->add_control('setting_google_maps', array(
        'label'   => 'Google Maps (Code)',
        'section' => 'section_contact',
        'type'    => 'textarea',
    ));
    
    //  Section (Sliders)
    $wp_customize->add_section('section_sliders', array(
        'title' => 'Sliders / Banners'
    ));
    //  Control (Home)
    $wp_customize->add_setting('setting_slider', array(
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ));
    $wp_customize->add_control('setting_slider', array(
        'label'   => 'Slider Home (Alias)',
        'section' => 'section_sliders',
        'type'    => 'text',
    ));
    //  Control (Banner Pages)
    $wp_customize->add_setting('setting_banner[pages]', array(
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ));
    $wp_customize->add_control( new WP_Customize_Upload_Control($wp_customize, 'pages', array(
        'label'    => __('Cargar bg header', 'themename'),
        'section'  => 'section_sliders',
        'settings' => 'setting_banner[pages]',
    )));
    //  Control (Banner Footer)
    $wp_customize->add_setting('setting_banner[footer]', array(
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ));
    $wp_customize->add_control( new WP_Customize_Upload_Control($wp_customize, 'footer', array(
        'label'    => __('Cargar bg footer', 'themename'),
        'section'  => 'section_sliders',
        'settings' => 'setting_banner[footer]',
    )));
    //  Control (Banner Pages)
    $wp_customize->add_setting('setting_banner[offer]', array(
        'capability'    => 'edit_theme_options',
        'type'          => 'option',
    ));
    $wp_customize->add_control( new WP_Customize_Upload_Control($wp_customize, 'offer', array(
        'label'    => __('Cargar bg offer', 'themename'),
        'section'  => 'section_sliders',
        'settings' => 'setting_banner[offer]',
    )));
}
add_action('customize_register', 'my_customize_register');
