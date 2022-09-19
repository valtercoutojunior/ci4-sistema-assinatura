<?php

$routes->group('{locale}/manager', ['namespace' => 'App\Controllers\Manager', 'filter' => 'superadmin'], function ($routes) {
    $routes->get('/', 'ManagerController::index', ['as' => 'manager']);
    //Grupo de categorias
    $routes->group('categories', function ($routes) {
        $routes->get('/', 'CategoriesController::index', ['as' => 'categories']);
        $routes->get('archived', 'CategoriesController::archived', ['as' => 'categories.archived']);
        $routes->get('get-all-archived', 'CategoriesController::getAllCategoriesArchived', ['as' => 'categories.get.all.archived']);
        $routes->get('get-all', 'CategoriesController::getAllCategories', ['as' => 'categories.get.all']);
        $routes->get('get-info', 'CategoriesController::getCategoryInfo', ['as' => 'categories.get.info']);
        $routes->get('get-parents', 'CategoriesController::getDropdownParents', ['as' => 'categories.parents']);
        $routes->post('create', 'CategoriesController::create', ['as' => 'categories.create']);
        $routes->put('update', 'CategoriesController::update', ['as' => 'categories.update']);
        $routes->put('archive', 'CategoriesController::archive', ['as' => 'categories.archive']);
        $routes->put('recover', 'CategoriesController::recover', ['as' => 'categories.recover']);
        $routes->delete('delete', 'CategoriesController::delete', ['as' => 'categories.delete']);
    });

    //Grupo de planos
    $routes->group('plans', function ($routes) {
        $routes->get('/', 'PlansController::index', ['as' => 'plans']);
        $routes->get('archived', 'PlansController::archived', ['as' => 'plans.archived']);
        $routes->get('get-all-archived', 'PlansController::getAllPlansArchived', ['as' => 'plans.get.all.archived']);
        $routes->get('get-all', 'PlansController::getAllPlans', ['as' => 'plans.get.all']);
        $routes->get('get-info', 'PlansController::getPlanInfo', ['as' => 'plans.get.info']);
        $routes->get('get-recorrences', 'PlansController::getRecorrences', ['as' => 'plans.get.recorrences']);

        $routes->post('create', 'PlansController::create', ['as' => 'plans.create']);
        $routes->put('update', 'PlansController::update', ['as' => 'plans.update']);
        $routes->put('archive', 'PlansController::archive', ['as' => 'plans.archive']);
        $routes->put('recover', 'PlansController::recover', ['as' => 'plans.recover']);
        $routes->delete('delete', 'PlansController::delete', ['as' => 'plans.delete']);
    });

    //Adverts
    $routes->group('adverts', function ($routes) {
        $routes->get('/', 'AdvertsManagerController::index', ['as' => 'adverts.manager']);
        $routes->get('get-all-manager-adverts', 'AdvertsManagerController::getAllAdverts', ['as' => 'get.all.manager.adverts']);
        $routes->get('get-manager-advert', 'AdvertsManagerController::getManagerAdvert', ['as' => 'get.manager.advert']);
        $routes->put('update-manager-advert', 'AdvertsManagerController::updateManagerAdvert', ['as' => 'adverts.manager.update']);
        $routes->put('archive-manager-advert', 'AdvertsManagerController::archiveManagerAdvert', ['as' => 'adverts.manager.archive']);
        $routes->get('archived', 'AdvertsManagerController::archived', ['as' => 'adverts.manager.archived']);
        $routes->get('get-archived-manager-adverts', 'AdvertsManagerController::getManagerArchivedAdverts', ['as' => 'get.archived.manager.adverts']);

        $routes->delete('delete', 'AdvertsManagerController::deleteManagerAdvert', ['as' => 'adverts.manager.delete']);
        $routes->get('show-manager-images/(:num)', 'AdvertsManagerController::showManagerAdvertImages/$1', ['as' => 'adverts.manager.edit.images']);


        // $routes->get('get-categories-situations', 'AdvertsUserController::getCategoriesAndSituations', ['as' => 'get.categories.situations']);
        // $routes->get('edit-images/(:num)', 'AdvertsUserController::editUserAdvertImages/$1', ['as' => 'adverts.my.edit.images']);
        // $routes->post('create', 'AdvertsUserController::createUserAdvert', ['as' => 'adverts.create.my']);
        // $routes->put('update', 'AdvertsUserController::updateUserAdvert', ['as' => 'adverts.update.my', 'filter' => 'adverts']);
        // $routes->put('upload/(:num)', 'AdvertsUserController::uploadAdvertImages/$1', ['as' => 'adverts.upload.my']);
        // $routes->delete('delete-image/(:any)', 'AdvertsUserController::deleteUserAdvertImage/$1', ['as' => 'adverts.delete.image']);
        // //Perguntas e respostas
        // $routes->get('questions/(:any)', 'AdvertsUserController::userAdvertQuestions/$1', ['as' => 'adverts.my.edit.questions']);
        // $routes->put('questions/(:num)', 'AdvertsUserController::userAdvertAnswerQuestions/$1', ['as' => 'adverts.my.answer.questions']);
    });
});
