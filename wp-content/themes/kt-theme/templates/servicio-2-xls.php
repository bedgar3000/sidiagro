<?php
/**
 * Template Name: KT Servicio Monitoreo (XLS)
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package KT Solutions
 * @subpackage Ktech Theme
 * @version 1.0.0
 */

require get_template_directory() . '/vendor/autoload.php';

use Spatie\SimpleExcel\SimpleExcelWriter;

$_periodo = (empty($_GET['periodo']) ? $periodo_id : $_GET['periodo']);
$_mes = (empty($_GET['mes']) ? date('n') : $_GET['mes']);
$_programa = (empty($_GET['programa']) ? $programa_id : $_GET['programa']);
$_formulario = (empty($_GET['formulario']) ? $formulario_id : $_GET['formulario']);
$_trampa = (empty($_GET['trampa']) ? '' : $_GET['trampa']);
$_tecnico = (empty($_GET['tecnico']) ? '' : $_GET['tecnico']);
$_condicion = (empty($_GET['condicion']) ? '' : $_GET['condicion']);

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
    // 'paged'          => $paged,
];
$query = new WP_Query($args);
$i = 0;
$data = [];
if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        $condicion = get_field('condicion');
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
            'presencia'           => get_field('presencia'),
            'estado'              => get_field('estado'),
            'formulario'          => get_field('formulario'),
            'condicion'           => $condicion,
        ];
    }
}
wp_reset_postdata();

$fileName = "export_" . date('YmdHis') . ".xlsx";
$writer = SimpleExcelWriter::streamDownload($fileName);

foreach ($data as $item) {
    $writer->addRow([
        'NUMERO'                    => ++$i,
        'CODIGO SEGUIMIENTO'        => $item['codigo_seguimiento'],
        'PROGRAMA'                  => $item['programa']->name,
        'CODIGO TRAMPA'             => $item['trampa']->name,
        'FECHA'                     => $item['fecha'],
        'CAPTURA'                   => $item['captura'],
        'CANTIDAD'                  => $item['cantidad'],
        'LATITUD'                   => $item['latitud'],
        'LONGITUD'                  => $item['longitud'],
        'ALTURA'                    => $item['altura'],
        'USUARIO'                   => $item['usuario']->name,
        'OBSERVACION'               => $item['observacion'],
        'CODIGO MUESTRA'            => $item['codigo_muestra'],
        'RESULTADO DE MUESTRA'      => $item['resultado_muestra'],
        'OBSERVACION DE LA MUESTRA' => $item['observacion_muestra'],
        'TECNICO DE LABORATORIO'    => $item['tecnico_laboratorio'],
        'FECHA DE ANALISIS'         => $item['fecha_analisis'],
        'METODO UTILIZADO'          => $item['metodo_utilizado'],
        'PRESENCIA'                 => $item['presencia'],
        'ESTADO'                    => $item['estado'],
    ]);
}

$writer->toBrowser();



