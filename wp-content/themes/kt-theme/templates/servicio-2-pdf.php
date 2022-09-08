<?php
/**
 * Template Name: KT Servicio Monitoreo (PDF)
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package KT Solutions
 * @subpackage Ktech Theme
 * @version 1.0.0
 */

require get_template_directory() . '/vendor/autoload.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

$html = '';
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

$html .= '
<style>
    th, td {
        padding: 5px;
        font-size: 8px;
    }

    th {
        font-weight: 700;
    }
</style>
<table style="width: 100%; border-collapse: collapse;" border="1">
    <thead>
        <tr>
            <th>' . __('NUMERO','ktech') . ' </th>
            <th>' . __('CODIGO SEGUIMIENTO','ktech') . ' </th>
            <th style="min-width: 125px;">' . __('PROGRAMA','ktech') . ' </th>
            <th>' . __('CODIGO TRAMPA','ktech') . ' </th>
            <th>' . __('FECHA','ktech') . ' </th>
            <th>' . __('CAPTURA','ktech') . ' </th>
            <th>' . __('CANTIDAD','ktech') . ' </th>
            <th>' . __('LATITUD','ktech') . ' </th>
            <th>' . __('LONGITUD','ktech') . ' </th>
            <th>' . __('ALTURA','ktech') . ' </th>
            <th style="min-width: 175px;">' . __('USUARIO','ktech') . ' </th>
            <th style="min-width: 175px;">' . __('OBSERVACION','ktech') . ' </th>
            <th>' . __('CODIGO MUESTRA','ktech') . ' </th>
            <th style="min-width: 175px;">' . __('RESULTADO DE MUESTRA','ktech') . ' </th>
            <th style="min-width: 175px;">' . __('OBSERVACION DE LA MUESTRA','ktech') . ' </th>
            <th style="min-width: 175px;">' . __('TECNICO DE LABORATORIO','ktech') . ' </th>
            <th>' . __('FECHA DE ANALISIS','ktech') . ' </th>
            <th>' . __('METODO UTILIZADO','ktech') . ' </th>
            <th>' . __('PRESENCIA','ktech') . ' </th>
            <th>' . __('ESTADO','ktech') . ' </th>
        </tr>
    </thead>
';

$html .= '<tbody>';
$i = 0;
foreach ($data as $item) {
    $html .= '
        <tr>
            <td>' . ++$i . '</td>
            <td>' . $item['codigo_seguimiento'] . '</td>
            <td>' . $item['programa']->name . '</td>
            <td>' . $item['trampa']->name . '</td>
            <td>' . $item['fecha'] . '</td>
            <td>' . $item['captura'] . '</td>
            <td>' . $item['cantidad'] . '</td>
            <td>' . $item['latitud'] . '</td>
            <td>' . $item['longitud'] . '</td>
            <td>' . $item['altura'] . '</td>
            <td>' . $item['usuario']->name . '</td>
            <td>' . $item['observacion'] . '</td>
            <td>' . $item['codigo_muestra'] . '</td>
            <td>' . $item['resultado_muestra'] . '</td>
            <td>' . $item['observacion_muestra'] . '</td>
            <td>' . $item['tecnico_laboratorio'] . '</td>
            <td>' . $item['fecha_analisis'] . '</td>
            <td>' . $item['metodo_utilizado'] . '</td>
            <td>' . $item['presencia'] . '</td>
            <td>' . $item['estado'] . '</td>
        </tr>
    ';
}
$html .= '</tbody>';
$html .= '</table>';

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
// $dompdf->setPaper('A4', 'landscape');
$dompdf->setPaper([0,0,1500,360]);

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$fileName = "export_" . date('YmdHis') . ".xlsx";
$dompdf->stream($fileName);