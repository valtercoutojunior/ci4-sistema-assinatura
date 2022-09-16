<?php

namespace App\Filters;

use App\Services\GerencianetService;
use CodeIgniter\Config\Factories;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;

class AdvertFilter implements FilterInterface
{
    use ResponseTrait;

    protected $response;
    protected $gerencianetService;

    public function __construct()
    {
        $this->response             = service('response');
        $this->gerencianetService   = Factories::class(GerencianetService::class);
    }
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {

        if ($this->gerencianetService->userReachedAdvertsLimit()) {

            $countUserAdverts = $this->gerencianetService->countAllUserAdverts();
            $countFeaturesAdverts = $this->gerencianetService->getUserSubcription()->features->adverts;

            //Verifica se a requisição é pela api
            if (url_is('api/adverts/create*') || $request->isAJAX()) {
                return $this->fail("você já cadastrou {$countUserAdverts} anúnicios. Seu plano contempla o cadastro de {$countFeaturesAdverts} anúncios. Para continuar você deverá migrar de plano.", ResponseInterface::HTTP_UNAUTHORIZED);
            }
            return redirect()->back()->with('danger', "você já cadastrou {$countUserAdverts} anúnicios. Seu plano contempla o cadastro de {$countFeaturesAdverts} anúncios. Para continuar você deverá migrar de plano.");
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
