<?php

namespace App\Models;

use CodeIgniter\Model;

class MyBaseModel extends Model
{

    public function __construct()
    {
        //Construtor
        parent::__construct();
    }

    /**
     * Escapa os dados para previnir os ataques XSS
     * essa função escapa possíveis dados maliciosos
     * para a aplicação como um comando SQL em um input
     *
     * @param array $data     
     */
    protected function escapeDataXSS(array $data)
    {
        return esc($data);
    }


    /**
     * Metodo responsável em gerenciar queries sql mais complexas ou 
     * aquelas que o engine do codeigniter não suportaria.
     * com esse metodo posso mandar queries e serão executadas com tranquilidade 
     * sem a preocupação de ter uma exception de sql
     *
     */
    protected function setSQLMode()
    {
        $this->db->simpleQuery("set session sql_mode=''");
    }
}
