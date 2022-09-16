<?php

namespace App\Services;

use Exception;
use App\Entities\Plan;
use App\Models\AdvertModel;
use Gerencianet\Gerencianet;
use CodeIgniter\Config\Factories;
use App\Services\SubscriptionService;
use Gerencianet\Exception\GerencianetException;
use phpDocumentor\Reflection\Types\This;
use stdClass;

class GerencianetService
{
    public const PAYMENT_METHOD_BILLET = 'billet';
    public const PAYMENT_METHOD_CREDIT = 'credit';

    private const STATUS_NEW           = 'new';
    private const STATUS_WAITHING      = 'waiting';
    private const STATUS_PAID          = 'paid';
    private const STATUS_UNPAID        = 'unpaid';
    private const STATUS_REFUNDED      = 'refunded';
    private const STATUS_CONTESTED     = 'contested';
    private const STATUS_SETTLED       = 'settled';
    private const STATUS_CANCELED      = 'canceled';

    private $options;
    private $user;
    private $subscriptionService;
    private $userSubscription;

    public function __construct()
    {
        $this->options = [
            'client_id'     => env('GERENCIANET_CLIENT_ID'),
            'client_secret' => env('GERENCIANET_CLIENT_SECRET'),
            'sandbox'       => env('GERENCIANET_SANDBOX'), // altere conforme o ambiente (true = homologação e false = producao)
            'timeout'       => env('GERENCIANET_TIMEOUT'),
        ];
        //Pega todos os dados do usuário logado
        $this->user = service('auth')->user();
        $this->subscriptionService = Factories::class(SubscriptionService::class);
    }

    public function createPlan(Plan $plan)
    {
        //define a periodicidade das cobranças a serem geradas
        $plan->setIntervalRepeats();

        $body = [
            'name'      => $plan->name, //Define o nome do plano que vai ser criado na gerencianet
            'interval'  => $plan->interval, //Denife o intervalo de cobraça do plano na gerencianet
            'repeats'   => $plan->repeats
        ];

        try {
            $api = new Gerencianet($this->options);
            $response = $api->createPlan([], $body);
            //Pega os dados que foram retornados pela gerencia net
            $plan->plan_id = (int)$response['data']['plan_id'];
        } catch (GerencianetException $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Erro ao tentar criar plano na gerencianet');
        } catch (Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Erro ao tentar criar plano na gerencianet');
        }
    }

    /**
     * Atualiza o plano na gerencianet
     *
     * @param Plan $plan
     * @return void
     */
    public function updatePlan(Plan $plan)
    {
        $params = ['id' => $plan->plan_id];
        $body = ['name' => $plan->name];

        try {
            $api = new Gerencianet($this->options);
            $response = $api->updatePlan($params, $body);

            // echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</pre>';
        } catch (GerencianetException $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Erro ao tentar atualizar plano na gerencianet');
        } catch (Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Erro ao tentar atualizar plano na gerencianet');
        }
    }

    public function deletePlan($planID)
    {
        $params = ['id' => $planID];

        try {
            $api = new Gerencianet($this->options);
            $response = $api->deletePlan($params, []);
        } catch (GerencianetException $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Erro ao tentar deletar plano na gerencianet');
        } catch (Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Erro ao tentar deletar plano na gerencianet');
        }
    }

    /*************************************************
     * ********* GERENCIANET ASSINATURA **************
     ************************************************/

    public function createSubscription(Plan $choosenPlan, object $request)
    {
        //Aqui vai o id do plano que está la na gerencianet
        $params = ['id' => $choosenPlan->plan_id];

        $items = [
            [
                'name'      => $choosenPlan->name, //Nome do plano
                'amount'    => 1, //Quantidade de assinaturas              
                'value'     => (int) str_replace([',', '.'], '', $choosenPlan->value),
            ],
        ];

        $body = [
            'items' => $items
        ];

        try {
            $api = new Gerencianet($this->options);
            $response = $api->createSubscription($params, $body);

            //Retorna o id da assinatura la na gerencianet
            $choosenPlan->subscription_id = (int) $response['data']['subscription_id'];
            if ($request->payment_method == self::PAYMENT_METHOD_BILLET) {
                $qrcodeImage = $this->paySubscription($choosenPlan, $request);
                return $qrcodeImage;
            }

            //Envia o plano para pagamento
            $this->paySubscription($choosenPlan, $request);
        } catch (GerencianetException $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Erro ao tentar criar assinatura Gerencianet');
        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Erro ao tentar criar assinatura');
        }
    }

