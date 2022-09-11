<script>
    $(document).on("click", "#btnCreatePlan", function() {
        $('input[name="_method"]').remove();
        $('#modalPlan').modal('show');
        $('.modal-header').addClass('bg-success').removeClass('bg-warning');
        $('.modal-title').text('<?= lang('Plans.title_new'); ?>').addClass('text-white'); //Mudar como o lang
        $(['name="_method"']).remove();
        $('#plans-form')[0].reset();
        $('#plans-form').attr('action', '<?= route_to('plans.create'); ?>');
        $('#plans-form').find('span.error-text').text('');
        $('#btnSalve').addClass('btn-success').removeClass('btn-warning');
        var url = '<?= route_to('plans.get.recorrences'); ?>';
        $.get(url, function(response) {
            $('#boxRecorrences').html(response.recorrences);
        }, 'json');
    });
</script>