<?php
/**
 * Helper functions
 *
 * @package KT Solutions
 * @subpackage Ktech Theme
 * @version 1.0.0
 */

/**
 * Obtener el path a un archivo en el folder upload a partir de una url absoluta
 * 
 * @param {String} $url Url absoluta de un archivo 
 */
if (!function_exists('path_upload')) {
    function path_upload($url) {
        $partes = explode('/', $url);
        $count = count($partes);
        $relative = $url;
        if (!empty($partes[$count - 5]) && !empty($partes[$count - 4]) && !empty($partes[$count - 3]) && !empty($partes[$count - 2]) && !empty($partes[$count - 1])) {
            $relative = get_option('siteurl') . '/' . $partes[$count - 5] . '/' . $partes[$count - 4] . '/' . $partes[$count - 3] . '/' . $partes[$count - 2] . '/' . $partes[$count - 1];
        }

        return $relative;
    }
}

/**
 * Iniciales avatar
 * 
 * @param {String} $name 
 */
if (!function_exists('ini_avatar')) {
    function ini_avatar($name) {
        $partes = explode(' ', $name);
        if (!empty($partes[1])) {
            $ini1 = substr(mb_strtoupper($partes[0]), 0, 1);
            $ini2 = substr(mb_strtoupper($partes[1]), 0, 1);

            return $ini1 . $ini2;
        } else {
            $ini1 = substr(mb_strtoupper($partes[0]), 0, 2);

            return $ini1;
        }
    }
}

/**
 * Formatear monto a currency tipe
 * 
 * @param {Float} $monto Monto a formatear
 */
if (!function_exists('currency')) {
    function currency($monto) {
        $moneda = "US$";
        return $moneda . number_format($monto, 2, '.', ',');
    }
}

/**
 * Obtener la lista de paises
 */
if (!function_exists('get_paises')) {
    function get_paises() {
        $paises = [
            "Afghanistan",
            "Albania",
            "Algeria",
            "American Samoa",
            "Andorra",
            "Angola",
            "Anguilla",
            "Antarctica",
            "Antigua and Barbuda",
            "Argentina",
            "Armenia",
            "Aruba",
            "Australia",
            "Austria",
            "Azerbaijan",
            "Bahamas",
            "Bahrain",
            "Bangladesh",
            "Barbados",
            "Belarus",
            "Belgium",
            "Belize",
            "Benin",
            "Bermuda",
            "Bhutan",
            "Bolivia",
            "Bosnia and Herzegovina",
            "Botswana",
            "Bouvet Island",
            "Brazil",
            "British Indian Ocean Territory",
            "Brunei Darussalam",
            "Bulgaria",
            "Burkina Faso",
            "Burundi",
            "Cambodia",
            "Cameroon",
            "Cape Verde",
            "Cayman Islands",
            "Central African Republic",
            "Chad",
            "Chile",
            "China",
            "Christmas Island",
            "Cocos (Keeling) Islands",
            "Colombia",
            "Comoros",
            "Congo",
            "Congo, The Democratic Republic of The",
            "Cook Islands",
            "Costa Rica",
            "Cote D'ivoire",
            "Croatia",
            "Cuba",
            "Cyprus",
            "Czech Republic",
            "Denmark",
            "Djibouti",
            "Dominica",
            "Dominican Republic",
            "Ecuador",
            "Egypt",
            "El Salvador",
            "Equatorial Guinea",
            "Eritrea",
            "Estonia",
            "Ethiopia",
            "Falkland Islands (Malvinas)",
            "Faroe Islands",
            "Fiji",
            "Finland",
            "France",
            "French Guiana",
            "French Polynesia",
            "French Southern Territories",
            "Gabon",
            "Gambia",
            "Georgia",
            "Germany",
            "Ghana",
            "Gibraltar",
            "Greece",
            "Greenland",
            "Grenada",
            "Guadeloupe",
            "Guam",
            "Guatemala",
            "Guinea",
            "Guinea-bissau",
            "Guyana",
            "Haiti",
            "Heard Island and Mcdonald Islands",
            "Holy See (Vatican City State)",
            "Honduras",
            "Hong Kong",
            "Hungary",
            "Iceland",
            "India",
            "Indonesia",
            "Iran, Islamic Republic of",
            "Iraq",
            "Ireland",
            "Israel",
            "Italy",
            "Jamaica",
            "Japan",
            "Jordan",
            "Kazakhstan",
            "Kenya",
            "Kiribati",
            "Korea, Democratic People's Republic of",
            "Korea, Republic of",
            "Kuwait",
            "Kyrgyzstan",
            "Lao People's Democratic Republic",
            "Latvia",
            "Lebanon",
            "Lesotho",
            "Liberia",
            "Libyan Arab Jamahiriya",
            "Liechtenstein",
            "Lithuania",
            "Luxembourg",
            "Macao",
            "Macedonia, The Former Yugoslav Republic of",
            "Madagascar",
            "Malawi",
            "Malaysia",
            "Maldives",
            "Mali",
            "Malta",
            "Marshall Islands",
            "Martinique",
            "Mauritania",
            "Mauritius",
            "Mayotte",
            "Mexico",
            "Micronesia, Federated States of",
            "Moldova, Republic of",
            "Monaco",
            "Mongolia",
            "Montserrat",
            "Morocco",
            "Mozambique",
            "Myanmar",
            "Namibia",
            "Nauru",
            "Nepal",
            "Netherlands",
            "Netherlands Antilles",
            "New Caledonia",
            "New Zealand",
            "Nicaragua",
            "Niger",
            "Nigeria",
            "Niue",
            "Norfolk Island",
            "Northern Mariana Islands",
            "Norway",
            "Oman",
            "Pakistan",
            "Palau",
            "Palestinian Territory, Occupied",
            "Panama",
            "Papua New Guinea",
            "Paraguay",
            "Peru",
            "Philippines",
            "Pitcairn",
            "Poland",
            "Portugal",
            "Puerto Rico",
            "Qatar",
            "Reunion",
            "Romania",
            "Russian Federation",
            "Rwanda",
            "Saint Helena",
            "Saint Kitts and Nevis",
            "Saint Lucia",
            "Saint Pierre and Miquelon",
            "Saint Vincent and The Grenadines",
            "Samoa",
            "San Marino",
            "Sao Tome and Principe",
            "Saudi Arabia",
            "Senegal",
            "Serbia and Montenegro",
            "Seychelles",
            "Sierra Leone",
            "Singapore",
            "Slovakia",
            "Slovenia",
            "Solomon Islands",
            "Somalia",
            "South Africa",
            "South Georgia and The South Sandwich Islands",
            "Spain",
            "Sri Lanka",
            "Sudan",
            "Suriname",
            "Svalbard and Jan Mayen",
            "Swaziland",
            "Sweden",
            "Switzerland",
            "Syrian Arab Republic",
            "Taiwan, Province of China",
            "Tajikistan",
            "Tanzania, United Republic of",
            "Thailand",
            "Timor-leste",
            "Togo",
            "Tokelau",
            "Tonga",
            "Trinidad and Tobago",
            "Tunisia",
            "Turkey",
            "Turkmenistan",
            "Turks and Caicos Islands",
            "Tuvalu",
            "Uganda",
            "Ukraine",
            "United Arab Emirates",
            "United Kingdom",
            "United States",
            "United States Minor Outlying Islands",
            "Uruguay",
            "Uzbekistan",
            "Vanuatu",
            "Viet Nam",
            "Virgin Islands, British",
            "Virgin Islands, U.S.",
            "Wallis and Futuna",
            "Western Sahara",
            "Yemen",
            "Zambia",
            "Zimbabwe",
        ];

        return $paises;
    }
}

