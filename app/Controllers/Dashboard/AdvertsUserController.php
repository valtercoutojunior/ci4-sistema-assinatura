<?php

namespace App\Controllers\Dashboard;

use App\Entities\Advert;
use App\Requests\AdvertRequest;
use App\Services\AdvertService;
use App\Services\CategoryService;
use CodeIgniter\Config\Factories;
use App\Controllers\BaseController;
use App\Services\GerencianetService;

class AdvertsUserController extends BaseController
{
    private $advertService;
    private $categoryService;
    private $advertRequest;

    public function __construct()
    {
        $this->advertService    = Factories::class(AdvertService::class);
        $this->categoryService  = Factories::class(CategoryService::class);
        $this->advertRequest    = Factories::class(AdvertRequest::class);
    }


    /**
     * Renderiza a view de index 
     * com todos os anuncios do usuário logado desde que o anuncio não esteja aquivado
     * @return void
     */
    public function index()
    {
        return view('Dashboard/Adverts/index');
    }


    /**
     * Renderiza a view com os dados dos anuncios arquivados
     * @return void
     */
    public function archived()
    {
        return view('Dashboard/Adverts/archived');
    }


    /**
     * Metodo que busca e preenche os dados do datatable.net
     * somente os anuncios que não estão arquivados
     *
     * @return void
     */
    public function getUserAdverts()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $response = [
            'data' => $this->advertService->getAllAdverts(),
        ];
        return $this->response->setJSON($response);
    }

    /**
     * metodo que busca e preenche os dados do datatable.net
     * somente anuncioos que estão arquivados
     *
     * @return void
     */
    public function getUserArchivedAdverts()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $response = [
            'data' => $this->advertService->getArchivedAdverts(),
        ];
        return $this->response->setJSON($response);
    }


    public function getUserAdvert()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $advert = $this->advertService->getAdvertByID($this->request->getGetPost('id'));

        $options = [
            'class' => 'form-control',
            'placeholder' => lang('Categories.label_choose_category'),
            'selected' => !(empty($advert->category_id)) ? $advert->category_id : "",
        ];

        $response = [
            'advert' => $advert,
            'situations' => $this->advertService->getDropdownSituations($advert->situation),
            'categories' => $this->categoryService->getMultinivel('category_id', $options),
        ];
        return $this->response->setJSON($response);
    }

    public function createUserAdvert()
    {
        $this->advertRequest->validateBeforeSave('advert');
        $advert = new Advert($this->removeSpoofingFromRequest());
        $this->advertService->trySaveAdvert($advert);
        return $this->response->setJSON($this->advertRequest->respondWithMessage(message: lang('App.success_saved')));
    }

    public function updateUserAdvert()
    {
        $this->advertRequest->validateBeforeSave('advert');
        $advert = $this->advertService->getAdvertByID($this->request->getGetPost('id'));
        $advert->fill($this->removeSpoofingFromRequest());
        $this->advertService->trySaveAdvert($advert);
        return $this->response->setJSON($this->advertRequest->respondWithMessage(message: lang('App.success_saved')));
    }

    public function getCategoriesAndSituations()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $options = [
            'class' => 'form-control',
            'placeholder' => lang('Categories.label_choose_category'),
            'selected' => "",
        ];

        $response = [
            'situations' => $this->advertService->getDropdownSituations(),
            'categories' => $this->categoryService->getMultinivel('category_id', $options),
        ];
        return $this->response->setJSON($response);
    }

    public function editUserAdvertImages(int $id = null)
    {
        $data = [
            'advert'        => $advert = $this->advertService->getAdvertByID($id),
            'hiddens'       => ['_method' => 'PUT'],  //Para o upload de imagens(editando um anuncio)
            'hiddensDelete' => ['id' => $advert->id, '_method' => 'DELETE'],  //Para deletar/remover imagem(ns) do anuncio selecionado passando o id do anuncio e a imagem
        ];
        return view('Dashboard/Adverts/edit_images', $data);
    }

    public function uploadAdvertImages(int $id = null)
    {
        $this->advertRequest->validateBeforeSave('advert_images', respondWithRedirect: true);
        $this->advertService->tryStoreAdvertImages($this->request->getFiles('images'), $id);
        return redirect()->back()->with('success', lang('App.success_image_advert'));
    }

    public function deleteUserAdvertImage(string $image = null)
    {
        $this->advertService->tryDeleteAdvertImage($this->request->getGetPost('id'), $image);
        return redirect()->back()->with('success', lang('App.success_deleted'));
    }

    public function archiveUserAdvert()
    {
        $this->advertService->tryArchiveAdvert($this->request->getGetPost('id'));
        return $this->response->setJSON($this->advertRequest->respondWithMessage(message: lang('App.success_archived')));
    }

    public function recoverUserAdvert()
    {
        $this->advertService->tryRecoverAdvert($this->request->getPost('id'));
        return $this->response->setJSON($this->advertRequest->respondWithMessage(message: lang('App.success_recovered')));
    }

    public function deleteUserAdvert()
    {
        $this->advertService->tryDeleteAdvert($this->request->getGetPost('id'));
        return $this->response->setJSON($this->advertRequest->respondWithMessage(message: lang('App.success_deleted')));
    }
}
