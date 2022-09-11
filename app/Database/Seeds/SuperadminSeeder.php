<?php

namespace App\Database\Seeds;

use App\Entities\User;
use App\Models\UserModel;
use CodeIgniter\Config\Factories;
use CodeIgniter\Database\Seeder;
use Exception;

class SuperadminSeeder extends Seeder
{
    public function run()
    {
        try {
            $this->db->transStart();
            $user = new User([
                'username'          => 'ValterCouto',
                //'first_name'      => 'Valter',
                //'last_name'       => 'Couto Santos Junior',
                'email'             => 'superadmin@email.com',
                'password'          => '12345678',
                'email_verified_at' => date('Y-m-d H:i:s'),
            ]);
            $userID = Factories::models(UserModel::class)->insert($user);
            $this->createSuperadmin($userID);
            $this->db->transCommit();
            echo 'Superadmin VALTER COUTO criado com sucesso "\n"';
        } catch (\Exception $e) {
            print $e->getMessage();
        }
    }

    /**
     * Metodo que cria um superadmin
     *
     * @param integer $userID
     * @return void
     */
    private function createSuperadmin(int $userID)
    {
        //Instacia a classe de conexão com o banco de dados
        $db = \Config\Database::connect();
        //Cria o array com os dados do superadmin(no caso o user que foi criado acima)
        $superadmin = [
            'user_id' => $userID
        ];
        //Insere os dados do super admin na base de dados
        $db->table('superadmins')->insert($superadmin);
    }
}
