<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRecoverCodeTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'code' => [
                'type' => 'CHAR',
                'constraint' => 6
            ],
            'expired_at' => [
                'type' => 'DATETIME',
                'null' => false
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'user', 'id', 'RESTRICT', 'RESTRICT');
        $this->forge->createTable('recover_code');
    }

    public function down()
    {
        $this->forge->dropTable('recover_code');
    }
}