    private function paySubscription(Plan $choosenPlan, object $request)
    {
        //Pega o id a assinatura que veio la da gerencianet
        $params = ['id' => $choosenPlan->subscription_id];

        //Dados do usuário logado
        $customer = [
            'name'          => $this->user->fullname(),
            'cpf'           => str_replace(['.', '-'], '', $this->user->cpf),
            'phone_number'  => str_replace(['(', ')', ' ', '-'], '', $this->user->phone),
            'email'         => $this->user->email,
            'birth'         => $this->user->birth,
        ];

        //Dados de endereço do cliente quando for cartão de crédito
        $billingAddress = [
            'street'        => $request->street,
            'number'        => ($request->number ? (int) $request->street : 'Não informado'),
            'neighborhood'  => $request->neighborhood,
            'zipcode'       => str_replace('-', '', $request->zipcode),
            'city'          => $request->city,
            'state'         => $request->state,
        ];

        //Verifica o tipo de pagamento(Boleto/Cartao)
        if ($request->payment_method == self::PAYMENT_METHOD_BILLET) {
            $body = [
                'payment' => [
                    'banking_billet' => [
                        'expire_at' => $request->expire_at,
                        'customer' => $customer
                    ]
                ]
            ];
        } else {
            $body = [
                'payment' => [
                    'credit_card' => [
                        'billing_address'   => $billingAddress,
                        'payment_token'     => $request->payment_token, //Pega o token da assinatura quando for paga com cartão de credito
                        'customer'          => $customer
                    ]
                ]
            ];
        }

        try {
            $api = new Gerencianet($this->options);
            $response = $api->paySubscription($params, $body);
            $this->subscriptionService->tryInsertSubscription($choosenPlan, $response['data']);
            $this->removeSessionData();

            if ($request->payment_method == self::PAYMENT_METHOD_BILLET) {
                return $response['data']['pix']['qrcode_image'];
            }
        } catch (GerencianetException $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Erro ao tentar pagar assinatura Gerencianet');
        } catch (Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Erro ao tentar pagar assinatura');
        }
    }

    public function detailsSubscription(int $subscriptionID): array
    {
        $params = [
            'id' => $subscriptionID
        ];

        try {
            $api = new Gerencianet($this->options);
            $response = $api->detailSubscription($params, []);
            return $response['data'];
        } catch (GerencianetException $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Erro ao tentar buscar assinatura Gerencianet');
        } catch (Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Erro ao tentar buscar assinatura');
        }
    }

    public function getUserSubscription()
    {
        if (is_null($this->userSubscription)) {
            $this->userSubscription = $this->subscriptionService->getUserSubscription();
        }
        //Verifica se ainda está null
        if (is_null($this->userSubscription)) {
            return null;
        }

        //Busca na gerencianet o status atual da assinatura
        if (!$this->userSubscription->isValid()) {
            $details = $this->detailsSubscription($this->userSubscription->subscription_id);

            if ($details['status'] == self::STATUS_CANCELED) {
                $this->subscriptionService->tryDestroyUserSubscription($this->userSubscription->subscription_id);
                //user não terá mais assinatura em nosso lado
                return null;
            }
            $this->defineSubscriptionSituation($details);
        }
        return $this->userSubscription;
    }

    public function reasonCharge(string $status): string
    {
        $message = match ($status) {
            self::STATUS_NEW        => 'Cobrança gerada, aguardando a definição da forma de pagamento.',
            self::STATUS_WAITHING   => 'Aguardando a confirmação do pagamento.',
            self::STATUS_PAID       => 'Pagamento confirmado.',
            self::STATUS_UNPAID     => 'Não foi possível confirmar o pagamento da cobrança.',
            self::STATUS_REFUNDED   => 'Pagamento devolvido pelo lojista ou pelo intermediador Gerencianet.',
            self::STATUS_CONTESTED  => 'Pagamento em processo de contestação.',
            self::STATUS_SETTLED    => 'Cobrança paga manualmente.',
            self::STATUS_CANCELED   => 'Cobrança cancelada.',
            default                 => 'Status de pagamento desconhecido.'
        };
        return $message;
    }

