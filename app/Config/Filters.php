<?php

namespace Config;

use App\Filters\AuthFilter;
use App\Filters\SuperadminFilter;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

use App\Filters\HasSubscriptionFilter; //Filtro de incrição
use App\Filters\PaymentFilter; //Filtro de pagamento

use App\Filters\AdvertFilter;


class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,

        // ...
        // 'auth'     => \Fluent\Auth\Filters\AuthenticationFilter::class, //Lança exception
        'auth'     => AuthFilter::class, //Meu Filter de autenticação
        'can'      => \Fluent\Auth\Filters\AuthorizeFilter::class,
        'confirm'  => [
            //\Fluent\Auth\Filters\AuthenticationFilter::class, //Lança exception
            AuthFilter::class,
            \Fluent\Auth\Filters\ConfirmPasswordFilter::class,
        ],
        'guest'    => \Fluent\Auth\Filters\RedirectAuthenticatedFilter::class,
        'throttle' => \Fluent\Auth\Filters\ThrottleFilter::class,
        'verified' => \Fluent\Auth\Filters\EmailVerifiedFilter::class,

        'superadmin' => [
            AuthFilter::class,
            SuperadminFilter::class
        ],

        'auth_verified' => [
            AuthFilter::class,
            \Fluent\Auth\Filters\EmailVerifiedFilter::class,
        ],

        'subscription' => [
            AuthFilter::class,
            HasSubscriptionFilter::class,
            PaymentFilter::class,
        ],

        'adverts' => [
            AuthFilter::class, //Verifica se o usuario está logado
            AdvertFilter::class,
        ],
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            // 'honeypot',
            'csrf' => [
                'except' => [
                    'api/*'
                ]
            ],
            // 'invalidchars',
        ],
        'after' => [
            'toolbar' => [
                'except' => [
                    'api/*'
                ]
            ],
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don’t expect could bypass the filter.
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [];
}
