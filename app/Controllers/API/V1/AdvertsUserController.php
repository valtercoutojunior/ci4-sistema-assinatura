<?php

namespace App\Controllers\API\V1;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class AdvertsUserController extends BaseController
{
    use ResponseTrait;


    public function index()
    {
        echo 'Chegamos na API';
    }
}
