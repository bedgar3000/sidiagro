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

$shortcode = get_field('shortcode');
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
                                        <th class="text-center bg-success-light" style="width: 30%;"><?php echo __('Indicador','ktech'); ?></th>
                                        <th class="text-center bg-danger-light text-white" style="width: 20%;"><?php echo __('Presencia de Plaga','ktech'); ?></th>
                                        <th class="text-center bg-danger-light text-white" style="width: 30%;"><?php echo __('Indicador','ktech'); ?></th>
                                    </tr>
                                    <tr>
                                        <td class="text-center bg-success-light">Ausencia</td>
                                        <td class="text-center bg-success-light">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/custom/pin-ausencia.png" alt="" class="img-fluid">
                                        </td>
                                        <td class="text-center bg-danger-light text-white">Presencia</td>
                                        <td class="text-center bg-danger-light text-white">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/custom/pin-presencia.png" alt="" class="img-fluid">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mapa">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/custom/mapa-monitoreo.jpg" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-tabla-info py-5">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr class="table-primary text-white">
                                        <th><?php echo __('NUMERO','ktech'); ?></th>
                                        <th><?php echo __('PROGRAMA','ktech'); ?></th>
                                        <th><?php echo __('PROVINCIA','ktech'); ?></th>
                                        <th><?php echo __('MUNICIPIO','ktech'); ?></th>
                                        <th><?php echo __('CODIGO TRAMPA','ktech'); ?></th>
                                        <th><?php echo __('FECHA','ktech'); ?></th>
                                        <th><?php echo __('USUARIO','ktech'); ?></th>
                                        <th><?php echo __('OBSERVACION','ktech'); ?></th>
                                        <th><?php echo __('CODIGO MUESTRA','ktech'); ?></th>
                                        <th><?php echo __('ESTADO','ktech'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>3997</td>
                                        <td>Tuta absoluta</td>
                                        <td>Azua</td>
                                        <td>Azua de Compostela</td>
                                        <td>PTR3-T6 / San Juan</td>
                                        <td>25/08/2022</td>
                                        <td>Martirez Gomez</td>
                                        <td>Gultivo en abandono</td>
                                        <td>PTR3 T6</td>
                                        <td>4</td>
                                    </tr>
                                    <tr>
                                        <td>3997</td>
                                        <td>Tuta absoluta</td>
                                        <td>Azua</td>
                                        <td>Azua de Compostela</td>
                                        <td>PTR3-T6 / San Juan</td>
                                        <td>25/08/2022</td>
                                        <td>Martirez Gomez</td>
                                        <td>Gultivo en abandono</td>
                                        <td>PTR3 T6</td>
                                        <td>4</td>
                                    </tr>
                                    <tr>
                                        <td>3997</td>
                                        <td>Tuta absoluta</td>
                                        <td>Azua</td>
                                        <td>Azua de Compostela</td>
                                        <td>PTR3-T6 / San Juan</td>
                                        <td>25/08/2022</td>
                                        <td>Martirez Gomez</td>
                                        <td>Gultivo en abandono</td>
                                        <td>PTR3 T6</td>
                                        <td>4</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="btn-actions">
                            <a href="#" class="btn btn-danger btn-lg text-white">
                                <i class="icon icon-pdf-white"></i>
                                <span><?php echo __('DESCARGAR PDF','ktech'); ?></span>
                            </a>
                            <a href="#" class="btn btn-success btn-lg text-white">
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
