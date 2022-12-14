<?php

$routes->group('{locale}/dashboard', ['namespace' => 'App\Controllers\Dashboard', 'filter' => 'auth:web'], function ($routes) {

    $routes->get('/', 'DashboardController::index', ['filter' => 'verified', 'as' => 'dashboard']);
    $routes->get('my-plan', 'DashboardController::myPlan', ['as' => 'my.plan']);
    $routes->delete('cancel-subscription', 'DashboardController::cancelSubscription', ['as' => 'my.subscription.cancel']);
    $routes->get('detail-charge/(:num)', 'DashboardController::detailCharge/$1', ['as' => 'detail.charge']);
    $routes->get('profile', 'DashboardController::profile', ['filter' => 'confirm', 'as' => 'profile']);
    $routes->put('profile-update', 'DashboardController::updateProfile', ['as' => 'profile.update']);
    $routes->get('access', 'DashboardController::access', ['filter' => 'confirm', 'as' => 'access']);
    $routes->put('access-update', 'DashboardController::updateAccess', ['as' => 'access.update']);
    //Account
    $routes->get('confirm-deletion-account', 'DashboardController::confirmDeleteAccount', ['as' => 'confirm.deletion.account', 'filter' => 'confirm']);
    $routes->delete('account-delete', 'DashboardController::accountDelete', ['as' => 'account.delete', 'filter' => 'confirm']);

    //user Adverts   
    $routes->group('adverts', ['namespace' => 'App\Controllers\Dashboard', 'filter' => 'subscription'], function ($routes) {
        $routes->get('my', 'AdvertsUserController::index', ['as' => 'adverts.my']);
        $routes->get('my-archived', 'AdvertsUserController::archived', ['as' => 'my.archived.adverts']);
        $routes->get('get-all-my-adverts', 'AdvertsUserController::getUserAdverts', ['as' => 'get.all.my.adverts']);
        $routes->get('get-all-my-archived-adverts', 'AdvertsUserController::getUserArchivedAdverts', ['as' => 'get.all.my.archived.adverts']);
        $routes->get('get-my-advert', 'AdvertsUserController::getUserAdvert', ['as' => 'get.my.advert']);
        $routes->get('get-categories-situations', 'AdvertsUserController::getCategoriesAndSituations', ['as' => 'get.categories.situations']);
        $routes->get('edit-images/(:num)', 'AdvertsUserController::editUserAdvertImages/$1', ['as' => 'adverts.my.edit.images']);
        $routes->post('create', 'AdvertsUserController::createUserAdvert', ['as' => 'adverts.create.my']);
        $routes->put('update', 'AdvertsUserController::updateUserAdvert', ['as' => 'adverts.update.my', 'filter' => 'adverts']);
        $routes->put('upload/(:num)', 'AdvertsUserController::uploadAdvertImages/$1', ['as' => 'adverts.upload.my']);
        $routes->delete('delete-image/(:any)', 'AdvertsUserController::deleteUserAdvertImage/$1', ['as' => 'adverts.delete.image']);
        $routes->put('archive', 'AdvertsUserController::archiveUserAdvert', ['as' => 'adverts.archive.my']);
        $routes->put('recover', 'AdvertsUserController::recoverUserAdvert', ['as' => 'adverts.recover.my']);
        $routes->delete('delete', 'AdvertsUserController::deleteUserAdvert', ['as' => 'adverts.delete.my']);

        //Perguntas e respostas
        $routes->get('questions/(:any)', 'AdvertsUserController::userAdvertQuestions/$1', ['as' => 'adverts.my.edit.questions']);
        $routes->put('questions/(:num)', 'AdvertsUserController::userAdvertAnswerQuestions/$1', ['as' => 'adverts.my.answer.questions']);
    });
});
