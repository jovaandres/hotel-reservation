<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Images extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'first_image' => ['type' => 'VARCHAR', 'constraint' => 255],
            'second_image' => ['type' => 'VARCHAR', 'constraint' => 255],
            'third_image' => ['type' => 'VARCHAR', 'constraint' => 255],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('images');
    }

    public function down()
    {
        $this->forge->dropTable('images');
    }
}
