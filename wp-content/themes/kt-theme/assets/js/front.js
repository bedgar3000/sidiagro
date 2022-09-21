(function ($) {
    "use strict";

    $(function () {
        $(document).ready(function () {
            //  pagina archive de proveedores
            if ($('#form-fito').length) {
                //  filtro condado
                $('#form-fito').on('submit', function (e) {
                    e.preventDefault();
                    handleSubmit();
                });
            }
        });

        /**
         * Submit form
         */
        function handleSubmit() {
            var formData = new FormData(document.getElementById('form-fito'));
            formData.append('action', 'form_fito');

            let overlay = document.getElementsByClassName('loading-overlay')[0];
            overlay.classList.toggle('is-active');

            $.ajax({
                type: "POST",
                url: front_ajax_obj.ajaxurl,
                data: formData,
                dataType: "JSON",
                processData: false,
                contentType: false,
                success: function (response) {
                    overlay.classList.toggle('is-active');
                    
                    if (response.status == 'ERROR') {
                        response.error_data.forEach(function (error) {
                            //create message error in input get getElementsByName
                            var input = document.getElementsByName(error.input)[0];
                            var message = document.createElement('p');
                            message.classList.add('text-danger');
                            message.innerHTML = error.message;
                            input.parentNode.appendChild(message);
                        });
                    } else {
                        document.getElementById('form-fito').html = `
                            <div class="aler alert-success">
                                Formulario enviado exitosamente
                            </div>
                        `;
                    }
                }
            });
        }
    });

})(jQuery);