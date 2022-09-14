<?php
/**
 * Template Name: KT Servicio Monitoreo
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package KT Solutions
 * @subpackage Ktech Theme
 * @version 1.0.0
 */
global $wp;
$current_url = home_url( add_query_arg( array(), $wp->request ) );

$shortcode = get_field('shortcode');

$periodos = get_terms('monitoreo-periodo', [
    'hide_empty' => false,
]);
$programas = get_terms('monitoreo-programa', [
    'hide_empty' => false,
]);
$formularios = [
    1 => 'Seguimiento Trampeo',
    2 => 'Formulario de Exploración',
];

$periodo_id = (empty($periodos[0]->term_id) ? '' : $periodos[0]->term_id);
$programa_id = (empty($programas[0]->term_id) ? '' : $programas[0]->term_id);
$formulario_id = 1;

$_periodo = (empty($_GET['periodo']) ? $periodo_id : $_GET['periodo']);
$_mes = (empty($_GET['mes']) ? '' : $_GET['mes']);
$_programa = (empty($_GET['programa']) ? $programa_id : $_GET['programa']);
$_formulario = (empty($_GET['tipo_formulario']) ? $formulario_id : $_GET['tipo_formulario']);
$_trampa = (empty($_GET['trampa']) ? '' : $_GET['trampa']);
$_incidencia = (empty($_GET['incidencia']) ? '' : $_GET['incidencia']);
$_tecnico = (empty($_GET['tecnico']) ? '' : $_GET['tecnico']);
$_condicion = (empty($_GET['condicion']) ? '' : $_GET['condicion']);
?>

<?php
// $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$meta_query = [];
if (!empty($_periodo)) {
    $meta_query[] = [
        'key'     =>  'periodo',
        'value'   =>  $_periodo,
        'compare' =>  '='
    ];
}
if (!empty($_mes)) {
    $meta_query[] = [
        'key'     =>  'mes',
        'value'   =>  $_mes,
        'compare' =>  '='
    ];
}
if (!empty($_programa)) {
    $meta_query[] = [
        'key'     =>  'programa',
        'value'   =>  $_programa,
        'compare' =>  '='
    ];
}
if (!empty($_formulario)) {
    $meta_query[] = [
        'key'     =>  'formulario',
        'value'   =>  $_formulario,
        'compare' =>  '='
    ];
}
if (!empty($_trampa)) {
    $meta_query[] = [
        'key'     =>  'trampa',
        'value'   =>  $_trampa,
        'compare' =>  '='
    ];
}
if (!empty($_incidencia)) {
    $meta_query[] = [
        'key'     =>  'incidencia',
        'value'   =>  $_incidencia,
        'compare' =>  '='
    ];
}
if (!empty($_tecnico)) {
    $meta_query[] = [
        'key'     =>  'tecnico',
        'value'   =>  $_tecnico,
        'compare' =>  '='
    ];
}
if (!empty($_condicion)) {
    $meta_query[] = [
        'key'     =>  'condicion',
        'value'   =>  $_condicion,
        'compare' =>  '='
    ];
}

$args = [
    'post_status'    => 'publish',
    'post_type'      => 'monitoreo',
    'posts_per_page' => -1,
    'meta_query'     => $meta_query,
];
$query = new WP_Query($args);
$i = 0;
$data = [];
if ($query->have_posts()) {
    $count_presencia = 0;
    $count_ausencia = 0;
    while ($query->have_posts()) {
        $query->the_post();
        $condicion = get_field('condicion');
        $presencia = get_field('presencia');
        if ($presencia == 'SI') { $pin = 'danger'; $bg = 'danger'; ++$count_presencia; }
        elseif ($presencia == 'NO') { $pin = 'success'; $bg = 'success'; ++$count_ausencia; }
        else { $pin = 'success'; $bg = ''; }
        $data[] = [
            'periodo'             => get_field('periodo'),
            'mes'                 => get_field('mes'),
            'fecha'               => get_field('fecha'),
            'codigo_seguimiento'  => get_field('codigo_seguimiento'),
            'programa'            => get_field('programa'),
            'trampa'              => get_field('trampa'),
            'captura'             => get_field('captura'),
            'cantidad'            => get_field('cantidad'),
            'latitud'             => get_field('latitud'),
            'longitud'            => get_field('longitud'),
            'altura'              => get_field('altura'),
            'usuario'             => get_field('usuario'),
            'observacion'         => get_field('observacion'),
            'codigo_muestra'      => get_field('codigo_muestra'),
            'resultado_muestra'   => get_field('resultado_muestra'),
            'observacion_muestra' => get_field('observacion_muestra'),
            'tecnico_laboratorio' => get_field('tecnico_laboratorio'),
            'fecha_analisis'      => get_field('fecha_analisis'),
            'metodo_utilizado'    => get_field('metodo_utilizado'),
            'presencia'           => $presencia,
            'estado'              => get_field('estado'),
            'formulario'          => get_field('formulario'),
            'condicion'           => $condicion,
            'pin'                 => $pin,
            'bg'                  => $bg,
        ];
    }
}
wp_reset_postdata();

