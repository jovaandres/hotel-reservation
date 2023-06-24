<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldsToUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'is_admin' => [
                'type' => 'BOOLEAN',
                'default' => false
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'name');
        $this->forge->dropColumn('users', 'is_admin');
    }
}
