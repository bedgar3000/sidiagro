<?php

/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package KT Solutions
 * @subpackage Ktech Theme
 * @version 1.0.0
 */

/**
 * Includes
 */
include(get_template_directory() . '/inc/helpers.php');
include(get_template_directory() . '/inc/custom.php');
include(get_template_directory() . '/inc/snippets.php');
// include(get_template_directory() . '/inc/lang.php');

//  Editor antiguo
add_filter('use_block_editor_for_post_type', '__return_false', 100);

// Post thumbnails
if (function_exists('add_theme_support')) 
{ 
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(200, 200);
    add_theme_support('post-tags');
}

/**
 * Habilitar la carga de archivos svg en el wordpress
 * 
 */
function custom_upload_mimes($existing_mimes = array()) 
{
    // Add the file extension to the array
    $existing_mimes['svg'] = 'image/svg+xml';
    return $existing_mimes;
}
add_filter('upload_mimes', 'custom_upload_mimes');

/**
 * Determinar si una pagina es el blog page
 */
function is_blog () {
    return ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag()) && 'post' == get_post_type();
}

/**
 * Limitar a productos la busqueda en WP
 */
function searchfilter($query) {
    // if ($query->is_search && !is_admin() ) {
    //     $query->set('post_type', ['product']);
    // }
    // return $query;
}
add_filter('pre_get_posts','searchfilter');