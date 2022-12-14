<?php

/**
 * Javascript file
 * 
 * Enqueue javascript on the frontend.
 */
function front_ajax_enqueue()
{
    wp_enqueue_script(
        'front-ajax-script',
        get_template_directory_uri() . '/assets/js/front.js?' . date('YmdHis'),
        [],
        false,
        true
    );

    // The wp_localize_script allows us to output the ajax_url path for our script to use.
    wp_localize_script(
        'front-ajax-script',
        'front_ajax_obj',
        array('ajaxurl' => admin_url('admin-ajax.php'))
    );
}
add_action('wp_enqueue_scripts', 'front_ajax_enqueue');

/**
 *  Form Fito
 * 
 * ajax para enviar la data de form fito
 */
function form_fito_callback()
{
    global $wpdb;
    
    $error = false;
    $error_data = [];
    extract($_POST);
    
    //Validate variables not empty
    if (empty($generador_nombre)) {
        $error = true;
        $error_data[] = [
            'input'   => 'generador_nombre',
            'message' => 'nombre requerido'
        ];
    }
    if (empty($generador_email)) {
        $error = true;
        $error_data[] = [
            'input'   => 'generador_email',
            'message' => 'correo electrónico requerido'
        ];
    }
    if (empty($generador_telefono)) {
        $error = true;
        $error_data[] = [
            'input'   => 'generador_telefono',
            'message' => 'teléfono requerido'
        ];
    }

    if ($error) {
        die(json_encode([
            'status'     => 'ERROR',
            'title'      => __('Error al enviar los datos','ktech'),
            'text'       => __('Por favor revise los campos en rojo','ktech'),
            'error_data' => $error_data,
            'data'       => $_POST
        ]));
        wp_die();
    }

    $photos_url = [];
    // for multiple file upload.
    $upload_overrides = array('test_form' => false);
    $files = $_FILES['fotos'];
    foreach ($files['name'] as $key => $value) {
        if ($files['name'][$key]) {
            $file = array(
                'name' => $files['name'][$key],
                'type' => $files['type'][$key],
                'tmp_name' => $files['tmp_name'][$key],
                'error' => $files['error'][$key],
                'size' => $files['size'][$key]
            );

            $photos_url[] = wp_handle_upload($file, $upload_overrides);
        }
    }
    $photos_url_name = '';
    foreach ($photos_url as $key => $value) {
        $photos_url_name .= $value['url'] . ', ';
    }

    //Saved photos in folder wordpress generate zip
    $zip = new ZipArchive();
    WP_Filesystem();
    $destination = wp_upload_dir();
    $destination_path = $destination['basedir'];
    $DelFilePath = date('YmdHis') . '.zip';
    $zip_destination_path = $destination_path . "/" . $DelFilePath;

    if ($zip->open($destination_path . "/" . $DelFilePath, ZIPARCHIVE::CREATE) != TRUE) {
        die("Could not open archive");
    }

    $zip->addEmptyDir('fotos');

    foreach ($photos_url as $key => $file) {
        //get the path to the file
        $path = $file['file'];
        //get the path to the upload directory
        $path_parts = pathinfo($path);
        //get the filename
        $filename = $path_parts['basename'];
        //add it to the zip
        $zip->addFile($path, 'fotos/' . $filename);
    }
    
    //generate url zip
    $url_zip = $destination['baseurl'] . "/" . $DelFilePath;

    $zip->close();
    
    $data = $_POST;
    $data['fotos'] = $photos_url_name;
    $data['zip'] = $url_zip;
    
    $table_name = 'kt_formularios';
    $insert = $wpdb->insert(
        $table_name,
        [
            'form'       => 'servicio-de-vigilancia-fitozoosanitario',
            'data'       => json_encode($data),
            'created_at' => date('Y-m-d H:i:s'),
        ],
        [
            '%s',
            '%s',
            '%s',
        ],
    );
    $lastid = $wpdb->insert_id;
    
    
    //Send email to admin
    $to = 'info@ktechproduccion.net';//get_option('setting_email');
    $subject = 'Notificación Sospecha de Alertas de plaga';
    
    $message = '<h2>Generador del Reporte</h2>';
    $message .= '<p><strong>Nombre y Apellido: </strong>' . $generador_nombre . '</p>';
    $message .= '<p><strong>Teléfono: </strong>' . $generador_telefono . '</p>';  
    $message .= '<p><strong>Correo Electrónico: </strong>' . $generador_email . '</p>';

    $message .= '<h2>Datos de Finca y Propietario</h2>';
    $message .= '<p><strong>Nombre Productor/Encargado: </strong>' . $finca_encargado . '</p>';
    $message .= '<p><strong>Nombre Finca: </strong>' . $finca_nombre . '</p>';  
    $message .= '<p><strong>Teléfono: </strong>' . $finca_telefono . '</p>';

    $message .= '<h2>Dirección de la Finca</h2>';
    $message .= '<p><strong>Provincia: </strong>' . $finca_provincia . '</p>';
    $message .= '<p><strong>Minicipio: </strong>' . $finca_municipio . '</p>';  
    $message .= '<p><strong>Distrito: </strong>' . $finca_distrito . '</p>';
    $message .= '<p><strong>Sección: </strong>' . $finca_seccion . '</p>';
    $message .= '<p><strong>Dirección: </strong>' . $finca_direccion . '</p>';

    $message .= '<h2>Geolocalización áreas con posible infección</h2>';
    $message .= '<p><strong>Latitud: </strong>' . $area_latitud[0] . ' / <strong>Longitud: </strong>' . $area_longitud[0] . ' / <strong>Sospecha de Plaga: </strong>' . $area_sospecha[0] . '</p>';
    $message .= '<p><strong>Latitud: </strong>' . $area_latitud[1] . ' / <strong>Longitud: </strong>' . $area_longitud[1] . ' / <strong>Sospecha de Plaga: </strong>' . $area_sospecha[1] . '</p>';
    $message .= '<p><strong>Latitud: </strong>' . $area_latitud[2] . ' / <strong>Longitud: </strong>' . $area_longitud[2] . ' / <strong>Sospecha de Plaga: </strong>' . $area_sospecha[2] . '</p>';
    $message .= '<p><strong>Latitud: </strong>' . $area_latitud[3] . ' / <strong>Longitud: </strong>' . $area_longitud[3] . ' / <strong>Sospecha de Plaga: </strong>' . $area_sospecha[3] . '</p>';
    $message .= '<p><strong>Latitud: </strong>' . $area_latitud[4] . ' / <strong>Longitud: </strong>' . $area_longitud[4] . ' / <strong>Sospecha de Plaga: </strong>' . $area_sospecha[4] . '</p>';
    $message .= '<p><strong>Características de la Finca y sobre la Sospecha de enfermedad: </strong>' . $area_caracteristicas . '</p>';
    $message .= '<p><strong>Tamaño de la finca: </strong>' . $area_tamano . '</p>';
    $message .= '<p><strong>Cultivo: </strong>' . $area_cultivo . '</p>';

    $message .= '<h2>Fenología</h2>';
    $message .= '<p><strong>Sospecha de Plaga: </strong>' . $fenologia_sospecha . '</p>';
    $message .= '<p><strong>Observaciones: </strong>' . $fenologia_observaciones . '</p>';
    $message .= '<p><strong>Estado Fenológico: </strong>' . $fenologia_estado . '</p>';

    $message .= '<h2>Síntomas</h2>';
    $message .= '<p>' . $fenologia_sintoma . '</p>';

    $message .= '<h2>Plagas Observadas</h2>';
    $message .= '<p>' . $fenologia_plaga . '</p>';

    $message .= '<h2>Fotos</h2>';
    $message .= '<p><a href="' . $url_zip . '">' . $url_zip . '</a></p>';
    
    $headers = array('Content-Type: text/html; charset=UTF-8');
    $mail = wp_mail($to, $subject, $message, $headers);

    die(json_encode([
        'status' => 'OK',
    ]));
    wp_die();
}
add_action('wp_ajax_nopriv_form_fito', 'form_fito_callback');
add_action('wp_ajax_form_fito', 'form_fito_callback');

