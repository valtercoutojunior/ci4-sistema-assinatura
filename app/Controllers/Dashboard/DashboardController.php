<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Requests\UserRequest;
use App\Services\GerencianetService;
use App\Services\UserService;
use CodeIgniter\Config\Factories;

class DashboardController extends BaseController
{
    private $user;
    private $userRequest;
    private $userService;
    private $gerencianetService;

    public function __construct()
    {
        $this->user = service('auth')->user();
        $this->userRequest = Factories::class(UserRequest::class);
        $this->userService = Factories::class(UserService::class);
        $this->gerencianetService = Factories::class(GerencianetService::class);
    }

    public function index()
    {
        return view('Dashboard/Home/index');
    }

    public function myPlan()
    {
        $data = [
            'subscription'  => $this->gerencianetService->getUserSubscription(),
            'hiddens'       => [
                '_method' => 'DELETE',
            ],

        ];
        return view('Dashboard/Home/my_plan', $data);
    }

    /*** Mostar a view com os dados do usuário para serem atualizados */
    public function profile()
    {
        $data = [
            'title' => 'Atualizando os dados de perfil',
            'hiddens' => [
                'id'        => $this->user->id,
                '_method'   => 'PUT',
            ],
        ];
        return view('Dashboard/Home/profile', $data);
    }

    /*** Envia os dados que o usuário atualizou para a classe UserService */
    public function updateProfile()
    {
        $this->userRequest->validateBeforeSave('user_profile', respondWithRedirect: true);
        $this->userService->tryUpdateProfile($this->removeSpoofingFromRequest());
        if (session()->has('choice')) {
            return redirect()->to(session('choice'));
        }
        return redirect()->back()->with('success', lang('App.success_saved'));
    }

    /*** Mostar a view para o user trocar a sua senha */
    public function access()
    {
        $data = [
            'title' => 'Alterar Minha Senha',
            'hiddens' => [
                'id'        => $this->user->id,
                '_method'   => 'PUT',
            ],
        ];
        return view('Dashboard/Home/access', $data);
    }

    /*** Envia os dados que o usuário atualize a sua senha */
    public function updateAccess()
    {
        $request = (object) $this->removeSpoofingFromRequest();

        if (!$this->userService->currentPasswordIsValid($request->current_password)) {
            return redirect()->back()->with('danger', 'Senha atual inválida!!');
        }
        $this->userRequest->validateBeforeSave('access_update', respondWithRedirect: true);
        $this->userService->tryUpdateAccess($request->password);
        return redirect()->back()->with('success', lang('App.success_saved'));
    }

    public function cancelSubscription()
    {
        $this->gerencianetService->cancelSubscription();
        return redirect()->route('dashboard')->with('success', "Sua assinatura foi cancelada com sucesso!");
    }
}
