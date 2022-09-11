<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use Exception;
use InvalidArgumentException;

class Plan extends Entity
{

    private const INTERVAL_MONTHLY      = 1; //MENSAL
    private const INTERVAL_QUARTERLY    = 3; //TRIMESTRAL
    private const INTERVAL_SEMESTER     = 6; //SEMESTRAL
    private const INTERVAL_YEARLY       = 12; //ANULA

    public const OPTION_MONTHLY      = 'monthly'; //MENSAL
    public const OPTION_QUARTERLY    = 'quarterly'; //TRIMESTRAL
    public const OPTION_SEMESTER     = 'semester'; //SEMESTRAL
    public const OPTION_YEARLY       = 'yearly'; //ANULA


    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'plan_id'           => 'integer', //retornará um inteiro
        'adverts'           => '?integer', //pode ser null, mas se for preenchido vai retornar um inteiro
        'is_highlighted'    => 'boolean', //retorna um boleano
    ];


    //=====================================================================================
    //METODOS MAGICOS
    //=====================================================================================

    //Retira a virgula do valor monetário para que seja armazenado no banco de dados
    public function setValue(string $value)
    {
        $this->attributes['value'] = str_replace(',', '', $value);
        return $this;
    }

    //Verifica se veio a quantidade de anuncios. se veio convert o valor informado para inteiro se não define como null
    public function setAdverts(string $adverts)
    {
        $this->attributes['adverts'] = $adverts ? (int) $adverts : null;
        return $this;
    }

    //Verifica se o plano selecionado é destacado de maneira true ou false
    public function setIsHighlighted(string $isHighlighted)
    {
        $this->attributes['is_highlighted'] = (bool)$isHighlighted;
        return $this;
    }

    //Verifica a periodicidade a ser cobrado pela gerencianet
    public function setIntervalRepeats()
    {
        //Gerencianet enviará a cobrança para o anunciante até que seja cancelado
        $this->repeats = null;
        $this->attributes['interval'] = match ($this->attributes['recorrence']) {
            'monthly'   => self::INTERVAL_MONTHLY,
            'quarterly' => self::INTERVAL_QUARTERLY,
            'semester'  => self::INTERVAL_SEMESTER,
            'yearly'    => self::INTERVAL_YEARLY,
            default     => throw new InvalidArgumentException("Unsupported {$this->attributes['recorrence']}")
        };
        return $this;
    }


    //recuperar plano setado como deletado
    public function recover()
    {
        $this->attributes['deleted_at'] = null;
    }

    public function isHighlighted()
    {
        return $this->attributes['is_highlighted'] ? lang('Plans.text_is_highlighted') : lang('Plans.text_no_highlighted');
    }

    public function adverts()
    {
        return $this->attributes['adverts'] ?? lang('Plans.text_unlimited_adverts');
    }


    public function details()
    {
        /**
         * @todo alterar conforme o idioma selecionado
         */
        return number_to_currency($this->value, 'BRL', 'pt-BR', 2) . ' /' . $this->recorrence;
    }
}