usort($data, fn($a, $b) => $a['codigo_seguimiento'] <=> $b['codigo_seguimiento']);

// $myArray = [];
// $myArray[] = [
//     'hashtag' => 'a7e87329b5eab8578f4f1098a152d6f4',
//     'title'   => 'Flower',
//     'order'   => '3',
// ];
// $myArray[] = [
//     'hashtag' => 'b24ce0cd392a5b0b8dedc66c25213594',
//     'title'   => 'Free',
//     'order'   => '1',
// ];
// $myArray[] = [
//     'hashtag' => 'e7d31fc0602fb2ede144d18cdffd816b',
//     'title'   => 'Ready',
//     'order'   => '2',
// ];

// usort($myArray, fn($a, $b) => $a['order'] <=> $b['order']);

// var_dump($myArray);
// wp_die();
?>

<?php get_header(); ?>
    <?php get_template_part('template-parts/banners/_banner2', null, []); ?>
    
    <main class="main-page-servicio servicio-2">
        <section class="section-formulario">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <?php echo do_shortcode($shortcode); ?>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="section-mapa">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="leyenda">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th class="text-center bg-success-light" style="width: 20%;"><?php echo __('Ausencia de Plaga','ktech'); ?></th>
                                        <th class="text-center bg-success-light" style="width: 20%;"><?php echo __('Indicador','ktech'); ?></th>
                                        <th class="text-center bg-success-light" style="width: 10%;"><?php echo __('Conteo','ktech'); ?></th>
                                        <th class="text-center bg-danger-light" style="width: 20%;"><?php echo __('Presencia de Plaga','ktech'); ?></th>
                                        <th class="text-center bg-danger-light" style="width: 10%;"><?php echo __('Indicador','ktech'); ?></th>
                                        <th class="text-center bg-danger-light" style="width: 10%;"><?php echo __('Conteo','ktech'); ?></th>
                                    </tr>
                                    <tr>
                                        <td class="text-center bg-success-light">Ausencia</td>
                                        <td class="text-center bg-success-light">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/custom/pin-success.png" alt="" class="img-fluid">
                                        </td>
                                        <td class="text-center bg-success-light"><?php echo $count_ausencia; ?></td>
                                        <td class="text-center bg-danger-light">Presencia</td>
                                        <td class="text-center bg-danger-light">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/custom/pin-danger.png" alt="" class="img-fluid">
                                        </td>
                                        <td class="text-center bg-danger-light"><?php echo $count_presencia; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mapa" id="mapa">
                            <div class="acf-map">
                                <?php foreach ($data as $item): ?>
                                    <div class="marker" data-lat="<?php echo $item['latitud']; ?>" data-lng="<?php echo $item['longitud']; ?>" data-pin="<?php echo $item['pin']; ?>">
                                        <p class="title"><?php echo $item['codigo_seguimiento']; ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="mapModalLabel"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body"></div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-tabla-info py-5">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="table-responsive" style="max-height: 690px;">
                            <table class="table table-striped">
                                <thead>
                                    <tr class="table-primary text-white">
                                        <th><?php echo __('NUMERO','ktech'); ?></th>
                                        <th><?php echo __('CODIGO SEGUIMIENTO','ktech'); ?></th>
                                        <th style="min-width: 125px;"><?php echo __('PROGRAMA','ktech'); ?></th>
                                        <th><?php echo __('CODIGO TRAMPA','ktech'); ?></th>
                                        <th><?php echo __('FECHA','ktech'); ?></th>
                                        <th><?php echo __('CAPTURA','ktech'); ?></th>
                                        <th><?php echo __('CANTIDAD','ktech'); ?></th>
                                        <th><?php echo __('LATITUD','ktech'); ?></th>
                                        <th><?php echo __('LONGITUD','ktech'); ?></th>
                                        <th><?php echo __('ALTURA','ktech'); ?></th>
                                        <th style="min-width: 175px;"><?php echo __('USUARIO','ktech'); ?></th>
                                        <th style="min-width: 175px;"><?php echo __('OBSERVACION','ktech'); ?></th>
                                        <th><?php echo __('CODIGO MUESTRA','ktech'); ?></th>
                                        <th style="min-width: 175px;"><?php echo __('RESULTADO DE MUESTRA','ktech'); ?></th>
                                        <th style="min-width: 175px;"><?php echo __('OBSERVACION DE LA MUESTRA','ktech'); ?></th>
                                        <th style="min-width: 175px;"><?php echo __('TECNICO DE LABORATORIO','ktech'); ?></th>
                                        <th><?php echo __('FECHA DE ANALISIS','ktech'); ?></th>
                                        <th><?php echo __('METODO UTILIZADO','ktech'); ?></th>
                                        <th><?php echo __('PRESENCIA','ktech'); ?></th>
                                        <th><?php echo __('ESTADO','ktech'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $item): ?>
                                        <tr class="table-<?php echo $item['bg']; ?>">
                                            <td><?php echo ++$i; ?></td>
                                            <td><?php echo $item['codigo_seguimiento']; ?></td>
                                            <td><?php echo $item['programa']->name; ?></td>
                                            <td><?php echo $item['trampa']->name; ?></td>
                                            <td><?php echo $item['fecha']; ?></td>
                                            <td><?php echo $item['captura']; ?></td>
                                            <td><?php echo $item['cantidad']; ?></td>
                                            <td><?php echo $item['latitud']; ?></td>
                                            <td><?php echo $item['longitud']; ?></td>
                                            <td><?php echo $item['altura']; ?></td>
                                            <td><?php echo $item['usuario']->name; ?></td>
                                            <td><?php echo $item['observacion']; ?></td>
                                            <td><?php echo $item['codigo_muestra']; ?></td>
                                            <td><?php echo $item['resultado_muestra']; ?></td>
                                            <td><?php echo $item['observacion_muestra']; ?></td>
                                            <td><?php echo $item['tecnico_laboratorio']; ?></td>
                                            <td><?php echo $item['fecha_analisis']; ?></td>
                                            <td><?php echo $item['metodo_utilizado']; ?></td>
                                            <td><?php echo $item['presencia']; ?></td>
                                            <td><?php echo $item['estado']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="btn-actions">
                            <a target="_blank" href="<?php echo $current_url; ?>/pdf?periodo=<?php echo $_periodo; ?>&mes=<?php echo $_mes; ?>&programa=<?php echo $_programa; ?>&formulario=<?php echo $_formulario; ?>&trampa=<?php echo $_trampa; ?>&tecnico=<?php echo $_tecnico; ?>&condicion=<?php echo $_condicion; ?>" class="btn btn-danger btn-lg text-white">
                                <i class="icon icon-pdf-white"></i>
                                <span><?php echo __('DESCARGAR PDF','ktech'); ?></span>
                            </a>
                            <a target="_blank" href="<?php echo $current_url; ?>/excel?periodo=<?php echo $_periodo; ?>&mes=<?php echo $_mes; ?>&programa=<?php echo $_programa; ?>&formulario=<?php echo $_formulario; ?>&trampa=<?php echo $_trampa; ?>&tecnico=<?php echo $_tecnico; ?>&condicion=<?php echo $_condicion; ?>" class="btn btn-success btn-lg text-white">
                                <i class="icon icon-pdf-white"></i>
                                <span><?php echo __('DESCARGAR EXCEL','ktech'); ?></span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="line my-5"></div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php get_footer(); ?>
