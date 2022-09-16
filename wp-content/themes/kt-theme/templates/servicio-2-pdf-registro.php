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
$formulario = get_field('formulario', $post->ID);

if ($formulario == 1) {
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
        'formulario'          => $formulario,
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
            td {
                height: 25px;
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
        </table>
    ';
} else {
    $condicion = get_field('condicion', $post->ID);
    $presencia = get_field('presencia', $post->ID);
    $data = [
        'periodo'                 => get_field('periodo', $post->ID),
        'mes'                     => get_field('mes', $post->ID),
        'fecha'                   => get_field('fecha', $post->ID),
        'codigo_seguimiento'      => get_field('codigo_seguimiento', $post->ID),
        'incidencia'              => get_field('incidencia', $post->ID),
        'usuario'                 => get_field('usuario', $post->ID),
        'finca'                   => get_field('finca', $post->ID),
        'propietario'             => get_field('propietario', $post->ID),
        'telefono'                => get_field('telefono', $post->ID),
        'encargado'               => get_field('encargado', $post->ID),
        'latitud'                 => get_field('latitud', $post->ID),
        'longitud'                => get_field('longitud', $post->ID),
        'altura'                  => get_field('altura', $post->ID),
        'temperatura'             => get_field('temperatura', $post->ID),
        'presion'                 => get_field('presion', $post->ID),
        'humedad'                 => get_field('humedad', $post->ID),
        'temperatura_min'         => get_field('temperatura_min', $post->ID),
        'temperatura_max'         => get_field('temperatura_max', $post->ID),
        'estacion'                => get_field('estacion', $post->ID),
        'area'                    => get_field('area', $post->ID),
        'cultivo'                 => get_field('cultivo', $post->ID),
        'variedad'                => get_field('variedad', $post->ID),
        'fenologia'               => get_field('fenologia', $post->ID),
        'sintomas'                => get_field('sintomas', $post->ID),
        'plagas'                  => get_field('plagas', $post->ID),
        'riego'                   => get_field('riego', $post->ID),
        'suelo'                   => get_field('suelo', $post->ID),
        'tratamiento'             => get_field('tratamiento', $post->ID),
        'muestra'                 => get_field('muestra', $post->ID),
        'recomendacion'           => get_field('recomendacion', $post->ID),
        'sospecha'                => get_field('sospecha', $post->ID),
        'enviar'                  => get_field('enviar', $post->ID),
        'urgente'                 => get_field('urgente', $post->ID),
        'analisis'                => get_field('analisis', $post->ID),
        'codigo_muestra'          => get_field('codigo_muestra', $post->ID),
        'sede'                    => get_field('sede', $post->ID),
        'observacion'             => get_field('observacion', $post->ID),
        'usuario_firma'           => get_field('usuario_firma', $post->ID),
        'diagnostico'             => get_field('diagnostico', $post->ID),
        'laboratorio_sede'        => get_field('laboratorio_sede', $post->ID),
        'laboratorio_resultado'   => get_field('laboratorio_resultado', $post->ID),
        'laboratorio_observacion' => get_field('laboratorio_observacion', $post->ID),
        'fecha_diagnostico'       => get_field('fecha_diagnostico', $post->ID),
        'laboratorio_codigo'      => get_field('laboratorio_codigo', $post->ID),
        'tecnico_diagnostico'     => get_field('tecnico_diagnostico', $post->ID),
        'condicion'               => get_field('condicion', $post->ID),
        'programa'                => get_field('programa', $post->ID),
        'formulario'              => get_field('formulario', $post->ID),
    ];

    $html = '';

    $html .= '
        <html>
            <head>
                <style>
                    @page { margin: 150px 30px 30px 30px; }
                    #header { position: fixed; left: 0px; top: -105px; right: 0px; height: 100px; }
                    th, td {
                        padding: 2.5px 5px;
                        font-size: 12px;
                    }
                    p {
                        font-size: 12px;
                    }
                    th {
                        font-weight: 700;
                    }
                </style>
            </head>
            <body>
                <div id="header">
                    <h4 style="text-align: center; margin: 0 0;">Departamento de sanidad Vegetal</h4>
                    <p style="text-align: center; margin: 0 0;">Dirección Vigilancia Fitosanitaria</p>
                    <h4 style="text-align: center; margin: 0 0 20px;;">HOJA DE VISITA: FORMULARIO DE EXPLORACIÓN</h4>
        
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
                </div>

                <div id="content">
                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;" border="1">
                        <tr>
                            <td colspan="3"><b>1. Datos generales del usuario/Encargado:</b></td>
                        </tr>
                        <tr>
                            <td colspan="3">Nombre de Finca/Lugar: ' . $data['finca'] . '</td>
                        </tr>
                        <tr>
                            <td style="width: 33.33%;">Departamento:</td>
                            <td style="width: 33.33%;">Municipio:</td>
                            <td style="width: 33.33%;">Canton:</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">Nombre de Propietario: ' . $data['propietario'] . '</td>
                        </tr>
                        <tr>
                            <td colspan="2">Nombre de Encargado: ' . $data['encargado'] . '</td>
                            <td style="width: 33.33%;">Telefono: ' . $data['telefono'] . '</td>
                        </tr>
                    </table>
            
                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;" border="1">
                        <tr>
                            <td colspan="3"><b>2. Ubicación geografica</b></td>
                        </tr>
                        <tr>
                            <td style="width: 33.33%;">Longitud:</td>
                            <td style="width: 33.33%;">Latitud:</td>
                            <td style="width: 33.33%;">Altura:</td>
                        </tr>
                        <tr>
                            <td>' . $data['longitud'] . '</td>
                            <td>' . $data['latitud'] . '</td>
                            <td>' . $data['altura'] . '</td>
                        </tr>
                    </table>
            
                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;" border="1">
                        <tr>
                            <td colspan="5"><b>3. Estacion Climatica: Estación seca</b></td>
                        </tr>
                        <tr>
                            <td style="width: 20%; text-align: center;"><small><b>Temperatura:</b></small></td>
                            <td style="width: 20%; text-align: center;"><small><b>Presión atmosférica:</b></small></td>
                            <td style="width: 20%; text-align: center;"><small><b>Humedad:</b></small></td>
                            <td style="width: 20%; text-align: center;"><small><b>Temperatura Minima:</b></small></td>
                            <td style="width: 20%; text-align: center;"><small><b>Temperatura Maxima:</b></small></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;"><small>&nbsp; ' . $data['temperatura'] . ' &nbsp;</small></td>
                            <td style="text-align: center;"><small>&nbsp; ' . $data['presion'] . ' &nbsp;</small></td>
                            <td style="text-align: center;"><small>&nbsp; ' . $data['humedad'] . ' &nbsp;</small></td>
                            <td style="text-align: center;"><small>&nbsp; ' . $data['temperatura_min'] . ' &nbsp;</small></td>
                            <td style="text-align: center;"><small>&nbsp; ' . $data['temperatura_max'] . ' &nbsp;</small></td>
                        </tr>
                    </table>
            
                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;" border="1">
                        <tr>
                            <td colspan="2"><b>4. Características de la unidad de producción:</b></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Área (mz):</td>
                            <td>' . $data['area'] . '</td>
                        </tr>
                        <tr>
                            <td>Cultivo:</td>
                            <td>' . $data['cultivo'] . '</td>
                        </tr>
                        <tr>
                            <td>Variedad:</td>
                            <td>' . $data['variedad'] . '</td>
                        </tr>
                        <tr>
                            <td>Fenología:</td>
                            <td>' . $data['fenologia'] . '</td>
                        </tr>
                        <tr>
                            <td>Síntomas:</td>
                            <td>' . $data['sintomas'] . '</td>
                        </tr>
                        <tr>
                            <td>Plagas observadas:</td>
                            <td>' . $data['plagas'] . '</td>
                        </tr>
                        <tr>
                            <td>Incidencia/Infestación:</td>
                            <td>' . $data['incidencia']->name . '</td>
                        </tr>
                        <tr>
                            <td>Tipo de Riego::</td>
                            <td>' . $data['riego'] . '</td>
                        </tr>
                        <tr>
                            <td>Tipo de Suelo::</td>
                            <td>' . $data['suelo'] . '</td>
                        </tr>
                        <tr>
                            <td>Tratamiento Efectuado:</td>
                            <td>' . $data['tratamiento'] . '</td>
                        </tr>
                        <tr>
                            <td>Tipo de Muestra:</td>
                            <td>' . $data['muestra'] . '</td>
                        </tr>
                        <tr>
                            <td>Recomendación:</td>
                            <td>' . $data['recomendacion'] . '</td>
                        </tr>
                    </table>
            
                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;" border="1">
                        <tr>
                            <td colspan="2"><b>6. Datos Laboratorio:</b></td>
                        </tr>
                        <tr>
                            <td>Envio Muestra:</td>
                            <td>' . $data['muestra'] . '</td>
                        </tr>
                        <tr>
                            <td>Urgente:</td>
                            <td>' . $data['urgente'] . '</td>
                        </tr>
                        <tr>
                            <td>Tipo de Analisis:</td>
                            <td>' . $data['analisis'] . '</td>
                        </tr>
                        <tr>
                            <td>Codigo de Muestra:</td>
                            <td>' . $data['codigo_muestra'] . '</td>
                        </tr>
                        <tr>
                            <td>Sede de Laboratorio Enviado:</td>
                            <td>' . $data['laboratorio_sede'] . '</td>
                        </tr>
                    </table>
            
                    <div style="page-break-before: always;"></div>
            
                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;" border="0">
                        <tr>
                            <td><b>7. Observaciones:</b></td>
                        </tr>
                        <tr>
                            <td>' . $data['observacion'] . '</td>
                        </tr>
                    </table>

                    <p style="text-align: center;">------------------------------------------------------------------------------------------------------------------------------------------</p>

                    <p style="text-align: center;"><b>Puntos de Seguimiento Exploración:</b></p>
            
                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;" border="1">
                        <tr>
                            <td style="text-align: center; width: 7%;"><b>No.</b></td>
                            <td style="text-align: center; width: 31%;"><b>Latitud</b></td>
                            <td style="text-align: center; width: 31%;"><b>Longitud</b></td>
                            <td style="text-align: center; width: 31%;"><b>Sospecha</b></td>
                        </tr>
                        <tr><td style="text-align: center;"><b>1</b></td><td></td><td></td><td></td></tr>
                        <tr><td style="text-align: center;"><b>2</b></td><td></td><td></td><td></td></tr>
                        <tr><td style="text-align: center;"><b>3</b></td><td></td><td></td><td></td></tr>
                        <tr><td style="text-align: center;"><b>4</b></td><td></td><td></td><td></td></tr>
                        <tr><td style="text-align: center;"><b>5</b></td><td></td><td></td><td></td></tr>
                        <tr><td style="text-align: center;"><b>6</b></td><td></td><td></td><td></td></tr>
                        <tr><td style="text-align: center;"><b>7</b></td><td></td><td></td><td></td></tr>
                        <tr><td style="text-align: center;"><b>8</b></td><td></td><td></td><td></td></tr>
                        <tr><td style="text-align: center;"><b>9</b></td><td></td><td></td><td></td></tr>
                        <tr><td style="text-align: center;"><b>10</b></td><td></td><td></td><td></td></tr>
                        <tr><td style="text-align: center;"><b>11</b></td><td></td><td></td><td></td></tr>
                        <tr><td style="text-align: center;"><b>12</b></td><td></td><td></td><td></td></tr>
                        <tr><td style="text-align: center;"><b>13</b></td><td></td><td></td><td></td></tr>
                        <tr><td style="text-align: center;"><b>14</b></td><td></td><td></td><td></td></tr>
                        <tr><td style="text-align: center;"><b>15</b></td><td></td><td></td><td></td></tr>
                        <tr><td style="text-align: center;"><b>16</b></td><td></td><td></td><td></td></tr>
                        <tr><td style="text-align: center;"><b>17</b></td><td></td><td></td><td></td></tr>
                        <tr><td style="text-align: center;"><b>18</b></td><td></td><td></td><td></td></tr>
                        <tr><td style="text-align: center;"><b>19</b></td><td></td><td></td><td></td></tr>
                        <tr><td style="text-align: center;"><b>20</b></td><td></td><td></td><td></td></tr>
                        <tr><td style="text-align: center;"><b>21</b></td><td></td><td></td><td></td></tr>
                        <tr><td style="text-align: center;"><b>22</b></td><td></td><td></td><td></td></tr>
                        <tr><td style="text-align: center;"><b>23</b></td><td></td><td></td><td></td></tr>
                        <tr><td style="text-align: center;"><b>24</b></td><td></td><td></td><td></td></tr>
                        <tr><td style="text-align: center;"><b>25</b></td><td></td><td></td><td></td></tr>
                        <tr><td style="text-align: center;"><b>26</b></td><td></td><td></td><td></td></tr>
                        <tr><td style="text-align: center;"><b>27</b></td><td></td><td></td><td></td></tr>
                        <tr><td style="text-align: center;"><b>28</b></td><td></td><td></td><td></td></tr>
                        <tr><td style="text-align: center;"><b>29</b></td><td></td><td></td><td></td></tr>
                        <tr><td style="text-align: center;"><b>30</b></td><td></td><td></td><td></td></tr>
                    </table>

                    <div style="page-break-before: always;"></div>
            
                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 5px;" border="1">
                        <tr>
                            <td style="width: 50%;">
                                <b>Firma:</b>
                            </td>
                            <td style="width: 50%;">
                                <b>Firma:</b>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">
                                <b>Nombre de tecnico: ' . $data['usuario_firma']->name . '</b>
                            </td>
                            <td style="width: 50%;">
                                <b>Nombre de Usuario: ' . $data['usuario']->name . '</b>
                            </td>
                        </tr>
                    </table>

                    <p style="margin: 0 0 10px; text-align: right;"><b>Hora ingreso sistema: ' . $data['fecha'] . '</b></p>
            
                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;" border="1">
                        <tr>
                            <td>
                                <b>8. Diagnostico Laboratorio: ' . $data['laboratorio_resultado'] . '</b>
                            </td>
                        </tr>
                    </table>
                </div>
            </body>
        </html>
    ';
}

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
// $dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$fileName = "export_" . date('YmdHis') . ".pdf";
$dompdf->stream($fileName, array("Attachment" => false));