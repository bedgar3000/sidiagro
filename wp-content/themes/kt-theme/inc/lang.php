<?php
global $wpdb;

//  Obtener lenguajes disponibles
$sql = "SELECT * FROM " . $wpdb->prefix . "icl_languages WHERE active = 1";
$languages = $wpdb->get_results( $sql );

//  languaje por default
$language_default = 'es';

function my_languages() {
    global $languages;
    global $language_default;
    global $wp;
    $current_slug = add_query_arg( array(), $wp->request );
    $current_lang = ICL_LANGUAGE_CODE;

    $idiomas = [];
    foreach ($languages as $lang) {
        $key = $lang->code;

        if ($language_default != $current_lang) {
            $base = substr(get_option('home'), 0, -3);
            if ($key == $language_default) $home = $base;
            else $home = $base . $key . '/';
        } else $home = get_option('home') . '/' . $key . '/';
        
        $url = $home . $current_slug;
        
        $idiomas[$key] = [
            'id'        => $key,
            'nombre'    => strtoupper($key),
            'url'       => $url,
        ];
    }

    return $idiomas;
}

function my_languages_default() {
    global $language_default;

    return $language_default;
}

function __lang($slug) {
    global $__traducciones;
    
    return $__traducciones[ICL_LANGUAGE_CODE][$slug];
}