/**
 * Obtener la lista de ciudades
 */
if (!function_exists('get_ciudades')) {
    function get_ciudades() {
        $ciudades = [
            "DISTRITO NACIONAL",
            "AZUA",
            "BAORUCO",
            "BARAHONA",
            "DAJABÓN",
            "DUARTE",
            "ELÍAS PIÑA",
            "EL SEIBO",
            "ESPAILLAT",
            "INDEPENDENCIA",
            "LA ALTAGRACIA",
            "LA ROMANA",
            "LA VEGA",
            "MARÍA TRINIDAD SÁNCHEZ",
            "MONTE CRISTI",
            "PEDERNALES",
            "PERAVIA",
            "PUERTO PLATA",
            "HERMANAS MIRABAL",
            "SAMANÁ",
            "SAN CRISTÓBAL",
            "SAN JUAN ",
            "SAN PEDRO DE MACORÍS",
            "SÁNCHEZ RAMÍREZ",
            "SANTIAGO",
            "SANTIAGO RODRÍGUEZ",
            "VALVERDE",
            "MONSEÑOR NOUEL",
            "MONTE PLATA",
            "HATO MAYOR",
            "SAN JOSÉ DE OCOA",
            "SANTO DOMINGO",
        ];

        return $ciudades;
    }
}

/*
 * Prepend Facebook, Twitter and Google+ social share buttons to the post's content
 *
 */
if (!function_exists('add_share_buttons')) {
    /**
     * Whatsapp
     * https://api.whatsapp.com/send?text=Zayenka%20%7C%20Conoce%20las%2010%20reglas%20para%20crear%20un%20eco%20evento%20en%20tu%20ciudad.%20http%3A%2F%2Flocalhost%2Fzayenka%2Fconoce-las-10-reglas-para-crear-un-eco-evento-en-tu-ciudad-4%2F
     * 
     * Email
     * https://www.addtoany.com/add_to/email?linkurl=http%3A%2F%2Flocalhost%2Fzayenka%2Fconoce-las-10-reglas-para-crear-un-eco-evento-en-tu-ciudad-4%2F&linkname=Zayenka%20%7C%20Conoce%20las%2010%20reglas%20para%20crear%20un%20eco%20evento%20en%20tu%20ciudad.&linknote=
     * 
     * Twitter
     * https://twitter.com/intent/tweet?text=Zayenka%20%7C%20Conoce%20las%2010%20reglas%20para%20crear%20un%20eco%20evento%20en%20tu%20ciudad.%20http%3A%2F%2Flocalhost%2Fzayenka%2Fconoce-las-10-reglas-para-crear-un-eco-evento-en-tu-ciudad-4%2F&related=AddToAny,micropat
     * 
     * 
     * 
     * 
     */
    function add_share_buttons($label = null) {
        global $post;

        // Get the post's URL that will be shared
        $post_url   = urlencode( esc_url( get_permalink($post->ID) ) );
        
        // Get the post's title
        $post_title = urlencode( $post->post_title );

        // Compose the share links for Facebook, Twitter and Google+
        $whatsapp_link = sprintf( 'https://api.whatsapp.com/send?text=%1$s - %2$s', $post_title, $post_url );
        $email_link    = sprintf( 'mailto:?Subject=%1$s&amp;Body=%2$s', $post_title, $post_url );
        $facebook_link = sprintf( 'http://www.facebook.com/sharer.php?u=%1$s', $post_url );
        $linkedin_link = sprintf( 'http://www.linkedin.com/shareArticle?mini=true&amp;url=%1$s', $post_url );
        $twitter_link  = sprintf( 'https://twitter.com/intent/tweet?text=%2$s&url=%1$s', $post_url, $post_title );

        // Wrap the buttons
        $output = '<div class="share-buttons">';
        
        // Add the links inside the wrapper
        if ($label) $output .= '<span>'.$label.'</span>';
        $output .= '<a target="_blank" href="' . $whatsapp_link . '" class="share-button"><i class="fab fa-whatsapp"></i></a>';
        $output .= '<a target="_blank" href="' . $email_link . '" class="share-button"><i class="far fa-envelope"></i></a>';
        $output .= '<a target="_blank" href="' . $facebook_link . '" class="share-button"><i class="fab fa-facebook-f"></i></a>';
        $output .= '<a target="_blank" href="' . $linkedin_link . '" class="share-button"><i class="fab fa-linkedin-in"></i></a>';
        $output .= '<a target="_blank" href="' . $twitter_link . '" class="share-button"><i class="fab fa-twitter"></i></a>';
            
        $output .= '</div>';

        // Return the buttons and the original content
        echo $output;
    }
}

