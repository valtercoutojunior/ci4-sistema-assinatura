<script>
    $(document).on("click", "#btnCreateCategory", function() {
        $('.modal-header').addClass('bg-success').removeClass('bg-warning');
        $('.modal-title').text('<?= lang('Categories.title_new'); ?>').addClass('text-white');
        $('#modalCategory').modal('show');
        $('input[name="id"]').val(''); //limpa o valor do id quando estamos criando
        $('input[name="_method"]').remove();
        $('#categories-form')[0].reset();
        $('#categories-form').attr('action', '<?= route_to('categories.create'); ?>');
        $('#categories-form').find('span.error-text').text('');
        $('#btnSalve').addClass('btn-success').removeClass('btn-warning');
        var url = '<?= route_to('categories.parents'); ?>';
        $.get(url, function(response) {
            $('#boxParents').html(response.parents);
        }, 'json');
    });
</script>