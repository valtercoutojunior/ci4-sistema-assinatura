<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use \Fluent\Auth\Filters\AuthenticationFilter;
use phpDocumentor\Reflection\Types\This;

class AuthFilter extends AuthenticationFilter implements FilterInterface
{
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
        return $this->authenticate($request, $arguments);
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

    protected function authenticate($request, $guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                return $this->auth->shouldUse($guard);
            }
        }

        /**
         * Cria uma sessão para quando o usuário logar redirecionar o user para 
         * a view de plando escolhido e continuar 
         */
        if (url_is('choice*')) {
            session()->set('choice', current_url());
        }

        /**
         * Verifica se foi clicado no botão de pergunta e o usuário ainda não estava logado
         */
        if (url_is('toask*')) {
            session()->set('details', previous_url()); //Aqui é previos_url
            session()->set('ask', $request->getPost('ask')); //seta na sessão a pergunta para quando o usuário logar na aplicação
        }


        return $this->unauthenticated($request, $guards);
    }

    protected function unauthenticated($request, $guards)
    {
        if ($request->isAJAX()) {
            return $this->fail('Unauthenticated.', ResponseInterface::HTTP_UNAUTHORIZED);
        }

        if (url_is('api/dashboard*')) {
            return $this->fail('Unauthenticated.', ResponseInterface::HTTP_UNAUTHORIZED);
        }

        if (url_is('api/adverts*')) {
            return $this->fail('Unauthenticated.', ResponseInterface::HTTP_UNAUTHORIZED);
        }

        //Garantimos que realmente o client está requisitando somente pela api
        if (in_array('api', $guards)) {
            return $this->fail('Unauthenticated.', ResponseInterface::HTTP_UNAUTHORIZED);
        }



        return redirect()->route('login');
    }
}
