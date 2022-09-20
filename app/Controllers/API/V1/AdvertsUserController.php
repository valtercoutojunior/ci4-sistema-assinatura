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
        /** @todo recuperar a paginação  */

        $adverts = (object) $this->advertService->getAllAdvertsForUserAPI();

        $pager = $adverts->pager;
        return $this->respond(
            [
                'code'      => 200,
                'adverts'   => $adverts->adverts,
                'pager'     => $adverts->pager,
            ]
        );
    }
}