/*
 * Prepend Facebook, Twitter and Google+ social share buttons to the post's content
 *
 */
if (!function_exists('add_share_buttons2')) {
    /**
     * Whatsapp
     * https://api.whatsapp.com/send?text=Zayenka%20%7C%20Conoce%20las%2010%20reglas%20para%20crear%20un%20eco%20evento%20en%20tu%20ciudad.%20http%3A%2F%2Flocalhost%2Fzayenka%2Fconoce-las-10-reglas-para-crear-un-eco-evento-en-tu-ciudad-4%2F
     * 
     * Email
     * https://www.addtoany.com/add_to/email?linkurl=http%3A%2F%2Flocalhost%2Fzayenka%2Fconoce-las-10-reglas-para-crear-un-eco-evento-en-tu-ciudad-4%2F&linkname=Zayenka%20%7C%20Conoce%20las%2010%20reglas%20para%20crear%20un%20eco%20evento%20en%20tu%20ciudad.&linknote=
     * 
     * Twitter
     * https://twitter.com/intent/tweet?text=Zayenka%20%7C%20Conoce%20las%2010%20reglas%20para%20crear%20un%20eco%20evento%20en%20tu%20ciudad.%20http%3A%2F%2Flocalhost%2Fzayenka%2Fconoce-las-10-reglas-para-crear-un-eco-evento-en-tu-ciudad-4%2F&related=AddToAny,micropat
     * 
     * 
     * 
     * 
     */
    function add_share_buttons2() {
        global $post;

        // Get the post's URL that will be shared
        $post_url   = urlencode( esc_url( get_permalink($post->ID) ) );
        
        // Get the post's title
        $post_title = urlencode( $post->post_title );

        // Compose the share links for Facebook, Twitter and Google+
        $whatsapp_link = sprintf( 'https://api.whatsapp.com/send?text=%1$s - %2$s', $post_title, $post_url );
        $email_link    = sprintf( 'mailto:?Subject=%1$s&amp;Body=%2$s', $post_title, $post_url );
        $facebook_link = sprintf( 'http://www.facebook.com/sharer.php?u=%1$s', $post_url );
        $linkedin_link = sprintf( 'http://www.linkedin.com/shareArticle?mini=true&amp;url=%1$s', $post_url );
        $twitter_link  = sprintf( 'https://twitter.com/intent/tweet?text=%2$s&url=%1$s', $post_url, $post_title );

        // Wrap the buttons
        $output = '<div class="share-buttons">';
        
        // Add the links inside the wrapper
        $output .= '<a class="dropdown-item" href="' . $whatsapp_link . '"><i class="fab fa-whatsapp"></i></a>';
        $output .= '<a class="dropdown-item" href="' . $email_link . '"><i class="far fa-envelope"></i></a>';
        $output .= '<a class="dropdown-item" href="' . $facebook_link . '"><i class="fab fa-facebook-f"></i></a>';
        $output .= '<a class="dropdown-item" href="' . $linkedin_link . '"><i class="fab fa-linkedin-in"></i></a>';
        $output .= '<a class="dropdown-item" href="' . $twitter_link . '"><i class="fab fa-twitter"></i></a>';
        
        $output .= '</div>';

        // Return the buttons and the original content
        echo $output;
    }
}

/**
 * Obtener telefono para linkear
 * 
 * @param string $setting
 * @return array
 */
if (!function_exists('get_telefono')) {
    function get_telefono($setting = null)
    {
        if (empty($setting)) $setting = 'setting_telefono';

        $parts = explode('|', get_option($setting));
        if (empty($parts[1])) {
            return [$parts[0],$parts[0]];
        } else {
            return [$parts[0],$parts[1]];
        }
    }
}

/**
 * Formatear monto a currency
 * 
 * @param float $num
 */
function currency_format($num)
{
    $float = floatval($num);
    $currency  = get_option('setting_currency');
    $new = number_format($float, 2, ',', '.');

    return $currency . '' .$new;
}

/**
 * Obtener todos los comentarios aprobados en todos los lenguajes
 */
function get_all_approved_comments($post_id)
{
    global $wpdb;

    $post_id_es = apply_filters( 'wpml_object_id', $post_id, 'page', false, 'es' );
    $post_id_en = apply_filters( 'wpml_object_id', $post_id, 'page', false, 'en' );

    $results = $wpdb->get_results( 
        "SELECT * 
         FROM $wpdb->comments
         WHERE 
            (comment_post_ID = $post_id_es OR comment_post_ID = $post_id_en)
            AND comment_approved = '1'
         ORDER BY comment_date DESC"
    );
    
    $comments_data = [];
    foreach ($results as $key => $item) {
        $star = intval(get_comment_meta($item->comment_ID, 'star', true));

        $comments_data[$key] = $item;
        $comments_data[$key]->star = $star;
    }
    
    return $comments_data;
}

