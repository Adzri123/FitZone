<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TrainerSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'John Smith',
                'specialty' => 'Strength Training',
                'phone' => '123-456-7890',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Sarah Johnson',
                'specialty' => 'Cardio Fitness',
                'phone' => '234-567-8901',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Mike Davis',
                'specialty' => 'Yoga & Flexibility',
                'phone' => '345-678-9012',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Lisa Wilson',
                'specialty' => 'Weight Loss',
                'phone' => '456-789-0123',
                'status' => 'inactive',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'David Brown',
                'specialty' => 'CrossFit',
                'phone' => '567-890-1234',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('trainer')->insertBatch($data);
    }
} 