/**
 * Formulario Fitozoosanitaria
 */
add_shortcode('form-fitozoosanitaria', function () {
    ?>

    <div class="contact-form form-4">
        <form enctype="multipart/form-data" method="POST" id="form-fito">
            <div class="loading-overlay">
                <span class="fas fa-circle-notch fa-3x fa-spin"></span>
            </div>

            <h3 class="form-subtitle"><?php echo __('Generador del Reporte','ktech'); ?></h3>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="generador_nombre" id="generador-nombre" placeholder="<?php echo __('Nombre y Apellido', 'ktech'); ?>" maxlength="191" required>
                </div>

                <div class="form-group col-md-4">
                    <input type="tel" class="form-control" name="generador_telefono" id="generador-telefono" placeholder="<?php echo __('Teléfono', 'ktech'); ?>" maxlength="25" required>
                </div>
                
                <div class="form-group col-md-4">
                    <input type="email" class="form-control" name="generador_email" id="generador-email" placeholder="<?php echo __('Correo Electrónico', 'ktech'); ?>" maxlength="191" required>
                </div>
            </div>
            
            <h3 class="form-subtitle"><?php echo __('Datos de Finca y Propietario','ktech'); ?></h3>
            
            <div class="form-row">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="finca_encargado" id="finca-encargado" placeholder="<?php echo __('Nombre Productor/Encargado', 'ktech'); ?>" maxlength="191" required>
                </div>

                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="finca_nombre" id="finca-nombre" placeholder="<?php echo __('Nombre Finca', 'ktech'); ?>" maxlength="191" required>
                </div>
                
                <div class="form-group col-md-4">
                    <input type="tel" class="form-control" name="finca_telefono" id="finca-telefono" placeholder="<?php echo __('Teléfono', 'ktech'); ?>" maxlength="25" required>
                </div>
            </div>
            
            <h3 class="form-subtitle"><?php echo __('Dirección de la Finca','ktech'); ?></h3>
            
            <div class="form-row">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="finca_provincia" id="finca-provincia" placeholder="<?php echo __('Provincia', 'ktech'); ?>" maxlength="191" required>
                </div>

                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="finca_municipio" id="finca-municipio" placeholder="<?php echo __('Municipio', 'ktech'); ?>" maxlength="191" required>
                </div>
                
                <div class="form-group col-md-4">
                    <input type="tel" class="form-control" name="finca_distrito" id="finca-distrito" placeholder="<?php echo __('Distrito', 'ktech'); ?>" maxlength="191" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="finca_seccion" id="finca-seccion" placeholder="<?php echo __('Sección', 'ktech'); ?>" maxlength="191" required>
                </div>

                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="finca_direccion" id="finca-direccion" placeholder="<?php echo __('Dirección', 'ktech'); ?>" maxlength="191" required>
                </div>
            </div>
            
            <h3 class="form-subtitle"><?php echo __('Geolocalización áreas con posible infección','ktech'); ?></h3>
            
            <div class="form-row align-items-center">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="area_latitud[0]" id="area-latitud-0" placeholder="<?php echo __('Latitud', 'ktech'); ?>" maxlength="25" required>
                </div>

                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="area_longitud[0]" id="area-longitud-0" placeholder="<?php echo __('Longitud', 'ktech'); ?>" maxlength="25" required>
                </div>

                <div class="form-group col-md-4">
                    <label class="mr-3"><?php echo __('Sospecha de Plaga','ktech'); ?></label>
                    
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="area-sospecha-si-0" name="area_sospecha[0]" class="custom-control-input" value="Si" required>
                        <label class="custom-control-label" for="area-sospecha-si-0">Si</label>
                    </div>

                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="area-sospecha-no-0" name="area_sospecha[0]" class="custom-control-input" value="No" required>
                        <label class="custom-control-label" for="area-sospecha-no-0">No</label>
                    </div>
                </div>
            </div>
            
            <div class="form-row align-items-center">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="area_latitud[1]" id="area-latitud-1" placeholder="<?php echo __('Latitud', 'ktech'); ?>" maxlength="25">
                </div>

                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="area_longitud[1]" id="area-longitud-1" placeholder="<?php echo __('Longitud', 'ktech'); ?>" maxlength="25">
                </div>

                <div class="form-group col-md-4">
                    <label class="mr-3"><?php echo __('Sospecha de Plaga','ktech'); ?></label>
                    
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="area-sospecha-si-1" name="area_sospecha[1]" class="custom-control-input" value="Si">
                        <label class="custom-control-label" for="area-sospecha-si-1">Si</label>
                    </div>

                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="area-sospecha-no-1" name="area_sospecha[1]" class="custom-control-input" value="No">
                        <label class="custom-control-label" for="area-sospecha-no-1">No</label>
                    </div>
                </div>
            </div>
            
            <div class="form-row align-items-center">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="area_latitud[2]" id="area-latitud-2" placeholder="<?php echo __('Latitud', 'ktech'); ?>" maxlength="25">
                </div>

                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="area_longitud[2]" id="area-longitud-2" placeholder="<?php echo __('Longitud', 'ktech'); ?>" maxlength="25">
                </div>

                <div class="form-group col-md-4">
                    <label class="mr-3"><?php echo __('Sospecha de Plaga','ktech'); ?></label>
                    
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="area-sospecha-si-2" name="area_sospecha[2]" class="custom-control-input" value="Si">
                        <label class="custom-control-label" for="area-sospecha-si-2">Si</label>
                    </div>

                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="area-sospecha-no-2" name="area_sospecha[2]" class="custom-control-input" value="No">
                        <label class="custom-control-label" for="area-sospecha-no-2">No</label>
                    </div>
                </div>
            </div>
            
            <div class="form-row align-items-center">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="area_latitud[3]" id="area-latitud-3" placeholder="<?php echo __('Latitud', 'ktech'); ?>" maxlength="25">
                </div>

                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="area_longitud[3]" id="area-longitud-3" placeholder="<?php echo __('Longitud', 'ktech'); ?>" maxlength="25">
                </div>

                <div class="form-group col-md-4">
                    <label class="mr-3"><?php echo __('Sospecha de Plaga','ktech'); ?></label>
                    
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="area-sospecha-si-3" name="area_sospecha[3]" class="custom-control-input" value="Si">
                        <label class="custom-control-label" for="area-sospecha-si-3">Si</label>
                    </div>

                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="area-sospecha-no-3" name="area_sospecha[3]" class="custom-control-input" value="No">
                        <label class="custom-control-label" for="area-sospecha-no-3">No</label>
                    </div>
                </div>
            </div>
            
            <div class="form-row align-items-center">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="area_latitud[4]" id="area-latitud-4" placeholder="<?php echo __('Latitud', 'ktech'); ?>" maxlength="25">
                </div>

                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="area_longitud[4]" id="area-longitud-4" placeholder="<?php echo __('Longitud', 'ktech'); ?>" maxlength="25">
                </div>

                <div class="form-group col-md-4">
                    <label class="mr-3"><?php echo __('Sospecha de Plaga','ktech'); ?></label>
                    
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="area-sospecha-si-4" name="area_sospecha[4]" class="custom-control-input" value="Si">
                        <label class="custom-control-label" for="area-sospecha-si-4">Si</label>
                    </div>

                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="area-sospecha-no-4" name="area_sospecha[4]" class="custom-control-input" value="No">
                        <label class="custom-control-label" for="area-sospecha-no-4">No</label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="area-caracteristicas"><?php echo __('Características de la Finca y sobre la Sospecha de enfermedad','ktech'); ?></label>
                    <textarea name="area_caracteristicas" id="area-caracteristicas" rows="10" class="form-control"></textarea>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="area-tamano"><?php echo __('Tamaño de la finca','ktech'); ?></label>
                    <input type="text" class="form-control" name="area_tamano" id="area-tamano" maxlength="191">
                </div>
                
                <div class="form-group col-md-4">
                    <label for="area-cultivo"><?php echo __('Cultivo','ktech'); ?></label>
                    <input type="text" class="form-control" name="area_cultivo" id="area-cultivo" maxlength="191">
                </div>
            </div>
            
            <h3 class="form-subtitle"><?php echo __('Fenología','ktech'); ?></h3>
            
            <div class="form-row align-items-center">
                <div class="form-group col-md-4">
                    <label class="mr-3"><?php echo __('Sospecha de Plaga','ktech'); ?></label>
                    
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="fenologia-sospecha-si" name="fenologia_sospecha" class="custom-control-input" value="Si" required>
                        <label class="custom-control-label" for="fenologia-sospecha-si">Si</label>
                    </div>

                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="fenologia-sospecha-no" name="fenologia_sospecha" class="custom-control-input" value="No" required>
                        <label class="custom-control-label" for="fenologia-sospecha-no">No</label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-8">
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="fenologia-observaciones"><?php echo __('Observaciones','ktech'); ?></label>
                            <textarea name="fenologia_observaciones" id="fenologia-observaciones" rows="10" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="label-title"><?php echo __('Síntomas','ktech'); ?></label>
                            <select name="fenologia_sintoma" id="fenologia-sintoma" class="form-control" required>
                                <option value=""><?php echo __('Seleccione una Sintomatología','ktech'); ?></option>
                                <option value="Achaparramiento">Achaparramiento</option>
                                <option value="Acolchamiento">Acolchamiento</option>
                                <option value="Agallas">Agallas</option>
                                <option value="Amarillamiento">Amarillamiento</option>
                                <option value="Asintomático">Asintomático</option>
                                <option value="Clorosis">Clorosis</option>
                                <option value="Deformación de brotes">Deformación de brotes</option>
                                <option value="Deformaciones foliares">Deformaciones foliares</option>
                                <option value="Mancha Foliar">Mancha Foliar</option>
                                <option value="Manchas foliares">Manchas foliares</option>
                                <option value="Marchites">Marchites</option>
                                <option value="Minar">Minar</option>
                                <option value="Asintomático">Asintomático</option>
                                <option value="Marchites">Marchites</option>
                                <option value="Minas">Minas</option>
                                <option value="Moteado">Moteado</option>
                                <option value="Necrosis">Necrosis</option>
                                <option value="Nódulos Radiculares">Nódulos Radiculares</option>
                                <option value="Pudrición">Pudrición</option>
                                <option value="Asintomático">Asintomático</option>
                            </select>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label class="label-title"><?php echo __('Plagas Observadas','ktech'); ?></label>
                            <select name="fenologia_plaga" id="fenologia-plaga" class="form-control" required>
                                <option value=""><?php echo __('Seleccione una Plaga','ktech'); ?></option>
                                <option value="Aleyrodidae">Aleyrodidae</option>
                                <option value="Anastrepha fraterculus">Anastrepha fraterculus</option>
                                <option value="Aphelenchoides sp.">Aphelenchoides sp.</option>
                                <option value="Aulacaspis tubercularis">Aulacaspis tubercularis</option>
                                <option value="Diplocarpon sp">Diplocarpon sp</option>
                                <option value="Hemiptera Margarodidae">Hemiptera Margarodidae</option>
                                <option value="Acalitus Essig">Acalitus Essig</option>
                                <option value="Acaro">Acaro</option>
                                <option value="Acaro Rojo">Acaro Rojo</option>
                                <option value="Acaros y escamas">Acaros y escamas</option>
                                <option value="Acharia stimulea">Acharia stimulea</option>
                                <option value="Aeneolamia contigua">Aeneolamia contigua</option>
                                <option value="Agromyzidae">Agromyzidae</option>
                                <option value="Aleurocanthus woglumi">Aleurocanthus woglumi</option>
                                <option value="Aleurodicus coccolobae">Aleurodicus coccolobae</option>
                                <option value="Aleurodicus dispersus">Aleurodicus dispersus</option>
                                <option value="Aleurodicus dugesi">Aleurodicus dugesi</option>
                                <option value="Aleurodicus mirabilis">Aleurodicus mirabilis</option>
                                <option value="Aleyrodidae">Aleyrodidae</option>
                                <option value="Alternaria solani">Alternaria solani</option>
                                <option value="Alternaria sp">Alternaria sp</option>
                                <option value="Amarillamiento Letal del Cocotero">Amarillamiento Letal del Cocotero</option>
                                <option value="Anastrepha fraterculus">Anastrepha fraterculus</option>
                                <option value="Anastrepha grandis y otras moscas de la fruta">Anastrepha grandis y otras moscas de la fruta</option>
                                <option value="anastrepha ludens">anastrepha ludens</option>
                                <option value="Anastrepha obliqua">Anastrepha obliqua</option>
                                <option value="Anastrepha striata">Anastrepha striata</option>
                                <option value="Anoplotermes sp.">Anoplotermes sp.</option>
                                <option value="Anthonomus eugenii">Anthonomus eugenii</option>
                                <option value="Antonomus sp">Antonomus sp</option>
                                <option value="Antracnosis">Antracnosis</option>
                                <option value="Aonidiella orientalis">Aonidiella orientalis</option>
                                <option value="Aphelenchoides bessey">Aphelenchoides bessey</option>
                                <option value="Aphelenchus sp">Aphelenchus sp</option>
                                <option value="Aphis gossypil">Aphis gossypil</option>
                                <option value="Aspergillus sp.">Aspergillus sp.</option>
                                <option value="Asperisporium caricae">Asperisporium caricae</option>
                                <option value="Aspidiotus nerii">Aspidiotus nerii</option>
                                <option value="Aulacaspis sp.">Aulacaspis sp.</option>
                                <option value="Aulacaspis yasumatsui">Aulacaspis yasumatsui</option>
                                <option value="Automeris sp">Automeris sp</option>
                                <option value="B Glumae">B Glumae</option>
                                <option value="Bacteria pseudomona">Bacteria pseudomona</option>
                                <option value="Bacterias">Bacterias</option>
                                <option value="Barrenador del tallo en aguacate">Barrenador del tallo en aguacate</option>
                                <option value="Belotus so">Belotus so</option>
                                <option value="Bemicia sp">Bemicia sp</option>
                                <option value="Bemicia tabacci">Bemicia tabacci</option>
                                <option value="Bevipalpus sp.">Bevipalpus sp.</option>
                                <option value="Blatella germanica">Blatella germanica</option>
                                <option value="Bolbonota sp.">Bolbonota sp.</option>
                                <option value="Botryodiplodia sp">Botryodiplodia sp</option>
                                <option value="Botrytis cinerea">Botrytis cinerea</option>
                                <option value="Botrytis sp.">Botrytis sp.</option>
                                <option value="Brevipalpus sp.">Brevipalpus sp.</option>
                                <option value="Burkholderia glumae">Burkholderia glumae</option>
                                <option value="Cactodera SD">Cactodera SD</option>
                                <option value="Cactodera sp">Cactodera sp</option>
                                <option value="Cachexia xyloporosis">Cachexia xyloporosis</option>
                                <option value="Camponotus sp">Camponotus sp</option>
                                <option value="Cancro bacteriano">Cancro bacteriano</option>
                                <option value="Candidatus liberibacter asiaticus">Candidatus liberibacter asiaticus</option>
                                <option value="Capnodium sp.">Capnodium sp.</option>
                                <option value="Cecidomylidae">Cecidomylidae</option>
                                <option value="Cephaleuros sp.">Cephaleuros sp.</option>
                                <option value="Cerataphis brasiliensis">Cerataphis brasiliensis</option>
                                <option value="Ceratitis capitata">Ceratitis capitata</option>
                                <option value="Ceratocystis sp.">Ceratocystis sp.</option>
                                <option value="Cercospora angolensis">Cercospora angolensis</option>
                                <option value="Cercospora sp.">Cercospora sp.</option>
                                <option value="Cerotoma ruficornis">Cerotoma ruficornis</option>
                                <option value="Cicadellidae">Cicadellidae</option>
                                <option value="Cilantro Prueba">Cilantro Prueba</option>
                                <option value="CILV">CILV</option>
                                <option value="Citrus leprosis">Citrus leprosis</option>
                                <option value="Cladosporium sp">Cladosporium sp</option>
                                <option value="Clavibacter michiganensis">Clavibacter michiganensis</option>
                                <option value="Clorosis variegada">Clorosis variegada</option>
                                <option value="Coccinellidae">Coccinellidae</option>
                                <option value="Cochinilla rosada">Cochinilla rosada</option>
                                <option value="Colaspis sp">Colaspis sp</option>
                                <option value="Collembola">Collembola</option>
                                <option value="Colletotrichum gleosporicides">Colletotrichum gleosporicides</option>
                                <option value="Colletotrichum gloeosporioides">Colletotrichum gloeosporioides</option>
                                <option value="Colletotrichum sp">Colletotrichum sp</option>
                                <option value="Complejo de Virus">Complejo de Virus</option>
                                <option value="copturus Aguacatae">copturus Aguacatae</option>
                                <option value="Corynespora sp.">Corynespora sp.</option>
                                <option value="Corythaica carinata">Corythaica carinata</option>
                                <option value="Corythucha sp">Corythucha sp</option>
                                <option value="Crambidae">Crambidae</option>
                                <option value="Culicidae">Culicidae</option>
                                <option value="Curvularia lunata">Curvularia lunata</option>
                                <option value="Curvularia sp.">Curvularia sp.</option>
                                <option value="Cylindrocladium sp.">Cylindrocladium sp.</option>
                                <option value="Cymindisp">Cymindisp</option>
                                <option value="Cyminds to">Cyminds to</option>
                                <option value="Chaoborida">Chaoborida</option>
                                <option value="Chapboridae">Chapboridae</option>
                                <option value="Chinche salivosa">Chinche salivosa</option>
                                <option value="Cholus sp.">Cholus sp.</option>
                                <option value="Lano por acaros">Lano por acaros</option>
                                <option value="Dendroctonus vitel">Dendroctonus vitel</option>
                                <option value="Diabrotica balteata">Diabrotica balteata</option>
                                <option value="Diabrotica sp.">Diabrotica sp.</option>
                                <option value="Diaphania hyalinata">Diaphania hyalinata</option>
                                <option value="Diaphorina citri">Diaphorina citri</option>
                                <option value="Diaspididae">Diaspididae</option>
                                <option value="Diaspopididae">Diaspopididae</option>
                                <option value="Diatras sp">Diatras sp</option>
                                <option value="Didymella sp">Didymella sp</option>
                                <option value="Diphthera festiva">Diphthera festiva</option>
                                <option value="Ditylenchus destructor">Ditylenchus destructor</option>
                                <option value="Ditylenchus dipsal">Ditylenchus dipsal</option>
                                <option value="Ditylenchus so">Ditylenchus so</option>
                                <option value="Dolichopodidae">Dolichopodidae</option>
                                <option value="Dolichotetranychus sp.">Dolichotetranychus sp.</option>
                                <option value="Dorylaimus sp">Dorylaimus sp</option>
                                <option value="Draeculacephala sp">Draeculacephala sp</option>
                                <option value="Drosophila sp">Drosophila sp</option>
                                <option value="Drosophila sp">Drosophila sp</option>
                                <option value="Drosophila suzuki">Drosophila suzuki</option>
                                <option value="Dysdercus mimulus">Dysdercus mimulus</option>
                                <option value="Dysmicoccus brevipes">Dysmicoccus brevipes</option>
                                <option value="Ecdytolopna torticornis">Ecdytolopna torticornis</option>
                                <option value="Elateridae">Elateridae</option>
                                <option value="Elsinoe fawsetti">Elsinoe fawsetti</option>
                                <option value="Empoasca sp">Empoasca sp</option>
                                <option value="Erwinia chrysanthem">Erwinia chrysanthem</option>
                                <option value="Erwinia sp">Erwinia sp</option>
                                <option value="Erysiphe">Erysiphe</option>
                                <option value="Escama Blanca">Escama Blanca</option>
                                <option value="Escamas de los citricos">Escamas de los citricos</option>
                                <option value="Esphaceloma">Esphaceloma</option>
                                <option value="Eucalandra setulosa">Eucalandra setulosa</option>
                                <option value="Eulophidae">Eulophidae</option>
                                <option value="Eutetranychus sp.">Eutetranychus sp.</option>
                                <option value="Evania appendigaster">Evania appendigaster</option>
                                <option value="Evergestis rimosalis">Evergestis rimosalis</option>
                                <option value="Exocortis">Exocortis</option>
                                <option value="Fam, Margarodidae">Fam, Margarodidae</option>
                                <option value="Ferrisia dasyliri">Ferrisia dasyliri</option>
                                <option value="FOCA">FOCA</option>
                                <option value="Frankiniela occidentalis">Frankiniela occidentalis</option>
                                <option value="Frankiniela occidentalis">Frankiniela occidentalis</option>
                                <option value="Frankliniella cephalica">Frankliniella cephalica</option>
                                <option value="Frankliniella cephalica">Frankliniella cephalica</option>
                                <option value="Frankliniella gossypiana">Frankliniella gossypiana</option>
                                <option value="Frankliniella insulars">Frankliniella insulars</option>
                                <option value="Frankliniella invasor">Frankliniella invasor</option>
                                <option value="Frankliniella parvula">Frankliniella parvula</option>
                                <option value="Fumagina">Fumagina</option>
                                <option value="Fusariosis de la piña">Fusariosis de la piña</option>
                                <option value="Fusarium sp">Fusarium sp</option>
                                <option value="Globodera pallida">Globodera pallida</option>
                                <option value="Globodera rostochiensis">Globodera rostochiensis</option>
                                <option value="Gorgojo del pino">Gorgojo del pino</option>
                                <option value="Guayaquila sp">Guayaquila sp</option>
                                <option value="Guignadria citricarpa">Guignadria citricarpa</option>
                                <option value="Quignardia citricarpa Kiely">Quignardia citricarpa Kiely</option>
                                <option value="Cusano de la flota de la yuca">Cusano de la flota de la yuca</option>
                                <option value="Cynaikothrips sp">Cynaikothrips sp</option>
                                <option value="Helicotylenchus sp">Helicotylenchus sp</option>
                                <option value="Helicotylenchus sp">Helicotylenchus sp</option>
                                <option value="Helicoverpa sp">Helicoverpa sp</option>
                                <option value="Helicoverpa to">Helicoverpa to</option>
                                <option value="Helmintosponum sp">Helmintosponum sp</option>
                                <option value="Hemibertesia latanian">Hemibertesia latanian</option>
                                <option value="Hemileia vastratix">Hemileia vastratix</option>
                                <option value="Heterodera sp.">Heterodera sp.</option>
                                <option value="Heteropsylla sp">Heteropsylla sp</option>
                                <option value="Hongos de granos almacenados">Hongos de granos almacenados</option>
                                <option value="Hongos del follaje">Hongos del follaje</option>
                                <option value="Hongos del fruto">Hongos del fruto</option>
                                <option value="Hongos del suelo">Hongos del suelo</option>
                                <option value="Hyblaea puera">Hyblaea puera</option>
                                <option value="Hypothenemus hampe">Hypothenemus hampe</option>
                                <option value="Hypothenemus hampel">Hypothenemus hampel</option>
                                <option value="Insectos plaga">Insectos plaga</option>
                                <option value="Insignotherzia insignis">Insignotherzia insignis</option>
                                <option value="Ips calligraphus">Ips calligraphus</option>
                                <option value="Iserya purchasi">Iserya purchasi</option>
                                <option value="TYSV0">TYSV0</option>
                                <option value="IYSV">IYSV</option>
                                <option value="Langosta voladora">Langosta voladora</option>
                                <option value="Larvas Nitidulidae">Larvas Nitidulidae</option>
                                <option value="Larvas Tephritidae">Larvas Tephritidae</option>
                                <option value="Lepidosaphes pinnaeformis">Lepidosaphes pinnaeformis</option>
                                <option value="Leptodictya tabida">Leptodictya tabida</option>
                                <option value="Leptophobia aripa">Leptophobia aripa</option>
                                <option value="Lothrips sp.">Lothrips sp.</option>
                                <option value="Liposcelis bostrychophila">Liposcelis bostrychophila</option>
                                <option value="Liriomyza sp.">Liriomyza sp.</option>
                                <option value="Lygus linolaris">Lygus linolaris</option>
                                <option value="Mancha de Asfalto">Mancha de Asfalto</option>
                                <option value="Mancha de hierro">Mancha de hierro</option>
                                <option value="Mancha de sol">Mancha de sol</option>
                                <option value="Melanaphis saccari">Melanaphis saccari</option>
                                <option value="Meleira de la papaya">Meleira de la papaya</option>
                                <option value="Membracis mexicana">Membracis mexicana</option>
                                <option value="Micoplasma">Micoplasma</option>
                                <option value="Micoplasma">Micoplasma</option>
                                <option value="Milax gagates">Milax gagates</option>
                                <option value="Milviscutulus mangiferae">Milviscutulus mangiferae</option>
                                <option value="Minadores">Minadores</option>
                                <option value="Miogryllus sp.">Miogryllus sp.</option>
                                <option value="Mocis latipes">Mocis latipes</option>
                                <option value="Mormidea sp.">Mormidea sp.</option>
                                <option value="Mosca blanca">Mosca blanca</option>
                                <option value="Mosca del mediterraneo">Mosca del mediterraneo</option>
                                <option value="Mosca prieta de los citricos">Mosca prieta de los citricos</option>
                                <option value="Mosca Sierra">Mosca Sierra</option>
                                <option value="Moscas de la fruta de la familia tephritidae">Moscas de la fruta de la familia tephritidae</option>
                                <option value="Murgantia histrionica">Murgantia histrionica</option>
                                <option value="Mycosphaerella citri">Mycosphaerella citri</option>
                                <option value="Mycosphaerella sp">Mycosphaerella sp</option>
                                <option value="Myndus crudus">Myndus crudus</option>
                                <option value="Myzus persicae">Myzus persicae</option>
                                <option value="Negativna ALC">Negativna ALC</option>
                                <option value="Myzus persicae">Myzus persicae</option>
                                <option value="Negativo a ALC">Negativo a ALC</option>
                                <option value="Negativo a Aleurodicus dispersus">Negativo a Aleurodicus dispersus</option>
                                <option value="Negativo a Anastrepha grandis">Negativo a Anastrepha grandis</option>
                                <option value="Negativo a Aphelenchoides bessey">Negativo a Aphelenchoides bessey</option>
                                <option value="Negativo a Bactericera cockerelli Negativo a Burkholderia glumae">Negativo a Bactericera cockerelli Negativo a Burkholderia glumae</option>
                                <option value="Negativo a Cachexia-xyloporosis">Negativo a Cachexia-xyloporosis</option>
                                <option value="Negativo a Cancro de los citricos">Negativo a Cancro de los citricos</option>
                                <option value="Negativo a Clavibacter michiganensis">Negativo a Clavibacter michiganensis</option>
                                <option value="Negativo a Clorosis variegada">Negativo a Clorosis variegada</option>
                                <option value="Negativo a Ditylenchus destructor">Negativo a Ditylenchus destructor</option>
                                <option value="Negativo a Ditylenchus dipsai">Negativo a Ditylenchus dipsai</option>
                                <option value="Negativo a Drosophilla melanogaster">Negativo a Drosophilla melanogaster</option>
                                <option value="Negativo a Drosophilla suzuki">Negativo a Drosophilla suzuki</option>
                                <option value="Negativo a Erwinia chrysanthemi">Negativo a Erwinia chrysanthemi</option>
                                <option value="Negativo a Evergestis romosalis">Negativo a Evergestis romosalis</option>
                                <option value="Negativo a Exocortis">Negativo a Exocortis</option>
                                <option value="Negativo a Fusarium oxysporum (FOC4)">Negativo a Fusarium oxysporum (FOC4)</option>
                                <option value="Negativo a Globodera pallida">Negativo a Globodera pallida</option>
                                <option value="Negativo a Globodera rostochiensis">Negativo a Globodera rostochiensis</option>
                                <option value="Negativo a HLB">Negativo a HLB</option>
                                <option value="Negativo a leprosis">Negativo a leprosis</option>
                                <option value="Negativo a Lygus linolaris">Negativo a Lygus linolaris</option>
                                <option value="Negativo a Maconellicoccus hirsutus">Negativo a Maconellicoccus hirsutus</option>
                                <option value="Negativo a Maconellicoccus hirsutus">Negativo a Maconellicoccus hirsutus</option>
                                <option value="Negativo a Mancha de asfalto">Negativo a Mancha de asfalto</option>
                                <option value="Negativo a Melanaphis saccari">Negativo a Melanaphis saccari</option>
                                <option value="Negativo a Murgantia histrionica">Negativo a Murgantia histrionica</option>
                                <option value="Negativo a Oopogona saccahri">Negativo a Oopogona saccahri</option>
                                <option value="Negativo a Pratylenchus bracnyurus">Negativo a Pratylenchus bracnyurus</option>
                                <option value="Negativo a Psorosis">Negativo a Psorosis</option>
                                <option value="Negativo a roya del cafe">Negativo a roya del cafe</option>
                                <option value="Negativo a Sun Blotch">Negativo a Sun Blotch</option>
                                <option value="Negativo a Thrips palmi">Negativo a Thrips palmi</option>
                                <option value="Negativo a Tilletia barclayana">Negativo a Tilletia barclayana</option>
                                <option value="Negativo a Trizteza de los citricos">Negativo a Trizteza de los citricos</option>
                                <option value="Negativo a Tuta absoluta">Negativo a Tuta absoluta</option>
                                <option value="Negativo a Tuta absoluta Negativo a virus de la Meleira de la papaya">Negativo a Tuta absoluta Negativo a virus de la Meleira de la papaya</option>
                                <option value="Negativo a virus del mosaico del pepino">Negativo a virus del mosaico del pepino</option>
                                <option value="Negativo a virus tristeza de los citricos CTV">Negativo a virus tristeza de los citricos CTV</option>
                                <option value="Negativo a Watermelon mosaic virus (WMV)">Negativo a Watermelon mosaic virus (WMV)</option>
                                <option value="Negativo a Xylella fastidiosa">Negativo a Xylella fastidiosa</option>
                                <option value="Negativo a Zuccini yellow mosaic (SqVYV)">Negativo a Zuccini yellow mosaic (SqVYV)</option>
                                <option value="no identificada">no identificada</option>
                                <option value="Nymphalidae">Nymphalidae</option>
                                <option value="Oebalus sp.">Oebalus sp.</option>
                                <option value="Oidium sp.">Oidium sp.</option>
                                <option value="Oin de Gallo">Oin de Gallo</option>
                                <option value="Oligonychus sp">Oligonychus sp</option>
                                <option value="Oncometopia sp.">Oncometopia sp.</option>
                                <option value="Opogona sacchari">Opogona sacchari</option>
                                <option value="Otros">Otros</option>
                                <option value="Palomilla barrenadora del aguacate">Palomilla barrenadora del aguacate</option>
                                <option value="Panonychus panonychus sp.">Panonychus panonychus sp.</option>
                                <option value="Papilio cresphontes Cramer">Papilio cresphontes Cramer</option>
                                <option value="Paracarsidara gigantea">Paracarsidara gigantea</option>
                                <option value="Paracoccus marginatus">Paracoccus marginatus</option>
                                <option value="Paraleyrodes sp">Paraleyrodes sp</option>
                                <option value="Paraphidippus aurantius">Paraphidippus aurantius</option>
                                <option value="Parasaissetia nigra">Parasaissetia nigra</option>
                                <option value="Parasaissetia nigra">Parasaissetia nigra</option>
                                <option value="Paratrichodorus sp.">Paratrichodorus sp.</option>
                                <option value="Paratriosa">Paratriosa</option>
                                <option value="Parlagena bennetti">Parlagena bennetti</option>
                                <option value="Parlagena bennetti">Parlagena bennetti</option>
                                <option value="Pentatomidae">Pentatomidae</option>
                                <option value="Phaeoisaripsis sp">Phaeoisaripsis sp</option>
                                <option value="Phenacoccus solenopsis">Phenacoccus solenopsis</option>
                                <option value="Phoma sp">Phoma sp</option>
                                <option value="Phthorimaea sp">Phthorimaea sp</option>
                                <option value="Phthorimaea sp.">Phthorimaea sp.</option>
                                <option value="Phyllachora maydis">Phyllachora maydis</option>
                                <option value="Phyllachora sp.">Phyllachora sp.</option>
                                <option value="Papilio cresphontes Cramer">Papilio cresphontes Cramer</option>
                                <option value="Paracarsidara gigantea">Paracarsidara gigantea</option>
                                <option value="Paracoccus marginatus">Paracoccus marginatus</option>
                                <option value="Paraleyrodes sp">Paraleyrodes sp</option>
                                <option value="Paraphidippus aurantius">Paraphidippus aurantius</option>
                                <option value="Parasaissetia nigra">Parasaissetia nigra</option>
                                <option value="Parasaissetia nigra">Parasaissetia nigra</option>
                                <option value="Paratrichodorus sp.">Paratrichodorus sp.</option>
                                <option value="Paratriosa">Paratriosa</option>
                                <option value="Parlagena bennetti">Parlagena bennetti</option>
                                <option value="Parlagena bennetti">Parlagena bennetti</option>
                                <option value="Pentatomidae">Pentatomidae</option>
                                <option value="Phaeoisaripsis sp">Phaeoisaripsis sp</option>
                                <option value="Phenacoccus solenopsis">Phenacoccus solenopsis</option>
                                <option value="Phoma sp">Phoma sp</option>
                                <option value="Phthorimaea sp">Phthorimaea sp</option>
                                <option value="Phthorimaea sp.">Phthorimaea sp.</option>
                                <option value="Phyllachora maydis">Phyllachora maydis</option>
                                <option value="Phyllachora sp.">Phyllachora sp.</option>
                                <option value="Phyllocnistis citrella">Phyllocnistis citrella</option>
                                <option value="Phyllophaga caanchaki">Phyllophaga caanchaki</option>
                                <option value="Phyllophaga parvisetis">Phyllophaga parvisetis</option>
                                <option value="Physopella zeae">Physopella zeae</option>
                                <option value="Phytalus sp.">Phytalus sp.</option>
                                <option value="Phytophthora sp.">Phytophthora sp.</option>
                                <option value="Picudo del cocotero">Picudo del cocotero</option>
                                <option value="Pieris brasicae">Pieris brasicae</option>
                                <option value="Pinnaspis strachani">Pinnaspis strachani</option>
                                <option value="PlagaMiel">PlagaMiel</option>
                                <option value="Plagas de granos almacenados">Plagas de granos almacenados</option>
                                <option value="Planocccus citri">Planocccus citri</option>
                                <option value="Plasmodiophora Brassicae">Plasmodiophora Brassicae</option>
                                <option value="Plusiotis sp">Plusiotis sp</option>
                                <option value="Plutella xylostella">Plutella xylostella</option>
                                <option value="PMeV">PMeV</option>
                                <option value="Polyphagotarsonemus latus">Polyphagotarsonemus latus</option>
                                <option value="Pratylenchus brachyurus">Pratylenchus brachyurus</option>
                                <option value="Proxys punctulatus">Proxys punctulatus</option>
                                <option value="Pseudacysta persea">Pseudacysta persea</option>
                                <option value="Pseudaonidia trilobitiformis">Pseudaonidia trilobitiformis</option>
                                <option value="Pseudocercospora sp.">Pseudocercospora sp.</option>
                                <option value="Pseudococcidae">Pseudococcidae</option>
                                <option value="Pseudococcidia">Pseudococcidia</option>
                                <option value="Phyllocnistis citrella">Phyllocnistis citrella</option>
                                <option value="Phyllophaga caanchaki">Phyllophaga caanchaki</option>
                                <option value="Phyllophaga parvisetis">Phyllophaga parvisetis</option>
                                <option value="Physopella zeae">Physopella zeae</option>
                                <option value="Phytalus sp.">Phytalus sp.</option>
                                <option value="Phytophthora sp.">Phytophthora sp.</option>
                                <option value="Phytophthora sp.">Phytophthora sp.</option>
                                <option value="Picudo del cocotero">Picudo del cocotero</option>
                                <option value="Pieris brasicae">Pieris brasicae</option>
                                <option value="Pinnaspis strachani">Pinnaspis strachani</option>
                                <option value="PlagaMiel">PlagaMiel</option>
                                <option value="Plagas de granos almacenados">Plagas de granos almacenados</option>
                                <option value="Planocccus citri">Planocccus citri</option>
                                <option value="Plasmodiophora Brassicae">Plasmodiophora Brassicae</option>
                                <option value="Plusiotis sp">Plusiotis sp</option>
                                <option value="Plutella xylostella">Plutella xylostella</option>
                                <option value="PMeV">PMeV</option>
                                <option value="Polyphagotarsonemus latus">Polyphagotarsonemus latus</option>
                                <option value="Pratylenchus brachyurus">Pratylenchus brachyurus</option>
                                <option value="Proxys punctulatus">Proxys punctulatus</option>
                                <option value="Pseudacysta persea">Pseudacysta persea</option>
                                <option value="Pseudaonidia trilobitiformis">Pseudaonidia trilobitiformis</option>
                                <option value="Pseudocercospora sp.">Pseudocercospora sp.</option>
                                <option value="Pseudococcidae">Pseudococcidae</option>
                                <option value="Pseudococcidia">Pseudococcidia</option>
                                <option value="Pseudococcus viburni">Pseudococcus viburni</option>
                                <option value="Pseudodendrothrips sp">Pseudodendrothrips sp</option>
                                <option value="Pseudomona sp.">Pseudomona sp.</option>
                                <option value="Pseudoparlatoria sp">Pseudoparlatoria sp</option>
                                <option value="Pseudoperonospora sp.">Pseudoperonospora sp.</option>
                                <option value="Pseudosercospora sp">Pseudosercospora sp</option>
                                <option value="Psorosis">Psorosis</option>
                                <option value="Pterocalla tarsata">Pterocalla tarsata</option>
                                <option value="Puccinia sp.">Puccinia sp.</option>
                                <option value="Pulgon Amarillo del Sorgo">Pulgon Amarillo del Sorgo</option>
                                <option value="Punctodera sp.">Punctodera sp.</option>
                                <option value="Pyraloidea">Pyraloidea</option>
                                <option value="Ralstonia Solanacearum">Ralstonia Solanacearum</option>
                                <option value="Ralstonia solanacearum">Ralstonia solanacearum</option>
                                <option value="Ragiella indica">Ragiella indica</option>
                                <option value="Rhizoctonia solani">Rhizoctonia solani</option>
                                <option value="Rhizopus sp">Rhizopus sp</option>
                                <option value="Rhopalosiphum maidis">Rhopalosiphum maidis</option>
                                <option value="Pseudococcidia">Pseudococcidia</option>

                                <option value="Pseudococcus viburni">Pseudococcus viburni</option>
                                <option value="Pseudodendrothrips sp">Pseudodendrothrips sp</option>
                                <option value="Pseudomona sp.">Pseudomona sp.</option>
                                <option value="Pseudoparlatoria sp">Pseudoparlatoria sp</option>
                                <option value="Pseudoperonospora sp.">Pseudoperonospora sp.</option>
                                <option value="Pseudosercospora sp">Pseudosercospora sp</option>
                                <option value="Psorosis">Psorosis</option>
                                <option value="Pterocalla tarsata">Pterocalla tarsata</option>
                                <option value="Puccinia sp.">Puccinia sp.</option>
                                <option value="Pulgon Amarillo del Sorgo">Pulgon Amarillo del Sorgo</option>
                                <option value="Punctodera sp.">Punctodera sp.</option>
                                <option value="Pyraloidea">Pyraloidea</option>
                                <option value="Ralstonia Solanacearum">Ralstonia Solanacearum</option>
                                <option value="Ralstonia solanacearum">Ralstonia solanacearum</option>
                                <option value="Ragiella indica">Ragiella indica</option>
                                <option value="Rhizoctonia solani">Rhizoctonia solani</option>
                                <option value="Rhizopus sp">Rhizopus sp</option>
                                <option value="Rhopalosiphum maidis">Rhopalosiphum maidis</option>
                                <option value="Taphrina deformans">Taphrina deformans</option>
                                <option value="Tarsonemus sp">Tarsonemus sp</option>
                                <option value="Tecia solanivora">Tecia solanivora</option>
                                <option value="Tetranychus sp">Tetranychus sp</option>
                                <option value="Thrips cardamomi">Thrips cardamomi</option>
                                <option value="Thrips palmi">Thrips palmi</option>
                                <option value="Thrips sp.">Thrips sp.</option>
                                <option value="Tilletia barclayana">Tilletia barclayana</option>
                                <option value="Tiro de munición del durazno">Tiro de munición del durazno</option>
                                <option value="Titanacris velasquezli">Titanacris velasquezli</option>
                                <option value="Tortricidae">Tortricidae</option>
                                <option value="Toxoptera citricida">Toxoptera citricida</option>
                                <option value="Trialeurodes vaporariorum">Trialeurodes vaporariorum</option>
                                <option value="Trioza">Trioza</option>
                                <option value="Tristeza de los citricos">Tristeza de los citricos</option>
                                <option value="Tuta absoluta">Tuta absoluta</option>
                                <option value="Virus de la meleira de la papaya">Virus de la meleira de la papaya</option>
                                <option value="Virus del mosaico del pepino">Virus del mosaico del pepino</option>
                                <option value="Virus del Mosaico del Tabaco">Virus del Mosaico del Tabaco</option>
                                <option value="Virus tristeza de los citricos CTV">Virus tristeza de los citricos CTV</option>
                                <option value="Watermelon mosaic virus">Watermelon mosaic virus</option>
                                <option value="Xantomona citri">Xantomona citri</option>
                                <option value="xylella fastidiosa">xylella fastidiosa</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="">&nbsp;</label>
                            <select name="fenologia_estado" id="fenologia-estado" class="form-control" required>
                                <option value=""><?php echo __('Seleccione un estado Fenológico','ktech'); ?></option>
                                <option value="Cosecha">Cosecha</option>
                                <option value="Crecimiento longitudinal del tallo">Crecimiento longitudinal del tallo</option>
                                <option value="Desarrollo de las hojas">Desarrollo de las hojas</option>
                                <option value="Desarrollo de las partes vegetativas">Desarrollo de las partes vegetativas</option>
                                <option value="Emergencia de la flor">Emergencia de la flor</option>
                                <option value="Floración">Floración</option>
                                <option value="Fructificación">Fructificación</option>
                                <option value="Germinación, brotación o desarrollo de yema">Germinación, brotación o desarrollo de yema</option>
                                <option value="No aplica">No aplica</option>
                                <option value="Preparado el suelo">Preparado el suelo</option>
                                <option value="Producción ">Producción </option>
                                <option value="Siembra">Siembra</option>
                                <option value="Desarrollo de las hojas">Desarrollo de las hojas</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-12">
                            <div class="upload__box">
                                <div class="upload__btn-box">
                                    <div class="label_btn"><?php echo __('Agregar Fotos','ktech'); ?></div>
                                    <label class="upload__btn">
                                        <i class="icon icon-camera-white"></i>
                                        <span><?php echo __('Subir fotos','ktech'); ?></span>
                                        <input name="fotos[]" type="file" multiple="" data-max_length="20" class="upload__inputfile">
                                    </label>
                                </div>
                                <div class="upload__img-wrap"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <button type="submit" class="btn btn-danger">
                        <i class="icon icon-btn-go-white"></i>
                        <span><?php echo __('Enviar Información','ktech'); ?></span>
                    </button>
                </div>
            </div>
        </form>
    </div>
<?php } );

