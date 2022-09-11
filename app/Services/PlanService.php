<?php

namespace App\Services;

use App\Entities\Plan;
use App\Models\PlanModel;
use CodeIgniter\Config\Factories;
use InvalidArgumentException;

class PlanService
{
    private $planModel;
    private $gerencianetService;

    public function __construct()
    {
        $this->planModel            = Factories::models(PlanModel::class);
        $this->gerencianetService   = Factories::class(GerencianetService::class);
    }

    public function getAllPlans()
    {
        $plans = $this->planModel->findAll();

        $data = [];
        foreach ($plans as $plan) {
            $btnEdit = form_button(
                [
                    'data-id'   => $plan->id,
                    'id'        => 'btnUpdatePlan', //ID do html do elemento
                    'class'     => 'btn btn-warning me-2 mb-2'
                ],
                '<i class="bi bi-pencil-square me-1"></i>' . lang('App.btn_edit')
            );
            $btnArchive = form_button(
                [
                    'data-id'   => $plan->id,
                    'id'        => 'btnArchivePlan', //ID do html do elemento
                    'class'     => 'btn btn-dark  mb-2'
                ],
                '<i class="bi bi-archive me-1"></i>' . lang('App.btn_archive')
            );

            $data[] = [
                'code'              => $plan->plan_id,
                'name'              => $plan->name,
                'is_highlighted'    => $plan->isHighlighted(),
                'details'           => $plan->details(),
                'actions'           => $btnEdit . '' . $btnArchive,
            ];
        }
        return $data;
    }

    public function getAllPlansArchived()
    {
        $plans    = $this->planModel->onlyDeleted()->orderBy('id', 'DESC')->findAll();

        $data = [];
        foreach ($plans as $plan) {

            $btnRecover = form_button(
                [
                    'data-id'   => $plan->id,
                    'id'        => 'btnRecoverPlan', //ID do html do elemento
                    'class'     => 'btn btn-info me-2 mb-2'
                ],
                '<i class="bi bi-folder-symlink me-1"></i>' . lang('App.btn_recover')
            );
            $btnDelete = form_button(
                [
                    'data-id'   => $plan->id,
                    'id'        => 'btnDeletePlan', //ID do html do elemento
                    'class'     => 'btn btn-danger  mb-2'
                ],
                '<i class="bi bi-trash me-1"></i>' . lang('App.btn_delete')
            );

            $data[] = [
                'code'              => $plan->plan_id,
                'name'              => $plan->name,
                'is_highlighted'    => $plan->isHighlighted(),
                'details'           => $plan->details(),
                'actions'           => $btnRecover . '' . $btnDelete,
            ];
        }
        return $data;
    }

    public function getRecorrences(string $recorrence = null): string
    {
        $options    = [];
        $selected   = [];

        $options = [
            ''                      => lang('Plans.label_recorrence'), //option vazio
            Plan::OPTION_MONTHLY    => lang('Plans.text_monthly'),
            Plan::OPTION_QUARTERLY  => lang('Plans.text_quarterly'),
            Plan::OPTION_SEMESTER   => lang('Plans.text_semester'),
            Plan::OPTION_YEARLY     => lang('Plans.text_yearly'),
        ];

        //Criando um plano
        if (is_null($recorrence)) {
            return form_dropdown('recorrence', $options, $selected, ['class' => 'form-control']);
        }

        //Atualizando um plano existente
        $selected[] = match ($recorrence) {
            Plan::OPTION_MONTHLY    => Plan::OPTION_MONTHLY,
            Plan::OPTION_QUARTERLY  => Plan::OPTION_QUARTERLY,
            Plan::OPTION_SEMESTER   =>  Plan::OPTION_SEMESTER,
            Plan::OPTION_YEARLY     => Plan::OPTION_YEARLY,
            default                 => throw new InvalidArgumentException("Unsupported recorrence {$recorrence}")
        };
        return form_dropdown('recorrence', $options, $selected, ['class' => 'form-control']);
    }

    public function trySavePlan(Plan $plan, bool $protect = true)
    {
        try {

            $this->createOrUpdatePlanOnGeencianet($plan);
            if ($plan->hasChanged()) {
                $this->planModel->protect($protect)->save($plan);
            }
        } catch (\Exception $e) {
            die('Error on create data on service');
        }
    }

    public function getPlanByID(int $id, bool $withDeleted = false)
    {
        $plan = $this->planModel->withDeleted($withDeleted)->find($id);
        if (is_null($plan)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Plan not found');
        }
        return $plan;
    }

    public function tryArchivePlan(int $id)
    {
        try {
            $plan = $this->getPlanByID($id);
            $this->planModel->delete($plan->id);
        } catch (\Exception $th) {
            die('Ops! Erros on archive plan service');
        }
    }

    public function tryRecoverPlan(int $id)
    {
        try {
            $plan = $this->getPlanByID($id, withDeleted: true);
            $plan->recover();
            $this->planModel->protect(false)->save($plan);
        } catch (\Exception $th) {
            die('Ops! Erros on recover plan service');
        }
    }

    public function tryDeletePlan(int $id)
    {
        try {
            $plan = $this->getPlanByID($id, withDeleted: true);
            $this->gerencianetService->delelePlan($plan->plan_id);
            $this->planModel->delete($plan->id, purge: true);
        } catch (\Exception $th) {
            die('Ops! Error on delete plan service');
        }
    }

    /**
     * retorna os planos para a página pricing no site
     *  Busca todos os planos disponíveis para venda no site
     * ele não recupera planos que estejam excluídos ou arquivados     
     */
    public function getPlansToSell()
    {
        return $this->planModel->findAll();
    }

    /**
     * Busca os dados do plano que o cliente escolheu
     *
     * @param integer $planID     
     */
    public function getChoosenPlan(int $planID)
    {
        return $this->getPlanByID($planID);
    }


    private function createOrUpdatePlanOnGeencianet(Plan $plan)
    {
        //Verifica se está criando
        if (empty($plan->id)) {
            //Sim
            return $this->gerencianetService->createPlan($plan);
        }
        /**
         * Atualizando o plano
         * A Gerencianet só permite atualizar o nome do plano
         */
        if ($plan->hasChanged('name')) {
            return $this->gerencianetService->updatePlan($plan);
        }
    }
}
