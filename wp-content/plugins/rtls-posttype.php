<?php  

/*
Plugin Name: RTLS Post Types
Description: Agregar Post Type Personalizados
Version: 2.1
Author: Ktech
License: GLP2
Licence URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

// STAR  ====================================>
function crear__post_type_RTLS(){
	$post_type_RTLS_array = [
		[
			'post_type_name' => 'servicio',
			'single_name'    => 'Servicio',
			'plural_name'    => 'Servicios',
			'post_type'      => 'post',
			'taxonomies'     => [],
			'supports_block' => ['title','editor','thumbnail','custom-fields'],
			'slug_rewrite'   => 'servicio', 'URL slug', 'servicio',
			'menu_icon'      => 'dashicons-analytics',
		],
		[
			'post_type_name' => 'cultivo',
			'single_name'    => 'Cultivo',
			'plural_name'    => 'Cultivos',
			'post_type'      => 'post',
			'taxonomies'     => [],
			'supports_block' => ['title','editor','thumbnail','custom-fields'],
			'slug_rewrite'   => 'cultivo', 'URL slug', 'cultivo',
			'menu_icon'      => 'dashicons-carrot',
		],
		[
			'post_type_name' => 'institucion',
			'single_name'    => 'Institución',
			'plural_name'    => 'Instituciones',
			'post_type'      => 'post',
			'taxonomies'     => [],
			'supports_block' => ['title','editor','thumbnail','custom-fields'],
			'slug_rewrite'   => 'institucion', 'URL slug', 'institucion',
			'menu_icon'      => 'dashicons-building',
		],
		[
			'post_type_name' => 'url',
			'single_name'    => 'Enlace Footer',
			'plural_name'    => 'Enlaces Footer',
			'post_type'      => 'post',
			'taxonomies'     => [],
			'supports_block' => ['title','editor','thumbnail','custom-fields'],
			'slug_rewrite'   => 'url', 'URL slug', 'url',
			'menu_icon'      => 'dashicons-paperclip',
		],
		[
			'post_type_name' => 'monitoreo',
			'single_name'    => 'Monitoreo Plaga',
			'plural_name'    => 'Monitoreo Plagas',
			'post_type'      => 'post',
			'taxonomies'     => [],
			'supports_block' => ['title','editor','thumbnail','custom-fields'],
			'slug_rewrite'   => 'monitoreo', 'URL slug', 'monitoreo',
			'menu_icon'      => 'dashicons-location-alt',
		],
	];

	foreach( $post_type_RTLS_array as $posttypearray ){
		// Register Custom Post Type 
		register_post_type(
            $posttypearray['post_type_name'],
            [
                'labels' => [
                    'name' 				  => _x($posttypearray['single_name'], 'post type general name'),
                    'singular_name' 		  => _x($posttypearray['single_name'], 'post type singular name'),
                    'menu_name' 			  => $posttypearray['plural_name'],
                    'name_admin_bar'        => __( $posttypearray['single_name'] ),
                    'archives'              => __( $posttypearray['single_name'] . ' Archives' ),
                    'attributes'            => __( $posttypearray['single_name'] . ' Attributes' ),
                    'parent_item_colon'     => __( 'Parent ' . $posttypearray['single_name'] . ':' ),
                    'all_items'             => __( $posttypearray['plural_name'] ),
                    'add_new_item' 		  => __('Añadir nuevo ' . $posttypearray['single_name']),
                    'add_new' 			  => _x('Añadir', $posttypearray['single_name']),
                    'new_item' 			  => __('Nueva ' . $posttypearray['single_name']),
                    'edit_item' 			  => __('Editar ' . $posttypearray['single_name']),
                    'update_item'           => __( 'Actualizar ' . $posttypearray['single_name'] ),
                    'view_item' 			  => __('Ver ' . $posttypearray['single_name']),
                    'view_items'            => __( 'Ver ' . $posttypearray['plural_name'] ),
                    'search_items' 	      => __('Buscar ' . $posttypearray['single_name']),
                    'not_found' 			  => __('No se han encontrado '. $posttypearray['plural_name']),
                    'not_found_in_trash' 	  => __('No se han encontrado ' . $posttypearray['plural_name'] . ' en la papelera'),
                    'featured_image'        => __( 'Imagen destacada' ),
                    'set_featured_image'    => __( 'Configurar Imagen destacada' ),
                    'remove_featured_image' => __( 'Remover Imagen destacada' ),
                    'use_featured_image'    => __( 'Usar como Imagen destacada' ),
                    'insert_into_item'      => __( 'Insertar en ' . $posttypearray['single_name'] ),
                    'uploaded_to_this_item' => __( 'Subir a este ' . $posttypearray['single_name'] ),
                    'items_list'            => __( 'Lista de ' . $posttypearray['single_name'] ),
                    'items_list_navigation' => __( 'Lista de navegación para ' . $posttypearray['plural_name'] ),
                    'filter_items_list'     => __( 'Filtro lista de ' . $posttypearray['plural_name'] ),
                ],

                'supports'             => $posttypearray['supports_block'],
                'taxonomies'           => $posttypearray['taxonomies'],
                'hierarchical'         => false,
                'public'               => true,
                'show_ui'              => true,
                'show_in_menu'         => true,
                'menu_position'        => null,
                'show_in_nav_menus'    => true,
                'can_export'           => true,
                'has_archive'          => true,
                'exclude_from_search'  => false,
                'publicly_queryable'   => true,
                'capability_type'      => 'post',
                'query_var'            => true,
                'rewrite'              => ['slug' => $posttypearray['slug_rewrite']],
                'menu_icon'            => $posttypearray['menu_icon'],
            ]
		);
	}
}

add_action('init','crear__post_type_RTLS', 0);
// ====================================>

function crear__taxonomy_RTLS() {
    register_taxonomy(
		'categoria-servicios',				        //	The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces). 
		['servicio'],                                //	post type name
		[
			'hierarchical' => true,  
			'label' => 'Categorias',	        //	Display name
			'query_var' => true,
			'rewrite' => [
				'slug' => 'categoria-servicios',      //	This controls the base slug that will display before each term
				'with_front' => false 		    //	Don't display the category base before 
            ]
        ]
    );

    register_taxonomy(
		'categoria-url',				        //	The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces). 
		['url'],                                //	post type name
		[
			'hierarchical' => true,  
			'label' => 'Categorias',	        //	Display name
			'query_var' => true,
			'rewrite' => [
				'slug' => 'categoria-url',      //	This controls the base slug that will display before each term
				'with_front' => false 		    //	Don't display the category base before 
            ]
        ]
    );

    register_taxonomy(
		'monitoreo-periodo',				        //	The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces). 
		['monitoreo'],                                //	post type name
		[
			'hierarchical' => true,  
			'label' => 'Periodos',	        //	Display name
			'query_var' => true,
			'rewrite' => [
				'slug' => 'monitoreo-periodo',      //	This controls the base slug that will display before each term
				'with_front' => false 		    //	Don't display the category base before 
            ]
        ]
    );
    register_taxonomy(
		'monitoreo-tecnico',				        //	The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces). 
		['monitoreo'],                                //	post type name
		[
			'hierarchical' => true,  
			'label' => 'Técnicos',	        //	Display name
			'query_var' => true,
			'rewrite' => [
				'slug' => 'monitoreo-tecnico',      //	This controls the base slug that will display before each term
				'with_front' => false 		    //	Don't display the category base before 
            ]
        ]
    );
    register_taxonomy(
		'monitoreo-programa',				        //	The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces). 
		['monitoreo'],                                //	post type name
		[
			'hierarchical' => true,  
			'label' => 'Programas',	        //	Display name
			'query_var' => true,
			'rewrite' => [
				'slug' => 'monitoreo-programa',      //	This controls the base slug that will display before each term
				'with_front' => false 		    //	Don't display the category base before 
            ]
        ]
    );
    register_taxonomy(
		'monitoreo-formulario',				        //	The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces). 
		['monitoreo'],                                //	post type name
		[
			'hierarchical' => true,  
			'label' => 'Formularios',	        //	Display name
			'query_var' => true,
			'rewrite' => [
				'slug' => 'monitoreo-formulario',      //	This controls the base slug that will display before each term
				'with_front' => false 		    //	Don't display the category base before 
            ]
        ]
    );
    register_taxonomy(
		'monitoreo-trampa',				        //	The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces). 
		['monitoreo'],                                //	post type name
		[
			'hierarchical' => true,  
			'label' => 'Trampas',	        //	Display name
			'query_var' => true,
			'rewrite' => [
				'slug' => 'monitoreo-trampa',      //	This controls the base slug that will display before each term
				'with_front' => false 		    //	Don't display the category base before 
            ]
        ]
    );
    register_taxonomy(
		'monitoreo-incidencia',				        //	The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces). 
		['monitoreo'],                                //	post type name
		[
			'hierarchical' => true,  
			'label' => 'Incidencias',	        //	Display name
			'query_var' => true,
			'rewrite' => [
				'slug' => 'monitoreo-incidencia',      //	This controls the base slug that will display before each term
				'with_front' => false 		    //	Don't display the category base before 
            ]
        ]
    );
}
add_action( 'init', 'crear__taxonomy_RTLS' );
// END  ====================================>

add_filter( 'manage_servicio_posts_columns', 'ed_filter_servicio_columns' );
function ed_filter_servicio_columns( $columns ) {
	$columns = [
		'cb'    => $columns['cb'],
		'image' => __( 'Imagen' ),
		'title' => __( 'Nombre' ),
	];
	
	return $columns;
}
add_action( 'manage_servicio_posts_custom_column', 'ed_servicio_column', 10, 2);
function ed_servicio_column( $column, $post_id ) {
    $imagen = wp_get_attachment_url(get_post_thumbnail_id($post_id));
	#Imagen
	if ( 'image' === $column ) {
		echo '<img src="'.path_upload($imagen).'" style="width: auto; height: 63px; object-fit: cover;" />';
    }
}

add_filter( 'manage_cultivo_posts_columns', 'ed_filter_cultivo_columns' );
function ed_filter_cultivo_columns( $columns ) {
	$columns = [
		'cb'    => $columns['cb'],
		'image' => __( 'Imagen' ),
		'title' => __( 'Nombre' ),
	];
	
	return $columns;
}
add_action( 'manage_cultivo_posts_custom_column', 'ed_cultivo_column', 10, 2);
function ed_cultivo_column( $column, $post_id ) {
    $imagen = wp_get_attachment_url(get_post_thumbnail_id($post_id));
	#Imagen
	if ( 'image' === $column ) {
		echo '<img src="'.path_upload($imagen).'" style="width: auto; height: 63px; object-fit: cover;" />';
    }
}

add_filter( 'manage_institucion_posts_columns', 'ed_filter_institucion_columns' );
function ed_filter_institucion_columns( $columns ) {
	$columns = [
		'cb'    => $columns['cb'],
		'image' => __( 'Imagen' ),
		'title' => __( 'Nombre' ),
	];
	
	return $columns;
}
add_action( 'manage_institucion_posts_custom_column', 'ed_institucion_column', 10, 2);
function ed_institucion_column( $column, $post_id ) {
    $imagen = wp_get_attachment_url(get_post_thumbnail_id($post_id));
	#Imagen
	if ( 'image' === $column ) {
		echo '<img src="'.path_upload($imagen).'" style="width: auto; height: 63px; object-fit: cover;" />';
    }
}

add_action('admin_head', 'ed_columns_width');
function ed_columns_width() {
    echo '<style type="text/css">';
        echo '.column-image { text-align: center; width:110px !important; overflow:hidden; }';
    echo '</style>';
}

add_action('admin_head', 'custom_form_transparencia');
function custom_form_transparencia() {
    echo '<style type="text/css">';
        echo '.post-type-transparencia #categoria-transparencia-all { min-height: 500px !important; }';
    echo '</style>';
}
?>