/**
 * Script formulario plan
 */
add_action( 'wp_footer', function () {
    ?>
    <script>
        (function($) { "use strict";
            $(document).ready( function() {
                ImgUpload();
            });
            
            function ImgUpload() {
                var imgWrap = "";
                var imgArray = [];

                $('.upload__inputfile').each(function () {
                    $(this).on('change', function (e) {
                        imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                        var maxLength = $(this).attr('data-max_length');
                        var files = e.target.files;
                        var filesArr = Array.prototype.slice.call(files);
                        var iterator = 0;

                        filesArr.forEach(function (f, index) {
                            if (!f.type.match('image.*')) {
                                return;
                            }
                            if (imgArray.length > maxLength) {
                                return false
                            } else {
                                var len = 0;
                                for (var i = 0; i < imgArray.length; i++) {
                                    if (imgArray[i] !== undefined) {
                                        len++;
                                    }
                                }
                                if (len > maxLength) {
                                    return false;
                                } else {
                                    imgArray.push(f);
                                    var reader = new FileReader();
                                    reader.onload = function (e) {
                                        var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                        imgWrap.append(html);
                                        iterator++;
                                    }
                                    reader.readAsDataURL(f);
                                }
                            }
                        });

                        $(this).closest('.upload__box').find('.label_btn').html(imgArray.length + 'Foto(s)');

                        console.log(imgArray.length);
                    });
                });

                $('body').on('click', ".upload__img-close", function (e) {
                    var file = $(this).parent().data("file");
                    for (var i = 0; i < imgArray.length; i++) {
                        if (imgArray[i].name === file) {
                            imgArray.splice(i, 1);
                            break;
                        }
                    }
                    $(this).parent().parent().remove();
                });


            }
        })(jQuery);
    </script>
<?php } );

