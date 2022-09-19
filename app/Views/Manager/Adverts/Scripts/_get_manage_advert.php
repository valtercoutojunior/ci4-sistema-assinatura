<script>
    $(document).on("click", "#btnEditAdvert", function() {
        var id = $(this).data('id');
        var url = '<?= route_to('get.manager.advert'); ?>';
        $.get(url, {
            id: id
        }, function(response) {
            $('#modalAdvert').modal('show');
            $('.modal-header').addClass('bg-warning').removeClass('bg-success'); //Muda a cor do modal-header
            $('.modal-title').text('<?= lang('Adverts.title_edit'); ?>' + ' / ' + response.advert.code).addClass('text-dark'); //Mudar como o lang

            $('#adverts-form').find('input[name="id"]').val(response.advert.id);
            $('#adverts-form').find('input[name="title"]').val(response.advert.title);
            $('#adverts-form').find('input[name="price"]').val(response.advert.price).addClass('money');
            //Address
            $('#adverts-form').find('input[name="zipcode"]').val(response.advert.zipcode);
            $('#adverts-form').find('input[name="street"]').val(response.advert.street);
            $('#adverts-form').find('input[name="number"]').val(response.advert.number);
            $('#adverts-form').find('input[name="neighborhood"]').val(response.advert.neighborhood);
            $('#adverts-form').find('input[name="city"]').val(response.advert.city);
            $('#adverts-form').find('input[name="state"]').val(response.advert.state);
            $('#adverts-form').find('textarea[name="description"]').val(response.advert.description);

            $('#adverts-form').find('input[name="is_published"]').prop('checked', response.advert.is_published);

            $('#adverts-form').append("<input type='hidden' name='_method' value='PUT'>");
            $('#boxSituations').html(response.situations);
            $('#boxCategories').html(response.categories);
            $('#adverts-form').find('span.error-text').text('');
            $('#btnSalve').addClass('btn-warning');

        }, 'json').fail(function() {
            // Display an error toast, with a title
            toastr.error("Could not find the selected ad");
        });
    });
</script>