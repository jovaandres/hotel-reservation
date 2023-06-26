<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Rooms extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'              => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'hotel_id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'room_type'       => ['type' => 'ENUM', 'constraint' => "'standard','deluxe','suite'"],
            'occupancy'       => ['type' => 'INT', 'constraint' => 11],
            'price_per_night' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'created_at'      => ['type' => 'DATETIME', 'null' => true],
            'updated_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('hotel_id', 'hotel', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('room');
    }

    public function down()
    {
        $this->forge->dropTable('room');
    }
}
