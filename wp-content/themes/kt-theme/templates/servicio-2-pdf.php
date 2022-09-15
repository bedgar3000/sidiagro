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

if ($_formulario == 1) {
    if (!empty($_trampa)) {
        $meta_query[] = [
            'key'     =>  'trampa',
            'value'   =>  $_trampa,
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
} else {
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
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $condicion = get_field('condicion');
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
                    <th>' . __('Numero','ktech') . ' </th>
                    <th>' . __('Codigo','ktech') . ' </th>
                    <th>' . __('Incidencia/Infestación','ktech') . ' </th>
                    <th>' . __('Fecha de inspección','ktech') . ' </th>
                    <th style="min-width: 125px;">' . __('Nombre de tecnico','ktech') . ' </th>
                    <th style="min-width: 125px;">' . __('Nombre de Finca/Lugar:','ktech') . ' </th>
                    <th style="min-width: 125px;">' . __('Nombre Propietario:','ktech') . ' </th>
                    <th>' . __('Teléfono:','ktech') . ' </th>
                    <th style="min-width: 150px;">' . __('Nombre del encargado:','ktech') . ' </th>
                    <th>' . __('Latitud','ktech') . ' </th>
                    <th>' . __('Longitud','ktech') . ' </th>
                    <th>' . __('Altura','ktech') . ' </th>
                    <th>' . __('Temperatura','ktech') . ' </th>
                    <th>' . __('Presión','ktech') . ' </th>
                    <th>' . __('Humedad','ktech') . ' </th>
                    <th>' . __('Temperatura minima','ktech') . ' </th>
                    <th>' . __('Temperatura Maxima','ktech') . ' </th>
                    <th>' . __('Estacion climatica','ktech') . ' </th>
                    <th>' . __('Área (mz)','ktech') . ' </th>
                    <th>' . __('Cultivo','ktech') . ' </th>
                    <th>' . __('Variedad','ktech') . ' </th>
                    <th>' . __('Fenología','ktech') . ' </th>
                    <th>' . __('Síntomas','ktech') . ' </th>
                    <th>' . __('Plagas observadas','ktech') . ' </th>
                    <th>' . __('Tipo de Riego','ktech') . ' </th>
                    <th>' . __('Tipo de Suelo','ktech') . ' </th>
                    <th>' . __('Tratamiento Efectuado','ktech') . ' </th>
                    <th>' . __('Tipo de Muestra','ktech') . ' </th>
                    <th>' . __('Recomendación','ktech') . ' </th>
                    <th>' . __('Sospecha?','ktech') . ' </th>
                    <th>' . __('Enviar Muestra?','ktech') . ' </th>
                    <th>' . __('Urgente?:','ktech') . ' </th>
                    <th>' . __('Tipo de Analisis:','ktech') . ' </th>
                    <th style="min-width: 150px;">' . __('Codigo de Muestra','ktech') . ' </th>
                    <th>' . __('Sede de Laboratorio:','ktech') . ' </th>
                    <th style="min-width: 200px;">' . __('Observaciones','ktech') . ' </th>
                    <th style="min-width: 150px;">' . __('Nombre Usuario que firma:','ktech') . ' </th>
                    <th style="min-width: 175px;">' . __('Ya cuentas con el diagnostico de Resultado de labotorio?','ktech') . ' </th>
                    <th style="min-width: 150px;">' . __('Sede de Laboratorio:','ktech') . ' </th>
                    <th style="min-width: 150px;">' . __('Resultado de Laboratorio:','ktech') . ' </th>
                    <th style="min-width: 150px;">' . __('Observacion de Laboratorio:','ktech') . ' </th>
                    <th style="min-width: 150px;">' . __('Fecha de Diagnostico:','ktech') . ' </th>
                    <th style="min-width: 125px;">' . __('Codigo de la muestra Laboratorio:','ktech') . ' </th>
                    <th style="min-width: 150px;">' . __('Tecnico que Diagnostico:','ktech') . ' </th>
                    <th style="min-width: 150px;">' . __('Condicion de Plaga (Status):','ktech') . ' </th>
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
                <td>' . $item['incidencia']->name . '</td>
                <td>' . $item['fecha'] . '</td>
                <td>' . $item['usuario']->name . '</td>
                <td>' . $item['finca'] . '</td>
                <td>' . $item['propietario'] . '</td>
                <td>' . $item['telefono'] . '</td>
                <td>' . $item['encargado'] . '</td>
                <td>' . $item['latitud'] . '</td>
                <td>' . $item['longitud'] . '</td>
                <td>' . $item['altura'] . '</td>
                <td>' . $item['temperatura'] . '</td>
                <td>' . $item['presion'] . '</td>
                <td>' . $item['humedad'] . '</td>
                <td>' . $item['temperatura_min'] . '</td>
                <td>' . $item['temperatura_max'] . '</td>
                <td>' . $item['estacion'] . '</td>
                <td>' . $item['area'] . '</td>
                <td>' . $item['cultivo'] . '</td>
                <td>' . $item['variedad'] . '</td>
                <td>' . $item['fenologia'] . '</td>
                <td>' . $item['sintomas'] . '</td>
                <td>' . $item['plagas'] . '</td>
                <td>' . $item['riego'] . '</td>
                <td>' . $item['suelo'] . '</td>
                <td>' . $item['tratamiento'] . '</td>
                <td>' . $item['muestra'] . '</td>
                <td>' . $item['recomendacion'] . '</td>
                <td>' . $item['sospecha'] . '</td>
                <td>' . $item['enviar'] . '</td>
                <td>' . $item['urgente'] . '</td>
                <td>' . $item['analisis'] . '</td>
                <td>' . $item['codigo_muestra'] . '</td>
                <td>' . $item['sede'] . '</td>
                <td>' . $item['observacion'] . '</td>
                <td>' . $item['usuario_firma']->name . '</td>
                <td>' . $item['diagnostico'] . '</td>
                <td>' . $item['laboratorio_sede'] . '</td>
                <td>' . $item['laboratorio_resultado'] . '</td>
                <td>' . $item['laboratorio_observacion'] . '</td>
                <td>' . $item['fecha_diagnostico'] . '</td>
                <td>' . $item['laboratorio_codigo'] . '</td>
                <td>' . $item['tecnico_diagnostico'] . '</td>
                <td>' . $item['condicion'] . '</td>
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
    $dompdf->setPaper([0,0,3000,360]);
}

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$fileName = "export_" . date('YmdHis') . ".pdf";
$dompdf->stream($fileName);