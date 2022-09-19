<script>
    $(document).on('click', '#btnCreateAdvert', function() {

        $('#modalAdvert').modal('show');

        $('input[name="id"]').val(''); //limpa o valor do id quando estamos criando
        $('input[name="_method"]').remove();
        $('#adverts-form')[0].reset();
        $('#adverts-form').attr('action', '<?= route_to('adverts.create.my'); ?>');
        $('#adverts-form').find('span.error-text').text('');
        $('#btnSalve').addClass('btn-success').removeClass('btn-warning');
        $('.modal-header').addClass('bg-success').removeClass('bg-warning');
        $('.modal-title').text('<?= lang('Adverts.title_new'); ?>').addClass('text-white');

        var url = '<?= route_to('get.categories.situations'); ?>';

        $.get(url, function(response) {
            $('#boxSituations').html(response.situations);
            $('#boxCategories').html(response.categories);


        }, 'json').fail(function() {
            // Display an error toast, with a title
            toastr.error('Error on backend. Contact a admin');
        });
    });
</script>