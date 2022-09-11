<script>
    $(document).on("click", "#btnDeletePlan", function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var url = '<?= route_to('plans.delete'); ?>';

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
                    // Display a success toast, with a title
                    toastr.success(response.message);
                    $("#myDataTable").DataTable().ajax.reload(null, false);

                }, 'json').fail(function() {
                    // Display an error toast, with a title
                    toastr.error('Error on backend. Contact a admin');
                });

            }
        })
    });
</script>