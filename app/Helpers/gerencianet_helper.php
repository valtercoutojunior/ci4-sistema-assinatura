<?php

use App\Services\GerencianetService;
use CodeIgniter\Config\Factories;

if (!function_exists('reason_charge')) {
    function reason_charge(string $status): string
    {
        return Factories::class(GerencianetService::class)->reason_charge($status);
    }
}
