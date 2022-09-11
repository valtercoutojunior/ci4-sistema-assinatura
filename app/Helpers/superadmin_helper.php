<?php

use App\Models\UserModel;
use CodeIgniter\Config\Factories;

if (!function_exists('get_superadmin')) {

    function get_superadmin()
    {
        return Factories::models(UserModel::class)->getSuperadmin();
    }
}
