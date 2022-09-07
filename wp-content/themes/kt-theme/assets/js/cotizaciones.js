(function($) { "use strict";
    //  GENERAL
	$(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        var cron_job = null;

        $(document).ready( function() {
            $('.datatable').DataTable({
                "order": [[ 0, "desc" ]]
            });
            $('[data-toggle="tooltip"]').tooltip();
            
            $(document).on('click', '.btn-cotizacion-detalle', function(e) {
                e.preventDefault();
                admin_quote_details($(this).data('id'));
            });
            
            $(document).on('click', '.btn-quote-cancel', function(e) {
                e.preventDefault();
                admin_quote_details_cancel($(this).data('id'));
            });
            
            $(document).on('click', '.btn-cotizacion-show', function(e) {
                e.preventDefault();
                admin_quote_show($(this).data('id'));
            });
            
            $(document).on('input', '.input-quote-qty', function() {
                update_admin_quote_qty($(this));
            });
            
            $(document).on('click', '.btn-input-quote-amount', function() {
                update_admin_quote_amount($(this));
            });
            
            $(document).on('click', '.btn-delete-item', function() {
                Swal.fire({
                    title: 'Está seguro?',
                    text: "Esta acción es irreversible!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#5a6268',
                    confirmButtonText: 'Si, remover!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        delete_admin_quote_item($(this));
                    }
                });
            });

            $('#modal-add-item').on('click', function() {
                modal_add_item();
            });

            $('.btnQuoteComplete').on('click', function() {
                quote_complete();
            });

            $('.btnQuoteCancelDetail').on('click', function() {
                quote_cancel();
            });
            
            /** */
            $('#btn-modal-quote-add').on('click', function() {
                var $modal = $('#modalQuoteAdd');
                
                $modal.find('#modal-quote-date').val('');
                $modal.find('#modal-quote-user-id').val('');
                $modal.find('#modal-quote-user-id').selectpicker('render');
                $modal.find('#modal-tbody-quote-detail').html('');
                $modal.find('#modal-quote-total').html('');

                $modal.modal('show');
            });

            $('#modal-form-quote').on('submit', function(e) {
                e.preventDefault();
                admin_quote_store($(this));
            });

            $('#modal-detail-add-item').on('click', function() {
                modal_detail_add_item();
            });

            $('#frm-add-notes').on('submit', function(e) {
                e.preventDefault();
                quote_add_notes();
            });

            $(document).on('click', '.btn-modal-notes', function() {
                var quote_id = $(this).data('id');
                var $modal = $('#modalAddNote');
                $modal.find('[name="quote_id"]').val(quote_id);
                $modal.modal('show');
            });
            
            $(document).on('click', '.btn-modal-quote-edit', function() {
                admin_quote_edit($(this).data('id'));
            });
            
            $(document).on('click', '.btn-quote-detail-delete', function() {
                var $btn = $(this);

                Swal.fire({
                    title: 'Está seguro?',
                    text: "Debe confirmar el borrado del item.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#5a6268',
                    confirmButtonText: 'Si, quitar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $btn.parent().parent().remove();
                        setTotal();
                    }
                });
            });

            $(document).on('input', '[name="quote_detail_qty[]"]', function() {
                setTotal();
            });

            $(document).on('input', '[name="quote_detail_amount[]"]', function() {
                setTotal();
            });
        });

        function init() {
        }

        /**
         * Obtener detalles de la cotizacion
         * 
         * @param {Object} alumno_id Id del alumno
         */
        function admin_quote_details(quote_id) {
            var $modal = $('#modalCotizacionDetalle');
            var $overlay = $modal.find('.modal-overlay');
            $modal.find('#btn-quote-cancel-detail').addClass('d-none');
            $modal.find('#btn-quote-complete').addClass('d-none');
            $modal.find('.modal-body-content').empty();
            $modal.modal('show');
            $overlay.toggleClass('is-active', true);

            var formData = new FormData();
            formData.append('action', 'admin_quote_details');
            formData.append('quote_id', quote_id);

            $.ajax({
                type: "POST",
                url: ajax_object.ajax_url,
                data: formData,
                dataType: "JSON",
                processData: false,
                contentType: false,
                success: function(response) {
                    $overlay.toggleClass('is-active', false);
                    $('#quote_id').val('');
                    if (response.status == 'OK') {
                        $modal.find('.modal-body-content').html(response.html);
                        $('#quote_id').val(response.quote_id);
                        $modal.find('#btn-quote-cancel-detail').addClass('d-none');
                        $modal.find('#btn-quote-complete').removeClass('d-none');
                    } else {
                        $modal.find('.modal-body-content').html(response.message);
                    }
                }
            });
        }

        /**
         * Obtener detalles de la cotizacion
         * 
         * @param {Object} alumno_id Id del alumno
         */
        function admin_quote_details_cancel(quote_id) {
            var $modal = $('#modalCotizacionDetalle');
            var $overlay = $modal.find('.modal-overlay');
            $modal.find('#btn-quote-cancel-detail').addClass('d-none');
            $modal.find('#btn-quote-complete').addClass('d-none');
            $modal.find('.modal-body-content').empty();
            $modal.modal('show');
            $overlay.toggleClass('is-active', true);

            var formData = new FormData();
            formData.append('action', 'admin_quote_details');
            formData.append('quote_id', quote_id);

            $.ajax({
                type: "POST",
                url: ajax_object.ajax_url,
                data: formData,
                dataType: "JSON",
                processData: false,
                contentType: false,
                success: function(response) {
                    $overlay.toggleClass('is-active', false);
                    $('#quote_id').val('');
                    if (response.status == 'OK') {
                        $modal.find('.modal-body-content').html(response.html);
                        $('#quote_id').val(response.quote_id);
                        $modal.find('#btn-quote-cancel-detail').removeClass('d-none');
                        $modal.find('#btn-quote-complete').addClass('d-none');
                    } else {
                        $modal.find('.modal-body-content').html(response.message);
                    }
                }
            });
        }

        /**
         * Obtener detalles de la cotizacion
         * 
         * @param {Object} alumno_id Id del alumno
         */
        function admin_quote_show(quote_id) {
            var $modal = $('#modalCotizacionShow');
            var $overlay = $modal.find('.modal-overlay');
            $modal.find('.modal-body').empty();
            $modal.modal('show');
            $overlay.toggleClass('is-active', true);

            var formData = new FormData();
            formData.append('action', 'admin_quote_show');
            formData.append('quote_id', quote_id);

            $.ajax({
                type: "POST",
                url: ajax_object.ajax_url,
                data: formData,
                dataType: "JSON",
                processData: false,
                contentType: false,
                success: function(response) {
                    $overlay.toggleClass('is-active', false);
                    if (response.status == 'OK') {
                        $modal.find('.modal-body').html(response.html);
                    } else {
                        $modal.find('.modal-body').html(response.message);
                    }
                }
            });
        }
        
        /**
         * Agregar nuevo item a la cotizacion
         */
        function modal_add_item() {
            var len = $('#modalCotizacionDetalle').find('[data-post_id="'+$('#post-item').val()+'"]').length;
            if (len > 0) {
                $('#addItemModal').find('.alert').removeClass('d-none').html('Item ya agregado.');
            } else {
                var formData = new FormData();
                formData.append('action', 'admin_add_item');
                formData.append('post_id', $('#post-item').val());
                formData.append('quote_id', $('#quote_id').val());

                $('#modal-add-item').prop('disabled', true);
            
                $.ajax({
                    type : "POST",
                    url: ajax_object.ajax_url,
                    data: formData,
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    success : function(response) {
                        $('#modal-add-item').prop('disabled', false);
                        if (response.status == 'ERROR') {
                            $('#modalCotizacionDetalle').prepend(`<div class="alert alert-danger d-none" role="alert">${response.message}</div>`);
                        }
                        else {
                            var html = `
                                <tr>
                                    <td>${$('#post-item option:selected').text()}</td>
                                    <td>
                                        <input class="form-control form-control-sm input-quote-qty text-center" data-quote_id="${$('#quote_id').val()}" data-post_id="${$('#post-item').val()}" value="1" type="number" min="1" max="10" placeholder="0" aria-label="">
                                    </td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <input class="form-control form-control-sm input-quote-amount text-right" data-quote_id="${$('#quote_id').val()}" data-post_id="${$('#post-item').val()}" value="0" type="text" placeholder="0" aria-label="">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary btn-sm btn-input-quote-amount" type="button">
                                                    <i class="fa fa-refresh" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-link btn-sm btn-delete-item" data-quote_id="${$('#quote_id').val()}" data-post_id="${$('#post-item').val()}">
                                            <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                            $('#tbody-quote-details').append(html);
                            $('#addItemModal').modal('hide');
                            $('#addItemModal').find('.alert').addClass('d-none').html('');
                            init();
                        }
                    }
                });
            }
        }
        
        /**
         * Actualizar cantidad del item en la cotizacion
         * 
         * @param {object} $input 
         * @return void
         */
        function update_admin_quote_qty($input) {
            $input.prop('disabled', true);
            var formData = new FormData();
            formData.append('action', 'update_admin_quote_qty');
            formData.append('post_id', $input.data('post_id'));
            formData.append('quote_id', $input.data('quote_id'));
            formData.append('qty', $input.val());
            
            $.ajax({
                type : "POST",
                url: ajax_object.ajax_url,
                data: formData,
                dataType: "JSON",
                processData: false,
                contentType: false,
                success : function(response) {
                    $input.prop('disabled', false);
                    if (response.status == 'ERROR') {
                        $('#modalCotizacionDetalle').prepend(`<div class="alert alert-danger d-none" role="alert">No se pudo actualizar la cantidad.</div>`);
                    }
                }
            });
        }
        
        /**
         * Actualizar cantidad del item en la cotizacion
         * 
         * @param {object} $btn 
         * @return void
         */
        function update_admin_quote_amount($btn) {
            var $input = $btn.parent().parent().find('.input-quote-amount');
            $input.prop('disabled', true);
            $btn.prop('disabled', true);
            var formData = new FormData();
            formData.append('action', 'update_admin_quote_amount');
            formData.append('post_id', $input.data('post_id'));
            formData.append('quote_id', $input.data('quote_id'));
            formData.append('amount', $input.val());
            
            $.ajax({
                type : "POST",
                url: ajax_object.ajax_url,
                data: formData,
                dataType: "JSON",
                processData: false,
                contentType: false,
                success : function(response) {
                    $input.prop('disabled', false);
                    $btn.prop('disabled', false);
                    if (response.status == 'ERROR') {
                        $('#modalCotizacionDetalle').prepend(`<div class="alert alert-danger d-none" role="alert">No se pudo actualizar el monto.</div>`);
                    }
                }
            });
        }
        
        /**
         * Eliminar item de la cotizacion
         * 
         * @param {object} $btn 
         * @return void
         */
        function delete_admin_quote_item($btn) {
            $btn.prop('disabled', true);
            var formData = new FormData();
            formData.append('action', 'delete_admin_quote_item');
            formData.append('post_id', $btn.data('post_id'));
            formData.append('quote_id', $btn.data('quote_id'));
            
            $.ajax({
                type : "POST",
                url: ajax_object.ajax_url,
                data: formData,
                dataType: "JSON",
                processData: false,
                contentType: false,
                success : function(response) {
                    if (response.status == 'ERROR') {
                        $('#modalCotizacionDetalle').prepend(`<div class="alert alert-danger d-none" role="alert">No se pudo eliminar el item.</div>`);
                    } else {
                        $btn.parent().parent().remove();
                    }
                }
            });
        }
        
        /**
         * Completar cotizacion
         */
        function quote_complete() {
            var $modal = $('#modalCotizacionDetalle');
            var $overlay = $modal.find('.modal-overlay');
            $overlay.toggleClass('is-active', true);

            var $tbody = $('#tbody-quote-details');
            var formData = new FormData();
            formData.append('action', 'quote_complete');
            formData.append('quote_id', $('#quote_id').val());
            
            $.ajax({
                type : "POST",
                url: ajax_object.ajax_url,
                data: formData,
                dataType: "JSON",
                processData: false,
                contentType: false,
                success : function(response) {
                    if (response.status == 'ERROR') {
                        $overlay.toggleClass('is-active', false);
                        $modal.find('.alert').remove();
                        $modal.find('.modal-body-content').prepend(`<div class="alert alert-danger" role="alert">${response.message}</div>`);
                    } else {
                        $modal.modal('hide');
                        Swal.fire({
                            title: 'Cotizaciones!',
                            text: 'Cotización completada exitosamente!',
                            icon: 'success'
                        }).then((result) => {
                            location.reload();
                        });
                    }
                }
            });
        }
        
        /**
         * Completar cotizacion
         */
        function quote_cancel() {
            var $modal = $('#modalCotizacionDetalle');
            var $overlay = $modal.find('.modal-overlay');
            $overlay.toggleClass('is-active', true);

            var $tbody = $('#tbody-quote-details');
            var formData = new FormData();
            formData.append('action', 'quote_cancel');
            formData.append('quote_id', $('#quote_id').val());
            
            $.ajax({
                type : "POST",
                url: ajax_object.ajax_url,
                data: formData,
                dataType: "JSON",
                processData: false,
                contentType: false,
                success : function(response) {
                    if (response.status == 'ERROR') {
                        $overlay.toggleClass('is-active', false);
                        $modal.find('.alert').remove();
                        $modal.find('.modal-body-content').prepend(`<div class="alert alert-danger" role="alert">${response.message}</div>`);
                    } else {
                        $modal.modal('hide');
                        Swal.fire({
                            title: 'Cotizaciones!',
                            text: 'Cotización cancelada exitosamente!',
                            icon: 'success'
                        }).then((result) => {
                            location.reload();
                        });
                    }
                }
            });
        }

        /** */
        
        /**
         * Agregar nuevo item a la cotizacion
         */
        function modal_detail_add_item() {
            var len = $('#modalQuoteAdd').find('[data-post_id="'+$('#quote-detail-post-item').val()+'"]').length;
            if (len > 0) {
                $('#modalQuoteDetailAdd').find('.alert').removeClass('d-none').html('Item ya agregado.');
            } else {
                var html = `
                    <tr data-post_id="${$('#quote-detail-post-item').val()}">
                        <td>
                            <input type="hidden" name="quote_detail_post_id[]" value="${$('#quote-detail-post-item').val()}">
                            ${$('#quote-detail-post-item option:selected').text()}
                        </td>
                        <td>
                            <input name="quote_detail_qty[]" class="form-control form-control-sm text-center" value="1" type="number" min="1" max="10" placeholder="0" aria-label="">
                        </td>
                        <td>
                            <input name="quote_detail_amount[]" class="form-control form-control-sm text-right" value="0" type="text" placeholder="0" aria-label="">
                        </td>
                        <td class="modal-quote-detail-total text-right font-weight-bold"></td>
                        <td>
                            <button type="button" class="btn btn-link btn-sm btn-quote-detail-delete">
                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                `;
                $('#modal-tbody-quote-detail').append(html);
                $('#modalQuoteDetailAdd').modal('hide');
                $('#modalQuoteDetailAdd').find('.alert').addClass('d-none').html('');
                init();
            }
        }
        
        /**
         * Guardar cotizacion
         * 
         * @param {object} $form 
         */
        function admin_quote_store($form) {
            var $modal = $('#modalQuoteAdd');
            var $overlay = $modal.find('.modal-overlay');
            $overlay.toggleClass('is-active', true);

            var formData = new FormData(document.getElementById($form.attr('id')));
            formData.append('action', 'admin_quote_store');
            
            $.ajax({
                type: "POST",
                url: ajax_object.ajax_url,
                data: formData,
                dataType: "JSON",
                processData: false,
                contentType: false,
                success: function(response) {
                    $overlay.toggleClass('is-active', false);
                    
                    if (response.status == 'OK') {
                        Swal.fire({
                            title: 'Cotizaciones!',
                            text: response.message,
                            icon: 'success'
                        }).then((result) => {
                            location.reload();
                        });
                    } else {
                        $modal.find('.modal-body').prepend(`<div class="alert alert-danger" role="alert">${response.message}</div>`);
                    }
                }
            });
        }

        /**
         * Editar cotizacion
         * 
         * @param {int} quote_id 
         */
        function admin_quote_edit(quote_id) {
            var $modal = $('#modalQuoteAdd');
            var $overlay = $modal.find('.modal-overlay');
            $modal.find('#modal-tbody-quote-detail').empty();
            $modal.find('[name="quote_id"]').val('');
            $modal.find('[name="user_id"]').val('').prop('disabled', true);
            $modal.find('[name="user_id"]').selectpicker('render');
            $modal.find('[name="date"]').val('');
            $modal.modal('show');
            $overlay.toggleClass('is-active', true);

            var formData = new FormData();
            formData.append('action', 'admin_quote_edit');
            formData.append('quote_id', quote_id);

            $.ajax({
                type: "POST",
                url: ajax_object.ajax_url,
                data: formData,
                dataType: "JSON",
                processData: false,
                contentType: false,
                success: function(response) {
                    $overlay.toggleClass('is-active', false);
                    
                    $modal.find('[name="quote_id"]').val(response.quote.id);
                    $modal.find('[name="user_id"]').val(response.quote.user_id);
                    $modal.find('[name="user_id"]').selectpicker('render');
                    $modal.find('[name="date"]').val(response.quote.date);

                    var html = ``;
                    response.details.forEach(element => {
                        var total = parseFloat(element.qty) * parseFloat(element.amount);

                        html += `
                            <tr data-post_id="${element.post_id}">
                                <td>
                                    <input type="hidden" name="quote_detail_post_id[]" value="${element.post_id}">
                                    ${element.post_title}
                                </td>
                                <td>
                                    <input name="quote_detail_qty[]" class="form-control form-control-sm text-center" value="${element.qty}" type="number" min="1" max="10" placeholder="0" aria-label="">
                                </td>
                                <td>
                                    <input name="quote_detail_amount[]" class="form-control form-control-sm text-right" value="${element.amount}" type="text" placeholder="0" aria-label="">
                                </td>
                                <td class="modal-quote-detail-total text-right font-weight-bold">${total}</td>
                                <td>
                                    <button type="button" class="btn btn-link btn-sm btn-quote-detail-delete">
                                        <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#modal-tbody-quote-detail').append(html);

                    init();
                    setTotal();
                }
            });
        }

        function setTotal() {
            var total_quote = 0;
            $('#modal-tbody-quote-detail').find('tr').each(function( index ) {
                var qty = $(this).find('[name="quote_detail_qty[]"]').val();
                var amount = $(this).find('[name="quote_detail_amount[]"]').val();
                var total = qty * amount;
                $(this).find('.modal-quote-detail-total').html(total);
                $(this).find('.modal-quote-detail-total').number( true, 2 );
                total_quote += total;
            });

            $('#modal-quote-total').html(total_quote);
            $('#modal-quote-total').number( true, 2 );
        }

        /**
         * Agregar notas
         */
        function quote_add_notes() {
            var $modal = $('#modalAddNote');
            var formData = new FormData(document.getElementById('frm-add-notes'));
            formData.append('action', 'admin_quote_add_notes');
            
            $.ajax({
                type: "POST",
                url: ajax_object.ajax_url,
                data: formData,
                dataType: "JSON",
                processData: false,
                contentType: false,
                success : function(response) {
                    var quote_id = $modal.find('[name="quote_id"]').val();
                    var html = ``;
                    var quotes_notes = response.quotes_notes;
                    quotes_notes.forEach(note => {
                        html += `
                            <div class="list-item ${note.type}">
                                <small>${note.note_date}</small>
                                <p>${note.notes}</p>
                            </div>
                        `;
                    });
                    $('#list-'+quote_id).html(html);
                    $modal.modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: response.message
                    });
                }
            });
        }
    });
})(jQuery); 