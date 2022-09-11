<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use Fluent\Auth\Contracts\AuthenticatorInterface;
use Fluent\Auth\Contracts\AuthorizableInterface;
use Fluent\Auth\Contracts\HasAccessTokensInterface;
use Fluent\Auth\Contracts\ResetPasswordInterface;
use Fluent\Auth\Contracts\VerifyEmailInterface;
use Fluent\Auth\Facades\Hash;
use Fluent\Auth\Traits\AuthenticatableTrait;
use Fluent\Auth\Traits\AuthorizableTrait;
use Fluent\Auth\Traits\CanResetPasswordTrait;
use Fluent\Auth\Traits\HasAccessTokensTrait;
use Fluent\Auth\Traits\MustVerifyEmailTrait;

use App\Traits\AdvertAuthorizationTrait; //Meu trait

class User extends Entity implements
    AuthenticatorInterface,
    AuthorizableInterface,
    HasAccessTokensInterface,
    ResetPasswordInterface,
    VerifyEmailInterface
{
    use AuthenticatableTrait;
    use AuthorizableTrait;
    use CanResetPasswordTrait;
    use HasAccessTokensTrait;
    use MustVerifyEmailTrait;

    use AdvertAuthorizationTrait; //Usa o meu trait

    /**
     * Array of field names and the type of value to cast them as
     * when they are accessed.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'display_phone'     => 'boolean',
    ];

    /**
     * Fill set password hash.
     *
     * @return $this
     */
    public function setPassword(string $password)
    {
        $this->attributes['password'] = Hash::make($password);
        return $this;
    }

    public function flashMessageToUser()
    {
        if (session()->has('choice')) {
            return "Antes de prosseguir com a sua assinatura por favor complete o seu perfil. Você fará isso apenas uma vez";
        }
        return 'Por favor complete o seu perfil';
    }

    public function fullname()
    {
        return "{$this->name} {$this->last_name}";
    }
}
