<?php

namespace App\Controllers;

use App\Requests\GerencianetRequest;
use App\Services\AdvertService;
use App\Services\CategoryService;
use App\Services\GerencianetService;
use App\Services\PlanService;
use App\Services\UserService;
use CodeIgniter\Config\Factories;

class HomeController extends BaseController
{
    private $planService;
    private $userService;
    private $gerencianetRequest;
    private $gerencianetService;
    private $advertService;

    public function __construct()
    {
        $this->planService          = Factories::class(PlanService::class);
        $this->userService          = Factories::class(UserService::class);
        $this->gerencianetRequest   = Factories::class(GerencianetRequest::class);
        $this->gerencianetService   = Factories::class(GerencianetService::class);
        $this->advertService        = Factories::class(AdvertService::class);
    }

    public function index()
    {
        $advertsForHome = (object) $this->advertService->getAllAdvertsPaginated(perPage: 20);

        $data = [
            'title'     => 'Home do Sistema de Anúncios',
            'adverts'   => $advertsForHome->adverts,
            'pager'     => $advertsForHome->pager,
        ];

        return view('Web/Home/index', $data);
    }

    public function pricing()
    {
        $data = [
            'title' => 'Conheça nossos planos',
            'plans' => $this->planService->getPlansToSell(),
        ];
        return view('Web/Home/pricing', $data);
    }

    /*** Mostra a view para o cliente pagar o plano que ele escolheu */
    public function choice(int $planID = null)
    {
        if ($this->gerencianetService->userHasSubscription()) {
            return redirect()->route('dashboard')->with('info', "Ops!! Você já tem uma assinatura. Para adquirir ou mudar o tipo de assinatura você deve cancelar a assinatura que você já tem. E assinar uma nova.");
        }

        if (!$this->userService->userDataIsComplete()) {
            /*** Caso o usuário tenha logado antes de comprar o plano */
            session()->set('choice', current_url());
            return redirect()->route('profile')->with('info', service('auth')->user()->flashMessageToUsuer());
        }

        $plan = $this->planService->getChoosenPlan($planID);
        $data = [
            'title' => "Realize o Pagamento do Plando Escolhido {$plan->name}",
            'plan'  => $plan,
        ];
        return view('Web/Home/choice', $data);
    }

    public function attemptPay(int $planID = null)
    {
        $this->gerencianetRequest->validateBeforeSave($this->request->getPost('payment_method'));
        $plan = $this->planService->getChoosenPlan($planID);
        $request = (object) $this->removeSpoofingFromRequest();

        if ($request->payment_method == $this->gerencianetService::PAYMENT_METHOD_BILLET) {
            $qrcodeImage = $this->gerencianetService->createSubscription($plan, $request);
            $qrcodeImageBuilded = img([
                'src' => $qrcodeImage,
                'width' => '150px'
            ]);
            session()->setFlashdata('success', "Muito obrigado!! Aproveite para realizar o pagamento do seu boleto com pix!! <br/><br/>{$qrcodeImageBuilded}");
            return $this->response->setJSON($this->gerencianetRequest->respondWithMessage('Muito obrigado!! Agora estamos aguardando a confirmação do pagamento do sua assinatura'));
        }

        $this->gerencianetService->createSubscription($plan, $request);
        session()->setFlashdata('success', 'Muito obrigado!! Agora estamos aguardando a confirmação do pagamento do sua assinatura');
        return $this->response->setJSON($this->gerencianetRequest->respondWithMessage('Muito obrigado!! Agora estamos aguardando a confirmação do pagamento do sua assinatura'));
    }

    public function userAdverts(string $userName = null)
    {
        $user = $this->userService->getUserByCriteria(['username' => $userName]);
        $adverts = (object) $this->advertService->getAllAdvertsPaginated(perPage: 10, criteria: ['adverts.user_id' => $user->id]);
        $userName = $user->name ?? $user->name;
        $data = [
            'title'     => "Anúncios do usuário {$userName}",
            'adverts'   => $adverts->adverts,
            'pager'     => $adverts->pager,
        ];
        return view('Web/Home/adverts_by_username', $data);
    }

    public function category(string $categorySlug = null)
    {
        $category = Factories::class(CategoryService::class)->getCategoryBySlug($categorySlug);
        $adverts = (object) $this->advertService->getAllAdvertsPaginated(perPage: 10, criteria: ['categories.slug' => $category->slug]);

        $data = [
            'title'     => "Resultado para a Categoria \"{$category->name}\"",
            'adverts'   => $adverts->adverts,
            'pager'     => $adverts->pager,
            'category'  => $category,
        ];
        return view('Web/Home/adverts_by_category', $data);
    }

    public function categoryCity(string $categorySlug = null, string $citySlug = null)
    {
        //Verificamos se existe a categoria
        $category = Factories::class(CategoryService::class)->getCategoryBySlug($categorySlug);

        $criteria = [
            'categories.slug'       => $category->slug,
            'adverts.city_slug'     => $citySlug
        ];

        $adverts = (object) $this->advertService->getAllAdvertsPaginated(perPage: 10, criteria: $criteria);
        $city = array_column($adverts->adverts, 'city')[0];

        $data = [
            'title'     => "\"{$category->name}\" em \"{$city}\"",
            'adverts'   => $adverts->adverts,
            'pager'     => $adverts->pager,
            'category'  => $category,
        ];
        return view('Web/Home/adverts_by_category_city', $data);
    }
}