/**
 * Formulario Fitozoosanitaria
 */
add_shortcode('form-monitoreo', function () {
    global $wp;
    $current_url = home_url( add_query_arg( array(), $wp->request ) );
    
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
    $trampas = get_terms('monitoreo-trampa', [
        'hide_empty' => false,
    ]);
    $incidencias = get_terms('monitoreo-incidencia', [
        'hide_empty' => false,
    ]);
    $tecnicos = get_terms('monitoreo-tecnico', [
        'hide_empty' => false,
    ]);
    $meses = getMonths();
    $conditions = getConditions();
    
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

    <div class="contact-form form-4">
        <h3 class="form-subtitle"><?php echo __('Filtros','ktech'); ?></h3>
        
        <form action="<?php echo $current_url; ?>" method="get">
            <div class="wrapper">
                <div class="form-row">
                    <div class="form-group col-lg-3 col-md-4">
                        <label class="label-title"><?php echo __('Año','ktech'); ?></label>
                        <select name="periodo" id="filtro-anio" class="form-control">
                            <?php foreach ($periodos as $item): ?>
                                <option value="<?php echo $item->term_id; ?>" <?php echo ($item->term_id == $_periodo ? 'selected' : ''); ?>><?php echo $item->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group col-lg-3 col-md-4">
                        <label class="label-title"><?php echo __('Mes','ktech'); ?></label>
                        <select name="mes" id="filtro-mes" class="form-control">
                            <option value=""><?php echo __('Todos','ktech'); ?></option>
                            <?php foreach ($meses as $key => $value): ?>
                                <option value="<?php echo $key; ?>" <?php echo ($key == $_mes ? 'selected' : ''); ?>><?php echo $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group col-lg-3 col-md-4">
                        <label class="label-title"><?php echo __('Programa bajo vigilancia','ktech'); ?></label>
                        <select name="programa" id="filtro-programa" class="form-control">
                            <?php foreach ($programas as $item): ?>
                                <option value="<?php echo $item->term_id; ?>" <?php echo ($item->term_id == $_programa ? 'selected' : ''); ?>><?php echo $item->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group col-lg-3 col-md-4">
                        <label class="label-title"><?php echo __('Tipo de formulario','ktech'); ?></label>
                        <select name="tipo_formulario" id="filtro-formulario" class="form-control">
                            <?php foreach ($formularios as $key => $item): ?>
                                <option value="<?php echo $key; ?>" <?php echo ($key == $_formulario ? 'selected' : ''); ?>><?php echo $item; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group col-lg-3 col-md-4 <?php echo ($_formulario == 1 ? 'd-block' : 'd-none'); ?>" id="input-trampa">
                        <label class="label-title"><?php echo __('Trampa','ktech'); ?></label>
                        <select name="trampa" id="filtro-trampa" class="form-control">
                            <option value=""><?php echo __('Todos','ktech'); ?></option>
                            <?php foreach ($trampas as $item): ?>
                                <option value="<?php echo $item->term_id; ?>" <?php echo ($item->term_id == $_trampa ? 'selected' : ''); ?>><?php echo $item->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group col-lg-3 col-md-4 <?php echo ($_formulario != 1 ? 'd-block' : 'd-none'); ?>" id="input-incidencia">
                        <label class="label-title"><?php echo __('Incidencia/Infestación','ktech'); ?></label>
                        <select name="incidencia" id="filtro-incidencia" class="form-control">
                            <option value=""><?php echo __('Todos','ktech'); ?></option>
                            <?php foreach ($incidencias as $item): ?>
                                <option value="<?php echo $item->term_id; ?>" <?php echo ($item->term_id == $_incidencia ? 'selected' : ''); ?>><?php echo $item->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group col-lg-3 col-md-4">
                        <label class="label-title"><?php echo __('Técnico','ktech'); ?></label>
                        <select name="tecnico" id="filtro-tecnico" class="form-control">
                            <option value=""><?php echo __('Todos','ktech'); ?></option>
                            <?php foreach ($tecnicos as $item): ?>
                                <option value="<?php echo $item->term_id; ?>" <?php echo ($item->term_id == $_tecnico ? 'selected' : ''); ?>><?php echo $item->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group col-lg-3 col-md-4">
                        <label class="label-title"><?php echo __('Condicion de Plaga','ktech'); ?></label>
                        <select name="condicion" id="filtro-condicion" class="form-control">
                            <option value=""><?php echo __('Todos','ktech'); ?></option>
                            <?php foreach ($conditions as $value): ?>
                                <option value="<?php echo $value; ?>" <?php echo ($item->term_id == $_condicion ? 'selected' : ''); ?>><?php echo $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group col-lg-3 col-md-4">
                        <label class="label-title">&nbsp;</label>
                        <button type="submit" class="btn btn-primary">
                            <i class="icon icon-btn-go-white"></i>
                            <span><?php echo __('Generar Mapa','ktech'); ?></span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php } );

