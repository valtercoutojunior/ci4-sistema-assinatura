<script>
    $(document).on("click", "#btnDeleteCategory", function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var url = '<?= route_to('categories.delete'); ?>';

        Swal.fire({
            title: '<?= lang('App.delete_confirmation'); ?>',
            text: "<?= lang('App.info_delete_confirmation'); ?>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?= lang('App.btn_confirmed_delete'); ?>',
            cancelButtonText: '<?= lang('App.btn_cancel'); ?>'
        }).then((result) => {
            if (result.isConfirmed) {


                $.post(url, {
                    '<?= csrf_token(); ?>': $('meta[name="<?= csrf_token(); ?>"]').attr('content'),
                    _method: 'DELETE', //Spoofing do request
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

            }
        })




    });
</script>