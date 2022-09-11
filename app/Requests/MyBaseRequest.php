<?php

namespace App\Requests;

class MyBaseRequest
{
    protected $validation;
    protected $request;
    protected $response;

    public function __construct()
    {
        $this->validation   = service('validation');
        $this->request      = service('request');
        $this->response     = service('response');
    }

    protected function validate(string $ruleGroup, bool $respondWithRedirect = false)
    {
        $this->validation->setRuleGroup($ruleGroup);
        if (!$this->validation->withRequest($this->request)->run()) {

            if ($respondWithRedirect) {
                $this->responseWithRedirect();
            }
            $this->respondWithValidationErros();
        }
    }

    private function responseWithRedirect()
    {
        redirect()
            ->back()
            ->with('danger', lang('App.danger_validations'))
            ->with('errors_model', $this->validation->getErrors())
            ->withInput()
            ->send();
        exit; //Não pode esquecer do exit
    }

    private function respondWithValidationErros(): array
    {
        $response = [
            'success' => false,
            'token' => csrf_hash(),
            'errors' => $this->validation->getErrors(),
        ];

        if (url_is('api*')) {
            unset($response['token']);
        }
        $this->response->setJSON($response)->send();
        exit;
    }

    public function respondWithMessage(bool $success = true, string $message = '', int $statusCode = 200): array
    {
        $response = [
            'code' => $statusCode,
            'success' => $success,
            'token' => csrf_hash(),
            'message' => $message,
        ];

        if (url_is('api*')) {
            unset($response['token']);
        }
        return $response;
    }
}
