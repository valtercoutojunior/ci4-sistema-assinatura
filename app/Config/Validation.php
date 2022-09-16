<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;
//Minhas validações
use App\Validations\Customized;

class Validation extends BaseConfig
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        //Minhas Validações
        Customized::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------

    //--------------------------------------------------------------------
    // Categories
    //--------------------------------------------------------------------
    public $category = [
        'name'     => 'required|min_length[3]|max_length[90]|is_unique[categories.name,id,{id}]',
    ];

    public $category_errors = [
        'name' => [
            'required'      => 'Categories.name.required',
            'min_length'    => 'Categories.name.min_length',
            'max_length'    => 'Categories.name.max_length',
            'is_unique'     => 'Categories.name.is_unique',
        ],
    ];

    //--------------------------------------------------------------------
    // Plans
    //--------------------------------------------------------------------   
    public $plan = [
        'name'          => 'required|min_length[3]|max_length[90]|is_unique[plans.name,id,{id}]',
        'recorrence'    => 'required|in_list[monthly,quarterly,semester,yearly]',
        'value'         => 'required',
        'description'   => 'required',
    ];

    public $plan_errors = [
        'name' => [
            'required'      => 'Plans.name.required',
            'min_length'    => 'Plans.name.min_length',
            'max_length'    => 'Plans.name.max_length',
            'is_unique'     => 'Plans.name.is_unique',
        ],
        'recorrence' => [
            'required'      => 'Plans.recorrence.required',
            'in_list'       => 'Plans.recorrence.in_list',
        ],
        'value' => [
            'required'      => 'Plans.value.required',
        ],
        'description' => [
            'required'      => 'Plans.description.required',
        ],
    ];

    //--------------------------------------------------------------------
    // Adverts
    //--------------------------------------------------------------------  
    public $advert = [
        'title'         => 'required|min_length[3]|max_length[125]|is_unique[adverts.title,id,{id}]',
        'situation'     => 'required|in_list[new,used]',
        'category_id'   => 'required|is_not_unique[categories.id,id,{category_id}]',
        'price'         => 'required',
        'zipcode'       => 'required|exact_length[9]',
        'street'        => 'required|min_length[3]|max_length[130]',
        'number'        => 'max_length[9]',
        'neighborhood'  => 'required|min_length[3]|max_length[120]',
        'city'          => 'required|min_length[3]|max_length[120]',
        'state'         => 'required|exact_length[2]',
        'description'   => 'required|min_length[20]|max_length[5000]',
    ];

    public $advert_errors = [
        'title' => [
            'required'      => 'Adverts.title.required',
            'min_length'    => 'Adverts.title.min_length',
            'max_length'    => 'Adverts.title.max_length',
            'is_unique'     => 'Adverts.title.is_unique',
        ],
        'situation' => [
            'required'      => 'Adverts.situation.required',
            'in_list'       => 'Adverts.situation.in_list',
        ],
        'category_id' => [
            'required'      => 'Adverts.category_id.required',
            'in_list'       => 'Adverts.category_id.is_not_unique',
        ],
        'price' => [
            'required'      => 'Adverts.title.required',
        ],
        'zipcode' => [
            'required'      => 'Adverts.zipcode.required',
            'exact_length'  => 'Adverts.zipcode.exact_length',
        ],
        'street' => [
            'required'      => 'Adverts.street.required',
            'min_length'    => 'Adverts.street.min_length',
            'max_length'    => 'Adverts.street.max_length',
        ],
        'number' => [
            'max_length'    => 'Adverts.number.max_length',
        ],
        'neighborhood' => [
            'required'      => 'Adverts.neighborhood.required',
            'min_length'    => 'Adverts.neighborhood.min_length',
            'max_length'    => 'Adverts.neighborhood.max_length',
        ],
        'city' => [
            'required'      => 'Adverts.city.required',
            'min_length'    => 'Adverts.city.min_length',
            'max_length'    => 'Adverts.city.max_length',
        ],
        'state' => [
            'required'      => 'Adverts.state.required',
            'exact_length'  => 'Adverts.state.exact_length',
        ],
        'description' => [
            'required'      => 'Adverts.description.required',
            'min_length'    => 'Adverts.description.min_length',
            'max_length'    => 'Adverts.description.max_length',
        ],
    ];

    //--------------------------------------------------------------------
    // Adverts Images
    //--------------------------------------------------------------------
    public $advert_images = [
        'images' => 'uploaded[images]'
            . '|is_image[images]'
            . '|mime_in[images,image/jpg,image/jpeg,image/png,image/webp]'
            . '|max_size[images,2048]'
            . '|max_dims[images,2560,1080]',
    ];
    public $advert_images_errors = [];

    //--------------------------------------------------------------------
    // User
    //--------------------------------------------------------------------  
    public $user_profile = [
        'name'          => 'required|min_length[3]|max_length[25]',
        'last_name'     => 'required|min_length[3]|max_length[95]',
        'email'         => 'required|valid_email|max_length[195]|is_unique[users.email,id,{id}]',
        'cpf'           => 'required|exact_length[14]|validate_cpf|is_unique[users.cpf,id,{id}]', //Criar classe de validação customizada para o CPF
        'phone'         => 'required|exact_length[15]|validate_phone|is_unique[users.phone,id,{id}]', //Criar classe de validação customizada para o TELEFONE
        'birth'         => 'required',
    ];

    public $user_profile_errors = [
        'name' => [
            'required'      => 'User.profile.name.required',
            'min_length'    => 'User.profile.name.min_length',
            'max_length'    => 'User.profile.name.max_length',
        ],
        'last_name' => [
            'required'      => 'User.profile.last_name.required',
            'min_length'    => 'User.profile.last_name.min_length',
            'max_length'    => 'User.profile.last_name.max_length',
        ],
        'email' => [
            'required'      => 'User.profile.email.required',
            'valid_email'   => 'User.profile.email.valid_email',
            'max_length'    => 'User.profile.email.max_length',
            'is_unique'     => 'User.profile.email.is_unique',
        ],
        'cpf' => [
            'required'      => 'User.profile.cpf.required',
            'is_unique'     => 'User.profile.cpf.is_unique',
        ],
        'phone' => [
            'required'      => 'User.profile.phone.required',
            'exact_length'  => 'User.profile.phone.exact_length',
            'is_unique'     => 'User.profile.phone.is_unique',
        ],
        'birth' => [
            'required'      => 'User.profile.birth.required',
        ],
    ];

    //--------------------------------------------------------------------
    // User Access
    //--------------------------------------------------------------------  
    public $access_update = [
        'password'              => 'required|min_length[8]',
        'password_confirmation' => 'matches[password]',
    ];

    public $access_update_errors = [
        'password' => [
            'required'      => 'User.access.password.required',
            'min_length'    => 'User.access.password.min_length',
        ],
        'password_confirmation' => [
            'matches'      => 'User.access.password_confirmation.matches',
        ],

    ];

    //--------------------------------------------------------------------
    // Gerencianet
    //--------------------------------------------------------------------  
    public $gerencianet_credit = [
        'payment_method'            => 'required|in_list[credit,billet]',
        'card_number'               => 'required',
        'card_expiration_date'      => 'required',
        'card_cvv'                  => 'required',
        'card_brand'                => 'required|in_list[visa,elo,diners,mastercard,amex,hipercard]',
        'payment_token'             => 'required|string',
        //Address
        'zipcode'                   => 'required',
        'street'                    => 'required',
        'city'                      => 'required',
        'neighborhood'              => 'required',
        'state'                     => 'required',
    ];
    public $gerencianet_credit_errors = [
        'payment_method' => [
            'required'      => 'Selecione o tipo de pagamento',
            'in_list'       => 'Por favor escolha Cartão de crédito ou boleto bancário',
        ],
        'card_number' => [
            'required'      => 'Informe o número do cartão de crédito',
        ],
        'card_expiration_date' => [
            'required'      => 'Informe a data de vencimento do cartão de crédito',
        ],
        'card_cvv' => [
            'required'      => 'Informe a CVV do cartão de crédito',
        ],
        'card_brand' => [
            'required'      => 'Informe a bandeira do cartão de crédito',
        ],
        //Address
        'zipcode' => [
            'required'      => 'Informe o CEP',
        ],
        'street' => [
            'required'      => 'Informe o endereço',
        ],

        'city' => [
            'required'      => 'Informe a cidade',
        ],

        'neighborhood' => [
            'required'      => 'Informe o bairro',
        ],

        'state' => [
            'required'      => 'Informe a UF',
        ],


    ];

    public $gerencianet_billet = [
        'payment_method'        => 'required|in_list[credit,billet]',
        'expire_at'             => 'required|valid_date[Y-m-d]',
    ];
    public $gerencianet_billet_errors = [
        'payment_method' => [
            'required'      => 'Selecione o tipo de pagamento',
            'in_list'       => 'Por favor escolha Cartão de crédito ou boleto bancário',
        ],
        'expire_at' => [
            'required'      => 'Informe a data de vencimento do boleto',
            'valid_date'    => 'A data selecionada é inválida',
        ],
    ];
}
