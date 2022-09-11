<script>
    $(document).on("click", "#btnArchiveAdvert", function() {
        var id = $(this).data('id');
        var url = '<?= route_to('adverts.archive.my'); ?>';

        $.post(url, {
            '<?= csrf_token(); ?>': $('meta[name="<?= csrf_token(); ?>"]').attr('content'),
            _method: 'PUT', //Spoofing do request
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
    });
</script>