/**
 * Recursively sort an array of taxonomy terms hierarchically. Child categories will be
 * placed under a 'children' member of their parent term.
 * @param Array   $cats     taxonomy term objects to sort
 * @param Array   $into     result array to put them in
 * @param integer $parentId the current parent ID to put them in
 */
function sort_terms_hierarchically(Array &$cats, Array &$into, $parentId = 0)
{
    foreach ($cats as $i => $cat) {
        if ($cat->parent == $parentId) {
            $into[$cat->term_id] = $cat;
            unset($cats[$i]);
        }
    }

    foreach ($into as $topCat) {
        $topCat->children = array();
        sort_terms_hierarchically($cats, $topCat->children, $topCat->term_id);
    }
}

/**
 * Obtener custom taxonomies
 * 
 * @param int $post_id
 * @param string $taxonomy
 * @return array
 */
if (!function_exists('kt_print_taxonomies')) {
    function kt_print_taxonomies($post_id, $taxonomy) {
        /*$terms = get_the_terms($post_id, $taxonomy);
        
        if (!$terms) return [];
        
        $arr = [];
        foreach ($terms as $term) {
            $arr[] = $term->name;
        }
        $arr_reversed = array_reverse($arr);
        $string = implode(', ', $arr_reversed);

        return $string;*/

        // $taxonomy = 'YOUR_TAXONOMY_NAME'; // change this to your custom taxonomy name.

        $arr = [];
        $taxonomy_terms = wp_get_post_terms( $post_id, $taxonomy, array( "fields" => "ids" ) );
        if( $taxonomy_terms ) {
            $term_array = trim( implode( ',', (array) $taxonomy_terms ), ' ,' );
            $neworderterms = get_terms($taxonomy, 'orderby=none&include=' . $term_array );
            foreach( $neworderterms as $orderterm ) {
                $arr[] = $orderterm->name;
            }
        }
        
        $arr_reversed = array_reverse($arr);
        $string = implode(', ', $arr_reversed);

        return $string;
    }
}

