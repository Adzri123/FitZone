<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEmailToTrainerTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('trainer', [
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
                'after' => 'specialty'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('trainer', 'email');
    }
} 