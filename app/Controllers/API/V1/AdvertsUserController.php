<?php

namespace App\Controllers\API\V1;

use App\Controllers\BaseController;
use App\Services\AdvertService;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Config\Factories;

class AdvertsUserController extends BaseController
{
    use ResponseTrait;

    private $advertService;

    public function __construct()
    {
        $this->advertService = Factories::class(AdvertService::class);
    }

    public function index()
    {
        $perPage = $this->request->getGet('perPage');
        $page = $this->request->getGet('page');

        $adverts = (object) $this->advertService->getAllAdvertsForUserAPI(perPage: $perPage, page: $page);

        $pager = $adverts->pager;
        return $this->respond(
            [
                'code'      => 200,
                'adverts'   => $adverts->adverts,
                'pager'     => $adverts->pager,
            ]
        );
    }

    public function getUserAdvert(int $advertID = null)
    {
        return $this->respond(
            [
                'code' => 200,
                'advert' => $this->advertService->getAdvertByID($advertID)
            ]
        );
    }

    public function deleteUserAdvert(int $advertID = null)
    {
        $advert = $this->advertService->getAdvertByID($advertID);
        $this->advertService->tryDeleteAdvert($advert->id, wantValidateAdvert: false);

        return $this->respond(
            [
                'code' => 200,
                'message' => lang('App.success_deleted')
            ]
        );
    }
}