if (!function_exists('arrProvincias')) {
    function arrProvincias() {
        $provincias = [
            // [
            //     "id"     => "0",
            //     "name"   => "Provincia",
            //     "cities" => []
            // ],
            [
                "id"     => "1",
                "name"   => "Azua",
                "cities" => [
                    ["id" => "2", "name" => "Azua de Compostela"],
                    ["id" => "3", "name" => "Estebanía"],
                    ["id" => "4", "name" => "Guayabal"],
                    ["id" => "5", "name" => "Las Charcas"],
                    ["id" => "6", "name" => "Las Yayas de Viajama"],
                    ["id" => "7", "name" => "Padre Las Casas"],
                    ["id" => "8", "name" => "Peralta"],
                    ["id" => "9", "name" => "Pueblo Viejo"],
                    ["id" => "10", "name" => "Sabana Yegua"], 
                    ["id" => "11", "name" => "Tábara Arriba"],
                ]
            ],
            [
                "id"     => "2",
                "name"   => "Bahoruco",
                "cities" => [
                    ["id" => "13", "name" => "Galván"],
                    ["id" => "14", "name" => "Los Ríos"],
                    ["id" => "12", "name" => "Neiba"],
                    ["id" => "15", "name" => "Tamayo"],
                    ["id" => "16", "name" => "Villa Jaragua"],
                ]
            ],
            [
                "id"     => "3",
                "name"   => "Barahona",
                "cities" => [
                    ["id" => "17", "name" => "Barahona"],
                    ["id" => "18", "name" => "Cabral"],
                    ["id" => "19", "name" => "El Peñón"],
                    ["id" => "20", "name" => "Enriquillo"],
                    ["id" => "21", "name" => "Fundación"],
                    ["id" => "22", "name" => "Jaquimeyes"],
                    ["id" => "23", "name" => "La Ciénaga"],
                    ["id" => "24", "name" => "Las Salinas"],
                    ["id" => "25", "name" => "Paraíso"],
                    ["id" => "26", "name" => "Polo"],
                    ["id" => "27", "name" => "Vicente Noble"],
                ]
            ],
            [
                "id"     => "4",
                "name"   => "Dajabón",
                "cities" => [
                    ["id" => "28", "name" => "Dajabón"],
                    ["id" => "29", "name" => "El Pino"],
                    ["id" => "30", "name" => "Loma de Cabrera"],
                    ["id" => "31", "name" => "Partido"],
                    ["id" => "32", "name" => "Restauración"],
                ]
            ],
            [
                "id"     => "5",
                "name"   => "Distrito Nacional",
                "cities" => [
                    ["id" => "1", "name" => "Distrito Nacional"],
                ]
            ],
            [
                "id"     => "6",
                "name"   => "Duarte",
                "cities" => [
                    ["id" => "34", "name" => "Arenoso"],
                    ["id" => "35", "name" => "Castillo"],
                    ["id" => "36", "name" => "Eugenio María de Hostos"],
                    ["id" => "37", "name" => "Las Guáranas"],
                    ["id" => "38", "name" => "Pimentel"],
                    ["id" => "33", "name" => "San Francisco de Macorís"],
                    ["id" => "39", "name" => "Villa Riva"],
                ]
            ],
            [
                "id"     => "7",
                "name"   => "El Seibo",
                "cities" => [
                    ["id" => "33", "name" => "El Seibo"],
                    ["id" => "39", "name" => "Miches"],
                ]
            ],
            [
                "id"     => "8",
                "name"   => "Elías Piña",
                "cities" => [
                    ["id" => "43", "name" => "Bánica"],
                    ["id" => "42", "name" => "Comendador"],
                    ["id" => "44", "name" => "El Llano"],
                    ["id" => "45", "name" => "Hondo Valle"],
                    ["id" => "46", "name" => "Juan Santiago"],
                    ["id" => "47", "name" => "Pedro Santana"],
                ]
            ],
            [
                "id"     => "9",
                "name"   => "Espaillat",
                "cities" => [
                    ["id" => "49", "name" => "Cayetano Germosén"],
                    ["id" => "50", "name" => "Gaspar Hernández"],
                    ["id" => "51", "name" => "Jamao al Norte"],
                    ["id" => "48", "name" => "Moca"],
                ]
            ],
            [
                "id"     => "10",
                "name"   => "Hato Mayor",
                "cities" => [
                    ["id" => "53", "name" => "El Valle"],
                    ["id" => "52", "name" => "Hato Mayor del Rey"],
                    ["id" => "54", "name" => "Sabana de la Mar"],
                ]
            ],
            [
                "id"     => "11",
                "name"   => "Hermanas Mirabal",
                "cities" => [
                    ["id" => "55", "name" => "Salcedo"],
                    ["id" => "56", "name" => "Tenares"],
                    ["id" => "57", "name" => "Villa Tapia"],
                ]
            ],
            [
                "id"     => "12",
                "name"   => "Independencia",
                "cities" => [
                    ["id" => "59", "name" => "Cristóbal"],
                    ["id" => "60", "name" => "Duvergé"],
                    ["id" => "58", "name" => "Jimaní"],
                    ["id" => "61", "name" => "La Descubierta"],
                    ["id" => "62", "name" => "Mella"],
                    ["id" => "63", "name" => "Postrer Río"],
                ]
            ],
            [
                "id"     => "13",
                "name"   => "La Altagracia",
                "cities" => [
                    ["id" => "64", "name" => "Higúey"],
                    ["id" => "65", "name" => "San Rafael del Yuma"],
                ]
            ],
            [
                "id"     => "14",
                "name"   => "La Romana",
                "cities" => [
                    ["id" => "67", "name" => "Guaymate"],
                    ["id" => "66", "name" => "La Romana"],
                    ["id" => "68", "name" => "Villa Hermosa"],
                ]
            ],
            [
                "id"     => "15",
                "name"   => "La Vega",
                "cities" => [
                    ["id" => "70", "name" => "Constanza"],
                    ["id" => "71", "name" => "Jarabacoa"],
                    ["id" => "72", "name" => "Jima Abajo"],
                    ["id" => "69", "name" => "La Concepción de La Vega"],
                ]
            ],
            [
                "id"     => "16",
                "name"   => "María Trinidad Sánchez",
                "cities" => [
                    ["id" => "74", "name" => "Cabrera"],
                    ["id" => "75", "name" => "El Factor"],
                    ["id" => "73", "name" => "Nagua"],
                    ["id" => "76", "name" => "Río San Juan"],
                ]
            ],
            [
                "id"     => "17",
                "name"   => "Monseñor Nouel",
                "cities" => [
                    ["id" => "77", "name" => "Bonao"],
                    ["id" => "78", "name" => "Maimón"],
                    ["id" => "79", "name" => "Piedra Blanca"],
                ]
            ],
            [
                "id"     => "18",
                "name"   => "Monte Cristi",
                "cities" => [
                    ["id" => "81", "name" => "Castañuela"],
                    ["id" => "82", "name" => "Guayubín"],
                    ["id" => "83", "name" => "Las Matas de Santa Cruz"],
                    ["id" => "80", "name" => "Montecristi"],
                    ["id" => "84", "name" => "Pepillo Salcedo"],
                    ["id" => "85", "name" => "Villa Vásquez"],
                ]
            ],
            [
                "id"     => "19",
                "name"   => "Monte Plata",
                "cities" => [
                    ["id" => "87", "name" => "Bayaguana"],
                    ["id" => "86", "name" => "Monte Plata"],
                    ["id" => "88", "name" => "Peralvillo"],
                    ["id" => "89", "name" => "Sabana Grande de Boyá"],
                    ["id" => "90", "name" => "Yamasá"],
                ]
            ],
            [
                "id"     => "20",
                "name"   => "Pedernales",
                "cities" => [
                    ["id" => "92", "name" => "Oviedo"],
                    ["id" => "91", "name" => "Pedernales"],
                ]
            ],
            [
                "id"     => "21",
                "name"   => "Peravia",
                "cities" => [
                    ["id" => "93", "name" => "Baní"],
                    ["id" => "94", "name" => "Nizao"],
                ]
            ],
            [
                "id"     => "22",
                "name"   => "Puerto Plata",
                "cities" => [
                    ["id" => "96", "name" => "Altamira"],
                    ["id" => "97", "name" => "Guananico"],
                    ["id" => "98", "name" => "Imbert"],
                    ["id" => "99", "name" => "Los Hidalgos"],
                    ["id" => "100", "name" => "Luperón"],
                    ["id" => "95", "name" => "Puerto Plata"],
                    ["id" => "101", "name" => "Sosúa"],
                    ["id" => "102", "name" => "Villa Isabela"],
                    ["id" => "103", "name" => "Villa Montellano"],
                ]
            ],
            [
                "id"     => "23",
                "name"   => "Samaná",
                "cities" => [
                    ["id" => "105", "name" => "Las Terrenas"],
                    ["id" => "104", "name" => "Samaná"],
                    ["id" => "106", "name" => "Sánchez"],
                ]
            ],
            [
                "id"     => "24",
                "name"   => "San Cristóbal",
                "cities" => [
                    ["id" => "108", "name" => "Bajos de Haina"],
                    ["id" => "109", "name" => "Cambita Garabito"],
                    ["id" => "110", "name" => "Los Cacaos"],
                    ["id" => "111", "name" => "Sabana Grande de Palenque"],
                    ["id" => "107", "name" => "San Cristóbal"],
                    ["id" => "112", "name" => "San Gregorio de Nigua"],
                    ["id" => "113", "name" => "Villa Altagracia"],
                    ["id" => "114", "name" => "Yaguate"],
                ]
            ],
            [
                "id"     => "25",
                "name"   => "San José de Ocoa",
                "cities" => [
                    ["id" => "116", "name" => "Rancho Arriba"],
                    ["id" => "117", "name" => "Sabana Larga"],
                    ["id" => "115", "name" => "San José de Ocoa"],
                ]
            ],
            [
                "id"     => "26",
                "name"   => "San Juan",
                "cities" => [
                    ["id" => "119", "name" => "Bohechío"],
                    ["id" => "120", "name" => "El Cercado"],
                    ["id" => "121", "name" => "Juan de Herrera"],
                    ["id" => "122", "name" => "Las Matas de Farfán"],
                    ["id" => "118", "name" => "San Juan de la Maguana"],
                    ["id" => "123", "name" => "Vallejuelo"],
                ]
            ],
            [
                "id"     => "27",
                "name"   => "San Pedro de Macorís",
                "cities" => [
                    ["id" => "125", "name" => "Consuelo"],
                    ["id" => "126", "name" => "Guayacanes"],
                    ["id" => "127", "name" => "Quisqueya"],
                    ["id" => "128", "name" => "Ramón Santana"],
                    ["id" => "129", "name" => "San José de Los Llanos"],
                    ["id" => "124", "name" => "San Pedro de Macorís"],
                ]
            ],
            [
                "id"     => "28",
                "name"   => "Sánchez Ramírez",
                "cities" => [
                    ["id" => "131", "name" => "Cevicos"],
                    ["id" => "130", "name" => "Cotuí"],
                    ["id" => "132", "name" => "Fantino"],
                    ["id" => "133", "name" => "La Mata"],
                ]
            ],
            [
                "id"     => "29",
                "name"   => "Santiago",
                "cities" => [
                    ["id" => "135", "name" => "Bisonó"],
                    ["id" => "136", "name" => "Jánico"],
                    ["id" => "137", "name" => "Licey al Medio"],
                    ["id" => "138", "name" => "Puñal"],
                    ["id" => "139", "name" => "Sabana Iglesia"],
                    ["id" => "140", "name" => "San José de las Matas"],
                    ["id" => "134", "name" => "Santiago"],
                    ["id" => "141", "name" => "Tamboril"],
                    ["id" => "142", "name" => "Villa González"],
                ]
            ],
            [
                "id"     => "30",
                "name"   => "Santiago Rodríguez",
                "cities" => [
                    ["id" => "144", "name" => "Los Almácigos"],
                    ["id" => "145", "name" => "Monción"],
                    ["id" => "143", "name" => "San Ignacio de Sabaneta"],
                ]
            ],
            [
                "id"     => "31",
                "name"   => "Santo Domingo",
                "cities" => [
                    ["id" => "147", "name" => "Boca Chica"],
                    ["id" => "148", "name" => "Los Alcarrizos"],
                    ["id" => "149", "name" => "Pedro Brand"],
                    ["id" => "150", "name" => "San Antonio de Guerra"],
                    ["id" => "146", "name" => "Santo Domingo Este"],
                    ["id" => "151", "name" => "Santo Domingo Norte"],
                    ["id" => "152", "name" => "Santo Domingo Oeste"],
                ]
            ],
            [
                "id"     => "32",
                "name"   => "Valverde",
                "cities" => [
                    ["id" => "154", "name" => "Esperanza"],
                    ["id" => "155", "name" => "Laguna Salada"],
                    ["id" => "153", "name" => "Mao"],
                ]
            ],
        ];

        return $provincias;
    }

    function insertProvinces() {
        global $wpdb;

        $provincias = arrProvincias();
        foreach ($provincias as $provincia) {
            $wpdb->insert('kt_provinces', [
                'id'   => $provincia['id'],
                'name' => $provincia['name'],
            ]);
            $province_id = $wpdb->insert_id;
            
            foreach ($provincia['cities'] as $city) {
                $wpdb->insert('kt_cities', [
                    'id'          => $city['id'],
                    'name'        => $city['name'],
                    'province_id' => $province_id,
                ]);
            }
        }
    }
}

