<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAdvertsTable extends Migration
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
            'category_id' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'      => true,
                'null'          => true,
            ],
            'code' => [
                'type'          => 'VARCHAR',
                'constraint'    => '128',
            ],
            'title' => [
                'type'          => 'VARCHAR',
                'constraint'    => '128',
            ],
            'description' => [
                'type'          => 'LONGTEXT',
            ],
            'price' => [
                'type'          => 'DECIMAL',
                'constraint'    => '10,2',
            ],
            'is_published' => [
                'type'      => 'BOOLEAN',
                'default'   => false,
                'null'      => false,
            ],
            'situation' => [
                'type'          => 'ENUM',
                'constraint'    => ['new', 'used'],
            ],
            //Address fields
            'zipcode' => [
                'type'          => 'VARCHAR',
                'constraint'    => '10',
            ],
            'street' => [
                'type'          => 'VARCHAR',
                'constraint'    => '140',
            ],
            'number' => [
                'type'          => 'VARCHAR',
                'constraint'    => '10',
                'null'          => true,
            ],
            'neighborhood' => [
                'type'          => 'VARCHAR',
                'constraint'    => '128',
            ],
            'city' => [
                'type'          => 'VARCHAR',
                'constraint'    => '140',
            ],
            'city_slug' => [
                'type'          => 'VARCHAR',
                'constraint'    => '140',
            ],
            'state' => [
                'type'          => 'VARCHAR',
                'constraint'    => '20',
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
            'deleted_at' => [
                'type'      => 'DATETIME',
                'null'      => true,
                'default'   => null,
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('title'); //Não permite que existam dois anuncios com o mesmo title
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('adverts');
    }

    public function down()
    {
        $this->forge->dropTable('adverts');
    }
}
