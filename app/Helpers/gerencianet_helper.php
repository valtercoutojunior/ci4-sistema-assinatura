<?php

use App\Services\GerencianetService;
use CodeIgniter\Config\Factories;

if (!function_exists('reason_charge')) {
    function reason_charge(string $status): string
    {
        return Factories::class(GerencianetService::class)->reasonCharge($status);
    }
}

//Verifica se o usuario logado já alcançou a quantidade de anuncios permitidos conforme o plano que ele comprou
if (!function_exists('user_reached_adverts_limit')) {
    function user_reached_adverts_limit(): bool
    {
        return Factories::class(GerencianetService::class)->userReachedAdvertsLimit();
    }
}

//Retorna a quantidade atual de anuncios que o usuário tem cadastrados incluive os arquivado
if (!function_exists('count_all_user_adverts')) {
    function count_all_user_adverts(): int
    {
        return Factories::class(GerencianetService::class)->countAllUserAdverts();
    }
}
