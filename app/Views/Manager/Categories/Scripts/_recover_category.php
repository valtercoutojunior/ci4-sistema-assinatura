<script>
    $(document).on("click", "#btnRecoverCategory", function() {
        var id = $(this).data('id');
        var url = '<?= route_to('categories.recover'); ?>';

        $.post(url, {
            '<?= csrf_token(); ?>': $('meta[name="<?= csrf_token(); ?>"]').attr('content'),
            _method: 'PUT', //Spoofing do request
            id: id
        }, function(response) {
            window.refreshCSRFToken(response.token);
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
            $("#myDataTable").DataTable().ajax.reload(null, false);

        }, 'json').fail(function() {
            toastr["error"]("Error on backend. Contact a admin");
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
        });
    });
</script>