    public function cancelSubscription()
    {
        $this->getUserSubscription();

        $params = ['id' => $this->userSubscription->subscription_id];

        try {
            $api = new Gerencianet($this->options);
            $response = $api->cancelSubscription($params, []);
            $this->subscriptionService->tryDestroyUserSubscription($this->userSubscription->subscription_id);
        } catch (GerencianetException $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e->errorDescription]);
            die('Erro ao tentar cancelar assinatura na gerencianet');
        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Erro ao tentar cancelar assinatura');
        }
    }

    public function userHasSubscription(): bool
    {
        return $this->subscriptionService->userHasSubscription();
    }

    public function detailCharge(int $chargeID = null)
    {
        $params = ['id' => $chargeID];

        try {
            $api = new Gerencianet($this->options);
            $response = $api->detailCharge($params, []);
            //echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</pre>';
            return  $this->preparesChargeForView($response['data']);
        } catch (GerencianetException $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e->errorDescription]);
            die('Erro ao tentar detalhar a assinatura na Gerencianet');
        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Erro ao tentar detalhar a assinatura');
        }
    }

    public function userReachedAdvertsLimit(): bool
    {
        //verifica se o usuario logado tem assinatura válida
        if (!$this->userHasSubscription()) {
            return true;
        }

        //Busca os dados da assinatura quando o usuario tem uma
        $this->getUserSubscription();
        //Verifica se o tipo de assinatura é com cadastro de anuncios ilimitados
        if (is_null($countFeaturesAdverts = $this->userSubscription->features->adverts)) {
            return false;
        }

        //Contamos a quantidade de anuncios que o usuario logado tem
        $countUserAdverts = $this->countAllUserAdverts();

        //Verifica se a quantidade de anuncios que o usuario tem é maior ou igual a que ele contratou no momento da compra do plano
        if ($countUserAdverts >= $countFeaturesAdverts) {
            return true;
        }
        //O usuário ainda não atingiu a quantidade de anuncios que o plano dele permite. Pode continuar cadastrando
        return false;
    }



    public function countAllUserAdverts(bool $withDeleted = true, array $criteria = []): int
    {
        if (!$this->userHasSubscription()) {
            return 0;
        }
        return Factories::models(AdvertModel::class)->countAllUserAdverts($this->user->id, $withDeleted, $criteria);
    }


    /**::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
     * ::::::::::::::::: METODOS PRIVADOS :::::::::::::::::::::::::::::::::::::
     ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    private function defineSubscriptionSituation(array $details): bool
    {
        if (empty($details)) {
            return false;
        }
        $this->userSubscription->status     = $details['status'];
        $this->userSubscription->history    = $details;
        return $this->handleBillingHistory($details['history']);
    }

    private function handleBillingHistory(array $history): bool
    {
        $this->userSubscription->is_paid = false;
        $isPaid = false;

        foreach ($history as $charge) {
            $this->userSubscription->reason_charge = $this->reasonCharge($charge['status']);
            //Verifica se a assinatura está paga ou não com os dados vindos da gerencianet
            if ($charge['status'] == self::STATUS_PAID || $charge['status'] == self::STATUS_SETTLED) {
                //Assinatura está paga
                $isPaid = true;
                $this->userSubscription->is_paid = true;
                $this->userSubscription->charge_not_paid = null;
                $this->userSubscription->valid_until = date('Y-m-d H:i:s', time() + 3600); //60 minutos
            } else {
                //Assinatura não está paga
                $isPaid = false;
                $this->userSubscription->is_paid = false;
                $this->userSubscription->charge_not_paid = $charge['charge_id'];
                $this->userSubscription->valid_until = null;
                break;
            }
        }

        //Atualiza os dados da assinatura no banco de dados de acordo com o que foi verificado na gerencianet
        $this->subscriptionService->trySaveSubscription($this->userSubscription);
        //retorna o status da assinatura (true : false)
        return $isPaid;
    }

    private static function removeSessionData(): void
    {
        $data = [
            'intended',
            'choice',
        ];
        session()->remove($data);
    }

    private function preparesChargeForView(array $chargeData): object
    {
        $chargeData = esc($chargeData);
        $charge = new stdClass;
        $charge->charge_id          = $chargeData['charge_id'];
        $charge->payment_method     = $chargeData['payment']['method'];
        $charge->status             = $chargeData['status'];
        if (isset($chargeData['payment']['banking_billet'])) {
            $charge->url_pdf = $chargeData['payment']['banking_billet']['pdf']['charge'];
            $charge->expire_at     = date('d-m-Y', strtotime($chargeData['payment']['banking_billet']['expire_at']));
        }
        $charge->created_at         = date('d-m-Y', strtotime($chargeData['payment']['created_at']));
        $charge->history            = $chargeData['history'];
        return $charge;
    }
}
