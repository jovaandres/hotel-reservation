<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Reviews extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'hotel_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'rating'     => ['type' => 'INT', 'constraint' => 11],
            'comment'    => ['type' => 'TEXT'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('hotel_id', 'hotel', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('review');
    }

    public function down()
    {
        $this->forge->dropTable('review');
    }
}
