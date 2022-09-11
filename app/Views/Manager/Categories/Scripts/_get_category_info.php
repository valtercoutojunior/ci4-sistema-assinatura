<script>
    $(document).on("click", "#btnUpdateCategory", function() {
        var id = $(this).data('id');
        var url = '<?= route_to('categories.get.info'); ?>';
        $.get(url, {
                id: id
            }, function(response) {
                $('#modalCategory').modal('show');
                $('.modal-header').addClass('bg-warning'); //Muda a cor do modal-header
                $('.modal-title').text('Atualizar categoria').addClass('text-dark'); //Mudar como o lang
                $('#categories-form').attr('action', '<?= route_to('categories.update'); ?>');
                $('#categories-form').find('input[name="id"]').val(response.category.id);
                $('#categories-form').find('input[name="name"]').val(response.category.name);
                $('#categories-form').append("<input type='hidden' name='_method' value='PUT'>");
                $('#boxParents').html(response.parents);
                $('#categories-form').find('span.error-text').text('');
                $('#btnSalve').addClass('btn-warning');

            },
            'json');
    });
</script>