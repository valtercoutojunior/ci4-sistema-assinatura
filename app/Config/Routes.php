<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'HomeController::index', ['as' => 'web.home']);



// Rotas para o manager
if (file_exists($manage = ROOTPATH . 'routes/manager.php')) {
    require $manage;
}

// Rotas para a web(site)
if (file_exists($dashboard = ROOTPATH . 'routes/dashboard.php')) {
    require $dashboard;
}

// Rotas para API Rest
if (file_exists($api = ROOTPATH . 'routes/api.php')) {
    require $api;
}

//Rotas do AUTH
//\Fluent\Auth\Facades\Auth::routes();
\Fluent\Auth\Facades\Auth::routes();
$routes->get('image/(:any)/(:any)', 'DetailsController::image/$1/$2', ['as' => 'web.image']);
//Rotas do site
$routes->get('pricing', 'HomeController::pricing', ['as' => 'pricing']);
$routes->get('choice/(:num)', 'HomeController::choice/$1', ['as' => 'choice', 'filter' => 'auth_verified']);
$routes->post('pay/(:num)', 'HomeController::attemptPay/$1', ['as' => 'pay']);

//Detalhes de um anuncio
$routes->get('detail/(:any)', 'DetailsController::details/$1', ['as' => 'adverts.detail']);
//Carregar mais anuncios de um usuário
$routes->get('user/(:any)', 'HomeController::userAdverts/$1', ['as' => 'adverts.user']);
//Busac anuncios por categoria
$routes->get('category/(:any)', 'HomeController::category/$1', ['as' => 'adverts.category']);
//Busac anuncios por cidade(Aqui ele recebe 2 parametros na url)
$routes->get('category-city/(:any)/(:any)', 'HomeController::categoryCity/$1/$2', ['as' => 'adverts.category.city']);
/**::::::::::::::::::::::::::::::::::
 * :::::: Perguntas e respostas :::::
 ::::::::::::::::::::::::::::::::::*/
$routes->post('toask/(:any)', 'DetailsController::toask/$1', ['as' => 'details.toask', 'filter' => 'auth']); //A responsta vai ser feita pelo dashboard


/**:::::::::::::::::::::::::::::::::::::::
 * :::::: autocomplete main e advert :::::
 :::::::::::::::::::::::::::::::::::::::*/
$routes->get('search', 'HomeController::search', ['as' => 'adverts.search']);


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