if (!function_exists('getProvincias')) {
    function getProvincias() {
        global $wpdb;
        
        $provincias = [];
        $provinces = $wpdb->get_results('SELECT * FROM kt_provinces', ARRAY_A);
        foreach ($provinces as $province) {
            $cities = $wpdb->get_results('SELECT * FROM kt_cities WHERE province_id = "'.$province['id'].'"', ARRAY_A);

            $provincias[] = [
                'id'     => $province['id'],
                'name'   => $province['name'],
                'cities' => $cities,
            ];
        }

        return $provincias;
    }
}

function getMonths() {
    $arr = [
        '01' => 'Enero',
        '02' => 'Febrero',
        '03' => 'Marzo',
        '04' => 'Abril',
        '05' => 'Mayo',
        '06' => 'Junio',
        '07' => 'Julio',
        '08' => 'Agosto',
        '09' => 'Septiembre',
        '10' => 'Octubre',
        '11' => 'Noviembre',
        '12' => 'Diciembre',
    ];

    return $arr;
}

function getConditions() {
    $arr = [
        'AUSENCIA',
        'PRESENCIA'
    ];

    return $arr;
}

function seguimiento_trampeo() {
    global $wpdb;

    $monitoreo = $wpdb->get_results('SELECT * FROM kt_monitoreo LIMIT 4000, 500', ARRAY_A);
    foreach ($monitoreo as $item) {
        #periodo
        $arr_periodo = explode('-', $item['FECHA']);
        $year = $arr_periodo[0];
        $month = $arr_periodo[1];
        $periodo = wp_insert_term($year, 'monitoreo-periodo');
        if (is_wp_error($periodo)) {
            $periodo = get_term_by('name', $year, 'monitoreo-periodo', ARRAY_A);
        }
        $periodo_id = $periodo['term_id'];
        #tecnico
        $tecnico = wp_insert_term($item['USUARIO'], 'monitoreo-tecnico');
        if (is_wp_error($tecnico)) {
            $tecnico = get_term_by('name', $item['USUARIO'], 'monitoreo-tecnico', ARRAY_A);
        }
        $tecnico_id = $tecnico['term_id'];
        #programa
        $programa = wp_insert_term($item['PROGRAMA'], 'monitoreo-programa');
        if (is_wp_error($programa)) {
            $programa = get_term_by('name', $item['PROGRAMA'], 'monitoreo-programa', ARRAY_A);
        }
        $programa_id = $programa['term_id'];
        #formulario
        // $formulario = wp_insert_term($item['FORMULARIO'], 'monitoreo-formulario');
        // if (is_wp_error($formulario)) {
        //     $formulario = get_term_by('name', $item['FORMULARIO'], 'monitoreo-formulario', ARRAY_A);
        // }
        // $formulario_id = $formulario['term_id'];
        $formulario_id = 21;
        #trampa
        $trampa = wp_insert_term($item['CODIGO_TRAMPA'], 'monitoreo-trampa');
        if (is_wp_error($trampa)) {
            $trampa = get_term_by('name', $item['CODIGO_TRAMPA'], 'monitoreo-trampa', ARRAY_A);
        }
        $trampa_id = $trampa['term_id'];

        #POST
        $post_title = $item['CODIGO_SEGUIMIENTO'] . '-' . $item['PROGRAMA'] . ' ' . $item['CODIGO_TRAMPA'];
        $post_id = wp_insert_post(array (
            'post_type'    => 'monitoreo',
            'post_title'   => $post_title,
            'post_content' => '',
            'post_status'  => 'publish',
        ));

        #META
        $condicion = ($item['PRESENCIA'] == 'SI' ? 'PRESENCIA' : 'AUSENCIA');
        update_field('periodo', $periodo_id, $post_id);
        update_field('mes', $month, $post_id);
        update_field('fecha', $item['FECHA'], $post_id);
        update_field('codigo_seguimiento', $item['CODIGO_SEGUIMIENTO'], $post_id);
        update_field('programa', $programa_id, $post_id);
        update_field('captura', $item['CAPTURA'], $post_id);
        update_field('cantidad', $item['CANTIDAD'], $post_id);
        update_field('latitud', $item['LATITUD'], $post_id);
        update_field('longitud', $item['LONGITUD'], $post_id);
        update_field('altura', $item['CODIGO_SEGUIMIENTO'], $post_id);
        update_field('usuario', $tecnico_id, $post_id);
        update_field('observacion', $item['OBSERVACION'], $post_id);
        update_field('codigo_muestra', $item['CODIGO_MUESTRA'], $post_id);
        update_field('resultado_muestra', $item['RESULTADO_MUESTRA'], $post_id);
        update_field('observacion_muestra', $item['OBSERVACION_MUESTRA'], $post_id);
        update_field('tecnico_laboratorio', $item['TECNICO_LABORATORIO'], $post_id);
        update_field('fecha_analisis', $item['FECHA_ANALISIS'], $post_id);
        update_field('metodo_utilizado', $item['METODO_UTILIZADO'], $post_id);
        update_field('presencia', ($item['PRESENCIA'] == 0 ? 'NO' : $item['PRESENCIA']), $post_id);
        update_field('estado', $item['ESTADO'], $post_id);
        update_field('condicion', $condicion, $post_id);
        update_field('trampa', $trampa_id, $post_id);
        update_field('formulario', $formulario_id, $post_id);
    }

    var_dump(date('YmdHis'));
    wp_die();
}

