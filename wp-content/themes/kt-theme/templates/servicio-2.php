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
$formularios = [
    1 => 'Seguimiento Trampeo',
    2 => 'Formulario de Exploración',
];
$formulario_id = 1;
$_formulario = (empty($_GET['tipo_formulario']) ? $formulario_id : $_GET['tipo_formulario']);

if ($_formulario == 1) {
    get_template_part('template-parts/servicio-2-trampeo', null, []);
} else {
    get_template_part('template-parts/servicio-2-formulario', null, []);
}