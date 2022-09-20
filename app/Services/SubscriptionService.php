<?php

namespace App\Services;

use App\Entities\Plan;
use App\Entities\Subscription;
use App\Models\SubscriptionModel;
use CodeIgniter\Config\Factories;
use stdClass;

class SubscriptionService
{

    private $user;
    private $subscriptionModel;

    public function __construct()
    {
        $this->user  = service('auth')->user() ?? auth('api')->user();
        $this->subscriptionModel = Factories::models(SubscriptionModel::class);
    }

    public function tryInsertSubscription(Plan $choosenPlan, array $data): bool
    {
        //Cria um objeto do Subscription da Entity
        $subscription = new Subscription();

        $subscription->user_id          = $this->user->id; //Pega o id do usuario logado
        $subscription->plan_id          = $choosenPlan->plan_id; //Pega os id do plano na gerencianet(não é a pk na minha tabela)
        $subscription->subscription_id  = $data['subscription_id']; //Pega o identificador da assinatura na gerencianet
        $subscription->status           = $data['status']; //Pega o identificador do status da assinatura na gerencianet
        $subscription->features         = $this->planFeatures($choosenPlan);
        return $this->trySaveSubscription($subscription);
    }

    public function trySaveSubscription(Subscription $subscription): bool
    {
        try {
            if ($subscription->hasChanged()) {
                $this->subscriptionModel->saveSubscription($subscription);
            }
            return true;
        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Error saving data on service');
        }
    }

    /** retorna a assinatura que o usuario logado tem no momento
     * @return object|null
     */
    public function getUserSubscription()
    {
        return $this->subscriptionModel->getUserSubscription();
    }

    //Verifica se usuario já tem uma assinatura
    public function userHasSubscription(): bool
    {
        return $this->getUserSubscription() !== null;
    }

    public function tryDestroyUserSubscription(int $subscriptionID)
    {
        try {
            return $this->subscriptionModel->destroyUserSubscrition($subscriptionID);
        } catch (\Exception $e) {
            die('Error on detroy on service');
        }
    }

    /**
     * metodo que retorna as caracteristicas do plano adquirido no momento da assinatura
     *
     * @param Plan $choosenPlan
     * @return object
     */
    private function planFeatures(Plan $choosenPlan): object
    {
        $features = new stdClass;
        $features->id               = $choosenPlan->id; //pega a pk na minha tabela
        $features->plan_id          = $choosenPlan->plan_id;
        $features->name             = $choosenPlan->name; //nome do plano
        $features->value            = $choosenPlan->value; //Valor do plano
        $features->value_details    = $choosenPlan->details(); //detalhes do plano 
        $features->adverts          = $choosenPlan->adverts; //Quantos anuncios podem ser cadastrados
        return $features;
    }
}
