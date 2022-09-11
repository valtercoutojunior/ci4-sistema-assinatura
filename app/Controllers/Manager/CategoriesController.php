<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use App\Entities\Category;
use App\Requests\CategoryRequest;
use App\Services\CategoryService;
use CodeIgniter\Config\Factories;

class CategoriesController extends BaseController
{
    private $categoryService;
    private $categoryRequest;

    /**
     * construtor da classe
     */
    public function __construct()
    {
        $this->categoryService = Factories::class(CategoryService::class);
        $this->categoryRequest = Factories::class(CategoryRequest::class);
    }

    /** Chama a view com os dados das categorias encontradas  */
    public function index()
    {
        return view('Manager/Categories/index');
    }

    /** * Busca todas as categorias e apresenta os dados encontrados na view */
    public function getAllCategories()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }
        return $this->response->setJSON(['data' => $this->categoryService->getAllCategories()]);
    }

    /** * Busca todas as categorias e apresenta os dados encontrados na view */
    public function getAllCategoriesArchived()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }
        return $this->response->setJSON(['data' => $this->categoryService->getAllCategoriesArchived()]);
    }

    /*** Busca todas as informações de uma categoria selecionada */
    public function getCategoryInfo()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }
        $category = $this->categoryService->getCategory($this->request->getGetPost('id'));
        $options = [
            'class' => 'form-control',
            'placeholder' =>  lang('Categories.label_choose_category'),
            'selected' => !(empty($category->parent_id)) ? $category->parent_id : "",

        ];

        $response = [
            'category' => $category,
            'parents' => $this->categoryService->getMultinivel('parent_id', $options, $category->id),
        ];
        return $this->response->setJSON($response);
    }

    /** Cria uma nova categoria */
    public function create()
    {
        $this->categoryRequest->validateBeforeSave('category');

        $category = new Category($this->removeSpoofingFromRequest());
        $this->categoryService->trySaveCategory($category);
        return $this->response->setJSON($this->categoryRequest->respondWithMessage(message: lang('App.success_saved')));
    }

    /** Atualida os dados da categoria selecionada */
    public function update()
    {
        $this->categoryRequest->validateBeforeSave('category');
        $category = $this->categoryService->getCategory($this->request->getGetPost('id'));
        $category->fill($this->removeSpoofingFromRequest());
        $this->categoryService->trySaveCategory($category);
        return $this->response->setJSON($this->categoryRequest->respondWithMessage(message: "Dados salvos com sucesso!"));
    }

    public function archive()
    {
        $this->categoryService->tryArchiveCategory($this->request->getGetPost('id'));
        return $this->response->setJSON($this->categoryRequest->respondWithMessage(message: lang('App.success_archived')));
    }

    /** Mostar a view com todas as categorias arquivadas  */
    public function archived()
    {
        return view('Manager/Categories/archived');
    }

    public function getDropdownParents()
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
            'parents' => $this->categoryService->getMultinivel('parent_id', $options),
        ];
        return $this->response->setJSON($response);
    }

    public function recover()
    {
        $this->categoryService->tryRecoverCategory($this->request->getGetPost('id'));
        return $this->response->setJSON($this->categoryRequest->respondWithMessage(message: lang('App.success_recovered')));
    }

    public function delete()
    {
        $this->categoryService->tryDeleteCategory($this->request->getGetPost('id'));
        return $this->response->setJSON($this->categoryRequest->respondWithMessage(message: lang('App.success_deleted')));
    }
}
