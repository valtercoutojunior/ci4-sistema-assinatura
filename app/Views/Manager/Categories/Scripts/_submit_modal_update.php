<script>
    $('#categories-form').submit(function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'JSON',
            contentType: false,
            beforeSend: function() {
                $(form).find('span.error-text').text('');
            },
            success: function(response) {
                window.refreshCSRFToken(response.token);
                if (response.success == false) {
                    toastr["error"]("Verifique os erros e tente novamente");
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-center",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }

                    $.each(response.errors, function(field, value) {
                        console.log(field);
                        $(form).find('span.' + field).text(value);
                    });
                    $('#btnSalve').removeClass('btn-warning');
                    return;
                }

                // Display a success toast, with a title                
                toastr["success"](response.message);
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-center",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                $('#btnSalve').removeClass('btn-warning');
                $('#modalCategory').modal('hide');
                $(form)[0].reset();
                $("#myDataTable").DataTable().ajax.reload(null, false);
                $('.modal-header').removeClass('bg-warning');
                $('.modal-title').text('Criar categoria');
                $(form).atr('action', '<?= route_to('categories.create'); ?>');
                $(form).find('input[name="id"]').val('');
                $('input[name="_method"]').remove();


            },
            error: function() {
                alert('Error backend on update category');
            }
        });

    });
</script>