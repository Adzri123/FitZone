<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTrainerTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'TrainerID' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'specialty' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
                'null' => false,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['active', 'inactive'],
                'default' => 'active',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        
        $this->forge->addKey('TrainerID', true);
        $this->forge->createTable('trainer');
    }

    public function down()
    {
        $this->forge->dropTable('trainer');
    }
} 