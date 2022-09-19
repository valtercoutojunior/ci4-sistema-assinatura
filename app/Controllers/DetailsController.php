<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\AdvertService;
use App\Services\ImageService;
use CodeIgniter\Commands\Server\Serve;
use CodeIgniter\Config\Factories;

class DetailsController extends BaseController
{

    private $advertService;

    public function __construct()
    {
        $this->advertService = Factories::class(AdvertService::class);
    }

    public function details(string $code = null)
    {
        $advert = $this->advertService->getAdvertByCode($code);
        $criteria = [
            'categories.slug'   => $advert->category_slug,
            'adverts.code !='   => $advert->code,
        ];

        $advertsFromSameCategory = (object) $this->advertService->getAllAdvertsPaginated(perPage: 10, criteria: $criteria);

        $data = [
            'title'         => "Detalhes do anúncio {$advert->title}",
            'advert'        => $advert,
            'moreAdverts'   => $advertsFromSameCategory->adverts,
            'pager'         => $advertsFromSameCategory->pager,
        ];
        return view('Web/Details/index', $data);
    }

    public function image(string $image = null, string $sizeImage = 'regular')
    {
        ImageService::showImage('adverts', $image, $sizeImage);
    }

    public function toask(string $code = null)
    {
        //Pega os dados do anuncio
        $advert = $this->advertService->getAdvertByCode($code);

        //Verifica se a pessoa que está fazendo a perguntaé a sona do anuncio
        if ($advert->user_id == service('auth')->user()->id) {
            return redirect()->back()->with('info_ask', "Esse anúncio pertence a você! Sua pergunta será ignorada");
        }

        $this->advertService->tryInsertAdvertQuestion($advert, $this->request->getPost('ask'));

        return redirect()->back()->with('success_ask', "Sua pergunta foi enviada com sucesso!");
    }
}
