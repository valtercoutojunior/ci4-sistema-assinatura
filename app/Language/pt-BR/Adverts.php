<?php

return [

    // texts
    'title_index'                   => 'Listando os Anúncios',
    'title_new'                     => 'Criar Anúncio',
    'title_edit'                    => 'Editar Anúncio',
    'text_is_published'             => 'Anúncio publicado',
    'text_under_analysis'           => 'Em análise',
    'text_new'                      => 'Item Novo',
    'text_used'                     => 'Item Usado',
    'text_edit_address'             => 'Localização do anúncio',
    'text_edit_questions'           => 'Perguntas e Respostas do anúncio {title}',
    'text_for_empty_address'        => 'Ainda não definido',
    'text_edit_images'              => 'Imagens do anúncio',
    'text_no_images'                => 'Esse anúncio ainda não possui imagens',
    'text_images_info_upload'       => 'Apenas arquivos jpg, jpeg, png, e webp. Tamanho máximo: 2048mb. Dimesões máximas: 2560 x 1080 pixels.',
    'text_rule_to_be_published'     => 'Para que seus anúncios sejam publicados, eles precisam ter um endereço definido, pois só assim eles serão exibidos nas pesquisas.',
    'cannot_be_published'           => 'Não pode ser publicado, pois não possui endereço definido',
    'text_total_user_advert'        => 'Total de anúncios',
    'text_total_advert_published'   => 'Anúncios Publicados',
    'text_total_waiting_approval'   => 'Aguardando Aprovação',
    'text_total_archived'           => 'Anúncios Arquivados',


    // Buttons
    'btn_edit_images'           => 'Imagens',
    'btn_edit_address'          => 'Endereço',
    'btn_send_for_approval'     => 'Enviar para aprovação',
    'btn_view_advert'           => 'Ver anúncio',
    'btn_view_questions'        => 'Perguntas e Respostas',



    // Labels
    'label_address'         => 'Onde',
    'label_image'           => 'Imagem',
    'label_form_images'     => 'Escolha uma ou mais imagens',
    'label_code'            => 'Código',
    'label_title'           => 'Título',
    'label_published'       => 'Publicado',
    'label_situation'       => 'Escolha a Situação do item...',
    'label_category'        => 'Categoria',
    'label_price'           => 'Valor do Item anunciado',
    'label_description'     => 'Descrição do anúncio',
    'label_status'          => 'Status',
    'label_zipcode'         => 'CEP do anúncio',
    'label_street'          => 'Endereço do anúncio',
    'label_number'          => 'Número',
    'label_neighborhood'    => 'Bairro do anúncio',
    'label_city'            => 'Cidade do anúncio',
    'label_state'           => 'Estado do anúncio',


    // Validation messages
    'title' => [
        'required'      => 'Informe um título',
        'min_length'    => 'O título deve ter no minímo 3 caractéres',
        'max_length'    => 'O título deve ter no máximo 125 caractéres',
        'is_unique'     => 'Esse Título já existe. Por favor escolha outro',
    ],
    'situation' => [
        'required'      => 'Selecione uma situação',
        'in_list'       => 'A situação deve ser novo ou usado',
    ],
    'category_id' => [
        'required'      => 'Selecione uma categoria',
        'in_list'       => 'A categoria selecionada deve estar conforme as listadas',
    ],
    'price' => [
        'required'      => 'Informe o preço',
    ],
    'zipcode' => [
        'required'      => 'Informe o cep',
        'exact_length'  => 'O cep deve ter exatamente 9 caractéres',
    ],
    'street' => [
        'required'      => 'Informe o logradouro',
        'min_length'    => 'A rua deve ter no minímo 3 caractéres',
        'max_length'    => 'A rua deve ter no máximo 130 caractéres',
    ],
    'number' => [
        'max_length'    => 'O número deve ter no máximo 9 caractéres',
    ],
    'neighborhood' => [
        'required'      => 'Informe o bairro',
        'min_length'    => 'O bairro deve ter no mínimo 3 caractéres',
        'max_length'    => 'O bairro deve ter no máximo 120 caractéres',
    ],
    'city' => [
        'required'      => 'Informe a cidade',
        'min_length'    => 'A cidade deve ter no mínimo 3 caractéres',
        'max_length'    => 'A cidade deve ter no máximo 120 caractéres',
    ],
    'state' => [
        'required'      => 'Informe a UF',
        'exact_length'  => 'A UF deve ter no exatamente 2 caractéres',
    ],
    'description' => [
        'required'      => 'Informe uma descrição',
        'max_length'    => 'A descrição deve ter pelo menos 20 caractéres',
        'max_length'    => 'A descrição deve ter no máximo 5000 caractéres',
    ],



];
