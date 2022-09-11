<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableSubscriptions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'      => true,
            ],
            'subscription_id' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'      => true,
            ],
            'plan_id' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'      => true,
            ],
            'charge_not_paid' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'default'       => null,
                'null'          => true,
            ],
            'status' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
            ],
            'is_paid' => [
                'type'      => 'BOOLEAN',
                'default'   => false,
                'null'      => false,
            ],
            'valid_until' => [
                'type'      => 'DATETIME',
                'default'   => null,
                'null'      => true,
            ],
            'reason_charge' => [
                'type'          => 'VARCHAR',
                'constraint'    => '128',
                'default'       => null,
                'null'          => true,
            ],
            'history' => [ //Histórico de cobranças... dados serializados
                'type'          => 'LONGTEXT',
                'default'       => null,
                'null'          => true,
            ],
            'features' => [ //Caracteristicas do plano adquirido no momento da compra... dados serializados
                'type'          => 'LONGTEXT',
                'default'       => null,
                'null'          => true,
            ],
            'created_at' => [
                'type'      => 'DATETIME',
                'null'      => true,
                'default'   => null,
            ],
            'updated_at' => [
                'type'      => 'DATETIME',
                'null'      => true,
                'default'   => null,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('subscriptions');
    }

    public function down()
    {
        $this->forge->dropTable('subscriptions');
    }
}
