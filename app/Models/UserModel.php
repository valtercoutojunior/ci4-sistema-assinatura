<?php

namespace App\Models;

use CodeIgniter\Model;
use Faker\Generator;
use Fluent\Auth\Contracts\UserProviderInterface;
use App\Entities\User;
use Fluent\Auth\Traits\UserProviderTrait;

class UserModel extends Model implements UserProviderInterface
{
    use UserProviderTrait;

    /**
     * Name of database table
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The format that the results should be returned as.
     * Will be overridden if the as* methods are used.
     *
     * @var User
     */
    protected $returnType = User::class;

    /**
     * An array of field names that are allowed
     * to be set by the user in inserts/updates.
     *
     * @var array
     */
    protected $allowedFields = [
        'email',
        'username',
        'password',
        'email_verified_at',
        'remember_token',
        //Campos Gerencianet
        'name',
        'last_name',
        'cpf',
        'birth',
        'phone',
        'display_phone',
    ];

    /**
     * If true, will set created_at, and updated_at
     * values during insert and update routines.
     *
     * @var boolean
     */
    protected $useTimestamps = true;

    /**
     * Generate fake data.
     *
     * @return array
     */
    public function fake(Generator &$faker)
    {
        return [
            'email'             => $faker->unique()->email,
            'username'          => $faker->unique()->userName,
            'password'          => '12345678',
            'name'              => $faker->name(),
            'last_name'         => $faker->lastName(),
            'email_verified_at' => date('Y-m-d H:i:s')
        ];
    }

    public function getSuperadmin()
    {
        return $this->join('superadmins', 'superadmins.user_id = users.id')->first();
    }

    public function deleteUserAccount()
    {
        try {
            $this->db->transStart();
            $this->delete(service('auth')->user()->id, purge: true);
            $this->db->transCommit();
        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Error delete user account');
        }
    }
}