function formulario_exploracion() {
    global $wpdb;

    $monitoreo = $wpdb->get_results('SELECT * FROM kt_formulario LIMIT 0, 500', ARRAY_A);
    foreach ($monitoreo as $item) {
        #periodo
        $arr_periodo = explode('-', $item['fecha']);
        $year = $arr_periodo[0];
        $month = $arr_periodo[1];
        $periodo = wp_insert_term($year, 'monitoreo-periodo');
        if (is_wp_error($periodo)) {
            $periodo = get_term_by('name', $year, 'monitoreo-periodo', ARRAY_A);
        }
        $periodo_id = $periodo['term_id'];
        #tecnico
        $tecnico = wp_insert_term($item['usuario'], 'monitoreo-tecnico');
        if (is_wp_error($tecnico)) {
            $tecnico = get_term_by('name', $item['usuario'], 'monitoreo-tecnico', ARRAY_A);
        }
        $tecnico_id = $tecnico['term_id'];
        #firma
        $firma = wp_insert_term($item['usuario'], 'monitoreo-tecnico');
        if (is_wp_error($firma)) {
            $firma = get_term_by('name', $item['usuario'], 'monitoreo-tecnico', ARRAY_A);
        }
        $firma_id = $firma['term_id'];
        #programa
        // $programa = wp_insert_term($item['PROGRAMA'], 'monitoreo-programa');
        // if (is_wp_error($programa)) {
            $programa = get_term_by('ID', $item['formulario'], 'monitoreo-programa', ARRAY_A);
        // }
        $programa_id = $item['formulario'];
        #formulario
        // $formulario = wp_insert_term($item['FORMULARIO'], 'monitoreo-formulario');
        // if (is_wp_error($formulario)) {
        //     $formulario = get_term_by('name', $item['FORMULARIO'], 'monitoreo-formulario', ARRAY_A);
        // }
        // $formulario_id = $formulario['term_id'];
        $formulario_id = 2;
        #trampa
        // $trampa = wp_insert_term($item['CODIGO_TRAMPA'], 'monitoreo-trampa');
        // if (is_wp_error($trampa)) {
        //     $trampa = get_term_by('name', $item['CODIGO_TRAMPA'], 'monitoreo-trampa', ARRAY_A);
        // }
        // $trampa_id = $trampa['term_id'];
        #formulario
        $incidencia = wp_insert_term($item['incidencia'], 'monitoreo-incidencia');
        if (is_wp_error($incidencia)) {
            $incidencia = get_term_by('name', $item['incidencia'], 'monitoreo-incidencia', ARRAY_A);
        }
        $incidencia_id = $incidencia['term_id'];

        #POST
        $post_title = $item['codigo_seguimiento'] . '-' . $programa['name'] . ' ' . $year;
        $post_id = wp_insert_post(array (
            'post_type'    => 'formulario',
            'post_title'   => $post_title,
            'post_content' => '',
            'post_status'  => 'publish',
        ));

        #META
        update_field('periodo', $periodo_id, $post_id);
        update_field('mes', $month, $post_id);
        update_field('fecha', $item['fecha'], $post_id);
        update_field('codigo_seguimiento', $item['codigo_seguimiento'], $post_id);
        update_field('incidencia', $incidencia_id, $post_id);
        update_field('usuario', $tecnico_id, $post_id);
        update_field('finca', $item['finca'], $post_id);
        update_field('propietario', $item['propietario'], $post_id);
        update_field('telefono', $item['telefono'], $post_id);
        update_field('encargado', $item['encargado'], $post_id);
        update_field('latitud', $item['latitud'], $post_id);
        update_field('longitud', $item['longitud'], $post_id);
        update_field('altura', $item['altura'], $post_id);
        update_field('temperatura', $item['temperatura'], $post_id);
        update_field('presion', $item['presion'], $post_id);
        update_field('humedad', $item['humedad'], $post_id);
        update_field('temperatura_min', $item['temperatura_min'], $post_id);
        update_field('temperatura_max', $item['temperatura_max'], $post_id);
        update_field('estacion', $item['estacion'], $post_id);
        update_field('area', $item['area'], $post_id);
        update_field('cultivo', $item['cultivo'], $post_id);
        update_field('variedad', $item['variedad'], $post_id);
        update_field('fenologia', $item['fenologia'], $post_id);
        update_field('sintomas', $item['sintomas'], $post_id);
        update_field('plagas', $item['plagas'], $post_id);
        update_field('riego', $item['riego'], $post_id);
        update_field('suelo', $item['suelo'], $post_id);
        update_field('tratamiento', $item['tratamiento'], $post_id);
        update_field('muestra', $item['muestra'], $post_id);
        update_field('recomendacion', $item['recomendacion'], $post_id);
        update_field('sospecha', $item['sospecha'], $post_id);
        update_field('enviar', $item['enviar'], $post_id);
        update_field('urgente', $item['urgente'], $post_id);
        update_field('analisis', $item['analisis'], $post_id);
        update_field('codigo_muestra', $item['codigo_muestra'], $post_id);
        update_field('sede', $item['sede'], $post_id);
        update_field('observacion', $item['observacion'], $post_id);
        update_field('usuario_firma', $firma_id, $post_id);
        update_field('diagnostico', $item['diagnostico'], $post_id);
        update_field('laboratorio_sede', $item['laboratorio_sede'], $post_id);
        update_field('laboratorio_resultado', $item['laboratorio_resultado'], $post_id);
        update_field('laboratorio_observacion', $item['laboratorio_observacion'], $post_id);
        update_field('fecha_diagnostico', $item['fecha_diagnostico'], $post_id);
        update_field('laboratorio_codigo', $item['laboratorio_codigo'], $post_id);
        update_field('tecnico_diagnostico', $item['tecnico_diagnostico'], $post_id);
        update_field('condicion', $item['condicion'], $post_id);
        update_field('programa', $programa_id, $post_id);
        update_field('formulario', $formulario_id, $post_id);
    }

    var_dump(date('YmdHis'));
    wp_die();
}

function fixFormulario() {
    $args = [
        'post_status'    => 'publish',
        'post_type'      => 'monitoreo',
        'posts_per_page' => -1,
    ];
    $query = new WP_Query($args);
    $data = [];
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $data[] = [
                'formulario' => get_field('formulario'),
            ];

            update_field('formulario', 1);
        }
    }
    wp_reset_postdata();
    
    wp_die();
}