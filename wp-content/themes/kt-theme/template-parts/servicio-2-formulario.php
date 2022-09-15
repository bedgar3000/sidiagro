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
if (!empty($_incidencia)) {
    $meta_query[] = [
        'key'     =>  'incidencia',
        'value'   =>  $_incidencia,
        'compare' =>  '='
    ];
}

$args = [
    'post_status'    => 'publish',
    'post_type'      => 'formulario',
    'posts_per_page' => -1,
    'meta_query'     => $meta_query,
];
$query = new WP_Query($args);
$i = 0;
$data = [];
$bajo  = 0;
$medio = 0;
$alto  = 0;
if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        $incidencia = get_field('incidencia');
        if ($incidencia->slug == 'opcion-uno') { $pin = 'success'; $bg = 'success'; ++$bajo; }
        elseif ($incidencia->slug == 'opcion-dos') { $pin = 'warning'; $bg = 'warning'; ++$medio; }
        elseif ($incidencia->slug == 'opcion-tres') { $pin = 'danger'; $bg = 'danger'; ++$alto; }
        else { $pin = 'success'; $bg = ''; }
        $data[] = [
            'periodo'                 => get_field('periodo'),
            'mes'                     => get_field('mes'),
            'fecha'                   => get_field('fecha'),
            'codigo_seguimiento'      => get_field('codigo_seguimiento'),
            'incidencia'              => get_field('incidencia'),
            'usuario'                 => get_field('usuario'),
            'finca'                   => get_field('finca'),
            'propietario'             => get_field('propietario'),
            'telefono'                => get_field('telefono'),
            'encargado'               => get_field('encargado'),
            'latitud'                 => get_field('latitud'),
            'longitud'                => get_field('longitud'),
            'altura'                  => get_field('altura'),
            'temperatura'             => get_field('temperatura'),
            'presion'                 => get_field('presion'),
            'humedad'                 => get_field('humedad'),
            'temperatura_min'         => get_field('temperatura_min'),
            'temperatura_max'         => get_field('temperatura_max'),
            'estacion'                => get_field('estacion'),
            'area'                    => get_field('area'),
            'cultivo'                 => get_field('cultivo'),
            'variedad'                => get_field('variedad'),
            'fenologia'               => get_field('fenologia'),
            'sintomas'                => get_field('sintomas'),
            'plagas'                  => get_field('plagas'),
            'riego'                   => get_field('riego'),
            'suelo'                   => get_field('suelo'),
            'tratamiento'             => get_field('tratamiento'),
            'muestra'                 => get_field('muestra'),
            'recomendacion'           => get_field('recomendacion'),
            'sospecha'                => get_field('sospecha'),
            'enviar'                  => get_field('enviar'),
            'urgente'                 => get_field('urgente'),
            'analisis'                => get_field('analisis'),
            'codigo_muestra'          => get_field('codigo_muestra'),
            'sede'                    => get_field('sede'),
            'observacion'             => get_field('observacion'),
            'usuario_firma'           => get_field('usuario_firma'),
            'diagnostico'             => get_field('diagnostico'),
            'laboratorio_sede'        => get_field('laboratorio_sede'),
            'laboratorio_resultado'   => get_field('laboratorio_resultado'),
            'laboratorio_observacion' => get_field('laboratorio_observacion'),
            'fecha_diagnostico'       => get_field('fecha_diagnostico'),
            'laboratorio_codigo'      => get_field('laboratorio_codigo'),
            'tecnico_diagnostico'     => get_field('tecnico_diagnostico'),
            'condicion'               => get_field('condicion'),
            'programa'                => get_field('programa'),
            'formulario'              => get_field('formulario'),
            'pin'                     => $pin,
            'bg'                      => $bg,
        ];
    }
}
wp_reset_postdata();
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
                                        <th class="text-center bg-success-light" style="width: 18%;"><?php echo __('Incidencia/Infestación','ktech'); ?></th>
                                        <th class="text-center bg-success-light" style="width: 8%;"><?php echo __('Indicador','ktech'); ?></th>
                                        <th class="text-center bg-success-light" style="width: 7%;"><?php echo __('Conteo','ktech'); ?></th>
                                        
                                        <th class="text-center bg-warning-light" style="width: 18%;"><?php echo __('Incidencia/Infestación','ktech'); ?></th>
                                        <th class="text-center bg-warning-light" style="width: 8%;"><?php echo __('Indicador','ktech'); ?></th>
                                        <th class="text-center bg-warning-light" style="width: 7%;"><?php echo __('Conteo','ktech'); ?></th>
                                        
                                        <th class="text-center bg-danger-light" style="width: 18%;"><?php echo __('Incidencia/Infestación','ktech'); ?></th>
                                        <th class="text-center bg-danger-light" style="width: 8%;"><?php echo __('Indicador','ktech'); ?></th>
                                        <th class="text-center bg-danger-light" style="width: 7%;"><?php echo __('Conteo','ktech'); ?></th>
                                    </tr>
                                    <tr>
                                        <td class="text-center bg-success-light"><?php echo __('Bajo','ktech'); ?></td>
                                        <td class="text-center bg-success-light">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/custom/pin-success.png" alt="" class="img-fluid">
                                        </td>
                                        <td class="text-center bg-success-light">
                                            <b><?php echo $bajo; ?></b>
                                        </td>
                                        
                                        <td class="text-center bg-warning-light"><?php echo __('Medio','ktech'); ?></td>
                                        <td class="text-center bg-warning-light">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/custom/pin-warning.png" alt="" class="img-fluid">
                                        </td>
                                        <td class="text-center bg-warning-light">
                                            <b><?php echo $medio; ?></b>
                                        </td>
                                        
                                        <td class="text-center bg-danger-light"><?php echo __('Alto','ktech'); ?></td>
                                        <td class="text-center bg-danger-light">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/custom/pin-danger.png" alt="" class="img-fluid">
                                        </td>
                                        <td class="text-center bg-danger-light">
                                            <b><?php echo $alto; ?></b>
                                        </td>
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
                                        <td>Numero</td>
                                        <td>Codigo</td>
                                        <td>Incidencia/Infestación</td>
                                        <td>Fecha de inspección</td>
                                        <td style="min-width: 250px;">Nombre de tecnico</td>
                                        <td style="min-width: 250px;">Nombre de Finca/Lugar:</td>
                                        <td style="min-width: 250px;">Nombre Propietario:</td>
                                        <td>Teléfono:</td>
                                        <td style="min-width: 150px;">Nombre del encargado:</td>
                                        <td>Latitud</td>
                                        <td>Longitud</td>
                                        <td>Altura</td>
                                        <td>Temperatura</td>
                                        <td>Preción</td>
                                        <td>Humedad</td>
                                        <td>Temperatura minima</td>
                                        <td>Temperatura Maxima</td>
                                        <td>Estacion climatica</td>
                                        <td>Área (mz)</td>
                                        <td>Cultivo</td>
                                        <td>Variedad</td>
                                        <td>Fenología</td>
                                        <td>Síntomas</td>
                                        <td>Plagas observadas</td>
                                        <td>Tipo de Riego</td>
                                        <td>Tipo de Suelo</td>
                                        <td>Tratamiento Efectuado</td>
                                        <td>Tipo de Muestra</td>
                                        <td>Recomendación</td>
                                        <td>Sospecha?</td>
                                        <td>Enviar Muestra?</td>
                                        <td>Urgente?:</td>
                                        <td>Tipo de Analisis:</td>
                                        <td style="min-width: 150px;">Codigo de Muestra</td>
                                        <td>Sede de Laboratorio:</td>
                                        <td style="min-width: 300px;">Observaciones</td>
                                        <td style="min-width: 200px;">Nombre Usuario que firma:</td>
                                        <td style="min-width: 250px;">Ya cuentas con el diagnostico de Resultado de labotorio?</td>
                                        <td style="min-width: 150px;">Sede de Laboratorio:</td>
                                        <td style="min-width: 150px;">Resultado de Laboratorio:</td>
                                        <td style="min-width: 150px;">Observacion de Laboratorio:</td>
                                        <td style="min-width: 150px;">Fecha de Diagnostico:</td>
                                        <td style="min-width: 250px;">Codigo de la muestra Laboratorio:</td>
                                        <td style="min-width: 150px;">Tecnico que Diagnostico:</td>
                                        <td style="min-width: 150px;">Condicion de Plaga (Status):</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $item): ?>
                                        <tr class="table-<?php echo $item['bg']; ?>">
                                            <td><?php echo ++$i; ?></td>
                                            <td><?php echo $item['codigo_seguimiento']; ?></td>
                                            <td><?php echo $item['incidencia']->name; ?></td>
                                            <td><?php echo $item['fecha']; ?></td>
                                            <td><?php echo $item['usuario']->name; ?></td>
                                            <td><?php echo $item['finca']; ?></td>
                                            <td><?php echo $item['propietario']; ?></td>
                                            <td><?php echo $item['telefono']; ?></td>
                                            <td><?php echo $item['encargado']; ?></td>
                                            <td><?php echo $item['latitud']; ?></td>
                                            <td><?php echo $item['longitud']; ?></td>
                                            <td><?php echo $item['altura']; ?></td>
                                            <td><?php echo $item['temperatura']; ?></td>
                                            <td><?php echo $item['presion']; ?></td>
                                            <td><?php echo $item['humedad']; ?></td>
                                            <td><?php echo $item['temperatura_min']; ?></td>
                                            <td><?php echo $item['temperatura_max']; ?></td>
                                            <td><?php echo $item['estacion']; ?></td>
                                            <td><?php echo $item['area']; ?></td>
                                            <td><?php echo $item['cultivo']; ?></td>
                                            <td><?php echo $item['variedad']; ?></td>
                                            <td><?php echo $item['fenologia']; ?></td>
                                            <td><?php echo $item['sintomas']; ?></td>
                                            <td><?php echo $item['plagas']; ?></td>
                                            <td><?php echo $item['riego']; ?></td>
                                            <td><?php echo $item['suelo']; ?></td>
                                            <td><?php echo $item['tratamiento']; ?></td>
                                            <td><?php echo $item['muestra']; ?></td>
                                            <td><?php echo $item['recomendacion']; ?></td>
                                            <td><?php echo $item['sospecha']; ?></td>
                                            <td><?php echo $item['enviar']; ?></td>
                                            <td><?php echo $item['urgente']; ?></td>
                                            <td><?php echo $item['analisis']; ?></td>
                                            <td><?php echo $item['codigo_muestra']; ?></td>
                                            <td><?php echo $item['sede']; ?></td>
                                            <td><?php echo $item['observacion']; ?></td>
                                            <td><?php echo $item['usuario_firma']->name; ?></td>
                                            <td><?php echo $item['diagnostico']; ?></td>
                                            <td><?php echo $item['laboratorio_sede']; ?></td>
                                            <td><?php echo $item['laboratorio_resultado']; ?></td>
                                            <td><?php echo $item['laboratorio_observacion']; ?></td>
                                            <td><?php echo $item['fecha_diagnostico']; ?></td>
                                            <td><?php echo $item['laboratorio_codigo']; ?></td>
                                            <td><?php echo $item['tecnico_diagnostico']; ?></td>
                                            <td><?php echo $item['condicion']; ?></td>
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
                            <a target="_blank" href="<?php echo $current_url; ?>/pdf?periodo=<?php echo $_periodo; ?>&mes=<?php echo $_mes; ?>&programa=<?php echo $_programa; ?>&tipo_formulario=<?php echo $_formulario; ?>&trampa=<?php echo $_trampa; ?>&incidencia=<?php echo $_incidencia; ?>&tecnico=<?php echo $_tecnico; ?>&condicion=<?php echo $_condicion; ?>" class="btn btn-danger btn-lg text-white">
                                <i class="icon icon-pdf-white"></i>
                                <span><?php echo __('DESCARGAR PDF','ktech'); ?></span>
                            </a>
                            <a target="_blank" href="<?php echo $current_url; ?>/excel?periodo=<?php echo $_periodo; ?>&mes=<?php echo $_mes; ?>&programa=<?php echo $_programa; ?>&tipo_formulario=<?php echo $_formulario; ?>&trampa=<?php echo $_trampa; ?>&incidencia=<?php echo $_incidencia; ?>&tecnico=<?php echo $_tecnico; ?>&condicion=<?php echo $_condicion; ?>" class="btn btn-success btn-lg text-white">
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