/**
 * Script formulario plan
 */
add_action( 'wp_footer', function () {
    ?>
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6pj4hRqrQSi6n9Ur7ejY6gBm7Lwmo-lU"></script>
    <script>
        function cierraSidebarMapa() {
            if ($("#mapa .mapa-sidebar").hasClass("open")) {
                $("#mapa .mapa-sidebar").animate({
                    left: '-350px'
                }, 500);
                $("#mapa .mapa-sidebar").removeClass('open');
            } else {
                $("#mapa .mapa-sidebar").animate({
                    left: '0px'
                }, 500);
                $("#mapa .mapa-sidebar").addClass('open');
            }
        }

        function abrirSidebarMapa(url) {
            if (!($("#mapa .mapa-sidebar").hasClass("open"))) {
                $("#mapa .mapa-sidebar").animate({
                    left: '0px'
                }, 500);
                $("#mapa .mapa-sidebar").addClass('open');
            }
        }

        function llenarSidebarMapa(title, url) {
            $('#mapModal').find('.modal-title').text(title);
            $('#mapModal').find('#modal-pdf-registro').attr('href', url);
            $('#mapModal').modal('show');
        }

        (function ($) {

            /**
             *  new_map
             *
             *  This function will render a Google Map onto the selected jQuery element
             *
             *  @type	function
             *  @date	8/11/2013
             *  @since	4.3.0
             *
             *  @param	$el (jQuery element)
             *  @return	n/a
            */

            function new_map($el) {
                var $markers = $el.find('.marker');
                var args = {
                    zoom: 8,
                    center: new google.maps.LatLng(18.8515178, -70.9307879),
                    mapTypeId: google.maps.MapTypeId.SATELLITE, //google.maps.MapTypeId.ROADMAP,
                    disableDefaultUI: false,
                    scaleControl: true,
                    zoomControl: true,
                };

                // create map
                var map = new google.maps.Map($el[0], args);

                var icons = {
                    success: {
                        icon: '<?php echo get_template_directory_uri(); ?>/assets/img/custom/pin-success.png'
                    },
                    warning: {
                        icon: '<?php echo get_template_directory_uri(); ?>/assets/img/custom/pin-warning.png'
                    },
                    danger: {
                        icon: '<?php echo get_template_directory_uri(); ?>/assets/img/custom/pin-danger.png'
                    }
                };

                // add a markers reference
                map.markers = [];

                $markers.each(function () {
                    add_marker($(this), map, icons);
                });
                
                return map;
            }
            var infowindow;

            function add_marker($marker, map, icons) {
                var latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng'));
                var title = $marker.find('.title').text();
                var pin = $marker.attr('data-pin');
                var url = $marker.attr('data-url');
                
                var marker = new google.maps.Marker({
                    position: latlng,
                    icon: icons[pin].icon,
                    map: map,
                });

                map.markers.push(marker);
                var styles = [
                    {
                        "featureType": "administrative",
                        "elementType": "labels.text.fill",
                    }, {
                        "featureType": "landscape",
                        "elementType": "all",
                    }, {
                        "featureType": "poi",
                        "elementType": "all",
                    }, {
                        "featureType": "poi",
                        "elementType": "geometry.fill",
                    }, {
                        "featureType": "poi",
                        "elementType": "geometry.stroke",
                    }, {
                        "featureType": "poi",
                        "elementType": "labels",
                    }, {
                        "featureType": "road",
                        "elementType": "all",
                    }, {
                        "featureType": "road.highway",
                        "elementType": "all",
                    }, {
                        "featureType": "road.arterial",
                        "elementType": "labels.icon",
                    }, {
                        "featureType": "transit",
                        "elementType": "all",
                    }, {
                        "featureType": "transit.station.bus",
                        "elementType": "all",
                    }, {
                        "featureType": "transit.station.bus",
                        "elementType": "labels.text.fill",
                    }, {
                        "featureType": "transit.station.bus",
                        "elementType": "labels.icon",
                    }, {
                        "featureType": "transit.station.rail",
                        "elementType": "all",
                    }, {
                        "featureType": "transit.station.rail",
                        "elementType": "labels.text.fill",
                    }, {
                        "featureType": "transit.station.rail",
                        "elementType": "labels.icon",
                    }, {
                        "featureType": "water",
                        "elementType": "all",
                    }
                ];
                var styledMap = new google.maps.StyledMapType(styles, {
                    name: "Styled Map"
                });
                map.mapTypes.set('map_style', styledMap);
                map.setMapTypeId('map_style');
                
                google.maps.event.addListener(marker, 'click', function () {
                    llenarSidebarMapa(title, url);
                    // abrirSidebarMapa(url);
                });
            }
            
            var map = null;
            $(document).ready(function () {
                $('.acf-map').each(function () {
                    map = new_map($(this));
                });
            });
        })(jQuery);

        (function ($) {
            $(document).ready(function () {
                $('#filtro-formulario').on('change', function(e) {
                    var formulario = $(this).val();

                    $('#input-trampa').removeClass('d-block');
                    $('#input-incidencia').removeClass('d-block');
                    $('#input-trampa').removeClass('d-none');
                    $('#input-incidencia').removeClass('d-none');

                    if (formulario == 1) {
                        $('#input-trampa').addClass('d-block');
                        $('#input-incidencia').addClass('d-none');
                    } else {
                        $('#input-trampa').addClass('d-none');
                        $('#input-incidencia').addClass('d-block');
                    }
                });
            });
        })(jQuery);
    </script>
<?php } );