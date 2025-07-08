<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateClassScheduleTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'scheduleID' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'trainerID' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'classID' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'schedule_date' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'start_time' => [
                'type' => 'TIME',
                'null' => false,
            ],
            'end_time' => [
                'type' => 'TIME',
                'null' => false,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['scheduled', 'completed', 'cancelled'],
                'default' => 'scheduled',
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
        
        $this->forge->addKey('scheduleID', true);
        $this->forge->addForeignKey('trainerID', 'trainer', 'TrainerID', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('classID', 'class', 'classID', 'CASCADE', 'CASCADE');
        $this->forge->createTable('class_schedule');
    }

    public function down()
    {
        $this->forge->dropTable('class_schedule');
    }
} 