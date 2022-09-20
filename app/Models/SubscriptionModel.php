<?php

namespace App\Models;

use App\Entities\Subscription;

class SubscriptionModel extends MyBaseModel
{
    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->user  = service('auth')->user() ?? auth('api')->user();
    }

    protected $table            = 'subscriptions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = Subscription::class;
    protected $useSoftDeletes   = false; //Não usaremos softDeletes nesse modelo
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'subscription_id',
        'plan_id',
        'charge_not_paid',
        'status',
        'history',
        'features',
        'is_paid',
        'valid_until',
        'reason_charge',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Recupera a assinatura/anunciante logado
     *
     * @return object|null
     */
    public function getUserSubscription()
    {
        return $this->where('user_id', $this->user->id)->first();
    }

    /**
     * Salva uma assinatura ao usuário logado
     *
     * @param Subscription $subscription
     * @return void
     */
    public function saveSubscription(Subscription $subscription)
    {
        try {
            $this->db->transStart();
            $this->save($subscription);
            $this->db->transCommit();
        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Error save data model subscriotion');
        }
    }


    /**
     * Metodo que remove do user logado a assinatura que esteja atrelada a ele
     *
     * @param integer $subscriptionID
     * @return boolean
     */
    public function destroyUserSubscrition(int $subscriptionID): bool
    {
        try {
            $this->db->transStart();
            $builder = $this;
            $builder->where('user_id', $this->user->id);
            $builder->where('subscription_id', $subscriptionID);
            $builder->delete();
            $this->db->transCommit();
            return true;
        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Error on destroy data');
        }
    }
}
