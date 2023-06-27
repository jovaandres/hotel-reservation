<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Reservations extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'room_id'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'booking_code'  => ['type' => 'VARCHAR', 'constraint' => 255],
            'status'        => ['type' => 'ENUM', 'constraint' => "'pending', 'transferred', 'confirmed','rejected','canceled'", 'default' => 'pending'],
            'payment'       => ['type' => 'VARCHAR', 'constraint' => 255, 'default' => 'cash'],
            'transfer_evidence' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'check_in_date' => ['type' => 'DATE'],
            'check_out_date' => ['type' => 'DATE'],
            'total_price'   => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('room_id', 'room', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('reservation');
    }

    public function down()
    {
        $this->forge->dropTable('reservation');
    }
}
