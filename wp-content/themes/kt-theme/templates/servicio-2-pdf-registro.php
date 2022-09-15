<?php
/**
 * Template Name: KT Servicio Monitoreo (PDF Registro)
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

$post = get_post($_GET['codigo']);
$condicion = get_field('condicion', $post->ID);
$presencia = get_field('presencia', $post->ID);
$data = [
    'periodo'             => get_field('periodo', $post->ID),
    'mes'                 => get_field('mes', $post->ID),
    'fecha'               => get_field('fecha', $post->ID),
    'codigo_seguimiento'  => get_field('codigo_seguimiento', $post->ID),
    'programa'            => get_field('programa', $post->ID),
    'trampa'              => get_field('trampa', $post->ID),
    'captura'             => get_field('captura', $post->ID),
    'cantidad'            => get_field('cantidad', $post->ID),
    'latitud'             => get_field('latitud', $post->ID),
    'longitud'            => get_field('longitud', $post->ID),
    'altura'              => get_field('altura', $post->ID),
    'usuario'             => get_field('usuario', $post->ID),
    'observacion'         => get_field('observacion', $post->ID),
    'codigo_muestra'      => get_field('codigo_muestra', $post->ID),
    'resultado_muestra'   => get_field('resultado_muestra', $post->ID),
    'observacion_muestra' => get_field('observacion_muestra', $post->ID),
    'tecnico_laboratorio' => get_field('tecnico_laboratorio', $post->ID),
    'fecha_analisis'      => get_field('fecha_analisis', $post->ID),
    'metodo_utilizado'    => get_field('metodo_utilizado', $post->ID),
    'presencia'           => $presencia,
    'estado'              => get_field('estado', $post->ID),
    'formulario'          => get_field('formulario', $post->ID),
    'condicion'           => $condicion,
];

$html = '';

$html .= '
<style>
    th, td {
        padding: 5px;
        font-size: 12px;
    }
    th {
        font-weight: 700;
    }
</style>

<h4 style="text-align: center; margin: 0 0;">Departamento de sanidad Vegetal</h4>
<p style="text-align: center; margin: 0 0;">Dirección Vigilancia Fitosanitaria</p>
<h4 style="text-align: center; margin: 0 0 20px;;">HOJA DE SEGUIMIENTO DE TRAMPEO:</h4>

<table style="width: 100%;">
    <tr>
        <th style="width: 33.3%; text-align: center;">
            NUMERO: ' . $data['codigo_seguimiento'] . '
        </th>
        <th style="width: 33.3%; text-align: center;"></th>
        <th style="width: 33.3%; text-align: center;">
            FECHA: ' . $data['fecha'] . '
        </th>
    <tr>
</table>

<table style="width: 100%; border-collapse: collapse;" border="1">
    <tr>
        <td style="width: 30%;">' . __('CODIGO SEGUIMIENTO','ktech') . ' </td>
        <td>' . $data['codigo_seguimiento'] . '</td>
    </tr>
    <tr>
        <td>' . __('PROGRAMA','ktech') . ' </td>
        <td>' . $data['programa']->name . '</td>
    </tr>
    <tr>
        <td>' . __('CODIGO TRAMPA','ktech') . ' </td>
        <td>' . $data['trampa']->name . '</td>
    </tr>
    <tr>
        <td>' . __('FECHA','ktech') . ' </td>
        <td>' . $data['fecha'] . '</td>
    </tr>
    <tr>
        <td>' . __('CAPTURA','ktech') . ' </td>
        <td>' . $data['captura'] . '</td>
    </tr>
    <tr>
        <td>' . __('CANTIDAD','ktech') . ' </td>
        <td>' . $data['cantidad'] . '</td>
    </tr>
    <tr>
        <td>' . __('LATITUD','ktech') . ' </td>
        <td>' . $data['latitud'] . '</td>
    </tr>
    <tr>
        <td>' . __('LONGITUD','ktech') . ' </td>
        <td>' . $data['longitud'] . '</td>
    </tr>
    <tr>
        <td>' . __('ALTURA','ktech') . ' </td>
        <td>' . $data['altura'] . '</td>
    </tr>
    <tr>
        <td>' . __('USUARIO','ktech') . ' </td>
        <td>' . $data['usuario']->name . '</td>
    </tr>
    <tr>
        <td>' . __('OBSERVACION','ktech') . ' </td>
        <td>' . $data['observacion'] . '</td>
    </tr>
    <tr>
        <td>' . __('CODIGO MUESTRA','ktech') . ' </td>
        <td>' . $data['codigo_muestra'] . '</td>
    </tr>
    <tr>
        <td>' . __('RESULTADO DE MUESTRA','ktech') . ' </td>
        <td>' . $data['resultado_muestra'] . '</td>
    </tr>
    <tr>
        <td>' . __('OBSERVACION DE LA MUESTRA','ktech') . ' </td>
        <td>' . $data['observacion_muestra'] . '</td>
    </tr>
    <tr>
        <td>' . __('TECNICO DE LABORATORIO','ktech') . ' </td>
        <td>' . $data['tecnico_laboratorio'] . '</td>
    </tr>
    <tr>
        <td>' . __('FECHA DE ANALISIS','ktech') . ' </td>
        <td>' . $data['fecha_analisis'] . '</td>
    </tr>
    <tr>
        <td>' . __('METODO UTILIZADO','ktech') . ' </td>
        <td>' . $data['metodo_utilizado'] . '</td>
    </tr>
    <tr>
        <td>' . __('PRESENCIA','ktech') . ' </td>
        <td>' . $data['presencia'] . '</td>
    </tr>
</table>';

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
// $dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$fileName = "export_" . date('YmdHis') . ".pdf";
$dompdf->stream($fileName);