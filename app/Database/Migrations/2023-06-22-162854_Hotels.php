<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Hotels extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'        => ['type' => 'VARCHAR', 'constraint' => 100],
            'description' => ['type' => 'TEXT'],
            'address'     => ['type' => 'VARCHAR', 'constraint' => 255],
            'city'        => ['type' => 'VARCHAR', 'constraint' => 100],
            'phone'       => ['type' => 'VARCHAR', 'constraint' => 20],
            'email'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'image_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('image_id', 'images', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('hotel');
    }

    public function down()
    {
        $this->forge->dropTable('hotel');
    }
}
