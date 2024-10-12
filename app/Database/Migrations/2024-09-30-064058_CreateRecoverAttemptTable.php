<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRecoverAttemptTable extends Migration
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
                'unsigned' => true,
                'null' => false
            ],
            'code' => [
                'type' => 'CHAR',
                'constraint' => 6,
                'null' => false
            ],
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
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
        $this->forge->createTable('recover_attempt');
    }

    public function down()
    {
        $this->forge->dropTable('recover_attempt');
    }
}
