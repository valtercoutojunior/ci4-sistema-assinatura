<script>
    $(document).on("click", "#btnUpdatePlan", function() {
        var id = $(this).data('id');
        var url = '<?= route_to('plans.get.info'); ?>';
        $.get(url, {
                id: id
            }, function(response) {
                $('#modalPlan').modal('show');
                $('.modal-header').addClass('bg-warning'); //Muda a cor do modal-header
                $('.modal-title').text('<?= lang('Plans.title_edit'); ?>').addClass('text-dark'); //Mudar como o lang
                $('#plans-form').attr('action', '<?= route_to('plans.update'); ?>');
                $('#plans-form').append("<input type='hidden' name='_method' value='PUT'>");
                //Fields from
                $('#plans-form').find('input[name="id"]').val(response.plan.id);
                $('#plans-form').find('input[name="name"]').val(response.plan.name);
                $('#plans-form').find('input[name="value"]').val(response.plan.value);
                $('#plans-form').find('input[name="adverts"]').val(response.plan.adverts);
                $('#plans-form').find('textarea[name="description"]').val(response.plan.description);
                $('#plans-form').find('input[name="is_highlighted"]').prop('checked', response.plan.is_highlighted);
                $('#boxRecorrences').html(response.recorrences);

                $('#plans-form').find('span.error-text').text('');
                $('#btnSalve').addClass('btn-warning');

            },
            'json');
    });
</script>