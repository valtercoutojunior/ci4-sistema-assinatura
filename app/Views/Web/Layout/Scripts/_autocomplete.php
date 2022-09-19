<!-- Para o autocomplete -->
<script src="<?php echo site_url('web/plugins/auto-complete/jquery-ui.js'); ?>"></script>
<script>
    $(function() {
        $("#query").autocomplete({
            minLength: 4, // Tamanho mínimo de 4 caractéres para começar a pesquisar
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo route_to('adverts.search'); ?>",
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        if (data.length < 1) {
                            var data = [{
                                label: 'Ops!!! Nenhum item encontrado com esses parâmetros',
                                value: -1
                            }];
                        }
                        response(data); // Aqui temos valor no data

                    },

                }); // fim ajax

            },
            minLenght: 1,
            select: function(event, ui) {

                if (ui.item.value == -1) {
                    $(this).val("");
                    return false;
                } else {
                    window.location.href = '<?php echo site_url('detail/'); ?>' + ui.item.code; // aqui temos que usar o site_url()
                }
            }, // fim select

            //Aqui é para renderizar a imagem do produto
        }).data("ui-autocomplete")._renderItem = function(ul, item) {
            return $("<li class='ui-autocomplete-row'></li>")
                .data("item.autocomplete", item)
                .css('font-size', '14px')
                .append(item.label)
                .appendTo(ul);
        }; // fim autocomplete
    });
</script>