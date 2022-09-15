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

    $fileName = "export_" . date('YmdHis') . ".xlsx";
    $writer = SimpleExcelWriter::streamDownload($fileName);

    foreach ($data as $item) {
        $writer->addRow([
            'Numero'                                                   => ++$i,
            'Codigo'                                                   => $item['codigo_seguimiento'],
            'Incidencia/Infestación'                                   => $item['incidencia']->name,
            'Fecha de inspección'                                      => $item['fecha'],
            'Nombre de tecnico'                                        => $item['usuario']->name,
            'Nombre de Finca/Lugar'                                    => $item['finca'],
            'Nombre Propietario'                                       => $item['propietario'],
            'Teléfono'                                                 => $item['telefono'],
            'Nombre del encargado'                                     => $item['encargado'],
            'Latitud'                                                  => $item['latitud'],
            'Longitud'                                                 => $item['longitud'],
            'Altura'                                                   => $item['altura'],
            'Temperatura'                                              => $item['temperatura'],
            'Presión'                                                  => $item['presion'],
            'Humedad'                                                  => $item['humedad'],
            'Temperatura minima'                                       => $item['temperatura_min'],
            'Temperatura Maxima'                                       => $item['temperatura_max'],
            'Estacion climatica'                                       => $item['estacion'],
            'Área (mz)'                                                => $item['area'],
            'Cultivo'                                                  => $item['cultivo'],
            'Variedad'                                                 => $item['variedad'],
            'Fenología'                                                => $item['fenologia'],
            'Síntomas'                                                 => $item['sintomas'],
            'Plagas observadas'                                        => $item['plagas'],
            'Tipo de Riego'                                            => $item['riego'],
            'Tipo de Suelo'                                            => $item['suelo'],
            'Tratamiento Efectuado'                                    => $item['tratamiento'],
            'Tipo de Muestra'                                          => $item['muestra'],
            'Recomendación'                                            => $item['recomendacion'],
            'Sospecha?'                                                => $item['sospecha'],
            'Enviar Muestra?'                                          => $item['enviar'],
            'Urgente?'                                                 => $item['urgente'],
            'Tipo de Analisis'                                         => $item['analisis'],
            'Codigo de Muestra'                                        => $item['codigo_muestra'],
            'Sede de Laboratorio'                                      => $item['sede'],
            'Observaciones'                                            => $item['observacion'],
            'Nombre Usuario que firma'                                 => $item['usuario_firma']->name,
            'Ya cuentas con el diagnostico de Resultado de labotorio?' => $item['diagnostico'],
            'Sede de Laboratorio'                                      => $item['laboratorio_sede'],
            'Resultado de Laboratorio'                                 => $item['laboratorio_resultado'],
            'Observacion de Laboratorio'                               => $item['laboratorio_observacion'],
            'Fecha de Diagnostico'                                     => $item['fecha_diagnostico'],
            'Codigo de la muestra Laboratorio'                         => $item['laboratorio_codigo'],
            'Tecnico que Diagnostico'                                  => $item['tecnico_diagnostico'],
            'Condicion de Plaga (Status)'                              => $item['condicion'],
        ]);
    }
}

$writer->toBrowser();



